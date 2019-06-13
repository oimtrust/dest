<?php

namespace App\Http\Controllers\Specifications;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Domain\Projects\Entities\Project;
use App\Domain\Spesifications\Entities\Scenario;

class ScenarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        $project    = Project::find($id);

        $keyword    = $request->get('keyword');

        $scenarios       = Scenario::where('action', 'LIKE', "%".$keyword."%")->whereHas('feature.story.project', function ($query) use ($id) {
            $query->where('id', $id)
            ->orderBy('updated_at', 'DESC');
        })->paginate(20);

        return view('scenarios.index', ['scenarios' => $scenarios, 'project' => $project]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $project    = Project::find($id);
        return view('scenarios.create', ['project' => $project]);
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
            'feature_id'    => 'required',
            'action'        => 'required',
            'test_step'     => 'required'
        ]);

        $project                    = Project::find($id);

        $scenario                   = new Scenario();
        $scenario->feature_id       = $request->get('feature_id');
        $scenario->action           = $request->get('action');
        $scenario->prerequisites    = $request->get('prerequisites');
        $scenario->test_step        = $request->get('test_step');
        $scenario->created_by       = Auth::user()->id;
        $scenario->save();

        return redirect()->route('scenarios.create', ['project' => $project])->with('status', 'Successfully created Scenario');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Domain\Spesifications\Entities\Scenario  $scenario
     * @return \Illuminate\Http\Response
     */
    public function show($scenario_id, $project_id)
    {

        $project    = Project::find($project_id);
        $scenario   = Scenario::find($scenario_id);

        return view('scenarios.show', ['scenario' => $scenario, 'project' => $project]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Domain\Spesifications\Entities\Scenario  $scenario
     * @return \Illuminate\Http\Response
     */
    public function edit($scenario_id, $project_id)
    {
        $project    = Project::find($project_id);
        $scenario   = Scenario::find($scenario_id);

        return view('scenarios.edit', ['scenario' => $scenario, 'project' => $project]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Domain\Spesifications\Entities\Scenario  $scenario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $scenario_id, $project_id)
    {
        $validation     = $request->validate([
            'action'        => 'required',
            'test_step'     => 'required'
        ]);

        $project    = Project::find($project_id);
        $scenario   = Scenario::find($scenario_id);

        $scenario->action           = $request->get('action');
        $scenario->prerequisites    = $request->get('prerequisites');
        $scenario->test_step        = $request->get('test_step');
        $scenario->updated_by       = Auth::user()->id;
        $scenario->save();
        return redirect()->route('scenarios.edit', ['scenario' => $scenario, 'project' => $project])->with('status', 'Successfully updated scenario');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Domain\Spesifications\Entities\Scenario  $scenario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project    = Project::find($id);
        $scenario   = Scenario::find($id);

        $scenario->deleted_by   = Auth::user()->id;
        $scenario->save();
        $scenario->delete();

        return redirect()->route('scenarios.index', ['project' => $project])->with('status', 'Scenario successfully moved to trash');
    }

    public function trash(Request $request)
    {
        $scenarios   = Scenario::onlyTrashed()->orderBy('updated_at', 'DESC')->paginate(20);

        $keyword     = $request->get('keyword') ? $request->get('keyword') : '';

        $scenarios   = Scenario::onlyTrashed()->where('action', 'LIKE', "%$keyword%")
            ->orderBy('updated_at', 'DESC')->paginate(20);

        return view('scenarios.trash', ['scenarios' => $scenarios]);
    }

    public function restore($id)
    {
        $scenario    = Scenario::onlyTrashed()->findOrFail($id);

        if ($scenario->trashed()) {
            $scenario->restore();
        } else {
            return redirect()->route('scenarios.trash')->with('status', 'Scenario is not in trash');
        }
        return redirect()->route('scenarios.trash')->with('status', 'Scenario successfully restored');
    }

    public function deletePermanent($id)
    {
        $scenario    = Scenario::onlyTrashed()->findOrFail($id);

        if (!$scenario->trashed()) {
            return redirect()->route('scenarios.trash')->with('status', 'Can not delete permanent active scenario');
        } else {
            $scenario->forceDelete();
        }
        return redirect()->route('scenarios.trash')->with('status', 'Scenario permanently deleted!');
    }

    public function ajaxSearchScenario(Request $request, $id)
    {
        $project        = Project::find($id);
        $keyword        = $request->get('q');
        $scenarios      = Scenario::where('action', 'LIKE', "%".$keyword."%")->whereHas('feature.story.project', function ($query) use ($project) {
            $query->where('id', $project->id);
        } )->get();

        return $scenarios;
    }
}
