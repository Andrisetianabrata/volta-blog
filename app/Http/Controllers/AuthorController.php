<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\User;

use Livewire\Attributes\On;
use Livewire\Livewire;

// use Intervention\Image\Facades\Image as Image;


class AuthorController extends Controller
{
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

    public function changeAuthorPictureFile(Request $request)
    {
        $user = User::find(auth('web')->id());

        $path = 'back/dist/img/authors/';
        if (!File::exists(public_path($path))) {
            File::makeDirectory(public_path($path), 0777, true);
        }
        $file = $request->file('file');
        $new_image_name = 'user-' . $user->username . date('-Ymd') . uniqid() . '.jpg';
        $upload = $file->move(public_path($path), $new_image_name);

        if ($upload) {
            $user->update([
                'picture' => $new_image_name
            ]);
            return response()->json(['status' => 1, 'msg' => 'Image has been updated successfully. Reload your browser', 'name' => $new_image_name]);
        } else {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong, try again later']);
        }
    }
    public function index(Request $request)
    {
        return view('back.pages.home');
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('author.login');
    }

    public function ResetForm(Request $request, $token = null)
    {
        $data = [
            'pageTitle' => 'Reset Password'
        ];
        return view('back.pages.auth.reset', $data)->with(['token' => $token, 'email' => $request->email]);
    }

    public function showUploadForm()
    {
        return view('back.pages.profile');
    }

    public function changeBlogLogoWhite(Request $request){
        $validate = $this->validate($request, [
            'blog_logo' => 'required|mimes:png,jpg,jpeg'
        ],[
            'blog_logo.mimes' => 'File type must be png, jpg, jpeg.'
        ]);
        // ddd($validate);
        if ($validate) {
            $file = $request->file('blog_logo');
            $user = User::find(auth('web')->id());
            $path = 'back/dist/img/logo-favicon/';
            $new_image_name = 'logo-white-1'.'.png';  
            File::delete(public_path($path), $new_image_name);
            $upload = $file->move(public_path($path), $new_image_name);
            if ($upload) {
                toastr()->success("Logo updated successfuly");
            }
            return redirect()->route('author.settings');
        }else {
            toastr()->error("File type must be png, jpg, jpeg.");
        }
    }

    public function changeBlogLogoDark(Request $request){
        $validate = $this->validate($request, [
            'blog_logo' => 'required|mimes:png,jpg,jpeg'
        ],[
            'blog_logo.mimes' => 'File type must be png, jpg, jpeg.'
        ]);
        // ddd($validate);
        if ($validate) {
            $file = $request->file('blog_logo');
            $user = User::find(auth('web')->id());
            $path = 'back/dist/img/logo-favicon/';
            $new_image_name = 'logo-1'.'.png';  
            File::delete(public_path($path), $new_image_name);
            $upload = $file->move(public_path($path), $new_image_name);
            if ($upload) {
                toastr()->success("Logo updated successfuly");
            }
            return redirect()->route('author.settings');
        }else {
            toastr()->error("File type must be png, jpg, jpeg.");
        }
    }
    public function changeBlogFavicon(Request $request){
        $path = 'back/dist/img/logo-favicon/';
        if (!File::exists(public_path($path))) {
            File::makeDirectory(public_path($path),0777,true);
        }
        $file = $request->file('file');
        $new_image_name = 'favicon-1.png';
        File::delete(public_path($path), $new_image_name);
        $upload = $file->move(public_path($path), $new_image_name);
        if($upload){
            return response()->json(['status'=>1, 'msg'=>'Image has been cropped successfully.', 'name'=>$new_image_name]);
        }else{
                return response()->json(['status'=>0, 'msg'=>'Something went wrong, try again later']);
        }   
    }
}
