<div>
    <form action="" method="POST" wire:submit.prevent='UpdateDetails()'>
      <div class="row">
  
        @if (Session::get('fail'))
        <div class="alert alert-danger">
        {{ Session::get('fail') }}
        </div>
        @endif
    
        @if (Session::get('success'))
        <div class="alert alert-success">
        {{ Session::get('success') }}
        </div>
        @endif
        
        <div class="col-md-6 mb-3">
          <label class="form-label">Facebook</label>
          <div class="input-icon mb-1">
            <span class="input-icon-addon">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-facebook" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" /></svg>
            </span>
            <input type="text" value="" class="form-control" placeholder="Facebook" wire:model='facebook_url'>
          </div>
          @error('facebook_url')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
  
        <div class="col-md-6 mb-3">
          <label class="form-label">Instagram</label>
          <div class="input-icon mb-1">
            <span class="input-icon-addon">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-instagram" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4m0 4a4 4 0 0 1 4 -4h8a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z" /><path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M16.5 7.5l0 .01" /></svg>
            </span>
            <input type="text" value="" class="form-control" placeholder="Instagram" wire:model='instagram_url'>
          </div>
          @error('instagram_url')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
  
        <div class="col-md-6 mb-3">
          <label class="form-label">Twitter</label>
          <div class="input-icon mb-1">
            <span class="input-icon-addon">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4l11.733 16h4.267l-11.733 -16z" /><path d="M4 20l6.768 -6.768m2.46 -2.46l6.772 -6.772" /></svg>
            </span>
            <input type="text" value="" class="form-control" placeholder="Twitter" wire:model='twitter_url'>
          </div>
          @error('twitter_url')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
  
        <div class="col-md-6 mb-3">
          <label class="form-label">Github</label>
          <div class="input-icon mb-1">
            <span class="input-icon-addon">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-brand-github" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 19c-4.3 1.4 -4.3 -2.5 -6 -3m12 5v-3.5c0 -1 .1 -1.4 -.5 -2c2.8 -.3 5.5 -1.4 5.5 -6a4.6 4.6 0 0 0 -1.3 -3.2a4.2 4.2 0 0 0 -.1 -3.2s-1.1 -.3 -3.5 1.3a12.3 12.3 0 0 0 -6.2 0c-2.4 -1.6 -3.5 -1.3 -3.5 -1.3a4.2 4.2 0 0 0 -.1 3.2a4.6 4.6 0 0 0 -1.3 3.2c0 4.6 2.7 5.7 5.5 6c-.6 .6 -.6 1.2 -.5 2v3.5" /></svg>
            </span>
            <input type="text" value="" class="form-control" placeholder="Github" wire:model='github_url'>
          </div>
          @error('github_url')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
  
        <div class="mb-3">
          <button type="submit" class="btn btn-primary w-100">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
            Save Changes
          </button>
        </div>
  
      </div>
    </form>
  </div>