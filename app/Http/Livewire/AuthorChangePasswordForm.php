<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthorChangePasswordForm extends Component
{
    public $current_password, $new_password, $confirm_password;
    public function UpdatePassword(){
        $this->validate([
            'current_password'=>['required', function($attribute, $value, $fail){
                if (!Hash::check($value, User::find(auth('web')->id())->password)) {
                    return $fail(__('The current password is incorrect'));
                }
            }],
            'new_password'=>['required', 'min:6', 'max:25', function($attribute, $value, $fail){
                if (Hash::check($value, User::find(auth('web')->id())->password)) {
                    return $fail(__('Must be different from the current password'));
                }
            }],
            'confirm_password'=>'same:new_password'
        ],[
            'current_password.required'=>'Enter your current password',
            'new_password.required'=>'Enter a new password'
        ]);
        $query = User::find(auth('web')->id())->update([
            'password'=>Hash::make($this->new_password)
        ]);

        if ($query) {
            // session()->flash('success', 'Your password has been update successfuly');
            toastr()->success('Your password has been update successfuly');
            $this->current_password = $this->new_password = $this->confirm_password = null;
        }else{
            // session()->flash('fail', 'Oops something went Wrong');
            toastr()->error('Oops something went Wrong');
        }
    }

    public function render()
    {
        return view('livewire.author-change-password-form');
    }
}
