<?php

namespace App\Domain\Projects\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Domain\Requirements\Entities\Story;
use App\Domain\UserManagement\Entities\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function createdUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedUser()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function deletedUser()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    public function stories()
    {
        return $this->hasMany(Story::class);
    }
}
