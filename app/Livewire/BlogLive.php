<?php

namespace App\Livewire;

use App\Models\Blog;
use App\Models\User;
use App\Service\FileUploadService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class BlogLive extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $viewForm = false;

    public $keywords;
    
    public $blog, $title, $preview_desc;

    public $user;

    public $file;

    public $isEditMode = false;

    public $rules = [
        // 'blog.date' => 'required|date|date_format:Y-m-d|after_or_equal:today',
        'title' => ['required', 'string'],
        'preview_desc' => ['required', 'string'],
        'file' => ['nullable','required_if:isEditMode,false', 'image']
    ];

    public function mount()
    {
        $this->blog = new Blog();
    }

    public function save()
    {
        $this->validate();

        if ($this->isEditMode){

            if (!empty($this->file)){
                $file_path = ((new FileUploadService())->upload("blog", $this->file));
                $this->blog->img = $file_path;
            }

            $this->blog->title = $this->title;
            $this->blog->preview_desc = $this->preview_desc;

            $this->blog->save();

            $this->dispatch('success_alert', 'Blog updated.');

        } else{
            $file_path = ((new FileUploadService())->upload("blog", $this->file));

            $this->blog->created_by = Auth::user()->id;
            $this->blog->img = $file_path;

            $this->blog->title = $this->title;
            $this->blog->preview_desc = $this->preview_desc;

            $this->blog->save();

            $this->dispatch('success_alert', 'Blog saved.');

        }

        $this->closeForm();

    }

    public function showForm()
    {
        $this->viewForm = true;
        $this->blog = new Blog();
        $this->isEditMode = false;
        $this->file = "";
    }

    public function closeForm()
    {
        $this->viewForm = false;
        $this->isEditMode = false;
        $this->blog = new Blog();
    }
    public function render()
    {
        $blogs = Blog::when(!empty($this->keywords), function ($query){
            $query->where('title', 'like', '%'. $this->keywords . '%')
                ->orWhere('preview_desc', 'like', '%'. $this->keywords . '%');
        })->latest()->paginate('15');
        return view('livewire.blog-live', ['blogs' => $blogs]);
    }

    public function showViewModal(Blog $news)
    {
        $this->blog = $news;
        $created_by = $this->blog->created_by;
        $this->user = User::find($created_by);
        $this->blog->created_by = $this->user->date;
        // $this->emit('showViewModal');
    }

    public function deleteBlog()
    {
        $this->blog->delete();
        // $this->emit('closeDeleteModal');
        $this->dispatchBrowserEvent('success_alert', 'Successful.');
        $this->blog = new Blog();
    }

    // public function Active_Inactive(int $blog_id)
    // {
    //     $is_active = Blog::find($blog_id)->is_active;

    //     if ($is_active) {
    //         blog::where('id',$blog_id)->update(['is_active', false]);
    //     } else {
    //         blog::where('id',$blog_id)->update(['is_active', true]);
    //     }


    //     // $this->blog->active();
    //     // $this->blog->Inative();
    //     // $this->emit('closeDeleteModal');
    //     // $this->dispatch('success_alert', 'Successful.');
    //     // $this->blog = new Blog();
    // }





    public function showDeleteModal(Blog $news)
    {
        $this->blog = $news;
        // $this->emit('showDeleteModal');
    }


    public function prepareEditBlog($id)
    {
        $this->viewForm = true;
        $this->isEditMode = true;
        $this->blog = Blog::find($id);

        $this->file = $this->blog->file;
        $this->blog->title = $this->title;
        $this->preview_desc + $this->blog->preview_desc;

    }

}

