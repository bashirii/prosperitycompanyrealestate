<?php

namespace App\Livewire;

use App\Models\Property;
use App\Models\Team;
use App\Models\User;
use App\Service\FileUploadService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class PropertyLive extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $viewForm = false;

    public $keywords;
    public $property;
    public $user;
    
    public $youtube_link, $property_id, $description, $address, $location, $file, $area, $beds, $baths, $garages, $price, $agent_id;

    public $isEditMode = false;

    public $rules = [
        'property_id' => ['required','integer'],
        'description' => ['required','string'],
        'address'=>['required', 'string'],
        'location'=>['required', 'string'],
        'file' => ['nullable', 'required_if:isEditMode,false', 'image'],
        'youtube_link' => ['required', 'string'],
        'area' => ['required','integer'],
        'beds' => ['required','integer'],
        'baths' => ['required','integer'],
        'garages' => ['required','integer'],
        'price' => ['required','integer'],
        'agent_id' => ['required', 'string']
    ];

    public function mount()
    {
        $this->property = new Property();
    }

    public function save()
    {
        $this->validate();

        if ($this->isEditMode){

            if (!empty($this->file)){
                $file_path = ((new FileUploadService())->upload("property", $this->file));
                $this->property->img = $file_path;
            }
            $this->property->property_id = $this->property_id;
            $this->property->youtube_link = $this->youtube_link;
            $this->property->description = $this->description;
            $this->property->address = $this->address;
            $this->property->location = $this->location;
            $this->property->area = $this->area;
            $this->property->beds = $this->beds;
            $this->property->baths = $this->baths;
            $this->property->garages = $this->garages;
            $this->property->price = $this->price;
            $this->property->agent_id = $this->agent_id;

            $this->property->save();

            $this->dispatch('success_alert', 'property updated.');

        }else{
            $file_path = ((new FileUploadService())->upload("property", $this->file));

            $this->property->created_by = Auth::user()->id;
            $this->property->img = $file_path;

            $this->property->property_id = $this->property_id;
            $this->property->youtube_link = $this->youtube_link;
            $this->property->description = $this->description;
            $this->property->address = $this->address;
            $this->property->location = $this->location;
            $this->property->area = $this->area;
            $this->property->beds = $this->beds;
            $this->property->baths = $this->baths;
            $this->property->garages = $this->garages;
            $this->property->price = $this->price;
            $this->property->agent_id = $this->agent_id;

            $this->property->save();

            $this->dispatch('success_alert', 'property saved.');
        }

        $this->closeForm();

    }

    public function showForm()
    {
        $this->viewForm = true;
        $this->property = new Property();
        $this->isEditMode = false;
        $this->file = "";
    }

    public function closeForm()
    {
        $this->viewForm = false;
        $this->isEditMode = false;
        $this->property = new Property();
    }
    public function render()
    {
        $query = Property::query();

        if (!empty($this->keywords)) {
            $query->where(function ($query) {
                $query->where('property_id', 'like', '%' . $this->keywords . '%')
                    ->orWhere('description', 'like', '%' . $this->keywords . '%');
            });
        }

        $properties = $query->latest()->paginate(15);

        $agents = Team::latest()->get();

        return view('livewire.property-live', ['properties' => $properties, 'agents' => $agents ]);
    }


    public function showViewModal(Property $news)
    {
        $this->property = $news;
        $created_by = $this->property->created_by;
        $this->user = User::find($created_by);
        $this->property->created_by = $this->user->property_id;
        $this->emit('showViewModal');
    }

    public function deleteproperty()
    {
        $this->property->delete();
        $this->emit('closeDeleteModal');
        $this->dispatchBrowserEvent('success_alert', 'Successful.');
        $this->property = new Property();
    }



    public function showDeleteModal(Property $news)
    {
        $this->property = $news;
        $this->emit('showDeleteModal');
    }

    // public function prepareViewNews($id)
    // {
    //     $this->viewForm = true;
    //     $this->property = property::find($id);

    // }

    public function prepareEditProperty($id)
    {
        $this->viewForm = true;
        $this->isEditMode = true;
        $this->property = Property::find($id);

        $this->property->property_id = $this->property_id;
        $this->youtube_link = $this->property->youtube_link;
        $this->property->description = $this->description;
        $this->file = $this->property->img;
        $this->address = $this->property->address;
        $this->location = $this->property->location;
        $this->area = $this->property->area;
        $this->beds = $this->property->beds;
        $this->baths = $this->property->baths;
        $this->garages = $this->property->garages;
        $this->price = $this->property->price;
        $this->agent_id = $this->property->agent_id;

    }

}

