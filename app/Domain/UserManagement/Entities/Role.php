<?php

namespace App\Domain\UserManagement\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Domain\UserManagement\Entities\User;

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
}
