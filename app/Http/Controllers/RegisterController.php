<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Impulzo\RestClientService\Libraries\Facade\RestClientFacade;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Course;
use App\Models\Ocupation;
use App\Models\Study;
use App\User;

class RegisterController extends Controller
{
    public function registro()
    {
        $courses = Course::all();
        $ocupations = Ocupation::all();
        $studies = Study::all();
        return view('user.register', [
            'ocupations' => $ocupations,
            'studies' => $studies,
            'courses' => $courses
            ]);
    }

    protected function crear(Request $data, RestClientFacade $service)
    {
        $data = request()->validate([
            'name' => ['required', 'string', 'max:30'],
            'last_name' => ['required', 'string', 'max:30'],
            'email' => ['required', 'string', 'email', 'max:30', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone_number' => ['required', 'numeric', 'min:7'],
            'city' => ['required', 'string', 'max:20'],
            'sex' => ['required', 'string'],
            'age' => ['required', 'numeric'],
            'ocupation_id' => [],
            'study_id' => [],
            'course_name' => [],
        ], [
            'name.required' => 'El campo de nombre es obligatorio',
            'name.max' => 'Este campo no puede contener más de 30 caracteres',
            'last_name.required' => 'El campo de apellidos es obligatorio',
            'last_name.max' => 'Este campo no puede contener más de 30 caracteres',
            'email.required' => 'El campo de correo es obligatorio',
            'email.email' => 'Debe introducir una dirección de correo válida',
            'email.unique' => 'Esta cuenta de correo ya existe',
            'password.required' => 'Es necesaria una contraseña',
            'password.min' => 'La contraseña debe contener al menos ocho caracteres',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'phone_number.required' => 'Debe otorgar algún número de teléfono',
            'phone_number.numeric' => 'Debe otorgar solamente números',
            'city.required' => 'Debe ingresar una ciudad',
            'city.max' => 'No puede ingresar más de 20 caracteres',
            'age.required' => 'Debe ingresar su edad',
            'age.numeric' => 'La edad solo puede contener números'
        ]);
        
        $user = User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'api_token' => Str::random(60),
            'password' => Hash::make($data['password']),
            'phone_number' => $data['phone_number'],
            'city' => $data['city'],
            'sex' => $data['sex'],
            'age' => $data['age'],
            'ocupation_id' => $data['ocupation_id'],
            'study_id' => $data['study_id'],
        ]);
        $user->courses()->attach($data['course_name']);
        $vista = view('mail.index', ['name' => $data['name']])->render();
        $datos = array('from' => 'Soluciones Informáticas de Grupo Impulzo',
                    'to' => $data['email'],
                    'subject' => 'Bienvenida',
                    'msg' => $vista);
        $resultado = $service->post("https://service-email-impulzo.herokuapp.com/sigi/api/v0.1/email", $datos);

        return view('user.login');
    }
}
