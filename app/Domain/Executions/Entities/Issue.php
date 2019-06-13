<?php

namespace App\Domain\Executions\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Domain\Executions\Entities\Comment;
use App\Domain\UserManagement\Entities\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Domain\Spesifications\Entities\Testcase;

class Issue extends Model
{
    use SoftDeletes;

    public function testcase()
    {
        return $this->belongsTo(Testcase::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function createdUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedUser()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
