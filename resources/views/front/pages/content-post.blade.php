{{-- @dd($post->author) --}}
@extends('front.layout.pages-layout')

{{-- @section('ogTitle', $post->post_title)
@section('ogDescription', Str::limit(strip_tags($post->post_content), 150))
@section('ogImage', asset('storage/images/thumbnails/' . $post->thumbnail)) --}}

@section('pageTitle', isset($pageTitle) ? $pageTitle : '')
@section('meta')
<!-- Primary Meta Tags -->
{!! SEOMeta::generate() !!}
<!-- Open Graph / Facebook -->
{!! OpenGraph::generate() !!}
@endsection
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
              @if (isset($post->author->username))
              <li> <a href="{{route('about', $post->author->username)}}">{{$post->author->name}}</a>
              </li>
              @endif
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

        @include('front.inc.side-bar', ['id' => isset($post->author->id) ? $post->author->id : $users->id])

      </div>
    </div>
  </section>
</main>
@endsection
@push('style')
  <link rel="stylesheet" href="./packages/jQuery-share/dist/jquery.floating-social-share.min.css">
@endpush
@push('script')
  <script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
  <script src="packages/jQuery-share/dist/jquery.floating-social-share.min.js"></script>
  <script>
    $("body").floatingSocialShare({
      buttons: [ // all of the currently available social buttons
        "facebook", "telegram", "twitter", "whatsapp"
      ],
      title: document.title, // your title, default is current page's title
      url: window.location.href,  // your url, default is current page's url
      text: { // the title of tags
        'default': 'share with ', 
        'facebook': 'share with facebook', 
        'twitter': 'tweet'
      },
      text_title_case: false, // if set true, then will convert share texts to title case like Share With G+
      description: $('meta[name="description"]').attr("content"), // your description, default is current page's description
      media: $('meta[property="og:image"]').attr("content"), // pinterest media
      target: true, // open share pages, such as Twitter and Facebook share pages, in a new tab
      popup: true, // open links in popup
      popup_width: 700, // the sharer popup width, default is 400px
      popup_height: 500 // the sharer popup height, default is 300px
    });
  </script>
  <script>
      // 2. This code loads the IFrame Player API code asynchronously.
      var tag = document.createElement('script');

      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      // 3. This function creates an <iframe> (and YouTube player)
      //    after the API code downloads.
      var player;
      function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
          height: '390',
          width: '640',
          videoId: 'M7lc1UVf-VE',
          playerVars: {
            'playsinline': 1
          },
          events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
          }
        });
      }

      // 4. The API will call this function when the video player is ready.
      function onPlayerReady(event) {
        event.target.playVideo();
      }

      // 5. The API calls this function when the player's state changes.
      //    The function indicates that when playing a video (state=1),
      //    the player should play for six seconds and then stop.
      var done = false;
      function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PLAYING && !done) {
          setTimeout(stopVideo, 6000);
          done = true;
        }
      }
      function stopVideo() {
        player.stopVideo();
      }
    </script>
@endpush