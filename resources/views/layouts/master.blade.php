<!DOCTYPE html>
<html>
    <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href="{{ asset('/css/blog.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/editormd.css') }}" />

  </head>
    <body>
        @yield('nav')
        
        <div class="container paddingTop100 paddingBottom100">
        	@yield('content')
        </div>

        <!-- Bootstrap core JavaScript -->
	    <script src="{{URL::asset('/vendor/jquery/jquery.min.js')}}"></script>
	    <script src="{{URL::asset('/vendor/popper/popper.min.js')}}"></script>
	    <script src="{{URL::asset('/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
	    <script src="{{URL::asset('/js/blog.js')}}"></script>
        @yield('md')
    </body>
</html>

