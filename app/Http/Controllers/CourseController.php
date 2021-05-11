<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\Dao\CourseDao;
use App\Libraries\Dao\TutorDao;
use App\Libraries\Dao\TypeDao;
use App\Libraries\Dao\StatusDao;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    protected function validator(array $data) 
    {
        return Validator::make($data, [
            'course_name' => ['required', 'string', 'max:50', 'min:2'],
            'hours' => ['required', 'numeric'],
            'status_id' => ['numeric' , 'min:1'],
            'type_id' => ['numeric', 'min:1'],
            'tutor_id' => ['numeric', 'min:1'],
            'image' => ['required', 'min:5']
        ], [
            'course_name.required' => 'El curso debe tener un nombre',
            'course_name.max' => 'No puede contener más de 50 caracteres',
            'course_name.min' => 'El curso debe tener un nombre válido',
            'hours.required' => 'Debe insertar un número de horas',
            'hours.numeric' => 'Solo números',
            'status_id.numeric' => 'Ingrese un estado',
            'type_id.numeric' => 'Ingrese un tipo de curso',
            'tutor_id.numeric' => 'Ingrese un tutor del curso',
            'image.required' => 'Ingrese una imagen'
        ]);
    }

    public function index()
    {
        return view ('courses.index');
    }

    public function create(TutorDao $tutorDao, TypeDao $typeDao, StatusDao $statusDao)
    {
        $tutors = $tutorDao->all();
        $types = $typeDao->all();
        $statuses = $statusDao->all();
        return view('courses.create', ['tutors' => $tutors, 'types' => $types, 'statuses' => $statuses]);
    }

    public function store(Request $data, CourseDao $dao)
    {
        $validator = $this->validator($data->all());

        if($validator->fails()) {
            return response()->json(["errors" => $validator->getMessageBag()], 422);
        }

        $course = $dao->insert($data->all());

        if($data->hasFile('image')) {
            $path = $data->image->storeAs('/cursosImg/'.$course->id, $data->file('image')->getClientOriginalName());
        } else {
            $path = "";
        }

        $dao->insertImage($course->id, $path);
        return redirect('/cursos');
    }

    public function edit($id)
    {
        return view('courses.edit', ['id' => $id]);
    }

    public function update(Request $request, $id, CourseDao $dao)
    {
        $validator = $this->validator($request->all());

        if($validator->fails()) {
            return response()->json(["errors" => $validator->getMessageBag()], 422);
        }

        if($request->hasFile('image')) {
            $path = $request->image->storeAs('/cursosImg/'.$id, $request->file('image')->getClientOriginalName());

            $data = $request->all();
            $data['image'] = $path;

            $dao->update($id, $data);
            return redirect('/cursos');
        } else {
            $dao->update($id, $request->all());
            return redirect('/cursos');
        }
    }

    public function destroy(CourseDao $dao, $id)
    {
        $dao->delete($id);
        return redirect('/cursos');
    }

    public function show($id, CourseDao $dao)
    {
        $user = \Auth::user();
        $subscribed = $dao->exists($user, $id) ? true : false;
        return view('courses.show', ['id' => $id, 'subscribed' => $subscribed]);
    }

    public function all()
    {
        return view('courses.courses');
    }
}