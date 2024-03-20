<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\SubCategory;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class AllPosts extends Component
{
    use WithPagination;
    public $search = null;
    public $categorySelecor = null;
    public $authorSelecor = null;
    public $shortBy = 'desc';
    
    public function editPost($id)
    {
      $post = Post::find($id);
      return redirect()->to(route('author.posts.edit-post', [
        'post_id' => $post->id,
        'author_id'=>$post->author_id
      ]));
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
