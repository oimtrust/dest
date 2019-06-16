<?php

use Illuminate\Support\Facades\Auth;
use App\Domain\Executions\Entities\Issue;
use App\Domain\UserManagement\Entities\User;
use Illuminate\Pagination\LengthAwarePaginator;

function getNotification()
{
    $user           = User::find(Auth::user()->id);

    $issues       = Issue::with(['comments' => function ($query) use ($user) {
                        $query->where('created_by', '!=', $user->id)->where('status', '!=', 'read');
                    }])->where('assigned_to', $user->id)->orWhere('created_by', $user->id)->get();
    $notifications = $issues->flatMap(function ($issue) {
        return $issue->comments;
    });
    // return $notifications;

    // Get current page form url e.x. &page=1
    $currentPage        = LengthAwarePaginator::resolveCurrentPage();

    // Create a new Laravel collection from the array data
    $itemCollection     = collect($notifications);

    // Define how many items we want to be visible in each page
    $perPage            = 4;

    // Slice the collection to get the items to display in current page
    $currentPageItems   = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

    // Create our paginator and pass it to the view
    $paginatedItems     = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);

    $paginatedItems->toArray();

    return $paginatedItems;
}
