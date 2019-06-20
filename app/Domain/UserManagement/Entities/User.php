<?php

namespace App\Domain\UserManagement\Entities;

use Illuminate\Notifications\Notifiable;
use App\Domain\Executions\Entities\Issue;
use App\Domain\Projects\Entities\Project;
use App\Domain\Executions\Entities\Comment;
use App\Domain\UserManagement\Entities\Role;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hasAccess($operation, $permission)
    {
        foreach ($this->roles as $key => $role) {
            if ($role->can($operation, $permission)) {
                return true;
            }
        }
        return false;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'created_by');
    }

    public function issues()
    {
        return $this->hasMany(Issue::class, 'assigned_to');
    }

    public function deletedUser()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
