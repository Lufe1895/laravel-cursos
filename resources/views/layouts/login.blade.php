<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/skel.min.js') }}"></script>
    <script src="{{ asset('assets/js/util.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <title>Document</title>
</head>
<body>
    <header id="header" class="skel layers fixed">
        <h1>Impulzo</h1>
        <a href="#nav">Menú</a>
    </header>

    <nav id="nav" class>
		<ul class="links">
            @if (auth()->user() != null)
				<h1>Hola, {{ auth()->user()->name }}</h1>
			@else
				<h1>No te has logueado</h1>
			@endif
			<li><a href="/home" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Home</a></li>
            @if (auth()->user() == null)
                <li><a href="/registro" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Registro</a></li>
                <li><a href="/login" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Iniciar Sesión</a></li>
            @endif
            @if (auth()->user() != null)
				<li><a href="/home"
					onclick="event.preventDefault();
					document.getElementById('logout-form').submit();">
						{{ __('Logout') }}
					</a>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						@csrf
					</form>
                </li>
			@endif
		</ul>
	    <a href="#nav" class="close" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></a>
    </nav>
    @yield('body')
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
</body>
</html>