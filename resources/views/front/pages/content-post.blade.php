{{-- @dd($post->author) --}}
@extends('front.layout.pages-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : '')
@section('content-main')
<main>
  <section class="section">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mb-5 mb-lg-0">
          
          <article>
            <img loading="lazy" id="thumbnail" decoding="async" src="./storage/images/thumbnails/{{$post->thumbnail}}" alt="Post Thumbnail" class="w-100">
            <ul class="post-meta mb-2 mt-4">
              <li>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" style="margin-right:5px;margin-top:-4px" class="text-dark" viewBox="0 0 16 16">
                  <path d="M5.5 10.5A.5.5 0 0 1 6 10h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z"></path>
                  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z"></path>
                  <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z"></path>
                </svg>
                <span>{{dateFormat($post->created_at)}}</span>
              </li>
            </ul>
            <h1 class="my-3">{{$post->post_title}}</h1>
            <ul class="post-meta mb-4">
              <li> <a href="{{route('category-post', $post->category->slug)}}">{{$post->category->subcategory_name}}</a>
              </li>
              <li> <a href="{{route('about', $post->author->username)}}">{{$post->author->name}}</a>
              </li>
            </ul>

            <div class="content text-left">
              {!!$post->post_content!!}
            </div>

          </article>

          <div class="mt-5">
            <div id="disqus_thread">Disqus comments not available by default when the website is previewed locally.</div>
            <script type="application/javascript">
              var disqus_config = function () {
                this.language = "id";
                  
                  
              };
               /**
                *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
                /*
                var disqus_config = function () {
                this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
                this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                };
                */
                (function() { // DON'T EDIT BELOW THIS LINE
                var d = document, s = d.createElement('script');
                s.src = 'https://volta-1.disqus.com/embed.js';
                s.setAttribute('data-timestamp', +new Date());
                (d.head || d.body).appendChild(s);
                })();
            </script>
            <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a>
            </noscript>
            <a href="https://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
          </div>
          
        </div>

        @include('front.inc.side-bar', ['id' => $post->author->id])

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