@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Home')
@section('content')
{!!$post->post_content!!}
@endsection
@push('scripts')
  <script>
    const gallery = document.getElementById('galery');
    const viewer = new Viewer(gallery, {
      title: [4, (image, imageData) => `${image.alt} (${imageData.naturalWidth} × ${imageData.naturalHeight})`],
      transition: false
    });
  </script>
@endpush