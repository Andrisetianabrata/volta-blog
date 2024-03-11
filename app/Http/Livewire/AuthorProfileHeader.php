<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\Attributes\On;

class AuthorProfileHeader extends Component
{
    public $author;
    // #[On('AuthorProfileHeader')] 
    public function mount(){
        $this->author = User::find(auth('web')->id());
    }
    public function render()
    {
        return view('livewire.author-profile-header');
    }
}
