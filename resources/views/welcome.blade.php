{{-- @dd(route("author.change-profile-picture")) --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link rel="stylesheet" href="{{ asset('/ijaboCropTool.min.css') }}">

    </head>
    <body class="antialiased">
        <input type="file" name="file" id="file">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
        <script src="{{ asset('/ijaboCropTool.min.js') }}"></script> 
        <script>
            $('#file').ijaboCropTool({
               preview : '.image-previewer',
               setRatio:1,
               allowedExtensions: ['jpg', 'jpeg','png'],
               buttonsText:['CROP','QUIT'],
               buttonsColor:['#30bf7d','#ee5155', -15],
               processUrl:'{{ route("author.change-blog-favicon") }}',
               withCSRF:['_token','{{ csrf_token() }}'],
               onSuccess:function(message, element, status){
                  alert(message);
               },
               onError:function(message, element, status){
                 alert(message);
               }
            });
       </script>
    </body>
</html>
