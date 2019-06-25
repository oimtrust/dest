<?php

namespace App\Http\Controllers\Executions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Domain\Executions\Entities\Issue;
use App\Domain\Executions\Entities\Comment;

class CommentController extends Controller
{
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $validation     = $request->validate([
            'comment'    => 'required',
            'attachment' => 'max:15000'
        ]);

        $issue                  = Issue::find($id);
        $comment                = new Comment();
        $comment->issue_id      = $request->get('issue_id');
        $comment->comment       = $request->get('comment');
        $comment->created_by    = Auth::user()->id;

        $comment->attachment_slug = $request->get('attachment_slug');

        if ($request->file('attachment')) {
            $file               = $request->file('attachment')->store('comments', 'public');
            $comment->attachment   = $file;
        }

        $comment->save();

        return redirect()->route('issues.detail', ['issue' => $issue]);
    }
}
