<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class AllPosts extends Component
{
    use WithPagination;
    public $search = null;
    public $categorySelecor = null;
    public $authorSelecor = null;
    public $shortBy = 'desc';

    public $selectedPostId = null;
    
    public function editPost($id)
    {
      $post = Post::find($id);
      $token = Str::random(40); // Menghasilkan token acak

      session(['post_edit_token' => $token]); // Menyimpan token ke dalam sesi

      return redirect()->to(route('author.posts.edit-post', [
          'post_id' => $post->id,
          'author_id' => $post->author_id,
          'token' => $token // Mengirim token sebagai parameter
      ]));
    }

    public function deletePost($id)
    {
      // dd($id);
      $this->selectedPostId = $id;
      $this->dispatchBrowserEvent('showDeletePostModal');  
    }

    public function deletePostAction()
    {
      $post = Post::findOrFail($this->selectedPostId);
      $thumbnail = $post->thumbnail;
      $deletion = Storage::disk('public')->delete('images/thumbnails/'.$thumbnail);
      $postDelete = $post->delete();
      if (!$deletion || !$postDelete) {
        toastr()->error("Canot delete something wrong");
      }else {
        toastr()->success("Post has been Deleted");
        $this->dispatchBrowserEvent('hideDeletePostModal');
      }
    }

    public function deleteAllForm()
    {
      $this->dispatchBrowserEvent('showDeletePostModal');  
    }
    
    public function render()
    {
        return view('livewire.all-posts',[
            'posts'=> auth()->user()->type == 1 ? 
                      Post::search(trim($this->search))
                      ->when($this->categorySelecor, function($query){
                        $query->where('category_id', $this->categorySelecor);
                      })
                      ->when($this->authorSelecor, function($query){
                        $query->where('author_id', $this->authorSelecor);
                      })
                      ->when($this->shortBy, function($query){
                        $query->orderBy('id', $this->shortBy);
                      })
                      ->paginate(8) : 
                      Post::search(trim($this->search))
                      ->when($this->categorySelecor, function($query){
                        $query->where('category_id', $this->categorySelecor);
                      })
                      ->where('author_id', auth()->id())
                      ->when($this->shortBy, function($query){
                        $query->orderBy('id', $this->shortBy);
                      })
                      ->paginate(8),
            'subCategory'=>SubCategory::whereHas('posts')->get(),
            'userType'=>auth()->user()->type,
            'authors'=>User::whereHas('posts')->get(),
        ]);
    }
}
