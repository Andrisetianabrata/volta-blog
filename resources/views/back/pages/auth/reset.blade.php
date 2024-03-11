@extends('back.layouts.auth-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Reset Password')
@section('content')
<div class="page page-center">
  <div class="container container-tight py-4">
    <div class="text-center mb-4">
      <a href="." class="navbar-brand navbar-brand-autodark"><img src="{{asset('back/dist/img/logo-favicon/logo-1.png')}}" height="50" alt=""></a>
    </div>
    @livewire('author-reset-form')
    <div class="text-center text-muted mt-3">
      Never mind back to <a href="{{route('author.login')}}" tabindex="-1">Login</a>
    </div>
  </div>
</div>
@endsection
@push('scripts')
  <script>
    function show() {
      var x = document.getElementById("password");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
  </script>
@endpush