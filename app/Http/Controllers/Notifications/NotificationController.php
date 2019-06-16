<?php

namespace App\Http\Controllers\Notifications;

use App\Http\Controllers\Controller;
use App\Domain\Executions\Entities\Issue;

class NotificationController extends Controller
{
    public function index()
    {
        return view('notifications.index', getNotification());
    }

    public function read($issue_id)
    {
        $issue      = Issue::find($issue_id);
        foreach ($issue->comments()->get() as $comment) {
            $comment->status    = 'read';
            $comment->save();
        }
        return redirect()->route('issues.detail', ['issue' => $issue]);
    }
}
