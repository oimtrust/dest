<?php

namespace App\Domain\UserManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Domain\UserManagement\Entities\Role;

class Permission extends Model
{
    protected $table = 'permissions';

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public static function findBySlug($slug)
    {
        return Permission::where('slug', $slug)->first();
    }
}
