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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

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

    /**
     * Display the specified resource.
     *
     * @param  \App\Domain\Executions\Entities\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Domain\Executions\Entities\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Domain\Executions\Entities\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Domain\Executions\Entities\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
