<?php
require_once('./models/Plan.php');

class PlanController
{
    private $plan;
    protected $dataTable;

    public function __construct()
    {
        $this->plan = new plan();
        $this->dataTable = array();
    }

    public function loadView()
    {
        $this->plan
            ->loadDataFromJsonFile()
            ->buildArrayOfPlans()
            ->orderPlansByStartDate();

        $this->dataTable = $this->plan->getUniquePlanArray();

        include_once('./views/PlanTable.php');
    }
}
