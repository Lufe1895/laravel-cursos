<!DOCTYPE HTML>
<!--
	Retrospect by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>Impulzo</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<link rel="stylesheet" href="{{ asset('Admin/plugins/fontawesome-free/css/all.min.css') }}">
	</head>
	<body class="landing">

		<!-- Header -->
			<header id="header" class="alt">
				<h1><a href="index.html">Impulzo</a></h1>
				<a href="#nav">Menu</a>
			</header>

		<!-- Nav -->
			<nav id="nav">
				@if (auth()->user() != null)
					<h1>Hola, {{ auth()->user()->name }}</h1>
				@else
					<h1>No te has logueado</h1>
				@endif
				<ul class="links">
					<li><a href="/home">Página Principal</a></li>
					@if (auth()->user() == null)
						<li><a href="/registro">Registro</a></li>
                		<li><a href="/login" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Iniciar Sesión</a></li>
            		@endif
					@if (auth()->user() != null)
						
						<li><a href="{{ url('/usuarios/'.auth()->user()->id) }}">Mi Perfil</a></li>
						
						<li><a href="/home"
							onclick="event.preventDefault();
							document.getElementById('logout-form').submit();">
								{{ __('Logout') }}
							</a>
							<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
								@csrf
							</form></li>
					@endif
				</ul>
			</nav>

		<!-- Banner -->
			<section id="banner">
			<img src="{{ asset('Admin/dist/img/Impulzo.png') }}" alt="AdminLTE Logo" width="35%" style="opacity: 1">
				@if (auth()->user() != null)
					<p>Hola, {{ auth()->user()->name }}</p>
				@else
					<p>No te has logueado</p>
					<ul class="actions">
						<li><a href="/login" class="button big alt"><i class="fas fa-sign-in-alt"></i>&nbsp;&nbsp;Iniciar Sesión</a></li>
						<li><a href="/registro" class="button big special"><i class="fas fa-edit"></i>&nbsp;Registrarme</a></li>
					</ul>
				@endif
			</section>

		<!-- One -->
			<section id="one" class="wrapper style1">
				<div class="inner">
					<div class="row 50% uniform">
						@foreach($courses as $course)
							<div class="6u 12u$(xsmall)" style="padding: 10px 10px 10px 10px;">
								<article class="feature right">
									<span class="image">
										<img src="{{ $course->image }}" alt="Imagen de Curso">
									</span>
									<div class="content">
										<h2>{{ $course->course_name }}</h2>
										<p>{{ $course->description }}</p>
										<ul class="actions">
											<li>
												<a href="{{ url('/registro') }}" class="button special"><i class="fas fa-edit"></i>&nbsp;Inscribirse</a>
											</li>
										</ul>
									</div>
								</article>
							</div>
						@endforeach
					</div>
				</div>

			</section>

		<!-- Two -->
			<!-- <section id="two" class="wrapper special">
				<div class="inner">
					<header class="major narrow">
						<h2>Aliquam Blandit Mauris</h2>
						<p>Ipsum dolor tempus commodo turpis adipiscing Tempor placerat sed amet accumsan</p>
					</header>
					<div class="image-grid">
						<a href="#" class="image"><img src="images/pic03.jpg" alt="" /></a>
						<a href="#" class="image"><img src="images/pic04.jpg" alt="" /></a>
						<a href="#" class="image"><img src="images/pic05.jpg" alt="" /></a>
						<a href="#" class="image"><img src="images/pic06.jpg" alt="" /></a>
						<a href="#" class="image"><img src="images/pic07.jpg" alt="" /></a>
						<a href="#" class="image"><img src="images/pic08.jpg" alt="" /></a>
						<a href="#" class="image"><img src="images/pic09.jpg" alt="" /></a>
						<a href="#" class="image"><img src="images/pic10.jpg" alt="" /></a>
					</div>
					<ul class="actions">
						<li><a href="#" class="button big alt">Tempus Aliquam</a></li>
					</ul>
				</div>
			</section> -->

		<!-- Three -->
			<section id="three" class="wrapper style3 special">
				<div class="inner">
					<header class="major narrow	">
						<h2>Magna sed consequat tempus</h2>
						<p>Ipsum dolor tempus commodo turpis adipiscing Tempor placerat sed amet accumsan</p>
					</header>
					<ul class="actions">
						<li><a href="#" class="button big alt">Magna feugiat</a></li>
					</ul>
				</div>
			</section>

		<!-- Four -->
			<!-- <section id="four" class="wrapper style2 special">
				<div class="inner">
					<header class="major narrow">
						<h2>Get in touch</h2>
						<p>Ipsum dolor tempus commodo adipiscing</p>
					</header>
					<form action="#" method="POST">
						<div class="container 75%">
							<div class="row uniform 50%">
								<div class="6u 12u$(xsmall)">
									<input name="name" placeholder="Name" type="text" />
								</div>
								<div class="6u$ 12u$(xsmall)">
									<input name="email" placeholder="Email" type="email" />
								</div>
								<div class="12u$">
									<textarea name="message" placeholder="Message" rows="4"></textarea>
								</div>
							</div>
						</div>
						<ul class="actions">
							<li><input type="submit" class="special" value="Submit" /></li>
							<li><input type="reset" class="alt" value="Reset" /></li>
						</ul>
					</form>
				</div>
			</section> -->

		<!-- Footer -->
			<footer id="footer">
				<div class="inner">
					<ul class="icons">
						<li><a href="https://www.facebook.com/impulzo" class="icon fa-facebook" target="_blank">
							<span class="label">Facebook</span>
						</a></li>
						<!-- <li><a href="#" class="icon fa-twitter">
							<span class="label">Twitter</span>
						</a></li>
						<li><a href="#" class="icon fa-instagram">
							<span class="label">Instagram</span>
						</a></li>
						<li><a href="#" class="icon fa-linkedin">
							<span class="label">LinkedIn</span>
						</a></li> -->
					</ul>
					<ul class="copyright">
						<li>&copy; SOLUCIONES INFORMÁTICAS DE GRUPO IMULSO S. A. S.</li>
					</ul>
				</div>
			</footer>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>