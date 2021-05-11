<?php
    namespace App\Libraries\Dao;

    use App\Models\Tutor;

    class TutorDao
    {
        public function all()
        {
            $tutors = Tutor::all();
            return $tutors;
        }

        public function insert($data){
            $tutor = new Tutor;
            $tutor->name = $data['name'];
            $tutor->academic_profile = $data['academic_profile'];
            $tutor->save();
        }

        public function update($data, $id)
        {
            $tutor = Tutor::find($id);
            $tutor->update($data);
            $tutor->save();
        }
    }
?>