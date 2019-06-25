<?php

namespace App\Http\Controllers\Projects;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Domain\Projects\Entities\Project;
use App\Domain\UserManagement\Entities\User;

class ProjectController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $projects      = Project::with('users')->orderBy('id', 'DESC')->paginate(10);

        $filter_keyword     = $request->get('keyword') ? $request->get('keyword') : '';
        $status             = $request->get('status');

        if ($status) {
            $projects  = Project::where('status', $status)->orderBy('id', 'DESC')->paginate(10);
        } else {
            $projects  = Project::orderBy('id', 'DESC')->paginate(10);
        }

        if ($filter_keyword) {
            if ($status) {
                $projects  = Project::where('title', 'LIKE', "%$filter_keyword%")
                    ->where('status', $status)
                    ->orderBy('id', 'DESC')->paginate(10);
            } else {
                $projects  = Project::where('title', 'LIKE', "%$filter_keyword%")
                    ->orderBy('id', 'DESC')->paginate(10);
            }
        }

        return view('projects.index', ['projects' => $projects])->with('no', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = \Validator::make($request->all(), [
            'title'         => 'required|max:50|unique:projects',
            'assigned_to'   => 'required',
            'description'   => 'min:20',
            'owner'         => 'required|max:60',
            'logo'          => 'required|image',
            'status'        => 'required'
        ])->validate();

        $project    = new Project();

        $project->title         = $request->get('title');
        $project->slug          = str_slug($request->get('title'));
        $project->description   = $request->get('description');
        $project->owner         = $request->get('owner');
        $project->status        = $request->get('status');
        $project->created_by    = Auth::user()->id;

        if ($request->file('logo')) {
            $file               = $request->file('logo')->store('logos', 'public');
            $project->logo   = $file;
        }

        $project->save();

        $project->users()->attach($request->get('assigned_to'));

        return redirect()->route('projects.create')->with('status', 'Project successfully created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Domain\Projects\Entities\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project    = Project::findOrFail($id);

        return view('projects.show', ['project' => $project]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Domain\Projects\Entities\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project    = Project::findOrFail($id);
        return view('projects.edit', ['project' => $project]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Domain\Projects\Entities\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = \Validator::make($request->all(), [
            'title'         => 'required|max:50|',
            'assigned_to'   => 'required',
            'description'   => 'min:20',
            'owner'         => 'required|max:60',
            'logo'          => 'image',
            'status'        => 'required'
        ])->validate();

        $project    = Project::findOrFail($id);

        $project->title         = $request->get('title');
        $project->description   = $request->get('description');
        $project->owner         = $request->get('owner');
        $project->status        = $request->get('status');
        $project->updated_by    = Auth::user()->id;

        if ($request->file('logo')) {
            if ($project->logo && file_exists(storage_path('app/public'. $project->logo))) {
                Storage::delete('public/'. $project->logo);
            }
            $file   = $request->file('logo')->store('logos', 'public');
            $project->logo   = $file;
        }
        $project->save();
        $project->users()->sync($request->get('assigned_to'));

        return redirect()->route('projects.edit', ['id' => $id])->with('status', 'Project successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Domain\Projects\Entities\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $project    = Project::findOrFail($id);

        $project->deleted_by    = $request->get('deleted_by');
        $project->save();
        $project->delete();

        return redirect()->route('projects.index')->with('status', "Moved to trash");
    }

    public function trash(Request $request)
    {
        $projects   = Project::onlyTrashed()->orderBy('deleted_at', 'DESC')->paginate(10);

        $filter_keyword     = $request->get('keyword') ? $request->get('keyword') : '';
        $status             = $request->get('status');

        if ($status) {
            $projects  = Project::onlyTrashed()->where('status', $status)->orderBy('deleted_at', 'DESC')->paginate(10);
        } else {
            $projects  = Project::onlyTrashed()->orderBy('deleted_at', 'DESC')->paginate(10);
        }

        if ($filter_keyword) {
            if ($status) {
                $projects  = Project::onlyTrashed()->where('title', 'LIKE', "%$filter_keyword%")
                    ->where('status', $status)
                    ->orderBy('deleted_at', 'DESC')->paginate(10);
            } else {
                $projects  = Project::onlyTrashed()->where('title', 'LIKE', "%$filter_keyword%")
                    ->orderBy('deleted_at', 'DESC')->paginate(10);
            }
        }

        return view('projects.trash', ['projects' => $projects])->with('no', ($request->input('page', 1) - 1) * 10);
    }

    public function ajaxSearchUser(Request $request)
    {
        $keyword    = $request->get('q');
        $users      = User::where('name', 'LIKE', "%$keyword%")->get();
        return $users;
    }

    public function restore($id)
    {
        $project    = Project::onlyTrashed()->findOrFail($id);

        if ($project->trashed()) {
            $project->restore();
        } else {
            return redirect()->route('trash.projects')->with('status', 'Project is not in trash');
        }
        return redirect()->route('trash.projects')->with('status', 'Project successfully restored');
    }

    public function deletePermanent($id)
    {
        $project    = Project::onlyTrashed()->findOrFail($id);
        $logo       = $project->logo;

        if (!$project->trashed()) {
            return redirect()->route('trash.projects')->with('status', 'Can not delete permanent active project');
        } else {
            $project->forceDelete();

            if ($logo) {
                $filepath    = 'storage/' . $project->logo;

                try {
                    File::delete($filepath);
                } catch (FileNotFoundException $e) {
                     $e->getMessage();
                }
            }
            return redirect()->route('trash.projects')->with('status', 'Project permanently deleted!');
        }
    }
}
