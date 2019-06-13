<?php

use Illuminate\Support\Facades\Auth;
use App\Domain\UserManagement\Entities\User;

function getMenu()
{
    $user          = User::find(Auth::user()->id);

    $projects      = $user->projects()->with('stories')
        ->where('status', '!=', 'DRAFT')
        ->orderBy('updated_at', 'DESC');

    return $projects->get();
}
