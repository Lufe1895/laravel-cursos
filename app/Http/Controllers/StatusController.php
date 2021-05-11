<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\Dao\StatusDao;
use Illuminate\Support\Facades\Validator;

class StatusController extends Controller
{
    protected function validator($data) 
    {
        return Validator::make($data, [
            'name' => ['required', 'min:5', 'max:20', 'string'],
            'description' => ['required', 'min:5', 'max:50', 'string']
        ], [
            'name.required' => 'Debe ingresar un nombre',
            'name.min' => 'Debe tener al menos 5 caracteres',
            'name.max' => 'No puede tener más de 20 caracteres',
            'description.required' => 'Debe ingresar una descripción',
            'description.min' => 'Debe tener al menos 5 caracteres',
            'description.max' => 'No puede tener más de 50 caracteres',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('statuses.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('statuses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, StatusDao $dao)
    {
        $validator = $this->validator($request->all());

        if($validator->fails()) {
            return response()->json(["errors" => $validator->getMessageBag()], 422);
        }

        $dao->store($request->all());
        return redirect('/estados');
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
        return view('statuses.edit', ['id' => $id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StatusDao $dao, Request $request, $id)
    {
        $validator = $this->validator($request->all());

        if($validator->fails()) {
            return response()->json(["errors" => $validator->getMessageBag()], 422);
        }

        $dao->update($request->all(), $id);
        return redirect('/estados');
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
