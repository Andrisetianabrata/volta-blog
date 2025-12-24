<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
// use Livewire\Livewire;


class AuthorPersonalDetails extends Component
{
    use WithFileUploads;
    public $author;
    public $name, $username, $email, $birth, $city, $biography, $user_banner;
    protected $listeners = ['updateAuthorProfileHeader' => '$refresh'];
    public $current_password, $new_password, $confirm_password;
    
    public function mount(){
        $this->author     = User::find(auth('web')->id());
        $this->name       = $this->author->name;
        $this->username   = $this->author->username;
        $this->email      = $this->author->email;
        $this->birth      = $this->author->birth;
        $this->city       = $this->author->city;
        $this->biography  = $this->author->biography;
        
    }
    
    public function changePassword()
    {
        $this->dispatchBrowserEvent('showChangePassword');
    }
    
    public function deleteAuthorPictureFile()
    {
        $user = User::find(auth('web')->id());
        if ($user->update(['picture' => null])) {
            toastr()->success('Profile picture has been deleted');
            return redirect()->route('author.profile');
        } else {
            return redirect()->route('author.profile');
        }
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
            toastr()->success('Your password has been update successfuly');
            $this->current_password = $this->new_password = $this->confirm_password = null;
            $this->dispatchBrowserEvent('hideChangePassword');
        }else{
            toastr()->error('Oops something went Wrong');
        }
    }

    public function uploadBanner()
    {
        // $this->validate([
        //     'user_banner'=>'mimes:jpeg,jpg,png|max:2048',
        // ]);
        $user = User::find(auth('web')->id());
        $oldFile = 'images/banner/'.DB::table('users')->where('id', auth('web')->id())->value('banner');
        
        $fileName = $this->user_banner->getClientOriginalName();
        // dd($fileName);
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        $thumbnailSlug = $user->username.'-'.uniqid().'-'.Str::slug(pathinfo($fileName, PATHINFO_FILENAME)).'.'.$extension;
        
        $image = Image::make($this->user_banner);
        $width = $image->getWidth();
        $height = $image->getHeight();

        $aspectRatio = 2 / 1;
        $cropWidth = $width;
        $cropHeight = round($cropWidth / $aspectRatio);
        if ($cropHeight > $height) {
            $cropHeight = $height;
            $cropWidth = $cropHeight * $aspectRatio;
        }

        $x = round(($width - $cropWidth) / 2);
        $y = round(($height - $cropHeight) / 2);
        $croppedImage = $image->crop($cropWidth, $cropHeight, $x, $y);
        $saved = Storage::disk('public')->put('images/banner/'.$thumbnailSlug, $croppedImage->stream());
        Storage::disk('public')->delete($oldFile);
        if ($saved) {
            $user->update([
                'banner' => $thumbnailSlug
            ]);
            toastr()->success('Yayy banner upload success');
            $this->dispatchBrowserEvent('hideUploadBannerModal');
        }else{
            toastr()->error('Opps somthing wrong');
        }
    }
    
    public function deleteBanner()
    {
        $user = User::find(auth('web')->id());
        $oldFile = 'images/banner/'.DB::table('users')->where('id', auth('web')->id())->value('banner');
        
        $user->update([
            'banner' => null
        ]);
        Storage::disk('public')->delete($oldFile);
        toastr()->success('Banner delete success');
    }
    
    public function render()
    {
        return view('livewire.author-personal-details');
    }
}
