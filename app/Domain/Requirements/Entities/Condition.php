<?php

namespace App\Domain\Requirements\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Domain\Requirements\Entities\Story;
use App\Domain\UserManagement\Entities\User;

class Condition extends Model
{
    public function story()
    {
        return $this->belongsTo(Story::class);
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
