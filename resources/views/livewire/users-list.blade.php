<div>
   <?php
   $isAdmin = App\Models\User::find(auth('web')->id());
   ?>
   <div class="row g-2 align-items-center">
      <div class="col">
        <h2 class="page-title">
          Users
        </h2>
        <!-- <div class="text-muted mt-1">1-18 of 413 people</div> -->
      </div>
      <!-- Page title actions -->
      <div class="col-auto ms-auto d-print-none">
         <div class="d-flex">
            <input type="search" class="form-control d-inline-block w-9 me-3" placeholder="Search user…" wire:model='search'>
           <button href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_user" {{($isAdmin->authorType->id) == 1 ? '' : 'disabled'}} >
            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 5l0 14"></path><path d="M5 12l14 0"></path></svg>
            New user
         </button>
      </div>
   </div>
   </div>
   
   <div id="galery">
   <!-- Page Body -->
      <div class="page-body">
         <div class="row row-cards">
            @forelse ($users as $user)
            <div class="col-md-6 col-lg-3">
               <div class="card">
                  <div class="card-body p-4 text-center">
                     <img class="avatar avatar-xl mb-3 rounded" src="{{$user->picture}}"></img>
                     <h3 class="m-0 mb-1">{{$user->name}}</h3>
                     <div class="text-muted">@ {{$user->username}}</div>
                     <div class="mt-3">
                        <span class="badge {{ ($user->authorType->id == 1) ? 'bg-purple-lt' : 'bg-green-lt' }}">{{$user->authorType->name}}</span>
                     </div>
                  </div>
                  <div class="d-flex">
                     <a href="#" wire:click.prevent='editUser()' class="card-btn" style="pointer-events: {{($user->id) == 1 ? 'none' : ''}}">
                        <!-- Download SVG icon from http://tabler-icons.io/i/mail -->
                        <svg class="icon me-2 text-muted" xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                        Edit
                     </a>
                     <a href="#" class="card-btn" style="pointer-events: {{($user->id) == 1 ? 'none' : ''}}">
                        <!-- Download SVG icon from http://tabler-icons.io/i/phone -->
                        <svg class="icon me-2 text-muted" xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                        Delete
                     </a>
                  </div>
               </div>
            </div>
            @empty
               <span class="text-danger">No users</span>
            @endforelse
         </div>
         <div class="row mt-4">
            {{$users->links('livewire::bootstrap')}}
         </div>
      </div>

      {{-- Add user Modal --}}
      <div wire:ignore.self class="modal modal-blur fade" id="add_user" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">New User</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click='resetForm()'></button>
            </div>
            <div class="modal-body">
               <form method="POST" action="" wire:submit.prevent='addUser()'>
                  <div class="mb-3">
                     <label class="form-label">Name</label>
                     <input type="text" class="form-control" name="example-text-input" placeholder="Name" wire:model='name'>
                     <span class="text-danger">@error('name') {{$message}} @enderror</span>
                  </div>
                  <div class="mb-3">
                     <label class="form-label">User Name</label>
                     <input type="text" class="form-control" name="example-text-input" placeholder="User Name" wire:model='username'>
                     <span class="text-danger">@error('username') {{$message}} @enderror</span>
                  </div>
                  <div class="mb-3">
                     <label class="form-label">Email</label>
                     <input type="text" class="form-control" name="example-text-input" placeholder="Email" wire:model='email'>
                     <span class="text-danger">@error('email') {{$message}} @enderror</span>
                  </div>
                  <label class="form-label">User type</label>
                  <div class="form-selectgroup-boxes row mb-3">
                     <div class="col-lg-6">
                        <label class="form-selectgroup-item">
                        <input type="radio" name="user_type" value="1" class="form-selectgroup-input" wire:model='user_type'>
                        <span class="form-selectgroup-label d-flex align-items-center p-3">
                        <span class="me-3">
                        <span class="form-selectgroup-check"></span>
                        </span>
                        <span class="form-selectgroup-label-content">
                        <span class="form-selectgroup-title strong mb-1">Admin</span>
                        <span class="d-block text-muted">Manage users or users posts.</span>
                        </span>
                        </span>
                        </label>
                     </div>
                     <div class="col-lg-6">
                        <label class="form-selectgroup-item">
                        <input type="radio" name="user_type" value="2" class="form-selectgroup-input" checked wire:model='user_type'>
                        <span class="form-selectgroup-label d-flex align-items-center p-3">
                        <span class="me-3">
                        <span class="form-selectgroup-check"></span>
                        </span>
                        <span class="form-selectgroup-label-content">
                        <span class="form-selectgroup-title strong mb-1">Author</span>
                        <span class="d-block text-muted">Post, edit and delete own article.</span>
                        </span>
                        </span>
                        </label>
                     </div>
                     <span class="text-danger">@error('user_type') {{$message}} @enderror</span>
   
                     <div class="modal-footer mt-4">
                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal" wire:click='resetForm()'>
                        Cancel
                        </a>
                        <button type="submit" class="btn btn-primary ms-auto">
                           <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                           <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                              <path d="M12 5l0 14" />
                              <path d="M5 12l14 0" />
                           </svg>
                           Create new user
                        </button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>

      {{-- Edit user Modal --}}
      <div wire:ignore.self class="modal modal-blur fade" id="edit_user" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">Edit User</h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" wire:click='resetForm()'></button>
            </div>
            <div class="modal-body">
               <form method="POST" action="" wire:submit.prevent='updateUser()'>
                  <div class="mb-3">
                     <label class="form-label">Name</label>
                     <input type="text" class="form-control" name="example-text-input" placeholder="Name" wire:model='name'>
                     <span class="text-danger">@error('name') {{$message}} @enderror</span>
                  </div>
                  <div class="mb-3">
                     <label class="form-label">User Name</label>
                     <input type="text" class="form-control" name="example-text-input" placeholder="User Name" wire:model='username'>
                     <span class="text-danger">@error('username') {{$message}} @enderror</span>
                  </div>
                  <div class="mb-3">
                     <label class="form-label">Email</label>
                     <input type="text" class="form-control" name="example-text-input" placeholder="Email" wire:model='email'>
                     <span class="text-danger">@error('email') {{$message}} @enderror</span>
                  </div>
                  <label class="form-label">User type</label>
                  <div class="form-selectgroup-boxes row mb-3">
                     <div class="col-lg-6">
                        <label class="form-selectgroup-item">
                        <input type="radio" name="user_type" value="1" class="form-selectgroup-input" wire:model='user_type'>
                        <span class="form-selectgroup-label d-flex align-items-center p-3">
                        <span class="me-3">
                        <span class="form-selectgroup-check"></span>
                        </span>
                        <span class="form-selectgroup-label-content">
                        <span class="form-selectgroup-title strong mb-1">Admin</span>
                        <span class="d-block text-muted">Manage users or users posts.</span>
                        </span>
                        </span>
                        </label>
                     </div>
                     <div class="col-lg-6">
                        <label class="form-selectgroup-item">
                        <input type="radio" name="user_type" value="2" class="form-selectgroup-input" checked wire:model='user_type'>
                        <span class="form-selectgroup-label d-flex align-items-center p-3">
                        <span class="me-3">
                        <span class="form-selectgroup-check"></span>
                        </span>
                        <span class="form-selectgroup-label-content">
                        <span class="form-selectgroup-title strong mb-1">Author</span>
                        <span class="d-block text-muted">Post, edit and delete own article.</span>
                        </span>
                        </span>
                        </label>
                     </div>
                     <span class="text-danger">@error('user_type') {{$message}} @enderror</span>
                     <div class="mb-3 mt-3">
                        <div class="form-label">Block</div>
                        <label class="form-check form-switch">
                          <input class="form-check-input" type="checkbox">
                          <span class="form-check-label">Block or Ban user</span>
                        </label>
                      </div>
                     <div class="modal-footer mt-4">
                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal" wire:click='resetForm()'>
                        Cancel
                        </a>
                        <button type="submit" class="btn btn-primary ms-auto">
                           <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                           <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                              <path d="M12 5l0 14" />
                              <path d="M5 12l14 0" />
                           </svg>
                           Create new user
                        </button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
   {{-- <input type="search" wire:model='search'>
   @foreach ($users as $user)
      <ul>
         <li>
            {{$user->name}}
         </li>
      </ul>
   @endforeach --}}
</div>