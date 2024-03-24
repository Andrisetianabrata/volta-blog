<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class CreatePost extends Component
{
    use WithFileUploads;
    public $post_title;
    public $post_content;
    public $post_category;
    public $post_thumbnail;
    public function createPost()
    {
        // dd($this->post_content);
        $this->validate([
            'post_title'=>'required|unique:posts,post_title',
            'post_content'=>'required',
            'post_category'=>'required|exists:sub_categories,id',
            'post_thumbnail'=>'required|mimes:jpeg,jpg,png|max:2048',
        ]);
        
        $fileName = $this->post_thumbnail->getClientOriginalName();
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        $thumbnailSlug = uniqid().'-'.Str::slug(pathinfo($fileName, PATHINFO_FILENAME)).'.'.$extension;
        // $saved = $this->post_thumbnail->storeAs('/public/images/thumbnails', $thumbnailSlug);
        $image = Image::make($this->post_thumbnail);
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
        $saved = Storage::disk('public')->put('images/thumbnails/'.$thumbnailSlug, $croppedImage->stream());


        if($saved){
            $post = new Post();
            $post->author_id = auth()->id();
            $post->category_id = $this->post_category;
            $post->post_title = $this->post_title;
            $post->post_slug = Str::slug($this->post_title);
            $post->post_content = $this->post_content;
            $post->thumbnail = $thumbnailSlug;
            $postSaved = $post->save();

            if ($postSaved) {
                toastr()->success('Yayy your article has been posted');
                $this->clearForm();
            }else{
                toastr()->error('Oops something wrong when posting your article');
            }
        }else{
            toastr()->error('Oops something wrong when uploading thumbnail');
        }
    }
    
    public function clearForm()
    {
        $this->post_title = null;
        $this->post_content = null;
        $this->post_category = null;
        $this->post_thumbnail = null;
    }

    public function render()
    {
        return view('livewire.create-post');
    }
}
