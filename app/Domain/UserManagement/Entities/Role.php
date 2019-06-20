<?php

namespace App\Domain\UserManagement\Entities;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Domain\UserManagement\Entities\User;
use App\Domain\UserManagement\Entities\Permission;

class Role extends Model
{
    protected $table    = 'roles';

    public static function findBySlug($slug)
    {
        return static::where('slug', $slug)->get()->first();
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function getPermissionObjectOperation($permission_id)
    {
        $permission_role    = DB::table('permission_role')->where('role_id', $this->id)
                ->where('permission_id', $permission_id)
                ->get()->first();

        if ($permission_role) {
            return json_decode($permission_role->operation);
        } else {
            return array();
        }
    }

    public function hasPermissionObjectOperation($permission_id, $operation)
    {
        foreach ($this->getPermissionObjectOperation($permission_id) as $key => $opt) {
            if ($opt == $operation) {
                return true;
            }
        }
        return false;
    }

    public function can($operation, $permission)
    {
        return $this->hasPermissionObjectOperation(Permission::findBySlug($permission)->id, $operation);
    }
}
