@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Categories')
@section('pageHeader')
<div class="page-header d-print-none">
  <div class="container-xl">
    <div class="row g-2 align-items-center">
      <div class="col">
        <h2 class="page-title">
          Category & SubCategory
        </h2>
      </div>
    </div>
  </div>
</div>
@endsection
@section('content')

@livewire('categories')
@endsection
@push('scripts')
  <script>
    var jq = jQuery.noConflict();

    // Use 'jq' instead of '$'
    window.addEventListener('hideCategoriesModal', function(event){
      jq('#category_modal').modal('hide');
    });
    window.addEventListener('showCategoriesModal', function(event){
      jq('#category_modal').modal('show');
    });

    window.addEventListener('showSubCategoriesModal', function(event){
      jq('#subcategory_modal').modal('show');
    });
    window.addEventListener('hideSubCategoriesModal', function(event){
      jq('#subcategory_modal').modal('hide');
    });
    
    window.addEventListener('showDeleteCategory', function(event){
      jq('#delete_category').modal('show');
    });
    window.addEventListener('showDeleteSubCategory', function(event){
      jq('#delete_subcategory').modal('show');
    });

    jq('#category_modal, #subcategory_modal, #delete_category, #delete_subcategory').on('hidden.bs.modal', function(event){
      Livewire.emit('deleteAllForm')
    });

  </script>
@endpush
