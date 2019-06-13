<?php

namespace App\Domain\Spesifications\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Domain\UserManagement\Entities\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Domain\Spesifications\Entities\Scenario;
use App\Domain\Executions\Entities\Issue;

class Testcase extends Model
{
    use SoftDeletes;

    public function scenario()
    {
        return $this->belongsTo(Scenario::class);
    }

    public function issues()
    {
        return $this->hasMany(Issue::class);
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
