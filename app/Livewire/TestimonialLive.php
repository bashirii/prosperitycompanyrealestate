<?php

namespace App\Livewire;

use App\Models\Testimonial;
use App\Models\User;
use App\Service\FileUploadService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class TestimonialLive extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $viewForm = false;

    public $keywords;
    public $Testimonial, $name, $preview_desc;
    public $user;


    public $file;

    public $isEditMode = false;

    public $rules = [
        'name' => ['required', 'string'],
        'preview_desc' => ['required', 'string'],
        'file' => ['nullable','required_if:isEditMode,false', 'image']
    ];

    public function mount()
    {
        $this->Testimonial = new Testimonial();
    }

    public function save()
    {
        $this->validate();

        if ($this->isEditMode){

            if (!empty($this->file)){
                $file_path = ((new FileUploadService())->upload("testimonials", $this->file));
                $this->Testimonial->img = $file_path;
            }

            $this->Testimonial->name = $this->name;
            $this->Testimonial->preview_desc = $this->preview_desc;

            $this->Testimonial->save();

            $this->dispatch('success_alert', 'Testimonial updated.');

        }else{
            $file_path = ((new FileUploadService())->upload("testimonials", $this->file));

            $this->Testimonial->created_by = Auth::user()->id;
            $this->Testimonial->img = $file_path;

            $this->Testimonial->name = $this->name;
            $this->Testimonial->preview_desc = $this->preview_desc;

            $this->Testimonial->save();

            $this->dispatch('success_alert', 'Testimonial saved.');
        }

        $this->closeForm();

    }

    public function showForm()
    {
        $this->viewForm = true;
        $this->Testimonial = new Testimonial();
        $this->isEditMode = false;
        $this->file = "";
    }

    public function closeForm()
    {
        $this->viewForm = false;
        $this->isEditMode = false;
        $this->Testimonial = new Testimonial();
    }
    public function render()
    {
        $query = Testimonial::query();

        if (!empty($this->keywords)) {
            $query->where(function ($query) {
                $query->where('name', 'like', '%' . $this->keywords . '%')
                    ->orWhere('preview_desc', 'like', '%' . $this->keywords . '%');
            });
        }

        $client = $query->latest()->paginate(15);

        return view('livewire.testimonial-live', ['client' => $client]);
    }


    public function showViewModal(Testimonial $news)
    {
        $this->Testimonial = $news;
        $created_by = $this->Testimonial->created_by;
        $this->user = User::find($created_by);
        $this->Testimonial->created_by = $this->user->name;
        // $this->emit('showViewModal');
    }

    public function deleteTestimonial()
    {
        $this->Testimonial->delete();
        // $this->emit('closeDeleteModal');
        $this->dispatchBrowserEvent('success_alert', 'Successful.');
        $this->Testimonial = new Testimonial();
    }



    public function showDeleteModal(Testimonial $news)
    {
        $this->Testimonial = $news;
        // $this->emit('showDeleteModal');
    }

    // public function prepareViewNews($id)
    // {
    //     $this->viewForm = true;
    //     $this->Testimonial = Testimonial::find($id);

    // }

    public function prepareEditTestimonial($id)
    {
        $this->viewForm = true;
        $this->isEditMode = true;
        $this->Testimonial = Testimonial::find($id);

        $this->name = $this->Testimonial->name;
        $this->preview_desc = $this->Testimonial->preview_desc;
        $this->file = $this->Testimonial->img;

    }

}
