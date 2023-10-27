<?php

namespace App\Livewire;

use App\Models\Team;
use App\Models\User;
use App\Service\FileUploadService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class TeamLive extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $viewForm = false;

    public $keywords;
    public $agent;
    public $user;

    public $file;

    public $destination_id;

    public $facebook_link, $name, $email, $phone, $description;
    public $twitter_link;
    //public $linkedin_link;
    public $instagram_link;



    public $isEditMode = false;

    public $rules = [
        'name' => ['required', 'string'],
        'email' => 'required|email',
        'phone' => ['required', 'string'],
        'file' => ['nullable','required_if:isEditMode,false', 'image'],
        'description' => ['required', 'string'],
        'facebook_link' => ['nullable', 'string'],
        'twitter_link' => ['nullable', 'string'],
        'instagram_link' => ['nullable', 'string'],
        //'linkedin_link' => ['nullable', 'string'],
    ];

    public function mount()
    {
        $this->agent = new Team();
    }

    public function save()
    {
        $this->validate();

        if ($this->isEditMode){

            if (!empty($this->file)){
                $file_path = ((new FileUploadService())->upload("Team", $this->file));
                $this->agent->img = $file_path;
                
            }

            $this->agent->name = $this->name;
            $this->agent->phone = $this->phone;
            $this->agent->email = $this->email;
            $this->agent->description = $this->description;
            $this->agent->facebook_link = $this->facebook_link;
            $this->agent->twitter_link = $this->twitter_link;
            $this->agent->instagram_link = $this->instagram_link;
            //$this->agent->linkedin_link = $this->linkedin_link;

            $this->agent->save();

            $this->dispatch('success_alert', 'Agent updated.');

        }else{
            $file_path = ((new FileUploadService())->upload("Team", $this->file));

            $this->agent->created_by = Auth::user()->id;
            $this->agent->img = $file_path;

            $this->agent->name = $this->name;
            $this->agent->phone = $this->phone;
            $this->agent->email = $this->email;
            $this->agent->description = $this->description;
            $this->agent->facebook_link = $this->facebook_link;
            $this->agent->twitter_link = $this->twitter_link;
            $this->agent->instagram_link = $this->instagram_link;
            //$this->agent->linkedin_link = $this->linkedin_link;

            $this->agent->save();

            $this->dispatch('success_alert', 'Agent saved.');
        }

        $this->closeForm();

    }

    public function showForm()
    {
        $this->viewForm = true;
        $this->agent = new Team();
        $this->isEditMode = false;
        $this->file = "";
    }

    public function closeForm()
    {
        $this->viewForm = false;
        $this->isEditMode = false;
        $this->agent = new Team();
    }
    public function render()
    {
        $team = Team::when(!empty($this->keywords), function ($query){
            $query->where('name', 'like', '%'. $this->keywords . '%')
                ->orWhere('email', 'like', '%'. $this->keywords . '%');
        })->latest()->paginate('15');
        return view('livewire.team-live', ['team' => $team]);
    }

    public function showViewModal(Team $news)
    {
        $this->agent = $news;
        $created_by = $this->agent->created_by;
        $this->user = User::find($created_by);
        $this->agent->created_by = $this->user->name;
        // $this->emit('showViewModal');
    }

    public function deleteAgent()
    {
        $this->agent->delete();
        // $this->emit('closeDeleteModal');
        $this->dispatch('success_alert', 'Successful.');
        $this->agent = new Team();
    }



    public function showDeleteModal(Team $news)
    {
        $this->agent = $news;
        // $this->emit('showDeleteModal');
    }


    public function prepareEditAgent($id)
    {
        $this->viewForm = true;
        $this->isEditMode = true;
        $this->agent = Team::find($id);

        $this->name = $this->agent->name;
        $this->file = $this->agent->image;
        $this->phone = $this->agent->phone;
        $this->email = $this->agent->email;
        $this->description = $this->agent->description;
        $this->facebook_link = $this->agent->facebook_link;
        $this->instagram_link = $this->agent->instagram_link;
        $this->twitter_link = $this->agent->twitter_link;
        //$this->linkedin_link = $this->agent->linkedin_link;

    }

}

