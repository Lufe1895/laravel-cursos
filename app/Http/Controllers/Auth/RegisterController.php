<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Ocupation;
use App\Models\Study;
use Impulzo\RestClientService\Libraries\Facade\RestClientFacade;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $courses = Course::all();
        $ocupations = Ocupation::all();
        $studies = Study::all();
        return view('register', [
            'ocupations' => $ocupations,
            'studies' => $studies,
            'courses' => $courses
            ]);
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:30'],
            'last_name' => ['required', 'string', 'max:30'],
            'email' => ['required', 'string', 'email', 'max:30', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone_number' => ['required', 'numeric', 'min:7'],
            'city' => ['required', 'string', 'max:20'],
            'sex' => ['required', 'string'],
            'age' => ['required', 'numeric'],
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
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    
    protected function create(array $data)
    {
        sendMail($data);

        $user = User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone_number' => $data['phone_number'],
            'city' => $data['city'],
            'sex' => $data['sex'],
            'age' => $data['age'],
            'ocupation_id' => $data['ocupation_id'],
            'study_id' => $data['study_id'],
        ]);
        $user->courses()->attach($data['course_name']);

        return $user;
    }
    
    public function sendMail(RestClientFacade $service, array $data)
    {
        $datos = array('from' => 'Email Desde Laravel',
                    'to' => $data['email'],
                    'subject' => 'Prueba de Email',
                    'msg' => '<p>Hola, prro.</p>');
        $resultado = $service->post("https://service-email-impulzo.herokuapp.com/sigi/api/v0.1/email", $datos);
        dd($resultado);
    }
}
