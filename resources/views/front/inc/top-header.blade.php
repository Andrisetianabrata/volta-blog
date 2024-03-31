<header class="navigation">
   <div class="container">
     <nav class="navbar navbar-expand-lg navbar-light px-0">
       <a class="navbar-brand order-1 py-0" href="/">
       <img loading="prelaod" id="logo" decoding="async" class="img-fluid" src="./back/dist/img/logo-favicon/logo-1.png" style="max-width: 100px;" alt="{{blogInfo()->blog_name}}">
       </a>
       <div class="navbar-actions order-3 ml-0 ml-md-4">
         <button aria-label="navbar toggler" class="navbar-toggler border-0" type="button" data-toggle="collapse"
           data-target="#navigation"> <span class="navbar-toggler-icon"></span>
         </button>
       </div>
       <form action="#!" class="search order-lg-3 order-md-2 order-3 ml-auto">
         <input id="search-query" name="s" type="search" placeholder="Search..." autocomplete="off">
       </form>
       <div class="collapse navbar-collapse text-center order-lg-2 order-4" id="navigation">
         <ul class="navbar-nav mx-auto mt-3 mt-lg-0">
           <li class="nav-item"> <a class="nav-link" href="{{route('about-list')}}">About</a>
           </li>
           <li class="nav-item"> <a class="nav-link" href="{{route('articles')}}">Articles</a>
           </li>
           <li class="nav-item dropdown">
             <a class="nav-link dropdown-toggle" href="#" role="button"
               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             Categories
             </a>
             <div class="dropdown-menu"> 
              @if (categories())
                @foreach (categories() as $category)
               
                    {{-- @dd($category->slug) --}}
                    <a class="dropdown-item" href="{{route('category-post', $category->slug)}}">{{$category->subcategory_name}}</a>
                  
                @endforeach
              @endif
             </div>
           </li>
           <li class="nav-item"> <a class="nav-link" href="contact.html">Contact</a>
           </li>
         </ul>
       </div>
     </nav>
   </div>
 </header>