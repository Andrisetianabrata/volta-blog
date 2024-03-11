<?php

namespace App\Http\Livewire;
use Livewire\Attributes\On;
use App\Models\Setting;

use Livewire\Component;

class AuthorFooter extends Component
{
    public $setting;
    public function mount(){
        $this->setting = Setting::find(1);
    }
    // #[On('AuthorFooter')] 
    public function render()
    {
        return view('livewire.author-footer');
    }
}
