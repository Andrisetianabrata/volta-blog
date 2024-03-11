<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
// use Livewire\Livewire;


class AuthorPersonalDetails extends Component
{
    public $author;
    public $name, $username, $email, $birth, $city, $biography;
    // protected $listeners = ['AuthorProfileHeader' => '$refresh'];

    public function mount(){
        $this->author     = User::find(auth('web')->id());
        $this->name       = $this->author->name;
        $this->username   = $this->author->username;
        $this->email      = $this->author->email;
        $this->birth      = $this->author->birth;
        $this->city       = $this->author->city;
        $this->biography  = $this->author->biography;
        
    }
    public function UpdateDetails(){
        $this->validate([
            'name'=>'required|string',
            'username'=>'required|unique:users,username,'.auth('web')->id(),
            'birth'=>'nullable|date_format:d/m/Y'
        ]);

        User::where('id', auth('web')->id())->update([
            'name'=>$this->name,
            'username'=>$this->username,
            'birth'=>$this->birth,
            'city'=>$this->city,
            'biography'=>$this->biography
        ]);
        // Livewire.emit('AuthorProfileHeader');
        // session()->flash('success', 'Yayy your Profile has been updated');
        $this->emit('updateAuthorProfileHeader');
        $this->emit('updateTopHeader');
        toastr()->success('Yayy your Profile has been updated');
        // session()->flash('success', 'Your password has been update successfuly');
    }
    public function render()
    {
        return view('livewire.author-personal-details');
    }
}
