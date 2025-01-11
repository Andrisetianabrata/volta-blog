<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class AuthorResetForm extends Component
{
    public $email, $new_password, $confirm_new_password, $token;
    
    public function mount(){
        $this->email = request()->email;
        $this->token = request()->token;
    }

    public function ResetHandler(){
        $this->validate([
            'email'=>'required|email|exists:users,email',
            'new_password'=>'required|min:6',
            'confirm_new_password'=>'same:new_password'
        ],[
            'new_password.required' => 'The password cannot be empty',
            'new_password.min' => 'Password must be at least 6 characters.'
        ]);

        $check_token = DB::table('password_reset_tokens')->where([
            'email'=>$this->email,
            'token'=>$this->token
        ])->first();

        if (!$check_token) {
            session()->flash('fail', 'Invalid Token!');
        }else{
            User::where('email', $this->email)->update([
                'password'=>Hash::make($this->new_password)
            ]);
            DB::table('password_reset_tokens')->where([
                'email'=>$this->email
            ])->delete();
            $success_token = Str::random(64);
            session()->flash('success', 'Your password has been update successfuly');
            $this->redirectRoute('author.login', ['tkn'=>$success_token, 'UEmail'=>$this->email]);
        }
    }

    public function render()
    {
        return view('livewire.author-reset-form');
    }
}
