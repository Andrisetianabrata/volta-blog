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

        // DB::table('password_reset_tokens')->insert([
        //     'email'=>$this->email,
        //     'token'=>$token,
        //     'created_at'=>Carbon::now()
        // ]);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $this->email], // where clause
            [
                'token' => $token,
                'created_at' => Carbon::now()
            ]
        );
        
        // Hapus token lama jika ada
        // DB::table('password_reset_tokens')
        // ->where('email', $this->email)
        // ->delete();

        // // Buat token baru
        // DB::table('password_reset_tokens')->insert([
        //     'email' => $this->email,
        //     'token' => $token,
        //     'created_at' => Carbon::now()
        // ]);
        
        $user = User::where('email', $this->email)->first();
        $link = route('author.reset-form', ['token'=>$token, 'email'=>$this->email]);
        

        $data = array(
            'name'=>$user->name,    
            'link'=>$link        
        );

        Mail::send('forgot-email-template', $data, function($message) use ($user){
            $message->from('no-reply@bratas.my.id', 'VOLTA');
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
