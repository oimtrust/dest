<?php
namespace App\Repositories\Executions;

use App\Domain\Executions\Entities\Issue;

class IssueRepository
{
    private $issue;

    public function __construct(Issue $issue) {
        $this->issue = $issue;
    }

    public function getAllIssue()
    {
        $data = Issue::where('status', '!=', 'DONE')->get();
        return $data;
    }

    public function getFinishedIssue()
    {
        $data = Issue::where('status', 'DONE')->get();
        return $data;
    }
}


