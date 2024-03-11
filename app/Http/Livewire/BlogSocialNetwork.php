<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\BlogSocialMedia;
use Livewire\Attributes\Validate;

class BlogSocialNetwork extends Component
{
    public $blog_social_media;
    public $facebook_url, $instagram_url, $twitter_url, $github_url;
    public function mount()
    {
        $this->blog_social_media = BlogSocialMedia::find(1);
        $this->facebook_url = $this->blog_social_media->bsm_facebook;
        $this->instagram_url = $this->blog_social_media->bsm_instagram;
        $this->twitter_url = $this->blog_social_media->bsm_twitter;
        $this->github_url = $this->blog_social_media->bsm_github;
    }

    public function UpdateDetails()
    {
        $this->Validate([
            'facebook_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'github_url' => 'nullable|url',
        ]);

        $update = $this->blog_social_media->update([
            'bsm_facebook' => $this->facebook_url,
            'bsm_instagram' => $this->instagram_url,
            'bsm_twitter' => $this->twitter_url,
            'bsm_github' => $this->github_url,
        ]);
        
        if ($update) {
            toastr()->success('Yayy Blog social network has been updated');
        }else{
            toastr()->error('Yayy Blog social network has been updated');
        }
    }
    public function render()
    {
        return view('livewire.blog-social-network');
    }
}
