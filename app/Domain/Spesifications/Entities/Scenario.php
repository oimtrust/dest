<?php

namespace App\Domain\Spesifications\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Domain\UserManagement\Entities\User;
use App\Domain\Requirements\Entities\Feature;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Domain\Spesifications\Entities\Testcase;

class Scenario extends Model
{
    use SoftDeletes;

    public function feature()
    {
        return $this->belongsTo(Feature::class);
    }

    public function testcases()
    {
        return $this->hasMany(Testcase::class);
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
