<?php

namespace App\Http\Controllers\Requirements;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Domain\Projects\Entities\Project;
use Illuminate\Support\Facades\Validator;
use App\Domain\Requirements\Entities\Story;
use App\Domain\Requirements\Entities\Feature;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('features.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $story  = Story::find($id);
        return view('features.create', ['story' => $story]);
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
            'title'     => 'required'
        ]);
        $story                  = Story::find($id);
        $feature                = new Feature();
        $feature->title         = $request->get('title');
        $feature->note          = $request->get('note');
        $feature->story_id      = $request->get('story_id');
        $feature->created_by    = Auth::user()->id;
        $feature->save();

        return redirect()->route('features.create', ['story' => $story])->with('status', 'Feature successfully created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Domain\Requirements\Entities\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $feature    = Feature::find($id);
        $story      = Story::find($id);

        return view('features.show', ['feature' => $feature, 'story' => $story]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Domain\Requirements\Entities\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $feature    = Feature::find($id);
        $story      = Story::find($id);

        return view('features.edit', ['feature' => $feature, 'story' => $story]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Domain\Requirements\Entities\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation     = Validator::make($request->all(), [
            'title'     => 'required'
        ]);

        $story                  = Story::find($id);
        $feature                = Feature::find($id);
        $feature->title         = $request->get('title');
        $feature->note          = $request->get('note');
        $feature->updated_by    = Auth::user()->id;
        $feature->save();

        return redirect()->route('features.edit', ['id' => $id, 'story' => $story])->with('status', 'Feature successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Domain\Requirements\Entities\Feature  $feature
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $feature                = Feature::find($id);
        $feature->deleted_by    = Auth::user()->id;
        $feature->save();
        $feature->delete();

        return redirect()->route('stories.show', ['story' => $feature->story->id])->with('status', 'Feature moved to trash');
    }

    public function trash(Request $request)
    {
        $features   = Feature::onlyTrashed()->orderBy('updated_at', 'DESC')->paginate(10);

        $keyword   = $request->get('keyword') ? $request->get('keyword') : '';

        $features  = Feature::onlyTrashed()->where('title', 'LIKE', "%$keyword%")
            ->orderBy('updated_at', 'DESC')->paginate(10);

        return view('features.trash', ['features' => $features]);
    }

    public function restore($id)
    {
        $feature    = Feature::onlyTrashed()->findOrFail($id);

        if ($feature->trashed()) {
            $feature->restore();
        } else {
            return redirect()->route('features.trash')->with('status', 'Feature is not in trash');
        }
        return redirect()->route('features.trash')->with('status', 'Feature successfully restored');
    }

    public function deletePermanent($id)
    {
        $feature    = Feature::onlyTrashed()->findOrFail($id);

        if (!$feature->trashed()) {
            return redirect()->route('features.trash')->with('status', 'Can not delete permanent active feature');
        } else {
            $feature->forceDelete();
        }
        return redirect()->route('features.trash')->with('status', 'Feature permanently deleted!');
    }

    public function ajaxSearchFeature(Request $request, $id)
    {
        $project        = Project::find($id);
        $keyword        = $request->get('q');
        $features       = Feature::where('title', 'LIKE', "%".$keyword."%")->whereHas('story.project', function ($query) use ($project) {
            $query->where('id', $project->id);
        } )->get();

        return $features;
    }
}
