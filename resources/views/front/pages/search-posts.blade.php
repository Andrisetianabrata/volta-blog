@extends('front.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : '')
@section('content-main')
<main>
  <section class="section">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="breadcrumbs mb-4"><a href="/">Home</a>
            <span class="mx-1">/</span><a href="/">Articles</a>
            <span class="mx-1">/</span><a href="/">{{$query}}</a>
          </div>
          <h1 class="mb-4 border-bottom border-primary d-inline-block">Articles</h1>
        </div>

        <div class="col-lg-8 mb-5 mb-lg-0">
          <div class="row">
            @forelse ($posts as $post)
              <div class="col-md-6 mb-4">
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
                      </li>
                      <li> 
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
            @empty
            <div class="col-md-6 mb-4">
              <div class="notices info">
                  <span class=" text-danger">No post(s) for {{$query}}</span>
              </div>
            </div>
            @endforelse

            <div class="col-12">
              <div class="row">
                <div class="col-12">
                  {{$posts->appends(request()->input())->links('page-paginate')}}
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