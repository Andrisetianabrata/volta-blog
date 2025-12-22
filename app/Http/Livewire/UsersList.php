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

    private function currentUser()
    {
        return auth('web')->user();
    }

    private function isOwner()
    {
        $u = $this->currentUser();
        return $u && $u->type == 1;
    }

    private function isAdmin()
    {
        $u = $this->currentUser();
        return $u && $u->type == 2;
    }

    private function unauthorizedResponse($message = 'You are not authorized to perform this action.')
    {
        toastr()->error($message);
        return false;
    }
    public function addUser()
    {
        $current = $this->currentUser();
        if (!$current || $current->type == 3) {
            return $this->unauthorizedResponse('You are not allowed to create users.');
        }
        $this->validate([
            'name' => 'required|max:25',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username|min:3|max:16',
            'user_type' => 'required',
        ]);

        if ($this->user_type == 1 && !$this->isOwner()) {
            return $this->unauthorizedResponse('Only Owner can create Owner accounts.');
        }

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
                $message->from('no-reply@bratas.my.id', 'VOLTA');
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
        $target = User::find($user['id']);
        if (!$target) {
            toastr()->error('User not found.');
            return;
        }

        $current = $this->currentUser();
        if (!$current) {
            return $this->unauthorizedResponse();
        }

        if ($current->id == $target->id) {
            return $this->unauthorizedResponse('You cannot edit your own account from here.');
        }

        if ($this->isOwner()) {
            // owner can edit others
        } elseif ($this->isAdmin()) {
            if (!in_array($target->type, [2,3])) {
                return $this->unauthorizedResponse('Admins cannot edit Owner accounts.');
            }
        } else {
            return $this->unauthorizedResponse();
        }

        $this->selectedUserId = $target->id;
        $this->name = $target->name;
        $this->email = $target->email;
        $this->username = $target->username;
        $this->user_type = $target->type;
        $this->blocked = $target->blocked;
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
            $target = User::find($this->selectedUserId);
            if (!$target) {
                toastr()->error('User not found.');
                return;
            }

            $current = $this->currentUser();
            if (!$current) {
                return $this->unauthorizedResponse();
            }

            if ($current->id == $target->id) {
                return $this->unauthorizedResponse('You cannot edit your own account from here.');
            }

            if ($this->isOwner()) {
                // owner may update
            } elseif ($this->isAdmin()) {
                if (!in_array($target->type, [2,3])) {
                    return $this->unauthorizedResponse('Admins cannot update Owner accounts.');
                }
            } else {
                return $this->unauthorizedResponse();
            }

            if ($this->user_type == 1 && !$this->isOwner()) {
                return $this->unauthorizedResponse('Only Owner can set Owner user type.');
            }

            $target->update([
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
        $target = User::find($users['id']);
        if (!$target) {
            toastr()->error('User not found.');
            return;
        }

        $current = $this->currentUser();
        if (!$current) {
            return $this->unauthorizedResponse();
        }

        if ($current->id == $target->id) {
            return $this->unauthorizedResponse('You cannot delete your own account.');
        }

        if ($this->isOwner()) {
            // owner may delete
        } elseif ($this->isAdmin()) {
            if (!in_array($target->type, [2,3])) {
                return $this->unauthorizedResponse('Admins cannot delete Owner accounts.');
            }
        } else {
            return $this->unauthorizedResponse();
        }

        $path = 'back/dist/img/authors/';
        $this->selectedUserPicture = $target->getAttributes()['picture'];
        $this->selectedFullPath = $path . $this->selectedUserPicture;
        $this->selectedUserId = $target; // keep model for delete action

        $this->dispatchBrowserEvent('showDeleteUser');
    }
    
    public function deleteUserAction()
    {
        $user = $this->selectedUserId;
        if (is_numeric($user)) {
            $user = User::find($user);
        }
        if (!$user) {
            toastr()->error('User not found.');
            return;
        }

        $current = $this->currentUser();
        if (!$current) {
            return $this->unauthorizedResponse();
        }

        if ($current->id == $user->id) {
            return $this->unauthorizedResponse('You cannot delete your own account.');
        }

        if ($this->isOwner()) {
            // allowed
        } elseif ($this->isAdmin()) {
            if (!in_array($user->type, [2,3])) {
                return $this->unauthorizedResponse('Admins cannot delete Owner accounts.');
            }
        } else {
            return $this->unauthorizedResponse();
        }

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
            'currentUser' => auth('web')->user(),
        ]);
    }
}
