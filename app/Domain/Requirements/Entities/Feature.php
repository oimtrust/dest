<?php

namespace App\Domain\Requirements\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Domain\Requirements\Entities\Story;
use App\Domain\UserManagement\Entities\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Domain\Spesifications\Entities\Scenario;

class Feature extends Model
{
    use SoftDeletes;

    public function story()
    {
        return $this->belongsTo(Story::class);
    }

    public function scenarios()
    {
        return $this->hasMany(Scenario::class);
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
