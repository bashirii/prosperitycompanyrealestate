<?php

namespace App\Livewire;

use App\Models\Carousel;
use App\Models\User;
use App\Service\FileUploadService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class CarouselLive extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $viewForm = false;

    public $keywords;

    public $carousel;

    public $user;


    public $file, $name, $p_o_box, $address, $location, $price;
    public $item;

    public $isEditMode = false;

    public $rules = [
        'file' => ['nullable','required_if:isEditMode,false', 'image'],
        'name' => ['required','string'],
        'p_o_box' => ['required','integer'],
        'address' => ['required','string'],
        'location'=>['required', 'string'],
        'price'=>['required','integer'],

    ];

    public function mount()
    {
        $this->carousel = new carousel();
    }

    public function save()
    {
        $this->validate();

        if ($this->isEditMode){

            if (!empty($file_path)){
                $file_path = ((new FileUploadService())->upload("carousel-items", $this->file));
                $this->carousel->image = $file_path;
            }
            $this->carousel->name = $this->name;
            $this->carousel->p_o_box = $this->p_o_box;
            $this->carousel->address = $this->address;
            $this->carousel->location = $this->location;
            $this->carousel->price = $this->price;

            $this->carousel->save();

            $this->dispatch('success_alert', 'Carousel Item  updated.');

        }else{
            $file_path = ((new FileUploadService())->upload("carousel-items", $this->file));

            $this->carousel->created_by = Auth::user()->id;
            $this->carousel->image = $file_path;
            
            $this->carousel->name = $this->name;
            $this->carousel->p_o_box = $this->p_o_box;
            $this->carousel->address = $this->address;
            $this->carousel->location = $this->location;
            $this->carousel->price = $this->price;

            $this->carousel->save();

            $this->dispatch('success_alert', 'Carousel Item saved.');
        }

        $this->closeForm();

      }

    public function showForm()
    {
        $this->viewForm = true;
        $this->carousel = new carousel();
        $this->isEditMode = false;
        $this->file = "";
    }

    public function closeForm()
    {
        $this->viewForm = false;
        $this->isEditMode = false;
        $this->carousel = new carousel();
    }

    public function render()
    {
        $query = carousel::query();
        if (!empty($this->keywords)){
            $query->where(function ($query) {
                $query->Where('image', 'like', '%' . $this->keywords . '%')
                    ->orWhere('location', 'like', '%' . $this->keywords . '%');
            });
        }
        $carousels = carousel::latest()->paginate(15);

        return view('livewire.carousel-live', ['carousels' => $carousels]);
    }

    public function showViewModal(carousel $item)
    {
        $this->carousel = $item;
        $created_by = $this->carousel->created_by;
        $this->user = User::find($created_by);
        $this->carousel->created_by = $this->user->name;
        // $this->emit('showViewModal');
    }

    public function deleteCarousel()
    {
        $this->carousel->delete();
        // $this->emit('closeDeleteModal');
        $this->dispatch('success_alert', 'Successful.');
        $this->carousel = new carousel();
    }

    public function showDeleteModal(carousel $item)
    {
        $this->carousel = $item;
        // $this->emit('showDeleteModal');
    }

    public function prepareEditCarousel($id)
    {
        $this->viewForm = true;
        $this->isEditMode = true;
        $this->carousel = carousel::find($id);

        $this->name = $this->carousel->name;
        $this->file = $this->carousel->image;
        $this->p_o_box = $this->carousel->p_o_box;
        $this->address = $this->carousel->address;
        $this->location = $this->carousel->location;
        $this->price = $this->carousel->price;

    }
}
