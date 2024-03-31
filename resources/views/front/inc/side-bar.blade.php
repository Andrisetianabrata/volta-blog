<div class="col-lg-4">
  <div class="widget-blocks">
    <div class="row">
      <div class="col-lg-12">
        <div class="widget">
          <div class="widget-body">
            <img loading="lazy" decoding="async" src="{{userInfo($id)->banner}}" alt="About Me" class="w-100 author-thumb-sm d-block">
            <h2 class="widget-title my-3">{{userInfo($id)->name}}</h2>
            <p class="mb-3 pb-2">{!!wordsExcerpt(userInfo($id)->biography)!!}</p>
            <a href="{{route('about',userInfo($id)->username)}}" class="btn btn-sm btn-outline-primary">Know
            More</a>
          </div>
        </div>
      </div>

      <div class="col-lg-12 col-md-6">
        <div class="widget">
          <h2 class="section-title mb-3">Recommended</h2>
          <div class="widget-body">
            <div class="widget-list">
              @if (recomendedPosts(4))
                @foreach (recomendedPosts(4) as $recomendedPosts)
                  <a class="media align-items-center" href="{{route('read-post', $recomendedPosts->post_slug)}}">
                    <img loading="lazy" decoding="async" src="./storage/images/thumbnails/{{$recomendedPosts->thumbnail}}" alt="Post Thumbnail" class="w-100">
                    <div class="media-body ml-3">
                      <h3 style="margin-top:-5px">{{shortTitle($recomendedPosts->post_title, 20)}}</h3>
                      <p class="mb-0 small">{!!Str::ucFirst(wordsExcerpt($recomendedPosts->post_content, 5))!!}</p>
                    </div>
                  </a>
                @endforeach
              @endif
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-12 col-md-6">
        <div class="widget">
          <h2 class="section-title mb-3">Categories</h2>
          <div class="widget-body">
            <ul class="widget-list">
              @if (categories())
                @foreach (categories() as $category)
                  <li>
                    {{-- @dd($category->slug) --}}
                    <a href="{{route('category-post', $category->slug)}}">{{Str::ucFirst($category->subcategory_name)}}<span class="ml-auto"> ({{$category->posts->count()}})</span></a>
                  </li>
                @endforeach
              @endif
            </ul>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>