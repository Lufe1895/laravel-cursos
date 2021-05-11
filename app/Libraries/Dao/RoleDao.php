<?php
    namespace App\Libraries\Dao;

    use App\Models\Role;

    class RoleDao
    {
        public function insert($data)
        {
            $role = new Role();
            $role->name = $data['name'];
            $role->display_name = $data['display_name'];
            $role->description = $data['description'];
            $role->save();
        }

        public function update($data, $id)
        {
            $role = Role::find($id);
            $role->update($data);
            $role->save();
        }
    }
?>