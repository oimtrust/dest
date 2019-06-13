<?php

namespace App\Http\Controllers\Menus;

use App\Http\Controllers\Controller;
use App\Domain\Projects\Entities\Project;

class MenuController extends Controller
{
    public function index($id)
    {
        $project    = Project::find($id);

        return view('menus.index', ['project' => $project]);
    }
}
