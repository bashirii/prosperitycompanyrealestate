<?php

namespace App\Livewire;

use App\Models\Property;
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
    public $name;
    public $price;


    public $file;

    public $isEditMode = false;
    public $rules = [
        'address' => ['required','interger'],
        'location'=>['required'],
        'file' => ['nullable', 'required_if:isEditMode,false', 'image'],
        'area' => 'required|integer',
        'beds' => 'required|integer',
        'baths' => 'required|integer',
        'garages' => 'required|integer',
        'price' => 'required|regex:/^\d+(\.\d{1,2})?$/',
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
            $this->property->save();

            $this->dispatchBrowserEvent('success_alert', 'property updated.');

        }else{
            $file_path = ((new FileUploadService())->upload("property", $this->file));

            $this->property->created_by = Auth::user()->id;
            $this->property->img = $file_path;

            $this->property->save();

            $this->dispatchBrowserEvent('success_alert', 'property saved.');
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
                $query->where('name', 'like', '%' . $this->keywords . '%')
                    ->orWhere('preview_desc', 'like', '%' . $this->keywords . '%');
            });
        }

        $property = $query->latest()->paginate(15);

        return view('livewire.property-live', ['property' => $property]);
    }


    public function showViewModal(Property $news)
    {
        $this->property = $news;
        $created_by = $this->property->created_by;
        $this->user = User::find($created_by);
        $this->property->created_by = $this->user->name;
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

    public function prepareEditproperty($id)
    {
        $this->viewForm = true;
        $this->isEditMode = true;
        $this->property = Property::find($id);

    }

}

