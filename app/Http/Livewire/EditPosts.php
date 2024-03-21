<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class EditPosts extends Component
{
    use WithFileUploads;
    public $postId;
    public $post;
    public $post_title;
    public $post_category;
    public $post_thumbnail;
    public $post_content;
    public $oldFile;
    public function mount()
    {
        $receivedToken = request()->token; // Token yang diterima dari URL

        if (session('post_edit_token') == $receivedToken) {
            if (auth()->user()->type != 1) {
                if (auth()->user()->id == request()->author_id) {
                    $this->postId = request()->post_id;
                    $this->post = Post::find($this->postId);
                    $this->post_category = $this->post->category_id;
                    $this->post_thumbnail = $this->post->thumbnail;
                    $this->post_title = $this->post->post_title;
                    $this->post_content = $this->post->post_content;
                    $this->oldFile = $this->post_thumbnail;
                }
            }else{
                $this->postId = request()->post_id;
                $this->post = Post::find($this->postId);
                $this->post_category = $this->post->category_id;
                $this->post_thumbnail = $this->post->thumbnail;
                $this->post_title = $this->post->post_title;
                $this->post_content = $this->post->post_content;
                $this->oldFile = $this->post_thumbnail;
            }
        } else {
            abort(403, 'Unauthorized action.');
        }
    }
    
    public function updatePost()
    {
        $this->validate([
            'post_title'=>'required|unique:posts,post_title,'.$this->postId,
            'post_content'=>'required',
            'post_category'=>'required|exists:sub_categories,id',
        ]);
        if ($this->post_thumbnail != $this->post->thumbnail) {
            $this->validate([
                'post_thumbnail'=>'mimes:png,jpg,jpeg',
            ]);
            // $data = [$this->oldFile, $this->post_thumbnail];
            // dd($data);
            $fileName = $this->post_thumbnail->getClientOriginalName();
            $extension = pathinfo($fileName, PATHINFO_EXTENSION);
            $thumbnailSlug = uniqid().'-'.Str::slug(pathinfo($fileName, PATHINFO_FILENAME)).'.'.$extension;
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
            $deletion = Storage::disk('public')->delete('images/thumbnails/'.$this->oldFile);
            $saved = Storage::disk('public')->put('images/thumbnails/'.$thumbnailSlug, $croppedImage->stream());
            if ($saved || $deletion) {
                $this->post->update([
                    'category_id' => $this->post_category,
                    'post_title' => $this->post_title,
                    'post_slug' => Str::slug($this->post_title),
                    'post_content' => $this->post_content,
                    'thumbnail' => $thumbnailSlug,
                ]);
                toastr()->success('Post has been updated.');
                session()->forget('post_edit_token');
                redirect(route('author.posts.all-post'));
            }
        }else{
            // dd('gak upload');
            $this->post->update([
                'category_id' => $this->post_category,
                'post_title' => $this->post_title,
                'post_slug' => Str::slug($this->post_title),
                'post_content' => $this->post_content,
            ]);
            toastr()->success('Post has been updated.');
            session()->forget('post_edit_token');
            redirect(route('author.posts.all-post'));
        }
    }
    
    public function render()
    {
        // return dump($this->post);
        return view('livewire.edit-posts', [
            'post' => $this->post,
        ]);
    }
}
