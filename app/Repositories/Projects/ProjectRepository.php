<?php
namespace App\Repositories\Projects;

use App\Domain\Projects\Entities\Project;

class ProjectRepository
{
    private $project;

    public function __construct(Project $project) {
        $this->project = $project;
    }

    public function getAllProject()
    {
       return $this->project->all();
    }

    public function getProjectByStatusActive()
    {
        $data   = Project::where('status', 'PUBLISH')->get();
        return $data;
    }

    public function getProjectByStatusInactive()
    {
        $data   = Project::where('status', 'DRAFT')->get();
        return $data;
    }
}

