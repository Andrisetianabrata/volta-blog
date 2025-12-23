<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use ReturnTypeWillChange;

class AuthorController extends Controller
{

    public function changeAuthorPictureFile(Request $request)
    {
        try {
            \Log::error('Avatar upload attempt', [
                'method' => $request->method(),
                'files' => $request->allFiles(),
                'inputs' => $request->except('file'),
                'has_file' => $request->hasFile('file'),
            ]);

            $user = User::find(auth('web')->id());
            if (!$user) {
                return response()->json(['status' => 0, 'msg' => 'User not found']);
            }

            $path = 'back/dist/img/authors/';
            if (!File::exists(public_path($path))) {
                File::makeDirectory(public_path($path), 0777, true);
            }
            
            $file = $request->file('file');
            if (!$file) {
                \Log::error('No file in request');
                return response()->json(['status' => 0, 'msg' => 'No file uploaded']);
            }
            
            \Log::error('File info', [
                'name' => $file->getClientOriginalName(),
                'size' => $file->getSize(),
                'mime' => $file->getMimeType(),
                'path' => $file->getRealPath(),
            ]);
            
            $new_image_name = 'user-' . $user->username . date('-Ymd') . uniqid() . '.jpg';
            
            // Move file dengan chmod permission
            $upload = $file->move(public_path($path), $new_image_name);
            
            if ($upload) {
                // Set permission untuk file yang baru di-upload
                chmod(public_path($path . $new_image_name), 0644);
                
                $user->update([
                    'picture' => $new_image_name
                ]);
                
                \Log::error('File uploaded successfully', [
                    'filename' => $new_image_name,
                    'full_path' => public_path($path . $new_image_name),
                    'exists' => file_exists(public_path($path . $new_image_name)),
                ]);
                
                return response()->json(['status' => 1, 'msg' => 'Image has been updated successfully. Reload your browser', 'name' => $new_image_name]);
            } else {
                \Log::error('File move failed');
                return response()->json(['status' => 0, 'msg' => 'Failed to move file']);
            }
        } catch (\Exception $e) {
            \Log::error('Avatar upload exception: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['status' => 0, 'msg' => 'Error: ' . $e->getMessage()]);
        }
    }

    public function index(Request $request)
    {
        return view('back.pages.home', [
            'post'=>Post::orderBy('id', 'desc')->first()
        ]);
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
