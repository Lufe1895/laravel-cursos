<?php
    namespace App\Libraries\Dao;

    use App\Models\Type;

    class TypeDao
    {
        public function all()
        {
            $types = Type::all();
            return $types;
        }

        public function store($data)
        {
            $type = new Type();
            $type->name = $data['name'];
            $type->description = $data['description'];
            $type->save();
        }

        public function update($data, $id)
        {
            $type = Type::find($id);
            $type->update($data);
            $type->save();
        }
    }
?>