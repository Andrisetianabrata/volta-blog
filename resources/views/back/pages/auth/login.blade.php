@extends('back.layouts.auth-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Login')
@section('content')
<div class="page page-center">
  <div class="container container-tight py-4">
    <div class="text-center mb-4">
      <a href="." class="navbar-brand navbar-brand-autodark"><img src="{{asset('back/dist/img/logo-favicon/logo-1.png')}}" height="50" alt=""></a>
    </div>
    @livewire('author-login-form')
    <div class="text-center text-muted mt-3">
      Don't have account yet? <a href="./sign-up.html" tabindex="-1">Sign up</a>
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