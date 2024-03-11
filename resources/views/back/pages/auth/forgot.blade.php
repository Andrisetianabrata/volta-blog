@extends('back.layouts.auth-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Forgot Password')
@section('content')
<div class="page page-center">
  <div class="container container-tight py-4">
    <div class="text-center mb-4">
      <a href="." class="navbar-brand navbar-brand-autodark"><img src="{{asset('back/dist/img/logo-favicon/logo-1.png')}}" height="50" alt=""></a>
    </div>
    @livewire('author-forgot-form')
    <div class="text-center text-muted mt-3">
      Forget it, <a href="{{route('author.login')}}">send me back</a> to the sign in screen.
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