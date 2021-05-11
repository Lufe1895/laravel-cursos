<?php
    namespace App\Libraries\Dao;

    use App\Models\Permission;

    class PermissionDao
    {
        public function store($data)
        {
            $permission = new Permission();
            $permission->name = $data['name'];
            $permission->display_name = $data['display_name'];
            $permission->description = $data['description'];
            $permission->save();
        }

        public function update($data, $id)
        {
            $permission = Permission::find($id);
            $permission->update($data);
            $permission->save();
        }
    }
?>