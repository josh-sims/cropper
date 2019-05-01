
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="http://gmpg.org/xfn/11" rel="profile">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" >

    <title>

        Cropper

    </title>

    <!-- CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/jquery-ui.min.css">
    <link rel="stylesheet" href="/css/app.css?v=1">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" >

    <!-- Meta -->
    <meta name="description" content="tool to resize images">
    <meta name="author" content="Josh Sims">

  </head>
  <body>
    @include('layouts.navigation')
    <div class="container">


      @yield('content')


    </div> <!-- /close container -->

    @include('layouts.footer')
  </body>
</html>
