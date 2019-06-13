<?php

namespace App\Http\Controllers\Requirements;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Domain\Projects\Entities\Project;
use Illuminate\Support\Facades\Validator;
use App\Domain\Requirements\Entities\Story;

class StoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Gate::allows('manage-stories')) return $next($request);
            abort(403, "You don't have access!");
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        $keyword    = $request->get('keyword');

        $project = Project::find($id);
        $stories = $project->stories()
        ->where('epic', 'LIKE', "%$keyword%")
        ->orderBy('id', 'DESC')
        ->paginate(20);

        return view('stories.index', ['stories' => $stories, 'project' => $project]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $project    = Project::find($id);

        return view('stories.create', ['project' => $project]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $validation     = Validator::make($request->all(), [
            'epic'          => 'required',
            'user_story'    => 'required',
            'project_id'    => 'required'
        ])->validate();

        $project        = Project::find($id);

        $story          = new Story();
        $story->epic                = $request->get('epic');
        $story->user_story          = $request->get('user_story');
        $story->acceptance_criteria = $request->get('acceptance_criteria');
        $story->data                = $request->get('data');
        $story->note                = $request->get('note');
        $story->project_id          = $request->get('project_id');
        $story->created_by          = Auth::user()->id;
        $story->save();

        return redirect()->route('stories.create', ['project' => $project])->with('status', 'User Story successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Domain\Requirements\Entities\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $story          = Story::findOrFail($id);
        $conditions     = $story->conditions()
            ->orderBy('updated_at', 'DESC')
            ->paginate(5);
        $features       = $story->features()
            ->orderBy('updated_at', 'DESC')
            ->paginate(5);
        return view('stories.show', ['story' => $story, 'conditions' => $conditions, 'features' => $features]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Domain\Requirements\Entities\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $story  = Story::findOrFail($id);
        return view('stories.edit', ['story' => $story]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Domain\Requirements\Entities\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation     = Validator::make($request->all(), [
            'epic'          => 'required',
            'user_story'    => 'required'
        ])->validate();

        $story          = Story::findOrFail($id);

        $story->epic                = $request->get('epic');
        $story->user_story          = $request->get('user_story');
        $story->acceptance_criteria = $request->get('acceptance_criteria');
        $story->data                = $request->get('data');
        $story->note                = $request->get('note');
        $story->updated_by          = Auth::user()->id;
        $story->save();

        return redirect()->route('stories.edit', ['id' => $id])->with('status', 'User Story successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Domain\Requirements\Entities\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $story    = Story::findOrFail($id);

        $story->deleted_by    = Auth::user()->id;
        $story->save();
        $story->delete();

        return redirect()->route('stories.list', ['id' => $story->project->id])->with('status', "Story Moved to trash");
    }

    public function ajaxSearchProjects(Request $request)
    {
        $keyword        = $request->get('q');
        $projects       = Project::where('title', 'LIKE', "%$keyword%")->where('status', '!=', 'DRAFT')->get();
        return $projects;
    }

    public function trash(Request $request)
    {
        $stories   = Story::onlyTrashed()->orderBy('id', 'DESC')->paginate(10);

        $keyword   = $request->get('keyword') ? $request->get('keyword') : '';

        $stories  = Story::onlyTrashed()->where('epic', 'LIKE', "%$keyword%")
            ->orderBy('id', 'DESC')->paginate(10);

        return view('stories.trash', ['stories' => $stories]);
    }

    public function restore($id)
    {
        $story    = Story::onlyTrashed()->findOrFail($id);

        if ($story->trashed()) {
            $story->restore();
        } else {
            return redirect()->route('stories.trash')->with('status', 'Story is not in trash');
        }
        return redirect()->route('stories.trash')->with('status', 'Story successfully restored');
    }

    public function deletePermanent($id)
    {
        $story    = Story::onlyTrashed()->findOrFail($id);

        if (!$story->trashed()) {
            return redirect()->route('stories.trash')->with('status', 'Can not delete permanent active story');
        } else {
            $story->forceDelete();
        }
        return redirect()->route('stories.trash')->with('status', 'Story permanently deleted!');
    }

}
