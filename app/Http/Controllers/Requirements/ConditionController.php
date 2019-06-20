<?php

namespace App\Http\Controllers\Requirements;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Domain\Requirements\Entities\Story;
use App\Domain\Requirements\Entities\Condition;

class ConditionController extends Controller
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

    }

    public function createByStory($id)
    {
        $story  = Story::find($id);

        return view('conditions.create', ['story' => $story]);
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
            'pre_condition'     => 'required',
            'post_condition'    => 'required'
        ]);

        $condition      = new Condition();
        $story          = Story::find($id);

        $condition->story_id        = $request->get('story_id');
        $condition->status          = $request->get('status');
        $condition->pre_condition   = $request->get('pre_condition');
        $condition->post_condition  = $request->get('post_condition');
        $condition->created_by      = Auth::user()->id;
        $condition->save();

        return redirect()->route('conditions.create', ['story' => $story])->with('status', 'Successfully created condition');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Domain\Requirements\Entities\Condition  $condition
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $condition      = Condition::find($id);
        $story          = Story::find($id);
        return view('conditions.show', ['condition' => $condition, 'story' => $story]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Domain\Requirements\Entities\Condition  $condition
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $condition      = Condition::find($id);
        $story          = Story::find($id);
        return view('conditions.edit', ['condition' => $condition, 'story' => $story]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Domain\Requirements\Entities\Condition  $condition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation     = Validator::make($request->all(), [
            'pre_condition'     => 'required',
            'post_condition'    => 'required'
        ]);
        $story          = Story::find($id);
        $condition      = Condition::find($id);
        $condition->status          = $request->get('status');
        $condition->pre_condition   = $request->get('pre_condition');
        $condition->post_condition  = $request->get('post_condition');
        $condition->updated_by      = Auth::user()->id;
        $condition->save();

        return redirect()->route('conditions.edit', ['id' => $id, 'story' => $story])->with('status', 'Story successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Domain\Requirements\Entities\Condition  $condition
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $condition  = Condition::find($id);
        $condition->delete();

        return redirect()->route('stories.show', ['story' => $condition->story->id])->with('status', 'Condition successfully deleted permanently');
    }
}
