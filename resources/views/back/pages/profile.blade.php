{{-- @dd(route("author.change-profile-picture")) --}}
@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Profile')
@push('stylesheets')
		<link rel="stylesheet" href="/back/dist/libs/viewerjs/dist/viewer.css"/>
    <script src="/back/dist/libs/viewerjs/dist/viewer.min.js"></script>
    <script src="./back/dist/libs/ckeditor/ckeditor.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
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
@section('pageHeader')
<div class="page-header d-print-none">
  <div class="container-xl">
    <div class="row g-2 align-items-center">
      <div class="col">
        <h2 class="page-title">
          Account Settings
        </h2>
      </div>
    </div>
  </div>
</div>
@endsection
@section('content')

@livewire('author-personal-details')
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
      // alert(message);
      Livewire.emit('updateAuthorProfileHeader');
      Livewire.emit('updateTopHeader');
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
  var jq = jQuery.noConflict();
  window.addEventListener('showChangePassword', function(event){
  jq('#change_password').modal('show');
  });
  window.addEventListener('hideChangePassword', function(event){
    jq('#change_password').modal('hide');
  });
  var jq = jQuery.noConflict();
  window.addEventListener('hideUploadBannerModal', function(event){
    jq('#upload_banner').modal('hide');
  });
</script>
@endpush
