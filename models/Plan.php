<?php

class Plan
{
    private String $dataJson;
    private array $arrayOfPlans;

    public function __construct()
    {
        $this->dataJson = "";
        $this->arrayOfPlans = [];
    }

    public function loadDataFromJsonFile()
    {
        $this->dataJson = file_get_contents("./data.json");

        if (!$this->dataJson) {
            throw new Exception("Arquivo não encontrado");
        }

        return $this;
    }

    public function buildArrayOfPlans()
    {
        if ($this->dataJson == "") {
            return $this;
        }

        $dataArray = json_decode($this->dataJson, true);
        $this->arrayOfPlans = $dataArray['plans'];

        return $this;
    }

    public function getDataJson()
    {
        return $this->dataJson;
    }

    public function getArrayOfPlans()
    {
        return $this->arrayOfPlans;
    }

    private function isStartDateAfterToday($startDate)
    {
        $today = date("Y-m-d");
        return $startDate > $today;
    }

    public function getUniquePlanArray()
    {
        $uniquePlanArray = array();

        foreach ($this->arrayOfPlans as $plan) {
            if ($this->isStartDateAfterToday($plan['schedule']['startDate'])) {
                continue;
            }

            $sku = str_replace(' ', '-', $plan['name']) . '-' . str_replace(' ', '-', $plan['localidade']['nome']);
            if (isset($uniquePlanArray[$sku])) {
                $plan = $this->chooseMostRecentPlan($plan, $uniquePlanArray[$sku]);
            }

            $uniquePlanArray[$sku] = $plan;
        }

        return $uniquePlanArray;
    }

    private function chooseMostRecentPlan($plan1, $plan2){
        if ($plan1['schedule']['startDate'] > $plan2['schedule']['startDate']) {
            return $plan1;
        }

        return $plan2;
    }

    public function orderPlansByStartDate()
    {
        usort($this->arrayOfPlans, function ($a, $b) {
            return $a['schedule']['startDate'] <=> $b['schedule']['startDate'];
        });

        return $this;
    }

    public function orderPlansByPriority(){
        usort($this->arrayOfPlans, function ($a, $b) {
            return $a['localidade']['prioridade'] > $b['localidade']['prioridade'] ? -1 : 1;
        });

        return $this;
    }
}
