<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Models\Role;
use App\Libraries\Dao\CourseDao;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:30'],
            'last_name' => ['required', 'string', 'max:30'],
            'email' => ['required', 'string', 'email', 'max:30', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone_number' => ['required', 'digits_between:7,10'],
            'city' => ['required', 'string', 'max:20'],
            'sex' => ['required', 'starts_with:M,F'],
            'age' => ['required', 'numeric'],
            'ocupation_id' => ['numeric', 'min:1'],
            'study_id' => ['numeric', 'min:1'],
            'course_id' => ['numeric', 'min:1'],
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
            'phone_number.digits_between' => 'Debe otorgar un teléfono de entre 7 y 10 dígitos',
            'city.required' => 'Debe ingresar una ciudad',
            'city.max' => 'No puede ingresar más de 20 caracteres',
            'sex.starts_with' => 'Debe seleccionar un sexo',
            'age.required' => 'Debe ingresar su edad',
            'age.numeric' => 'La edad solo puede contener números',
            'ocupation_id.numeric' => 'Debe seleccionar una ocupación',
            'study_id.numeric' => 'Debe seleccionar un nivel de estidios',
            'course_id.numeric' => 'Debe seleccionar un curso',
        ]);
    }

    protected function validatorEdit(array $data, $id)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:30'],
            'last_name' => ['required', 'string', 'max:30'],
            'phone_number' => ['required', 'digits_between:7,10'],
            'email' => ['required', 'string', 'email', 'max:30', 'unique:users,email,'.$id ],
            'city' => ['required', 'string', 'max:20'],
            'sex' => ['required', 'starts_with:M,F'],
            'age' => ['required', 'numeric'],
            'ocupation_id' => ['numeric', 'min:1'],
            'study_id' => ['numeric', 'min:1'],
            'course_id' => ['numeric', 'min:1'],
        ], [
            'name.required' => 'El campo de nombre es obligatorio',
            'name.max' => 'Este campo no puede contener más de 30 caracteres',
            'last_name.required' => 'El campo de apellidos es obligatorio',
            'last_name.max' => 'Este campo no puede contener más de 30 caracteres',
            'phone_number.required' => 'Debe otorgar algún número de teléfono',
            'phone_number.digits_between' => 'Debe otorgar un teléfono de entre 7 y 10 dígitos',
            'email.required' => 'El campo de correo es obligatorio',
            'email.email' => 'Debe introducir una dirección de correo válida',
            'email.unique' => 'Esta cuenta de correo ya existe',
            'city.required' => 'Debe ingresar una ciudad',
            'city.max' => 'No puede ingresar más de 20 caracteres',
            'sex.starts_with' => 'Debe seleccionar un sexo',
            'age.required' => 'Debe ingresar su edad',
            'age.numeric' => 'La edad solo puede contener números',
            'ocupation_id.numeric' => 'Debe seleccionar una ocupación',
            'study_id.numeric' => 'Debe seleccionar un nivel de estidios',
            'course_id.numeric' => 'Debe seleccionar un curso',
        ]);
    }

    public function index()
    {
        return view('user.index');
    }

    public function save(Request $data)
    {
        $validator = $this->validator($data->all());

        if($validator->fails()) {
            return response()->json(["errors" => $validator->getMessageBag()], 422);
        }

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

        if($data->hasFile('image')) {
            $path = $data->image->storeAs('/usuariosImg/'.$user->id, $data->file('image')->getClientOriginalName());

            $user->image = $path;

            $user->save();
        }

        $user->courses()->attach($data['course_id']);
        $user->attachRole($data->all()['role']);
        return redirect('/usuarios');
    }

    public function show($id)
    {
        $user = \Auth::user()->id;
        $alumno = \Auth::user()->hasRole('student');
        if($user == $id || !$alumno){
            return view('user.show', ['id' => $id]);
        }
        abort(404);
        
    }

    public function create()
    {
        return view('user.create');
    }

    public function edit($id)
    {
        return view('user.edit', ['id' => $id]);
    }

    public function update(Request $data, $id)
    {
        $validator = $this->validatorEdit($data->all(), $id);

        if($validator->fails()) {
            return response()->json(["errors" => $validator->getMessageBag()], 422);
        }

        if($data->hasFile('image')) {
            $path = $data->image->storeAs('/usuariosImg/'.$id, $data->file('image')->getClientOriginalName());
            $user = User::find($id);
            $role = $user->role;
            $user->roles()->detach($role[0]->id);

            if($user->image) {
                if(\Storage::disk('public')->exists($user->image)) {
                    \Storage::disk('public')->delete($user->image);
                }
            }

            $request = $data->all();
            $request['image'] = $path;

            $user->update($request);
            $role = Role::find($data->all()['role']);
            $user->attachRole($role);
            $user->save();
        } else {
            $user = User::find($id);
            $image = $user->image;
            $role = $user->role;
            $user->roles()->detach($role[0]->id);
            $request = $data->all();
            $user->update($request);
            $user->image = $image;
            $role = Role::find($data->all()['role']);
            $user->attachRole($role);
            $user->save();
        }
        return redirect('/usuarios/'.$id);
    }

    public function account($id)
    {
        return view('user.account', ['id' => $id]);
    }

    public function password(Request $data, $id)
    {
        $validator = Validator::make($data->all(),
        [
            'old_password' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ], [
            'old_password.required' => 'Debes introducir tu antigüa contraseña',
            'password.required' => 'Es necesaria una contraseña',
            'password.min' => 'La contraseña debe contener al menos ocho caracteres',
            'password.confirmed' => 'Las contraseñas no coinciden'
        ]);

        if($validator->fails()) {
            return response()->json(["errors" => $validator->getMessageBag()], 422);
        }
        

        $value = (Hash::check($data->all()['old_password'],\Auth::user()->password));

        if (!$value) {
            return response()->json(["errors" => ['old_password' => ['La contraseña es incorrecta']]], 422);
        }

        $user = User::find($id);
        $user->email = $data->all()['email'];
        $user->password = Hash::make($data['password']);
        $user->save();
        return redirect('/usuarios/'.$id);
    }

    public function courses($id)
    {
        $user = \Auth::user()->id;
        $alumno = \Auth::user()->hasRole('student');
        if($user == $id || !$alumno){
            return view('user.courses', ['id' => $id]);
        }
        abort(404);
    }

    public function subscribe($id, CourseDao $dao)
    {
        $user = \Auth::user();
        if($dao->exists($user, $id)){
            abort(404);
        }
        $user->courses()->attach($id);
        return redirect('/usuarios/cursos/'.$user->id);
    }
}
