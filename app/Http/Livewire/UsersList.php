<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Nette\Utils\Random;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Livewire\WithPagination;

class UsersList extends Component
{
    use WithPagination;
    public $name, $username, $email, $user_type;
    public $search = '';
    public $perpage = 8;
    public $selectedUserId;
    public $blocked = 0;
    public function resetForm()
    {
        $this->name = $this->username = $this->email = $this->user_type = null;
        $this->resetErrorBag();
    }
    public function addUser()
    {
        $this->validate([
            'name' => 'required|max:25',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username|min:3',
            'user_type' => 'required',
        ]);

        $default_password = Random::generate(6);
        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->username = $this->username;
        $user->password = Hash::make($default_password);
        $user->type = $this->user_type;
        $saved = $user->save();

        $data = array(
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'password' => $default_password,
            'url' => route('author.profile')
        );

        $user_email = $this->email;
        $user_name = $this->name;

        if ($saved) {
            // Mail::send('new-user-mail-template', $data, function ($message) use ($user_email, $user_name) {
            //     $message->from('noreply@example.com', 'VOLTA');
            //     $message->to($user_email, $user_name)->subject('New Account');
            // });
            toastr()->success('Yayy new User has been created.');
            $this->name = $this->username = $this->email = $this->user_type = null;
            $this->resetErrorBag();
            
        } else {
            toastr()->error('Opss something wrong.');
        }
    }

    public function editUser($user){
        dd($user);
        $this->dispatch('showModalEdit');
    }

    public function render()
    {
        return view('livewire.users-list', [
            'users' => User::where('name', 'like', '%'.$this->search.'%')->orderBy('type', 'ASC')->paginate($this->perpage)
        ]);
    }
}
