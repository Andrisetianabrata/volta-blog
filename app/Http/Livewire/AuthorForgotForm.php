<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthorForgotForm extends Component
{
    public $email;

    public function ForgotHandler()
    {
        $this->validate([
            'email' => 'required|exists:users,email|email:rfc,dns'
        ],[
            // 'email.required'=>'The :atribute is required',
            'email.email'=>'Invalid email address',
            'email.exists'=>'Email is not registered',
        ]);
        $token = base64_encode(Str::random(64));
        DB::table('password_reset_tokens')->insert([
            'email'=>$this->email,
            'token'=>$token,
            'created_at'=>Carbon::now()
        ]);
        $user = User::where('email', $this->email)->first();
        $link = route('author.reset-form', ['token'=>$token, 'email'=>$this->email]);
        $body_message = 'Kami menerima Request reset password untuk akun <b>VOLTA</b> anda<br>untuk mereset akun anda klik link di bawah ini</br>';
        $body_message .= '<br>';
        $body_message .= '<a href="'.$link.'">'.$link.'</a>';
        $body_message .= '</br>';
        $body_message .= 'Abaikan email ini jika anda tidak merasa meminta reset password';

        $data = array(
            'name'=>$user->name,    
            'body_message'=>$body_message        
        );

        Mail::send('forgot-email-template', $data, function($message) use ($user){
            $message->from('noreply@example.com', 'VOLTA');
            $message->to($user->email, $user->name)
                    ->subject('Reset Password');
        });

        $this->email = null;
        // session()->flash('success', 'Kami telah mengirm ada email pemulihan');
        toastr()->success('Kami telah mengirm ada email pemulihan');
    }

    public function render()
    {
        return view('livewire.author-forgot-form');
    }
}
