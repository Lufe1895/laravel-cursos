<?php
    namespace App\Libraries\Dao;

    use App\Models\Course;

    class CourseDao
    {
        public function all()
        {
            $courses = Course::all();
            return $courses;
        }

        public function find($id)
        {
            $course = Course::find($id);
            return $course;
        }

        public function insert($data)
        {
            $course = new Course();
            $course->course_name = $data['course_name'];
            $course->start_date = $data['start_date'];
            $course->finish_date = $data['finish_date'];
            $course->hours = $data['hours'];
            $course->description = $data['description'];
            $course->status_id = $data['status_id'];
            $course->type_id = $data['type_id'];
            $course->tutor_id = $data['tutor_id'];
            $course->save();

            return $course;
        }

        public function insertImage($id, $path)
        {
            $course = Course::find($id);
            $course->image = $path;
            $course->save();
        }

        public function update($id, $data)
        {
            $course = Course::find($id);
            $image = $course->image;

            if($course->image && $data['image'] != 'undefined'){
                if(\Storage::disk('public')->exists($course->image)) {
                    \Storage::disk('public')->delete($course->image);
                    $image = '/'.$data['image'];
                }
            }

            $course->update($data);
            $course->image = $image;
            $course->save();
        }

        public function delete($id)
        {
            $course = Course::find($id);
            $course->status_id = 2;
            $course->save();
        }

        public function exists($user, $course){
            return $exists = \DB::table('course_user')
            ->join('users', 'course_user.user_id', '=', 'users.id')
            ->join('courses', 'course_user.course_id', '=', 'courses.id')
            ->where('user_id', '=', $user->id)
            ->where('course_id', '=', $course)
            ->get()->all();
        }
    }
?>