<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\Dao\TutorDao;
use Illuminate\Support\Facades\Validator;

class TutorController extends Controller
{
    protected function validator($data) 
    {
        return Validator::make($data, [
            'name' => ['required', 'min:5', 'max:100', 'string'],
            'academic_profile' => ['required', 'min:5', 'max:20', 'string']
        ], [
            'name.required' => 'Debe ingresar un nombre',
            'name.min' => 'Debe tener al menos 5 caracteres',
            'name.max' => 'No puede tener más de 100 caracteres',
            'academic_profile.required' => 'Debe ingresar un Perfil Académico',
            'academic_profile.min' => 'Debe tener al menos 5 caracteres',
            'academic_profile.max' => 'No puede tener más de 20 caracteres',
        ]);
    }

    public function index(){
        return view('tutors.index');
    }

    public function create(){
        return view('tutors.create');
    }

    public function store(Request $data, TutorDao $dao){

        $validator = $this->validator($data->all());

        if($validator->fails()) {
            return response()->json(["errors" => $validator->getMessageBag()], 422);
        }

        $dao->insert($data->all());
        return redirect('/tutores');
    }

    public function edit($id)
    {
        return view('tutors.edit', ['id' => $id]);
    }

    public function update(TutorDao $dao, $id, Request $request)
    {
        $validator = $this->validator($request->all());

        if($validator->fails()) {
            return response()->json(["errors" => $validator->getMessageBag()], 422);
        }

        $dao->update($request->all(), $id);
        return redirect('/tutores');
    }
}
