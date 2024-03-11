@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Users')

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
@section('content')


@livewire('users-list')
@endsection

@push('scripts')
<script>
const gallery = document.getElementById('galery');
const viewer = new Viewer(gallery, {
  title: [4, (image, imageData) => `${image.alt} (${imageData.naturalWidth} × ${imageData.naturalHeight})`],
  transition: false
});
// $wire.on('showModalEdit', (event)=>{
//   $('#edit_user').modal('show');
// });
</script>
@endpush