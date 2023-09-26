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

            $sku = str_replace(' ', '-', $plan['name']);
            if (isset($uniquePlanArray[$sku])) {
                $plan = $this->chooseMostPriorityPlan($plan, $uniquePlanArray[$sku]);
            }

            $uniquePlanArray[$sku] = $plan;
        }

        return $uniquePlanArray;
    }

    private function chooseMostPriorityPlan($currentPlan, $planInUniqueArray)
    {
        if ($currentPlan['localidade']['prioridade'] > $planInUniqueArray['localidade']['prioridade']) {
            return $currentPlan;
        }

        return $planInUniqueArray;
    }

    public function orderPlansByStartDate()
    {
        usort($this->arrayOfPlans, function ($a, $b) {
            return $a['schedule']['startDate'] <=> $b['schedule']['startDate'];
        });

        return $this;
    }
}
