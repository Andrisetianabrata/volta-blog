@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'All posts')
{{-- @section('pageHeader')
<div class="page-header d-print-none">
  <div class="container-xl">
    <div class="row g-2 align-items-center">
      <div class="col">
        <h2 class="page-title">
          All Posts
        </h2>
      </div>
    </div>
  </div>
</div>
@endsection --}}
@section('content')
@livewire('all-posts')
@endsection
@push('scripts')
  <script>
    // const gallery = document.getElementById('galery');
    // const viewer = new Viewer(gallery, {
    //   title: [4, (image, imageData) => `${image.alt} (${imageData.naturalWidth} × ${imageData.naturalHeight})`],
    //   transition: false
    // });
    
    var jq = jQuery.noConflict();

    // Use 'jq' instead of '$'
    window.addEventListener('hideCategoriesModal', function(event){
      jq('#delete_post').modal('hide');
    });
    window.addEventListener('showDeletePostModal', function(event){
      jq('#delete_post').modal('show');
    });

    jq('#category_modal, #subcategory_modal, #delete_category, #delete_subcategory').on('hidden.bs.modal', function(event){
      Livewire.emit('deleteAllForm')
    });
  </script>
@endpush
