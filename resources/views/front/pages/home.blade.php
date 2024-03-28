@extends('front.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Home')
@section('content-main')
<main>
  <section class="section">
    <div class="container">
      <div class="row no-gutters-lg">
        
        <div class="col-12">
          <h2 class="section-title">Latest Articles</h2>
        </div>
        <div class="col-lg-8 mb-5 mb-lg-0">
          <div class="row">

            <div class="col-12 mb-4">
              @if (singleLatestPost())
              <article class="card article-card">
                <a href="{{route('read-post', singleLatestPost()->post_slug)}}">
                  <div class="card-image">
                    <div class="post-info"> 
                      <span class="text-uppercase">{{dateFormat(singleLatestPost()->created_at)}}</span>
                      <span class="text-uppercase">{{singleLatestPost()->created_at->diffForHumans()}}</span>
                    </div>
                    <img loading="lazy" decoding="async" src="./storage/images/thumbnails/{{singleLatestPost()->thumbnail}}" alt="Post Thumbnail" class="w-100">
                  </div>
                </a>
                <div class="card-body px-0 pb-1">
                  <ul class="post-meta mb-2">
                    <li> 
                      <a href="{{route('category-post', singleLatestPost()->category->slug)}}">{{singleLatestPost()->category->subcategory_name}}</a>
                      @if (isset(singleLatestPost()->category->parentCategory->slug))
                        <a href="{{route('tags-post', singleLatestPost()->category->parentCategory->slug)}}">{{singleLatestPost()->category->parentCategory->category_name}}</a>
                      @endif
                      {{-- <a href="#!">news</a> --}}
                    </li>
                  </ul>
                  <h2 class="h1"><a class="post-title" href="{{route('read-post', singleLatestPost()->post_slug)}}">{{shortTitle(singleLatestPost()->post_title)}}</a>
                  </h2>
                  <p class="card-text">{!!Str::ucFirst(wordsExcerpt(singleLatestPost()->post_content, 35))!!}</p>
                  <div class="content"> <a class="read-more-btn" href="{{route('read-post', singleLatestPost()->post_slug)}}">Read Full Article</a>
                  </div>
                </div>
              </article>
              @endif
            </div>

            @if (latestPostList())
              @foreach (latestPostList() as $posts)
                <div class="col-md-6 mb-4">
                  <article class="card article-card article-card-sm h-100">
                    <a href="{{route('read-post', $posts->post_slug)}}">
                      <div class="card-image">
                        <div class="post-info"> 
                          <span class="text-uppercase">{{dateFormat($posts->created_at)}}</span>
                          <span class="text-uppercase">{{$posts->created_at->diffForHumans()}}</span>
                        </div>
                        <img loading="lazy" decoding="async" src="./storage/images/thumbnails/{{$posts->thumbnail}}" alt="Post Thumbnail" class="w-100">
                      </div>
                    </a>
                    <div class="card-body px-0 pb-0">
                      <ul class="post-meta mb-2">
                        <li> 
                          <a href="{{route('category-post', $posts->category->slug)}}">{{$posts->category->subcategory_name}}</a>
                          @if (isset($posts->category->parentCategory->slug))
                            <a href="{{route('tags-post', $posts->category->parentCategory->slug)}}">{{$posts->category->parentCategory->category_name}}</a>
                          @endif
                        </li>
                      </ul>
                      <h2>
                        <a class="post-title" href="{{route('read-post', $posts->post_slug)}}">{{shortTitle($posts->post_title)}}</a>
                      </h2>
                      <p class="card-text">{!!Str::ucFirst(wordsExcerpt($posts->post_content, 35))!!}</p>
                      <div class="content"> <a class="read-more-btn" href="{{route('read-post', $posts->post_slug)}}">Read Full Article</a>
                      </div>
                    </div>
                  </article>
                </div>
              @endforeach
            @endif
            
            <!-- pagination -->
            <div class="col-12">
              <div class="row">
                <div class="col-12">
                  {{-- {{latestPostList()->appends(request()->input())->links('page-paginate')}} --}}
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