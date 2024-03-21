@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Settings')
@section('Header')
@livewire('general-setting-header')
@endsection
@section('content')
<div class="row">
   <div class="card">
      <div class="card-header">
         <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
            <li class="nav-item" role="presentation">
               <a href="#tabs-home-3" class="nav-link active" data-bs-toggle="tab" aria-selected="true" role="tab">
                  <!-- Download SVG icon from http://tabler-icons.io/i/home -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                     <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                     <path d="M5 12l-2 0l9 -9l9 9l-2 0"></path>
                     <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
                     <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6"></path>
                  </svg>
                  General Settings
               </a>
            </li>
            {{-- <li class="nav-item" role="presentation">
               <a href="#tabs-profile-3" class="nav-link" data-bs-toggle="tab" aria-selected="false" tabindex="-1" role="tab">
                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                     <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                     <path d="M2 5m0 3a3 3 0 0 1 3 -3h14a3 3 0 0 1 3 3v8a3 3 0 0 1 -3 3h-14a3 3 0 0 1 -3 -3z" />
                     <path d="M6 10v4" />
                     <path d="M11 10a2 2 0 1 0 0 4" />
                     <path d="M16 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                  </svg>
                  Logo & Favicon
               </a>
            </li> --}}
            <li class="nav-item" role="presentation">
               <a href="#tabs-social-3" class="nav-link" data-bs-toggle="tab" aria-selected="false" tabindex="-1" role="tab">
                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                     <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                     <path d="M12 5m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                     <path d="M5 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                     <path d="M19 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                     <path d="M6.5 17.5l5.5 -4.5l5.5 4.5" />
                     <path d="M12 7l0 6" />
                  </svg>
                  Social Media
               </a>
            </li>
         </ul>
      </div>
      <div class="card-body">
         <div class="tab-content">
            <div class="tab-pane active show" id="tabs-home-3" role="tabpanel">
               <div class="mt-3">
                  @livewire('author-general-settings')
               </div>
            </div>
            {{-- <div class="tab-pane" id="tabs-profile-3" role="tabpanel">
               <div class="mt-3">
                  <div class="mb-3">
                     <div class="row">
                        <form action="{{route('author.change-blog-logo-white')}}" method="POST" class="mb-3" enctype="multipart/form-data">
                           @csrf
                           <div class="mb-3">
                              <div class="form-label">Upload White Logo</div>
                              <input type="file" name="blog_logo" id="blog_logo" class="form-control">
                              @error('blog_logo')<span class="text-danger">{{$message}}</span>@enderror
                           </div>
                           <button class="btn btn-primary" type="submit">
                           Save
                           </button>
                        </form>
                        <form action="{{route('author.change-blog-logo-dark')}}" method="POST" class="mb-3" enctype="multipart/form-data">
                           @csrf
                           <div class="mb-3">
                              <div class="form-label">Upload Dark Logo</div>
                              <input type="file" name="blog_logo" id="blog_logo" class="form-control">
                              @error('blog_logo')<span class="text-danger">{{$message}}</span>@enderror
                           </div>
                           <button class="btn btn-primary" type="submit">
                           Save
                           </button>
                        </form>
                        <div>
                           <div class="mb-3">
                              <div class="form-label">Upload Favicon</div>
                              <input type="file" name="file" id="file" class="form-control">
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div> --}}
            <div class="tab-pane" id="tabs-social-3" role="tabpanel">
             <div>
                <div class="row">
                  @livewire('blog-social-network')
                </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@push('scripts')
<script>
   $('#file').ijaboCropTool({
      preview : '.image-previewer',
      setRatio:1,
      allowedExtensions: ['jpg', 'jpeg','png'],
      buttonsText:['CROP','QUIT'],
      buttonsColor:['#30bf7d','#ee5155', -15],
      processUrl:'{{ route("author.change-blog-favicon") }}',
      withCSRF:['_token','{{ csrf_token() }}'],
      onSuccess:function(message, element, status){
         alert(message);
      },
      onError:function(message, element, status){
        alert(message);
      }
   });
</script>
@endpush