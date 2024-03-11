<div id="galery">
    <div class="page-header">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-auto">
              <img id="image-profile" alt="avatar-{{$author->username}}" class="avatar avatar-lg rounded" src="{{url($author->picture)}}"></img>
            </div>
            <div class="col">
              <h1 class="fw-bold">{{$author->name}}</h1>
              <div class="mt-1 mb-1">@ {{$author->username}} | {{$author->authorType->name}}
              </div>
              <div class="list-inline text-muted">
                <div class="list-inline-item">
                  <!-- Download SVG icon from http://tabler-icons.io/i/map -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-skyscraper" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 21l18 0" /><path d="M5 21v-14l8 -4v18" /><path d="M19 21v-10l-6 -4" /><path d="M9 9l0 .01" /><path d="M9 12l0 .01" /><path d="M9 15l0 .01" /><path d="M9 18l0 .01" /></svg>
                  {{$author->city}}
                </div>
                <div class="list-inline-item">
                  <!-- Download SVG icon from http://tabler-icons.io/i/mail -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z"></path><path d="M3 7l9 6l9 -6"></path></svg>
                  <a href="#" class="text-reset">{{$author->email}}</a>
                </div>
                <div class="list-inline-item">
                  <!-- Download SVG icon from http://tabler-icons.io/i/cake -->
                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M3 20h18v-8a3 3 0 0 0 -3 -3h-12a3 3 0 0 0 -3 3v8z"></path><path d="M3 14.803c.312 .135 .654 .204 1 .197a2.4 2.4 0 0 0 2 -1a2.4 2.4 0 0 1 2 -1a2.4 2.4 0 0 1 2 1a2.4 2.4 0 0 0 2 1a2.4 2.4 0 0 0 2 -1a2.4 2.4 0 0 1 2 -1a2.4 2.4 0 0 1 2 1a2.4 2.4 0 0 0 2 1c.35 .007 .692 -.062 1 -.197"></path><path d="M12 4l1.465 1.638a2 2 0 1 1 -3.015 .099l1.55 -1.737z"></path></svg>
                  {{$author->birth}}
                </div>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
</div>
