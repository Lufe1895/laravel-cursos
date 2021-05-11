@extends('template.layout')

@section('body')
    <div class="container">
        <section class="banner">
            <div class="inner">
                <div class="content">
                    <center>
                        <header class="major narrow" style="margin-top: 50px;">
                            <h2>Restablecer Contraseña</h2>
                        </header>

                        <form action="{{ route('password.email') }}" method="POST">
                            @csrf

                            <div class="5u$ 12u$(xsmall)">
                                <label for="email">Correo Electrónico: <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus></label>
                                @error('email')
                                    <p style="color:#FF0000;font-style: italic;">Hay un error con el correo electrónico. Verifíquelo e inténtelo de nuevo.</p>
                                @enderror
                            </div>
                            <ul class="actions" style="margin-top: 50px;">
                                <li>
                                    <input type="submit" class="special button big" value="Enviar Correo">
                                </li>
                            </ul>
                        </form>
                    </center>
                </div>
            </div>
        </section>
    </div>
@endsection
