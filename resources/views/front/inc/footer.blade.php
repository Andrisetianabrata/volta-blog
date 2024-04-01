<footer class="bg-dark mt-5">
   <div class="container section">
     <div class="row">
       <div class="col-lg-10 mx-auto text-center">
         <a class="d-inline-block mb-4 pb-2" href="/">
         <img loading="prelaod" id="logo" decoding="async" class="img-fluid" src="./back/dist/img/logo-favicon/logo-white-1.png" style="max-width: 100px;" alt="{{blogInfo()->blog_name}}">
         </a>
         <ul class="p-0 d-flex navbar-footer mb-0 list-unstyled">
          <li class="nav-item"> <a class="nav-link" href="{{route('home')}}">Home</a>
          </li>
          <li class="nav-item"> <a class="nav-link" href="{{route('about-list')}}">About</a>
          </li>
          <li class="nav-item"> <a class="nav-link" href="{{route('articles')}}">Articles</a>
          </li>
         </ul>
       </div>
     </div>
   </div>
   <div class="copyright bg-dark content">Copyright &copy; <script>document.write(new Date().getFullYear())</script>
    <a href="." class="link-secondary">{{blogInfo()->blog_name}}</a>.
    All rights reserved.</script></div>
 </footer>