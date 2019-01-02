@extends('home.layout')
@section('content')

  <aside id="colorlib-hero" class="js-fullheight">
  					<div class="flexslider js-fullheight">
  						<ul class="slides">
  							<li style="background-image: url({{asset('home/images/img1.jpg')}});">
  								<div class="overlay"></div>
  								<div class="container-fluid">
  									<div class="row">
  										<div class="col-md-6 col-md-offset-3 col-md-push-3 col-sm-12 col-xs-12 js-fullheight slider-text">
  											<div class="slider-text-inner">
  												<div class="desc">
  													<h1>HiveApp-Software de apicultura</h1>
  													<h2>Elimina el trabajo en papel y ahorra horas de trabajo con HiveApp software de apicultura</h2>
  													<p><a href="{{route('register')}}" class="btn btn-primary btn-learn">Registrarse <i class="icon-arrow-right3"></i></a></p>
  												</div>
  											</div>
  										</div>
  									</div>
  								</div>
  							</li>
  							<li style="background-image: url({{asset('home/images/img2.jpg')}});">
  								<div class="overlay"></div>
  								<div class="container-fluid">
  									<div class="row">
  										<div class="col-md-6 col-md-offset-3 col-md-push-3 col-sm-12 col-xs-12 js-fullheight slider-text">
  											<div class="slider-text-inner">
  												<div class="desc">
  													<h1>Mejorar la comunicación organizacional</h1>
  													<h2>Mantente actualizados de lo que esta sucediendo en tus apiarios</h2>
  													<p><a class="btn btn-primary btn-learn">Registrarse <i class="icon-arrow-right3"></i></a></p>
  												</div>
  											</div>
  										</div>
  									</div>
  								</div>
  							</li>
  							<li style="background-image: url({{asset('home/images/img3.jpg')}});">
  								<div class="overlay"></div>
  								<div class="container-fluid">
  									<div class="row">
  										<div class="col-md-6 col-md-offset-3 col-md-push-3 col-sm-12 col-xs-12 js-fullheight slider-text">
  											<div class="slider-text-inner">
  												<div class="desc">
  													<h1>Basado en datos </h1>
  													<h2>Utilice informes oportunos para tomar decisiones inteligentes de administración de negocios y apiario.</h2>
  													<p><a class="btn btn-primary btn-learn">Registrarse <i class="icon-arrow-right3"></i></a></p>
  												</div>
  											</div>
  										</div>
  									</div>
  								</div>
  							</li>
  						</ul>
  					</div>
  				</aside>

  				<div class="colorlib-about">
  					<div class="colorlib-narrow-content">
  						<div class="row">
  							<div class="col-md-6">
  								<div class="about-img animate-box" data-animate-effect="fadeInLeft" style="background-image: url({{asset('home/images/soft1.png')}});">
  								</div>
  							</div>
  							<div class="col-md-6 animate-box" data-animate-effect="fadeInLeft">
  								<div class="about-desc">
  									<span class="heading-meta">Bienvenidos</span>
  									<h2 class="colorlib-heading">Que es HiveApp</h2>
  									<p>HiveApp es mas que un software de gestion apícola , es una plataforma desarrollada por y para apicultores apacionados por las abejas , que desean llevar el manejo de sus apiarios a la vanguardia tecnológica.</p>
  									<p>Hoy en día tener acceso a la tecnología no es tan complicado, el acceso está abierto para todos aquellos apicultores que quieran hacer uso de ello. Gracias a HiveApp, obtendras  múltiples ventajas .</p>
  								</div>
  								<div class="row padding">
  									<div class="col-md-4 no-gutters animate-box" data-animate-effect="fadeInLeft">
  										<a href="#" class="steps active">
  											<p class="icon"><span><i class="icon-check"></i></span></p>
  											<h3>Gestión<br>de la información</h3>
  										</a>
  									</div>
  									<div class="col-md-4 no-gutters animate-box" data-animate-effect="fadeInLeft">
  										<a href="#" class="steps">
  											<p class="icon"><span><i class="icon-check"></i></span></p>
  											<h3>Reportes <br> y estadisticas</h3>
  										</a>
  									</div>
  									<div class="col-md-4 no-gutters animate-box" data-animate-effect="fadeInLeft">
  										<a href="#" class="steps">
  											<p class="icon"><span><i class="icon-check"></i></span></p>
  											<h3>Proyección <br>de crecimiento</h3>
  										</a>
  									</div>
  								</div>
  							</div>
  						</div>
  					</div>
  				</div>


  				<div id="colorlib-counter" class="colorlib-counters" style="background-image: url({{asset('home/images/pan1.jpg')}});" data-stellar-background-ratio="0.5">
  					<div class="overlay"></div>
  					<div class="colorlib-narrow-content">
  						<div class="row">
  						</div>
  						<div class="row">
  							<div class="col-md-3 text-center animate-box">
  								<span class="icon"><i class="flaticon-architect-with-helmet"></i></span>
  								<span class="colorlib-counter js-counter" data-from="0" data-to="1539" data-speed="5000" data-refresh-interval="50"></span>
  								<span class="colorlib-counter-label">Proceso</span>
  							</div>
  							<div class="col-md-3 text-center animate-box">
  								<span class="icon"><i class="flaticon-architect-with-helmet"></i></span>
  								<span class="colorlib-counter js-counter" data-from="0" data-to="3653" data-speed="5000" data-refresh-interval="50"></span>
  								<span class="colorlib-counter-label">Disponibilidad</span>
  							</div>
  							<div class="col-md-3 text-center animate-box">
  								<span class="icon"><i class="flaticon-architect-with-helmet"></i></span>
  								<span class="colorlib-counter js-counter" data-from="0" data-to="5987" data-speed="5000" data-refresh-interval="50"></span>
  								<span class="colorlib-counter-label">Reportes</span>
  							</div>
  							<div class="col-md-3 text-center animate-box">
  								<span class="icon"><i class="flaticon-architect-with-helmet"></i></span>
  								<span class="colorlib-counter js-counter" data-from="0" data-to="3999" data-speed="5000" data-refresh-interval="50"></span>
  								<span class="colorlib-counter-label">Real Time</span>
  							</div>
  						</div>
  					</div>
  				</div>





  				<div id="get-in-touch" class="colorlib-bg-color">
  					<div class="colorlib-narrow-content">
  						<div class="row">
  							<div class="col-md-6 animate-box" data-animate-effect="fadeInLeft">
  								<h2>Estás en buena compañía!</h2>
  							</div>
  						</div>
  						<div class="row">
  							<div class="col-md-6 col-md-offset-3 col-md-pull-3 animate-box" data-animate-effect="fadeInLeft">
  								<p class="colorlib-lead">Estamos orgullosos de ayudar al desarrollo de la apicultura.</p>
  								<p><a href="#" class="btn btn-primary btn-learn">Registrase!</a></p>
  							</div>

  						</div>
  					</div>
  				</div>

<script src="{{ asset('js/home.js') }}" defer></script>
@endsection
