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
            ->orderPlansByPriority();

        // o método abaixo percorre o array de planos e cria um array unico de planos,
        // como o array está em ordem crescente de datas o mais recente terá prioridade
        $this->dataTable = $this->plan->getUniquePlanArray();

        include_once('./views/PlanTable.php');
    }
}
