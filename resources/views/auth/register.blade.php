@extends('template.layout')

@section('content')
    <div class="container">
        <h3>Inscripción</h3>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="6u 12u$(xsmall)"><label>Nombre: <input type="text" name="name" placeholder="Nombre"></label></div>
                <div class="6u$ 12u$(small)"><label>Apellidos: <input type="text" name="last_name" placeholder="Apellidos"></label></div>
                <div class="4u 12u$(xsmall)"><label>Correo: <input type="email" name="email" placeholder="ejemplo@example.com"></label></div>
                <div class="4u 12u$(xsmall)"><label>Contraseña: <input type="password" name="email"></label></div> 
                <div class="4u$ 12u$(xsmall)"><label>Repetir Contraseña: <input type="password" name="email"></label></div>    
                <div class="4u 12u$(xsmall)"><label>Teléfono: <input type="text" name="phone_number" placeholder="XXX-XXX-XXXX"></label></div>
                <div class="4u 12u$(xsmall)"><label>Ciudad: <input type="text" name="city" placeholder="Ciudad"></label></div>
                <div class="2u 12u$(xsmall)"><label>Sexo: <select name="sex" id="">
                    <option value="M">Masculino</option>
                    <option value="F">Femenino</option>
                </select></label></div>
                <div class="2u$ 12u$(xsmall)"><label>Edad: <input type="text" name="age" placeholder="Edad"></label></div>
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
