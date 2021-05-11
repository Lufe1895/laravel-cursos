@extends('layouts.login')

@section('body')
    <div class="container">
        <section class="banner">
            <div class="inner">
                <div class="content">
                    <center>
                        <header class="major narrow" style="margin-top: 50px;">
                            <h2>Iniciar Sesión</h2>
                        </header>

                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="4u$ 12u$(xsmall)">
                                <label for="user">
                                    Correo Electrónico:
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                </label>
                                @error('email')
                                    <p style="color:#FF0000;font-style: italic;">El usuario o la contraseña son incorrectos</p>
                                @enderror
                            </div>
                            <div class="4u$ 12u$(xsmall)">
                                <label for="password">
                                    Contraseña:
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                </label>
                                @error('password')
                                    <p style="color:#FF0000;font-style: italic;">{{ $message }}</p>
                                @enderror
                            </div>
                            <a href="{{ route('password.request') }}">Olvidé mi contraseña</a>
                            <ul class="actions" style="margin-top: 50px;">
                                <li>
                                    <input type="submit" value="Iniciar Sesión" class="button big alt" />
                                </li>
                                <li>
                                    <a href="/registro" class="special button big">Registrarme</a>
                                </li>
                            </ul>
                        </form>                         
                    </center>
                </div>
            </div>
        </section>
    </div>
@endsection