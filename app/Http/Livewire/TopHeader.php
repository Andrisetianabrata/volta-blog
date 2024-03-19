<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\Attributes\On;

class TopHeader extends Component
{
    public $author;
    // #[On('TopHeader')] 
    protected $listeners = ['updateTopHeader' => '$refresh'];
    public function mount(){
        $this->author = User::find(auth('web')->id());
    }
    public function render()
    {
        return view('livewire.top-header',[
            'author' => User::find(auth('web')->id()),
            'userType'=>auth()->user()->type,
        ]);
    }
}
