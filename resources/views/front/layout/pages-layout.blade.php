{{-- @dd(blogInfo()) --}}
<!DOCTYPE html>
<!--
  // WEBSITE: https://themefisher.com
  // TWITTER: https://twitter.com/themefisher
  // FACEBOOK: https://www.facebook.com/themefisher
  // GITHUB: https://github.com/themefisher/
  -->
<html lang="en-us">
  <head>
    <meta charset="utf-8">
    <title>@yield('pageTitle')</title>
    <meta property="og:title" content="@yield('ogTitle', blogInfo()->blog_name)">
    <meta property="og:description" content="@yield('ogDescription', blogInfo()->blog_description)">
    <meta property="og:image" content="@yield('ogImage', asset('default-image.jpg'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="article">
    
    <base href="/">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5">
    <meta name="description" content="{{blogInfo()->blog_description}}">
    <meta name="author" content="{{blogInfo()->blog_name}}">
    <link rel="shortcut icon" href="./back/dist/img/logo-favicon/favicon-1.png" type="image/x-icon">
    <link rel="icon" href="./back/dist/img/logo-favicon/favicon-1.png" type="image/x-icon">
    <!-- theme meta -->
    <meta name="theme-name" content="reporter" />
    <!-- # Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Neuton:wght@700&family=Work+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- # CSS Plugins -->
    <link rel="stylesheet" href="./front/plugins/bootstrap/bootstrap.min.css">
    <link href="./prism.css" rel="stylesheet" />
    <!-- # Main Style Sheet -->
    <link rel="stylesheet" href="./front/css/style.css">
    @stack('style')
  </head>
  <body class="match-braces rainbow-braces treeview">
    {{-- <header data-plugin-header="download-button autolinker line-numbers show-language normalize-whitespace match-braces rainbow-braces treeview"></header> --}}
    @include('front.inc.top-header')
    @yield('content-main')
    @include('front.inc.footer')
    <!-- # JS Plugins -->
    <script src="./front/plugins/jquery/jquery.min.js"></script>
    <script src="./front/plugins/bootstrap/bootstrap.min.js"></script>
    <!-- Main Script -->
    <script src="./front/js/script.js"></script>
    <script src="prism.js"></script>
    @stack('script')
  </body>
</html>
