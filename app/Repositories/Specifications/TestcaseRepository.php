<?php
namespace App\Repositories\Specifications;

use App\Domain\Spesifications\Entities\Testcase;

class TestcaseRepository
{
    private $testcase;

    public function __construct(Testcase $testcase) {
        $this->testcase = $testcase;
    }

    public function getAllTestcase()
    {
        return $this->testcase->all();
    }

    public function getPassTestcase()
    {
        $data = Testcase::where('status', 'PASS')->get();
        return $data;
    }

    public function getFailTestcase()
    {
        $data = Testcase::where('status', 'FAIL')->get();
        return $data;
    }
}

