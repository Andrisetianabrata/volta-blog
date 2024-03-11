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
          
          <div class="col-md-4 mb-3">
            <label class="form-label">Name</label>
            <div class="input-icon mb-1">
              <span class="input-icon-addon">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-signature" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 17c3.333 -3.333 5 -6 5 -8c0 -3 -1 -3 -2 -3s-2.032 1.085 -2 3c.034 2.048 1.658 4.877 2.5 6c1.5 2 2.5 2.5 3.5 1l2 -3c.333 2.667 1.333 4 3 4c.53 0 2.639 -2 3 -2c.517 0 1.517 .667 3 2" /></svg>
              </span>
              <input type="text" value="" class="form-control" placeholder="Name" wire:model='name'>
            </div>
            @error('name')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>

          <div class="col-md-4 mb-3">
            <label class="form-label">Username</label>
            <div class="input-icon mb-1">
              <span class="input-icon-addon">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
              </span>
              <input type="text" value="" class="form-control" placeholder="Username" wire:model='username'>
            </div>
            @error('username')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>

          <div class="col-md-4 mb-3">
            <label class="form-label">Email</label>
            <div class="input-icon mb-1">
              <span class="input-icon-addon">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" /><path d="M3 7l9 6l9 -6" /></svg>
              </span>
              <input type="text" value="" class="form-control" placeholder="Email" wire:model='email' disabled>
            </div>
            @error('email')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>

          <div class="col-md-4 mb-3">
            <label class="form-label">Date of birth</label>
            <div class="input-icon mb-1">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-month" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M7 14h.013" /><path d="M10.01 14h.005" /><path d="M13.01 14h.005" /><path d="M16.015 14h.005" /><path d="M13.015 17h.005" /><path d="M7.01 17h.005" /><path d="M10.01 17h.005" /></svg>
                </span>
                <input type="text" name="input-mask" class="form-control" data-mask="00/00/0000" data-mask-visible="true" placeholder="00/00/0000" autocomplete="off" wire:model='birth'>
              </div>
              @error('birth')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>

          <div class="col-md-4 mb-3">
            <label class="form-label">City</label>
            <div class="input-icon mb-1">
              <span class="input-icon-addon">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-skyscraper" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 21l18 0" /><path d="M5 21v-14l8 -4v18" /><path d="M19 21v-10l-6 -4" /><path d="M9 9l0 .01" /><path d="M9 12l0 .01" /><path d="M9 15l0 .01" /><path d="M9 18l0 .01" /></svg>
              </span>
              <input type="text" value="" class="form-control" placeholder="City" wire:model='city'>
            </div>
            @error('city')
            <span class="text-danger">{{$message}}</span>
            @enderror
          </div>

          <div class="mb-3">
            <label class="form-label">Biograpy</label>
            <textarea class="form-control" name="biograpy" rows="6" placeholder="Here tell us your story >_<" style="height: 165px;" wire:model='biography' wire:model='biograpy'></textarea>
            <div class="col-6 col-sm-4 col-md-2 col-xl-auto py-3">
            </div>
          </div>
          
          <div class="mb-3">
            <button type="submit" class="btn btn-rss w-100">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
              Save Changes
            </button>
          </div>

          <div class="mb-3">
            <input type="file" name='file' id='changeAuthorPictureFile' class="d-none" onchange="this.dispatchEvent(new InputEvent('input'))">
            <a href="#" class="btn btn-primary w-100" onclick="event.preventDefault();document.getElementById('changeAuthorPictureFile').click();">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-photo" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 8h.01" /><path d="M3 6a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3v-12z" /><path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l5 5" /><path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0l3 3" /></svg>
              Change Profile Picture
            </a>
          </div>
        </div>
      </form>
      <div class="mb-3">
        <form action="{{route("author.delete-profile-picture")}}" id="deletePicture" method="POST">
          @csrf
          <button class="btn btn-danger w-100" type="submit">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
            Delete Profile Picture
          </button>
        </form>
      </div>
</div>