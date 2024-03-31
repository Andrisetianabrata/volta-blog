{{-- @dd($users->banner) --}}
@extends('front.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Author List')
@section('content-main')
<main>
  <section class="section">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="breadcrumbs mb-4"><a href="/">Home</a>
            <span class="mx-1">/</span><a href="/">About</a>
          </div>
          <h1 class="mb-4 border-bottom border-primary d-inline-block">Author List</h1>
        </div>

        <div class="col-lg-8 mb-5 mb-lg-0">
          <div class="row">
            @foreach ($users as $user)
              <div class="col-md-6 mb-4">
                <article class="card article-card article-card-sm h-100">
                  <a href="{{route('about',$user->username)}}">
                    <div class="card-image">
                      <div class="post-info">
                      </div>
                      <img loading="lazy" decoding="async" src="{{$user->banner}}" alt="Post Thumbnail" class="w-100">
                    </div>
                  </a>
                  <div class="card-body px-0 pb-0">
                    <ul class="post-meta mb-2">
                      <li> 
                        <a href="{{route('about',$user->username)}}" style="pointer-events: none;">{{$user->authorType->name}}</a>
                      </li>
                    </ul>
                    <h2>
                      <a class="post-title" href="{{route('about',$user->username)}}">{{$user->name}}</a>
                    </h2>
                    <p class="card-text mb-3 pb-2">{!!Str::ucFirst(wordsExcerpt($user->biography))!!}</p>
                    <a class="btn btn-sm btn-outline-primary" href="{{route('about',$user->username)}}">Know More</a>
                  </div>
                </article>
              </div>
            @endforeach

            <div class="col-12">
              <div class="row">
                <div class="col-12">
                  {{$users->appends(request()->input())->links('page-paginate')}}
                </div>
              </div>
            </div>
            
          </div>
        </div>

        @include('front.inc.side-bar', ['id' => 1])
      </div>
    </div>
  </section>
</main>
@endsection
@push('script')
<script>
  // Pilih semua elemen img
  const images = document.querySelectorAll('img:not([id])');
  
  // Iterasi melalui setiap elemen img
  images.forEach(function(img) {
    // Hapus atribut style
    
    // Tambahkan class 'w-100 h-100' jika belum ada
    if (!img.classList.contains('w-100')) {
      img.removeAttribute('style');
      img.classList.add('w-100', 'h-100');
      img.setAttribute('loading', 'lazy')
      img.setAttribute('decoding', 'async')
    }
  });
</script>
@endpush