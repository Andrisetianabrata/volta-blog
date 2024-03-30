<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Nette\Utils\Random;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UsersList extends Component
{
    use WithPagination;
    public $name, $username, $email, $user_type;
    public $search = '';
    public $perpage = 8;
    public $blocked = 0;
    public $selectedUserId;
    public $selectedFullPath;
    public $selectedUserPicture;
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
            'username' => 'required|unique:users,username|min:3|max:16',
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
            Mail::send('new-user-mail-template', $data, function ($message) use ($user_email, $user_name) {
                $message->from('noreply@example.com', 'VOLTA');
                $message->to($user_email, $user_name)->subject('New Account');
            });
            toastr()->success('Yayy new User has been created.');
            $this->name = $this->username = $this->email = $this->user_type = null;
            $this->resetErrorBag();
        } else {
            toastr()->error('Opss something wrong.');
        }
    }

    public function editUser($user)
    {
        // dd($user);
        $this->selectedUserId = $user['id'];
        $this->name = $user['name'];
        $this->email = $user['email'];
        $this->username = $user['username'];
        $this->user_type = $user['type'];
        $this->blocked = $user['blocked'];
        $this->dispatchBrowserEvent('showModalEdit');
    }

    public function updateUser()
    {
        $this->validate([
            'name' => 'required|max:25',
            'email' => 'required|email|unique:users,email,' . $this->selectedUserId,
            'username' => 'required|min:3|max:16|unique:users,username,' . $this->selectedUserId,
            'user_type' => 'required',
        ]);

        if ($this->selectedUserId) {
            $user = User::find($this->selectedUserId);
            $user->update([
                'name' => $this->name,
                'username' => $this->username,
                'email' => $this->email,
                'type' => $this->user_type,
                'blocked' => $this->blocked,
            ]);
            toastr()->success('User has been updated.');
            $this->dispatchBrowserEvent('hideModalEdit');
        }
    }


    public function deleteUser($users)
    {
        // dd($this->isOnline());
        $this->selectedUserId = User::find($users['id']);
        // dd($users);
        $path = 'back/dist/img/authors/';
        $this->selectedUserPicture = $this->selectedUserId->getAttributes()['picture'];
        $this->selectedFullPath = $path.$this->selectedUserPicture;

        $this->dispatchBrowserEvent('showDeleteUser');
    }
    
    public function deleteUserAction()
    {
        $user = $this->selectedUserId;
        $user->delete();
        if ($this->selectedUserPicture != null || File::exists(public_path($this->selectedFullPath))) {
            File::delete(public_path($this->selectedFullPath));
        }
        $this->name = $this->selectedUserPicture = $this->selectedFullPath = $this->username = $this->email = $this->user_type = $this->selectedUserId = null;
        $this->resetErrorBag();
        toastr()->success('User has been deleted.');
    }

    public function render()
    {
        return view('livewire.users-list', [
            'users' => User::search(trim($this->search))
                        ->orderBy('type', 'ASC')
                        ->paginate($this->perpage),
            // 'userSelectedDelete' => User::find()
        ]);
    }
}
