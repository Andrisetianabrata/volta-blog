@extends('back.layouts.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'New Post')
@push('stylesheets')
{{-- <script src="./ckeditor/ckeditor.js"></script> --}}
<script src="{{ asset('back/dist/libs/ckeditor/ckeditor.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
@endpush
@section('pageHeader')
<div class="page-header d-print-none">
  <div class="container-xl">
    <div class="row g-2 align-items-center">
      <div class="col">
        <h2 class="page-title">
          New Post
        </h2>
      </div>
    </div>
  </div>
</div>
@endsection
@section('content')
@livewire('create-post')
@endsection
@push('scripts')
<script>
  window.addEventListener('beforeunload', function (e) {
    // Batalkan event default
    e.preventDefault();
    // Chrome memerlukan returnValue diatur
    e.returnValue = '';
  });
</script>
  
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
</script>
@endpush