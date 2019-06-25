<?php

namespace App\Http\Controllers;

use App\Repositories\Projects\ProjectRepository;
use App\Repositories\Specifications\TestcaseRepository;
use App\Repositories\Executions\IssueRepository;

class HomeController extends Controller
{

    private $projectRepository, $testcaseRepository, $issueRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProjectRepository $projectRepository, TestcaseRepository $testcaseRepository, IssueRepository $issueRepository)
    {
        $this->middleware('auth');

        $this->projectRepository    = $projectRepository;
        $this->testcaseRepository   = $testcaseRepository;
        $this->issueRepository      = $issueRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /**
         * Get all data from projects
         */
        $projects           = $this->projectRepository->getAllProject();
        $activeProject      = $this->projectRepository->getProjectByStatusActive();
        $inactiveProject    = $this->projectRepository->getProjectByStatusInactive();

        /**
         * Get all data from testcase
         */
        $testcases          = $this->testcaseRepository->getAllTestcase();
        $passTestcase       = $this->testcaseRepository->getPassTestcase();
        $failTestcase       = $this->testcaseRepository->getFailTestcase();

        /**
         * Get all data from issue
         */
        $issues             = $this->issueRepository->getAllIssue();
        $finishedIssue      = $this->issueRepository->getFinishedIssue();

        return view('home', compact('projects', 'activeProject', 'inactiveProject', 'testcases', 'passTestcase', 'failTestcase', 'issues', 'finishedIssue'));
    }

}
