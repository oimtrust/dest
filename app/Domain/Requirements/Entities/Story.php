<?php

namespace App\Domain\Requirements\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Domain\Projects\Entities\Project;
use App\Domain\UserManagement\Entities\User;
use App\Domain\Requirements\Entities\Feature;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Domain\Requirements\Entities\Condition;

class Story extends Model
{
    use SoftDeletes;

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function conditions()
    {
        return $this->hasMany(Condition::class);
    }

    public function features()
    {
        return $this->hasMany(Feature::class);
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
}
