<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>HiveApp</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <meta name="author" content="" />

  <!-- Facebook and Twitter integration -->
  <meta property="og:title" content=""/>
  <meta property="og:image" content=""/>
  <meta property="og:url" content=""/>
  <meta property="og:site_name" content=""/>
  <meta property="og:description" content=""/>
  <meta name="twitter:title" content="" />
  <meta name="twitter:image" content="" />
  <meta name="twitter:url" content="" />
  <meta name="twitter:card" content="" />

  <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
  <link rel="shortcut icon" href="favicon.ico">

  <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">

  <!-- Animate.css -->
  <link rel="stylesheet" href="{{asset('home/css/animate.css')}}">
  <!-- Icomoon Icon Fonts-->
  <link rel="stylesheet" href="{{asset('home/css/icomoon.css')}}">
  <!-- Bootstrap  -->
  <link rel="stylesheet" href="{{asset('home/css/bootstrap.css')}}">
  <!-- Flexslider  -->
  <link rel="stylesheet" href="{{asset('home/css/flexslider.css')}}">
  <!-- Flaticons  -->
  <link rel="stylesheet" href="{{asset('home/fonts/flaticon/font/flaticon.css')}}">
  <!-- Owl Carousel -->
  <link rel="stylesheet" href="{{asset('home/css/owl.carousel.min.css')}}">
  <link rel="stylesheet" href="{{asset('home/css/owl.theme.default.min.css')}}">
  <!-- Theme style  -->
  <link rel="stylesheet" href="{{asset('home/css/style.css')}}">

  <!-- Modernizr JS -->
  <script src="{{asset('home/js/modernizr-2.6.2.min.js')}}"></script>
  <!-- FOR IE9 below -->
  <!--[if lt IE 9]>
  <script src="{{asset('home/js/respond.min.js')}}"></script>
  <![endif]-->

</head>
<body>
  <div id="colorlib-page">
    <a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle"><i></i></a>
    <aside id="colorlib-aside" role="complementary" class="border js-fullheight">
      <h1 id="colorlib-logo"><a href="index.html">HiveApp</a></h1>
      <nav id="colorlib-main-menu" role="navigation">
        <ul>
          <li id="index"><a href="{{route('index')}}">INICIO</a></li>
          @if (Route::has('login'))
            @auth
              <li id="login_inicio"><a href="{{route('dashboard')}}" >VOLVER AL SISTEMA</a></li>
            @else
              <li id="login_inicio"><a href="{{route('login')}}" >INGRESAR</a></li>
              <li id="registrarse"><a href="{{route('register')}}">Registrarse</a></li>
            @endauth
          @endif
          <li id="noticias" ><a href="{{route('noticias')}}">Noticias</a></li>
          <li id="descargas" ><a href="{{route('descargas')}}">Descargas</a></li>
          <li id="contactos"><a href="{{route('contactos')}}">Contactos</a></li>
        </ul>
      </nav>

      <div class="colorlib-footer">
        <p><small>&copy; <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
          Copyright &copy;<script>document.write(new Date().getFullYear());</script> Derechos Reservados <i class="icon-heart" aria-hidden="true"></i> By <a href="http://skynsoft.com" target="_blank">SkynSoft</a>
          <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --> </span> <span></span></small></p>
          <ul>
            <li><a href="#"><i class="icon-facebook2"></i></a></li>
            <li><a href="#"><i class="icon-twitter2"></i></a></li>
            <li><a href="#"><i class="icon-instagram"></i></a></li>
            <li><a href="#"><i class="icon-linkedin2"></i></a></li>
          </ul>
        </div>

      </aside>
      <div id="colorlib-main">
        @yield('content')
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{asset('home/js/jquery.min.js')}}"></script>
    <!-- jQuery Easing -->
    <script src="{{asset('home/js/jquery.easing.1.3.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('home/js/bootstrap.min.js')}}"></script>
    <!-- Waypoints -->
    <script src="{{asset('home/js/jquery.waypoints.min.js')}}"></script>
    <!-- Flexslider -->
    <script src="{{asset('home/js/jquery.flexslider-min.js')}}"></script>
    <!-- Sticky Kit -->
    <script src="{{asset('home/js/sticky-kit.min.js')}}"></script>
    <!-- Owl carousel -->
    <script src="{{asset('home/js/owl.carousel.min.js')}}"></script>
    <!-- Counters -->
    <script src="{{asset('home/js/jquery.countTo.js')}}"></script>


    <!-- MAIN JS -->
    <script src="{{asset('home/js/main.js')}}"></script>

  </body>
  </html>
