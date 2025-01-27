@extends('front.layout.pages-layout')
@section('content-main')
<main>
  <section style="min-height: 100vh; display: flex; align-items: center; justify-content: center; flex-direction: column;">
    <dotlottie-player 
      src="https://lottie.host/4de24b38-06c9-42e4-92b3-b449803dcb76/IZmYWwtn5N.lottie" 
      background="transparent" 
      speed="1" 
      style="width: 350px; height: 350px;" 
      loop 
      autoplay>
    </dotlottie-player>
    <h1 class="mb-4 text-center">Page Not Found!</h1>
    <a href="/" class="btn btn-outline-primary">Back To Home</a>
  </section>
</main>
@endsection
