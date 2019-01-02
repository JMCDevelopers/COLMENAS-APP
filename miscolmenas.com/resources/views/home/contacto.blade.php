@extends('home.layout')
@section('content')
  <div class="colorlib-contact">
					<div class="colorlib-narrow-content">
						<div class="row">
							<div class="col-md-12 animate-box" data-animate-effect="fadeInLeft">
								<span class="heading-meta"></span>
								<h2 class="colorlib-heading">Contactanos</h2>
							</div>
						</div>
						<div class="row">
							<div class="col-md-5">
								<div class="colorlib-feature colorlib-feature-sm animate-box" data-animate-effect="fadeInLeft">
									<div class="colorlib-icon">
										<i class="icon-globe-outline"></i>
									</div>
									<div class="colorlib-text">
										<p><a href="#">info@7hiveapp.com</a></p>
									</div>
								</div>

								<div class="colorlib-feature colorlib-feature-sm animate-box" data-animate-effect="fadeInLeft">
									<div class="colorlib-icon">
										<i class="icon-map"></i>
									</div>
									<div class="colorlib-text">
										<p>Quito-Ecuador</p>
									</div>
								</div>

								<div class="colorlib-feature colorlib-feature-sm animate-box" data-animate-effect="fadeInLeft">
									<div class="colorlib-icon">
										<i class="icon-phone"></i>
									</div>
									<div class="colorlib-text">
										<p><a href="tel://">+593 979277861</a></p>
									</div>
								</div>
							</div>
							<div class="col-md-7 col-md-push-1">
								<div class="row">
									<div class="col-md-10 col-md-offset-1 col-md-pull-1 animate-box" data-animate-effect="fadeInLeft">
										<form action="">
											<div class="form-group">
												<input type="text" class="form-control" placeholder="Nombre">
											</div>
											<div class="form-group">
												<input type="text" class="form-control" placeholder="Email">
											</div>
											<div class="form-group">
												<input type="text" class="form-control" placeholder="Asunto">
											</div>
											<div class="form-group">
												<textarea name="" id="message" cols="30" rows="7" class="form-control" placeholder="Mensaje"></textarea>
											</div>
											<div class="form-group">
												<input type="submit" class="btn btn-primary btn-send-message" value="Enviar">
											</div>
										</form>
									</div>

								</div>
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

				</div>
			</div>
  <script src="{{ asset('js/contactos.js') }}" defer></script>
@endsection
