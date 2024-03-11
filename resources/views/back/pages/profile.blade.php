{{-- @dd(route("author.change-profile-picture")) --}}
@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Profile')
@push('stylesheets')
		<link rel="stylesheet" href="/back/dist/libs/viewerjs/dist/viewer.css"/>
    <script src="/back/dist/libs/viewerjs/dist/viewer.min.js"></script>
    <style>
      .viewer-download {
      color: #fff;
      font-family: FontAwesome, serif;
      font-size: 0.75rem;
      line-height: 1.5rem;
      text-align: center;
    }

    .viewer-download::before {
      content: "\f019";
    }
    </style>
@endpush
@section('Header')
@livewire('author-profile-header')
@endsection
@section('content')
<div class="row" id="">
  <div class="card">
    <div class="card-header">
      <ul class="nav nav-tabs card-header-tabs" data-bs-toggle="tabs" role="tablist">
        <li class="nav-item" role="presentation">
          <a href="#tabs-home-3" class="nav-link active" data-bs-toggle="tab" aria-selected="true" role="tab"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none" />
              <circle cx="12" cy="7" r="4" />
              <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
            </svg>
            Personal Information</a>
        </li>
        <li class="nav-item" role="presentation">
          <a href="#tabs-profile-3" class="nav-link" data-bs-toggle="tab" aria-selected="false" tabindex="-1" role="tab"><!-- Download SVG icon from http://tabler-icons.io/i/user -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon me-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16.555 3.843l3.602 3.602a2.877 2.877 0 0 1 0 4.069l-2.643 2.643a2.877 2.877 0 0 1 -4.069 0l-.301 -.301l-6.558 6.558a2 2 0 0 1 -1.239 .578l-.175 .008h-1.172a1 1 0 0 1 -.993 -.883l-.007 -.117v-1.172a2 2 0 0 1 .467 -1.284l.119 -.13l.414 -.414h2v-2h2v-2l2.144 -2.144l-.301 -.301a2.877 2.877 0 0 1 0 -4.069l2.643 -2.643a2.877 2.877 0 0 1 4.069 0z" /><path d="M15 9h.01" /></svg>
            Change Password
          </a>
        </li>
      </ul>
    </div>
    <div class="card-body">
      <div class="tab-content">
        <div class="tab-pane active show" id="tabs-home-3" role="tabpanel">
          <div class="mt-3">
          @livewire('author-personal-details')
          </div>
        </div>
        <div class="tab-pane" id="tabs-profile-3" role="tabpanel">
          <div class="mt-3">
            @livewire('author-change-password-form')
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('scripts')

<script>
$('#changeAuthorPictureFile').ijaboCropTool({
  preview : '.image-previewer',
  setRatio:1,
  allowedExtensions: ['jpg', 'jpeg','png'],
  buttonsText:['CROP','QUIT'],
  buttonsColor:['#30bf7d','#ee5155', -15],
  withCSRF:['_token','{{ csrf_token() }}'],
  processUrl:'{{ route("author.change-profile-picture") }}',
  onSuccess:function(message, element, status){
    alert(message);
  },
  onError:function(message, element, status){
    alert(message);
  }
});
const gallery = document.getElementById('galery');
const viewer = new Viewer(gallery, {
  title: [4, (image, imageData) => `${image.alt} (${imageData.naturalWidth} × ${imageData.naturalHeight})`],
  transition: false
});
</script>
@endpush
