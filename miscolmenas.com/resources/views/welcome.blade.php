<!DOCTYPE HTML>
<!--
	Eventually by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>HiveApp</title>
		<meta charset="utf-8" />
    <link rel="icon" type="image/png" href="{{asset('adminlite/img/logo-abeja.png')}}" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="{{asset('home/assets/css/main.css')}}" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
	</head>
	<body>

		<!-- Header -->
			<header id="header">
				<h1>Bienvenido a HiveApp</h1>
				<p>Software de gestión apícola<br />
				La apicultura comercial es un negocio dinámico que requiere decisiones<br>
         de gestión diarias basadas en datos clave sobre su operación.</p>


         <h4>Basado en datos:</h4>
         </li><li>utilice informes oportunos para tomar decisiones inteligentes de administración de negocios y apiario.
			</header>

		<!-- Signup Form -->
			<form id="signup-form" method="post" action="#">
        <div class="flex-center position-ref full-height">
           @if (Route::has('login'))
               <div class="top-right links">
                   @auth
                     <br>
                       <a class="btn btn-successs" href="{{ url('/dashboard') }}">Inicio</a>
                   @else

                        <br>
                       <a  href="{{ route('login') }}">Login</a>|
                       <a href="{{ route('register') }}">Registrar</a>
                   @endauth
               </div>
           @endif


       </div>

			</form>

		<!-- Footer -->
			<footer id="footer">
				<ul class="icons">
					<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
					<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
					<li><a href="#" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
				</ul>
				<ul class="copyright">
					<li>&copy; Todos los derechos reservados</li><li>by <a href="#">ODRES GROUP 2018</a></li>
				</ul>
			</footer>

		<!-- Scripts -->
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="{{asset('home/assets/js/main.js')}}"></script>

	</body>
</html>
