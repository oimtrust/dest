<?php

namespace App\Http\Controllers\Executions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Domain\Executions\Entities\Issue;
use App\Domain\Projects\Entities\Project;
use App\Domain\UserManagement\Entities\User;
use App\Domain\Spesifications\Entities\Testcase;

class IssueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user          = User::find(Auth::user()->id);
        $keyword   = $request->get('keyword') ? $request->get('keyword') : '';
        $issues      = $user->issues()->where('title', 'LIKE', "%$keyword%")
            ->where('status', '!=', 'DONE')
            ->orderBy('updated_at', 'DESC')->paginate(20);

        return view('issues.index', ['issues' => $issues]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $testcase   = Testcase::find($id);
        return view('issues.create', ['testcase' => $testcase]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $validation = $request->validate([
            'testcase_id'       => 'required',
            'type'              => 'required',
            'severity'          => 'required',
            'priority'          => 'required',
            'assigned_to'       => 'required',
            'title'             => 'required|min:5|max:255',
            'description'       => 'required|min:15|max:255',
            'status'            => 'required',
            'image1'            => 'image',
            'image2'            => 'image'
        ]);

        $project                = Project::find($id);
        $issue                  = new Issue();
        $issue->testcase_id     = $request->get('testcase_id');
        $issue->type            = $request->get('type');
        $issue->severity        = $request->get('severity');
        $issue->priority        = $request->get('priority');
        $issue->assigned_to     = $request->get('assigned_to');
        $issue->title           = $request->get('title');
        $issue->description     = $request->get('description');
        $issue->status          = $request->get('status');
        $issue->created_by      = Auth::user()->id;
        if ($request->file('image1')) {
            $file               = $request->file('image1')->store('issues', 'public');
            $issue->image1   = $file;
        } elseif ($request->file('image2')) {
            $file               = $request->file('image2')->store('issues', 'public');
            $issue->image2   = $file;
        }
        $issue->save();

        return redirect()->route('issues.create', ['id' => $project])->with('status', 'Issue successfully created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Domain\Executions\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $issue      = Issue::find($id);
        $testcase   = Testcase::find($id);

        return view('issues.show', ['issue' => $issue, 'testcase' => $testcase]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Domain\Executions\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function edit($issue_id, $project_id)
    {
        $issue      = Issue::find($issue_id);
        $project    = Project::find($project_id);

        return view('issues.edit', ['issue' => $issue, 'project' => $project]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Domain\Executions\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $issue_id, $project_id)
    {
        $validation = $request->validate([
            'type'              => 'required',
            'severity'          => 'required',
            'priority'          => 'required',
            'assigned_to'       => 'required',
            'title'             => 'required|min:5|max:255',
            'description'       => 'required|min:15|max:255',
            'status'            => 'required',
            'image1'            => 'image',
            'image2'            => 'image'
        ]);

        $project                = Project::find($project_id);
        $issue                  = Issue::find($issue_id);
        $issue->type            = $request->get('type');
        $issue->status          = $request->get('status');
        $issue->severity        = $request->get('severity');
        $issue->priority        = $request->get('priority');
        $issue->assigned_to     = $request->get('assigned_to');
        $issue->title           = $request->get('title');
        $issue->description     = $request->get('description');
        $issue->updated_by      = Auth::user()->id;

        if ($request->file('image1')) {
            if ($issue->image1 && file_exists(storage_path('app/public'. $issue->image1))) {
                $filepath    = 'storage/' . $issue->image1;
                File::delete($filepath);
            }
            $file   = $request->file('image1')->store('issues', 'public');
            $issue->image1   = $file;
        } elseif ($request->file('image2')) {
            if ($issue->image2 && file_exists(storage_path('app/public'. $issue->image2))) {
                $filepath    = 'storage/' . $issue->image2;
                File::delete($filepath);
            }
            $file   = $request->file('image2')->store('issues', 'public');
            $issue->image2   = $file;
        }

        $issue->save();

        return redirect()->route('issues.edit', ['issue' => $issue, 'project' => $project])->with('status', 'Issue successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Domain\Executions\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project        = Project::find($id);
        $issue          = Issue::find($id);

        $issue->deleted_by  = Auth::user()->id;
        $issue->save();
        $issue->delete();

        return redirect()->route('testcases.show', ['testcase' => $issue->testcase->id, 'project' => $project])->with('status', 'Issue moved to trash!');
    }

    public function trash(Request $request)
    {
        $issues   = Issue::onlyTrashed()->orderBy('updated_at', 'DESC')->paginate(20);

        $keyword   = $request->get('keyword') ? $request->get('keyword') : '';

        $issues  = Issue::onlyTrashed()->where('title', 'LIKE', "%$keyword%")
            ->orderBy('updated_at', 'DESC')->paginate(20);

        return view('issues.trash', ['issues' => $issues]);
    }

    public function deletePermanent($id)
    {
        $issue    = Issue::onlyTrashed()->findOrFail($id);

        if (!$issue->trashed()) {
            return redirect()->route('issues.trash')->with('status', 'Can not delete permanent active Issue');
        } else {
            $issue->forceDelete();
        }
        return redirect()->route('issues.trash')->with('status', 'Issue permanently deleted!');
    }

    public function restore($id)
    {
        $issue    = Issue::onlyTrashed()->findOrFail($id);

        if ($issue->trashed()) {
            $issue->restore();
        } else {
            return redirect()->route('issues.trash')->with('status', 'Issue is not in trash');
        }
        return redirect()->route('issues.trash')->with('status', 'Issue successfully restored');
    }

    public function ajaxAssignedTo(Request $request, $id)
    {
        $project        = Project::find($id);
        $keyword        = $request->get('q');
        $users          = User::where('name', 'LIKE', "%".$keyword."%")->whereHas('projects', function ($query) use ($project) {
            $query->where('project_id', $project->id);
        } )->get();

        return $users;
    }

    public function detail($id)
    {
        $issue      = Issue::find($id);
        return view('issues.detail', ['issue' => $issue]);
    }

    public function setDone($id)
    {
        $issue  = Issue::find($id);
        $issue->status  = 'DONE';
        $issue->save();
        return redirect()->route('issues.index')->with('status', 'Issues successfully fixed!');
    }
}
