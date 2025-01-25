{{-- @dd($posts) --}}
@extends('front.layout.pages-layout')
{{-- @section('pageTitle', isset($pageTitle) ? $pageTitle : $user->name) --}}
{{-- @section('ogTitle', $user->name)
@section('ogDescription', Str::limit(strip_tags($user->biography), 150))
@section('ogImage', $user->banner)) --}}
@section('meta')
{!! SEOMeta::generate() !!}
{!! OpenGraph::generate() !!}
@endsection
@section('content-main')
<main>
  <section class="section">
    <div class="container">
      <div class="row">
        <div class="col-8">
          <div class="breadcrumbs mb-4"> <a href="/">Home</a>
            <span class="mx-1">/</span> <a href="/about-list">About</a>
            <span class="mx-1">/</span> <a href="">{{$user->name}}</a>
          </div>
        </div>
        <div class="col-lg-8 mb-5 mb-lg-0">
          <div class="mb-5">
            <img id="thumb" decoding="async" src="{{$user->banner}}" class="img-fluid w-100 mb-4" alt="Author Image">
            <h1 class="mb-4 mt-3">{{$user->name}}</h1>
            <div class="content">
              {!!$user->biography!!}
            </div>
          </div>
          <div class="col-12 mt-5">
            <h2 class="section-title">{{wordsExcerpt($user->name, 1, ' ')}} Articles</h2>
          </div>
          <div class="row">
            @foreach ($posts as $post)
            <div class="col-md-6 mb-4 mt-2">
              <article class="card article-card article-card-sm h-100">
                <a href="{{route('read-post', $post->post_slug)}}">
                  <div class="card-image">
                    <div class="post-info"> 
                      <span class="text-uppercase">{{dateFormat($post->created_at)}}</span>
                      <span class="text-uppercase">{{$post->created_at->diffForHumans()}}</span>
                    </div>
                    <img loading="lazy" decoding="async" src="./storage/images/thumbnails/{{$post->thumbnail}}" alt="Post Thumbnail" class="w-100">
                  </div>
                </a>
                <div class="card-body px-0 pb-0">
                  <ul class="post-meta mb-2">
                    <li> 
                      <a href="{{route('category-post', $post->category->slug)}}">{{$post->category->subcategory_name}}</a>
                      @if (isset($post->category->parentCategory->slug))
                      <a href="{{route('tags-post', $post->category->parentCategory->slug)}}">{{$post->category->parentCategory->category_name}}</a>
                      @endif
                    </li>
                  </ul>
                  <h2>
                    <a class="post-title" href="{{route('read-post', $post->post_slug)}}">{{shortTitle($post->post_title)}}</a>
                  </h2>
                  <p class="card-text">{!!Str::ucFirst(wordsExcerpt($post->post_content, 35))!!}</p>
                  <div class="content"> <a class="read-more-btn" href="{{route('read-post', $post->post_slug)}}">Read Full Article</a>
                  </div>
                </div>
              </article>
            </div>
            @endforeach
            <!-- pagination -->
            <div class="col-12">
              <div class="row">
                <div class="col-12">
                  {{$posts->appends(request()->input())->links('page-paginate')}}
                </div>
              </div>
            </div>
          </div>
        </div>
        @include('front.inc.side-bar', ['id'=>$user->id])
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