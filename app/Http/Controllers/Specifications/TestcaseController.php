<?php

namespace App\Http\Controllers\Specifications;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Domain\Projects\Entities\Project;
use App\Domain\Spesifications\Entities\Testcase;

class TestcaseController extends Controller
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

        $testcases       = Testcase::where('expected_result', 'LIKE', "%".$keyword."%")->whereHas('scenario.feature.story.project', function ($query) use ($id) {
            $query->where('id', $id)
            ->orderBy('updated_at', 'DESC');
        })->paginate(20);

        return view('testcases.index', ['testcases' => $testcases, 'project' => $project]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $project    = Project::find($id);
        return view('testcases.create', ['project' => $project]);
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
            'scenario_id'       => 'required',
            'expected_result'   => 'required',
            'status'            => 'required'
        ]);

        $project                    = Project::find($id);
        $testcase                   = new Testcase();
        $testcase->scenario_id      = $request->get('scenario_id');
        $testcase->expected_result  = $request->get('expected_result');
        $testcase->description      = $request->get('description');
        $testcase->url              = $request->get('url');
        if ($request->get('status') == 'Other'){
            $testcase->status       = $request->get('other_status');
        } elseif($request->get('other_status') == '') {
            $testcase->status           = $request->get('status');
        }
        $testcase->created_by       = Auth::user()->id;

        if ($request->file('picture')) {
            $file               = $request->file('picture')->store('pictures', 'public');
            $testcase->picture  = $file;
        }

        $testcase->save();

        return redirect()->route('testcases.create', ['project' => $project])->with('status', 'Successfully created testcase');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Domain\Spesifications\Entities\Testcase  $testcase
     * @return \Illuminate\Http\Response
     */
    public function show($project_id, $testcase_id)
    {
        $project    = Project::find($project_id);
        $testcase   = Testcase::find($testcase_id);

        $issues       = $testcase->issues()
            ->orderBy('updated_at', 'DESC')
            ->paginate(20);

        return view('testcases.show', ['testcase' => $testcase, 'issues' => $issues, 'project' => $project]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Domain\Spesifications\Entities\Testcase  $testcase
     * @return \Illuminate\Http\Response
     */
    public function edit($project_id, $testcase_id)
    {
        $project    = Project::find($project_id);
        $testcase   = Testcase::find($testcase_id);

        return view('testcases.edit', ['testcase' => $testcase, 'project' => $project]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Domain\Spesifications\Entities\Testcase  $testcase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $testcase_id, $project_id)
    {
        // dd($request->all());

        $validation     = $request->validate([
            'scenario_id'   => 'required',
            'status'        => 'required',
            'expected_result'   => 'required'
        ]);

        $project        = Project::find($project_id);
        $testcase       = Testcase::find($testcase_id);
        $testcase->scenario_id      = $request->get('scenario_id');
        $testcase->expected_result  = $request->get('expected_result');
        $testcase->description      = $request->get('description');
        $testcase->url              = $request->get('url');
        if ($request->get('status') == 'Other'){
            $testcase->status       = $request->get('other_status');
        } elseif($request->get('other_status') == '') {
            $testcase->status           = $request->get('status');
        }
        $testcase->updated_by       = Auth::user()->id;

        if ($request->file('picture')) {
            if ($testcase->picture && file_exists(storage_path('app/public'. $testcase->picture))) {
                $filepath    = 'storage/' . $testcase->picture;
                File::delete($filepath);
            }
            $file   = $request->file('picture')->store('pictures', 'public');
            $testcase->picture   = $file;
        }
        $testcase->save();

        return redirect()->route('testcases.edit', ['project' => $project, 'testcase' => $testcase])->with('status', 'Successfully updated testcase');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Domain\Spesifications\Entities\Testcase  $testcase
     * @return \Illuminate\Http\Response
     */
    public function destroy($project_id, $testcase_id)
    {
        $project    = Project::find($project_id);
        $testcase   = Testcase::find($testcase_id);

        $testcase->deleted_by   = Auth::user()->id;
        $testcase->save();
        $testcase->delete();

        return redirect()->route('testcases.index', ['project' => $project])->with('status', 'Testcase successfully moved to trash');
    }

    public function trash(Request $request)
    {
        $testcases   = Testcase::onlyTrashed()->orderBy('updated_at', 'DESC')->paginate(20);

        $keyword     = $request->get('keyword') ? $request->get('keyword') : '';

        $testcases   = Testcase::onlyTrashed()->where('expected_result', 'LIKE', "%$keyword%")
            ->orderBy('updated_at', 'DESC')->paginate(20);

        return view('testcases.trash', ['testcases' => $testcases]);
    }

    public function restore($id)
    {
        $testcase    = Testcase::onlyTrashed()->findOrFail($id);

        if ($testcase->trashed()) {
            $testcase->restore();
        } else {
            return redirect()->route('trash.testcases')->with('status', 'Testcase is not in trash');
        }
        return redirect()->route('trash.testcases')->with('status', 'Testcase successfully restored');
    }

    public function deletePermanent($id)
    {
        $testcase    = Testcase::onlyTrashed()->findOrFail($id);

        $picture  = $testcase->picture;

        if (!$testcase->trashed()) {
            return redirect()->route('trash.testcases')->with('status', 'Can not delete permanent active testcase');
        } else {
            $testcase->forceDelete();

            if ($picture) {
                $filepath    = 'storage/' . $testcase->picture;

                try {
                    File::delete($filepath);
                } catch (FileNotFoundException $e) {
                     $e->getMessage();
                }
            }
            return redirect()->route('trash.testcases')->with('status', 'Testcase permanently deleted!');
        }
    }
}
