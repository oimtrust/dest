<?php

namespace App\Domain\Executions\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Domain\Executions\Entities\Issue;
use App\Domain\UserManagement\Entities\User;

class Comment extends Model
{
    public function issue()
    {
        return $this->belongsTo(Issue::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function createdUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
