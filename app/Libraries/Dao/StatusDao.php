<?php
    namespace App\Libraries\Dao;

    use App\Models\Status;

    class StatusDao
    {
        public function all()
        {
            $statuses = Status::all();
            return $statuses;
        }

        public function store($data)
        {
            $status = new Status;
            $status->name = $data['name'];
            $status->description = $data['description'];
            $status->save();
        }

        public function update($data, $id)
        {
            $status = Status::find($id);
            $status->update($data);
            $status->save();
        }
    }
?>