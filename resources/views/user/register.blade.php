@extends('layouts.login')

@section('body')
    <div class="container">
        <header class="major special">
            <h2>Inscripción</h2>
            <p>Rellena los campos y presiona el botón de ¡Inscribirme!</p>
        </header>

        <form action="{{ route('registrar') }}" method="POST">
            <div class="row uniform 50%">
                @csrf
                <div class="6u 12u$(xsmall)"><label>Nombre(s): <input type="text" name="name" placeholder="Nombre" value="{{ old('name') }}"></label>
                @if ($errors->has('name'))
                    <p style="color:#FF0000;font-style: italic;">{{ $errors->first('name') }}</p>
                @endif
                </div>
                <div class="6u$ 12u$(small)"><label>Apellidos: <input type="text" name="last_name" placeholder="Apellidos" value="{{ old('last_name') }}"></label>
                @if ($errors->has('last_name'))
                    <p style="color:#FF0000;font-style: italic;">{{ $errors->first('last_name') }}</p>
                @endif
                </div>

                <div class="4u 12u$(xsmall)"><label>Correo: <input type="email" name="email" placeholder="ejemplo@example.com" value="{{ old('email') }}"></label>
                @if ($errors->has('email'))
                    <p style="color:#FF0000;font-style: italic;">{{ $errors->first('email') }}</p>
                @endif
                </div>
                <div class="4u 12u$(xsmall)"><label>Contraseña: <input type="password" name="password"></label>
                @if ($errors->has('password'))
                    <p style="color:#FF0000;font-style: italic;">{{ $errors->first('password') }}</p>
                @endif</div> 
                <div class="4u$ 12u$(xsmall)"><label>Repetir Contraseña: <input type="password" name="password_confirmation"></label></div>    
                
                <div class="4u 12u$(xsmall)"><label>Teléfono: <input type="text" name="phone_number" placeholder="Ejemplo: 9515555555" value="{{ old('phone_number') }}"></label>
                @if ($errors->has('phone_number'))
                    <p style="color:#FF0000;font-style: italic;">{{ $errors->first('phone_number') }}</p>
                @endif</div>
                <div class="4u 12u$(xsmall)"><label>Ciudad: <input type="text" name="city" placeholder="Ciudad" value="{{ old('city') }}"></label>
                @if ($errors->has('city'))
                    <p style="color:#FF0000;font-style: italic;">{{ $errors->first('city') }}</p>
                @endif</div>
                <div class="2u 12u$(xsmall)"><label>Sexo: <select name="sex">
                    <option value="M">Masculino</option>
                    <option value="F">Femenino</option>
                </select></label></div>
                <div class="2u$ 12u$(xsmall)"><label>Edad: <input type="text" name="age" placeholder="Edad" value="{{ old('age') }}"></label>
                @if ($errors->has('age'))
                    <p style="color:#FF0000;font-style: italic;">{{ $errors->first('age') }}</p>
                @endif</div>
                
                <div class="6u 12u$(xsmall)"><label>Ocupación: <select name="ocupation_id">
                    @foreach($ocupations as $ocupation)
                        <option value='{{ $ocupation->id }}'>{{ $ocupation->ocupation_name }}</option>
                    @endforeach
                </select></label></div>
                <div class="6u$ 12u$(xsmall)"><label>Nivel de Estudios: <select name="study_id">
                    @foreach($studies as $study)
                        <option value="{{ $study->id }}">{{ $study->study_level }}</option>
                    @endforeach
                </select></label></div>

                <div class="12u$"><label>Curso: <select name="course_name" id="">
                    @foreach($courses as $course)
                        <option value='{{ $course->id }}'>{{ $course->course_name }}</option>
                    @endforeach
                </select></label></div>
                <label><input type="submit", value="¡Inscribirme!" class="special button big"></label>
            </div>
        </form>
    </div>
@endsection