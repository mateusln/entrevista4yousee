<?php

class plan
{
    private String $dataPath;
    private String $dataJson;

    function __construct()
    {
        
    }

    public function loadDataFromJson()
    {
        $this->dataJson = file_get_contents("./data.json");
    }

    public function getDataJson()
    {
        return $this->dataJson;
    }

    public function getPlanDataAsArrays()
    {
        $dataArray = json_decode($this->dataJson, true);
        $planArray = $dataArray['plans'];
        return $planArray;
    }

    private function isStartDateAfterToday($startDate){
        $today = date("Y-m-d");
        return $startDate > $today;
    }

    public function getUniquePlanArray(){
        $planArray = $this->getPlanDataAsArrays();
        $uniquePlanArray = array();

        foreach($planArray as $plan){
            if($this->isStartDateAfterToday($plan['schedule']['startDate'])){
                continue;
            }

            $sku = str_replace(' ', '-', $plan['name']);
            $uniquePlanArray[$sku] = $plan;
        }
        
        return $uniquePlanArray;

    }
}
