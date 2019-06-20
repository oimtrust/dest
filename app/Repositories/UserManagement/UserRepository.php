<?php

namespace App\Repositories\UserManagement;

use App\Domain\UserManagement\Entities\User;
/**
 * Class UserRepository.
 *
 * @package namespace App\Repositories\UserManagement;
 */
class UserRepository
{
    protected $model;

    public function __construct(User $user) {
        $this->model    = $user;
    }

    public function getUserByApiToken($token)
    {
        return $this->model->where('api_token', $token)->first();
    }
}
