<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\Dao\RoleDao;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    protected function validator($data) 
    {
        return Validator::make($data, [
            'name' => ['required', 'min:5', 'max:20', 'string'],
            'display_name' => ['required', 'min:5', 'max:20', 'string'],
            'description' => ['required', 'min:5', 'max:20', 'string']
        ], [
            'name.required' => 'Debe ingresar una clave',
            'name.min' => 'Debe tener al menos 5 caracteres',
            'name.max' => 'No puede tener más de 20 caracteres',
            'display_name.required' => 'Debe ingresar un nombre',
            'display_name.min' => 'Debe tener al menos 5 caracteres',
            'display_name.max' => 'No puede tener más de 20 caracteres',
            'description.required' => 'Debe ingresar una descripción',
            'description.min' => 'Debe tener al menos 5 caracteres',
            'description.max' => 'No puede tener más de 20 caracteres',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, RoleDao $dao)
    {
        $validator = $this->validator($request->all());

        if($validator->fails()) {
            return response()->json(["errors" => $validator->getMessageBag()], 422);
        }

        $dao->insert($request->all());
        return redirect('/roles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('roles.edit', ['id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, RoleDao $dao)
    {
        $validator = $this->validator($request->all());

        if($validator->fails()) {
            return response()->json(["errors" => $validator->getMessageBag()], 422);
        }

        $dao->update($request->all(), $id);
        return redirect('/roles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
