<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\User;
use Flasher\Laravel\Http\Request;

class AuthorLoginForm extends Component
{
    public $returnUrl;
    public $login_id, $password;
    public function mount()
    {
        $this->returnUrl = request()->ReturnUrl;
    }
    public function LoginHandler()
    {
        // dd(($this->returnUrl) ? 'true' : 'false');
        $fieldtype = filter_var($this->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        if ($fieldtype == 'email') {
            $this->validate([
                'login_id' => 'required|email',
                'password' => 'required|min:6',

            ], [
                'login_id' => 'Email or Username is required',
                'login_id.email' => 'Invalid email address',
                'password.required' => 'Password is required'
            ]);
        } else {
            $this->validate([
                'login_id' => 'required|min:3',
                'password' => 'required|min:6',

            ], [
                'login_id' => 'Email or Username is required',
                // 'login_id.email' => 'Invalid email address',
                'password.required' => 'Password is required'
            ]);
        }

        $creds = array($fieldtype => $this->login_id, 'password' => $this->password);
        if (Auth::guard('web')->attempt($creds)) {
            $checkUser = User::where($fieldtype, $this->login_id)->first();
            if ($checkUser->blocked == 1) {
                Auth::guard('web')->logout();
                return redirect()->route('author.login')->with('fail', 'Your Account has been blocked by Admin');
            } else {
                if ($this->returnUrl) {
                    return redirect()->to($this->returnUrl);
                }else{
                    redirect()->route('author.home');
                }
            }
        } else {
            session()->flash('fail', 'Incorrect Email/Username or Pasword');
        }
    }

    public function render()
    {
        return view('livewire.author-login-form');
    }
}
