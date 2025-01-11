<div>
  <form class="card" action="" method="POST" wire:submit.prevent='UpdateDetails()'>
    <div class="row g-0">
      <div class="col d-flex flex-column">
        <div class="card-body">
          <h2 class="mb-4">{{$author->name}} | {{$author->authorType->name}}</h2>
          <h3 class="card-title">Profile Details</h3>
          <div class="row align-items-center">
            <div class="col-auto"><span class="avatar avatar-xl" style="background-image: url({{url($author->picture)}})"></span>
            </div>
            <div class="col-auto mt-3">
              <input type="file" name='file' id='changeAuthorPictureFile' class="d-none" onchange="this.dispatchEvent(new InputEvent('input'))">
              <a href="#" class="btn" onclick="event.preventDefault();document.getElementById('changeAuthorPictureFile').click();">
              Change Avatar
              </a>
            </div>
            <div class="col-auto mt-3">
              <a href="#" class="btn btn-ghost-lime" data-bs-toggle="modal" data-bs-target="#upload_banner">
              Upload Banner
              </a>
            </div>
            <div class="col-auto mt-3"><button href="" wire:click.prevent='deleteAuthorPictureFile' class="btn btn-ghost-danger">
              Delete avatar
              </button>
            </div>
          </div>
          <h3 class="card-title mt-4">Profile</h3>
          <div class="row g-4">
            <div class="col-md">
              <label class="form-label">Name</label>
              <div class="input-icon mb-1">
                <span class="input-icon-addon">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-signature" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M3 17c3.333 -3.333 5 -6 5 -8c0 -3 -1 -3 -2 -3s-2.032 1.085 -2 3c.034 2.048 1.658 4.877 2.5 6c1.5 2 2.5 2.5 3.5 1l2 -3c.333 2.667 1.333 4 3 4c.53 0 2.639 -2 3 -2c.517 0 1.517 .667 3 2" />
                  </svg>
                </span>
                <input type="text" value="" class="form-control" placeholder="Name" wire:model='name'>
              </div>
              @error('name')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
            <div class="col-md">
              <label class="form-label">Username</label>
              <div class="input-icon mb-1">
                <span class="input-icon-addon">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                  </svg>
                </span>
                <input type="text" value="" class="form-control" placeholder="Username" wire:model='username'>
              </div>
              @error('username')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
            <div class="col-md">
              <label class="form-label">Date of birth</label>
              <div class="input-icon mb-1">
                <span class="input-icon-addon">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-month" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                    <path d="M16 3v4" />
                    <path d="M8 3v4" />
                    <path d="M4 11h16" />
                    <path d="M7 14h.013" />
                    <path d="M10.01 14h.005" />
                    <path d="M13.01 14h.005" />
                    <path d="M16.015 14h.005" />
                    <path d="M13.015 17h.005" />
                    <path d="M7.01 17h.005" />
                    <path d="M10.01 17h.005" />
                  </svg>
                </span>
                <input type="text" name="input-mask" class="form-control" data-mask="00/00/0000" data-mask-visible="true" placeholder="00/00/0000" autocomplete="off" wire:model='birth'>
              </div>
              @error('birth')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
            <div class="col-md">
              <label class="form-label">City</label>
              <div class="input-icon mb-1">
                <span class="input-icon-addon">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-skyscraper" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M3 21l18 0" />
                    <path d="M5 21v-14l8 -4v18" />
                    <path d="M19 21v-10l-6 -4" />
                    <path d="M9 9l0 .01" />
                    <path d="M9 12l0 .01" />
                    <path d="M9 15l0 .01" />
                    <path d="M9 18l0 .01" />
                  </svg>
                </span>
                <input type="text" value="" class="form-control" placeholder="City" wire:model='city'>
              </div>
              @error('city')
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
          </div>
          <h3 class="card-title mt-4">Biography</h3>
          <p class="card-subtitle">Your story or your quote will be display here.</p>
          <div>
            <div class="row g-1">
              <div class="" wire:ignore>
                <textarea class="form-control" id="biograpy" rows="6" placeholder="Here tell your story / moto 💖">
                  @if ($author->biography != null)
                  {!!$author->biography!!}
                  @else
                  {{'Here tell your story / moto 💖'}}
                  @endif
                </textarea>
              </div>
            </div>
          </div>
          <h3 class="card-title mt-4">Email</h3>
          <p class="card-subtitle">This contact will be shown to others publicly, so choose it carefully.</p>
          <div>
            <div class="row g-2">
              <div class="col-auto">
                <div class="input-icon">
                  <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-mail" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                      <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                      <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
                      <path d="M3 7l9 6l9 -6" />
                    </svg>
                  </span>
                  <input type="text" value="" class="form-control" placeholder="Email" wire:model='email' disabled>
                </div>
              </div>
              <div class="col-auto"><button disabled href="#" class="btn btn-primary">
                Change
                </button>
              </div>
            </div>
          </div>
          <h3 class="card-title mt-4">Password</h3>
          <p class="card-subtitle">You can set a permanent password if you don't want to use temporary login codes.</p>
          <div>
            <a href="#" wire:click.prevent='changePassword' class="btn">
            Set new password
            </a>
          </div>
        </div>
        <div class="card-footer bg-transparent mt-auto">
          <div class="btn-list justify-content-end">
            <button type="submit" class="btn btn-primary">
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                <path d="M16 5l3 3" />
              </svg>
              Save Changes
            </button>
          </div>
        </div>
      </div>
    </div>
  </form>

  <div wire:ignore.self class="modal modal-blur fade" id="change_password" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Set new password</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="" wire:submit.prevent='UpdatePassword()'>
            <div class="mb-3">
              <label class="form-label">Current passsword</label>
              <div class="input-icon">
                <span class="input-icon-addon">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-key" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16.555 3.843l3.602 3.602a2.877 2.877 0 0 1 0 4.069l-2.643 2.643a2.877 2.877 0 0 1 -4.069 0l-.301 -.301l-6.558 6.558a2 2 0 0 1 -1.239 .578l-.175 .008h-1.172a1 1 0 0 1 -.993 -.883l-.007 -.117v-1.172a2 2 0 0 1 .467 -1.284l.119 -.13l.414 -.414h2v-2h2v-2l2.144 -2.144l-.301 -.301a2.877 2.877 0 0 1 0 -4.069l2.643 -2.643a2.877 2.877 0 0 1 4.069 0z" /><path d="M15 9h.01" /></svg>
                </span>
                <input type="password" value="" class="form-control" placeholder="Current Password" wire:model='current_password'>
              </div>
              @error('current_password')
              <span class="text-danger">{{$message}}</span>
              @enderror
           </div>
           <div class="mb-3">
              <label class="form-label">New Password</label>
              <div class="input-icon">
                <span class="input-icon-addon">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-key" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16.555 3.843l3.602 3.602a2.877 2.877 0 0 1 0 4.069l-2.643 2.643a2.877 2.877 0 0 1 -4.069 0l-.301 -.301l-6.558 6.558a2 2 0 0 1 -1.239 .578l-.175 .008h-1.172a1 1 0 0 1 -.993 -.883l-.007 -.117v-1.172a2 2 0 0 1 .467 -1.284l.119 -.13l.414 -.414h2v-2h2v-2l2.144 -2.144l-.301 -.301a2.877 2.877 0 0 1 0 -4.069l2.643 -2.643a2.877 2.877 0 0 1 4.069 0z" /><path d="M15 9h.01" /></svg>
                </span>
                <input type="password" value="" class="form-control" placeholder="New Password" wire:model='new_password' id="password">
              </div>
              @error('new_password')
              <span class="text-danger">{{$message}}</span>
              @enderror
           </div>
           <div class="mb-3">
              <label class="form-label">Confirm new Password</label>
              <div class="input-icon mb-1">
                <span class="input-icon-addon">
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-key" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16.555 3.843l3.602 3.602a2.877 2.877 0 0 1 0 4.069l-2.643 2.643a2.877 2.877 0 0 1 -4.069 0l-.301 -.301l-6.558 6.558a2 2 0 0 1 -1.239 .578l-.175 .008h-1.172a1 1 0 0 1 -.993 -.883l-.007 -.117v-1.172a2 2 0 0 1 .467 -1.284l.119 -.13l.414 -.414h2v-2h2v-2l2.144 -2.144l-.301 -.301a2.877 2.877 0 0 1 0 -4.069l2.643 -2.643a2.877 2.877 0 0 1 4.069 0z" /><path d="M15 9h.01" /></svg>
                </span>
                <input type="password" value="" class="form-control" placeholder="Confirm new Password" wire:model='confirm_password' id="password">
              </div>
              @error('confirm_password')
              <span class="text-danger">{{$message}}</span>
              @enderror
           </div>
          </form>
        </div>
        <div class="modal-footer mt-4">
          <button href="#" class="btn" data-bs-dismiss="modal">
          Cancel
          </button>
          <button wire:click.prevent='UpdatePassword()' class="btn btn-primary ms-auto">
            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
            <svg class="icon me-2" xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
              <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
              <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
              <path d="M16 5l3 3" />
            </svg>
            Update password
          </button>
        </div>
      </div>
    </div>
  </div>

  <div wire:ignore.self class="modal modal-blur fade" id="upload_banner" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Upload Banner</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <div class="form-label">Banner</div>
            <input type="file" class="form-control" wire:model="user_banner" accept="image/jpeg, image/png">
            @error('user_banner')<span class="text-danger">{{$message}}</span><br>@enderror
            <span class="small text-indigo">Tips: 2:1 Aspect ratio image</span>
         </div>
         <div class="col-6 mb-3" wire:ignore>
            <div class="img-responsive img-responsive-2x1 rounded-3 border" style="background-image: url({{$author->banner}})"></div>
         </div>
        </div>
        <div class="modal-footer">
          <div class="col-sm g-2">
            <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-ghost-danger" wire:click.prevent='deleteBanner' data-bs-dismiss="modal">Delete</button>
          </div>
          <button type="button" class="btn btn-primary" wire:click.prevent='uploadBanner'">Save changes</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    // Mengambil referensi dari input file dan div yang akan menampilkan gambar
    const fileInput = document.querySelector('.form-control[type="file"]');
    const imageDisplay = document.querySelector('.img-responsive');
    
    // Fungsi untuk mengubah tampilan gambar
    function updateImageDisplay() {
      const files = fileInput.files;
      if (files.length > 0) {
        const file = files[0];
        const imageUrl = URL.createObjectURL(file);
    
        // Mengatur gambar sebagai background div
        imageDisplay.style.backgroundImage = `url(${imageUrl})`;
      }
    }
    
    // Menambahkan event listener untuk merespon saat file dipilih
    fileInput.addEventListener('change', updateImageDisplay);

    // CKEDITOR.replace( 'post_content' );
    $(document).ready(function(){
       const editor = CKEDITOR.replace( 'biograpy', {
        height: 400
       } );
       editor.on('change', function(event){
        //  console.log(event.editor.getData());
         @this.set('biography', event.editor.getData());
       }); 
     })
  </script>
</div>