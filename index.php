<?php
//import plan model
require_once('./models/plan.php');

//read json file
//$json = file_get_contents('./data.json');

//$decodeData =   json_decode($json, true);

//create plan object
$plan = new plan();
$plan->loadDataFromJson();

echo "<pre>" . print_r($plan->getUniquePlanArray(), true) . "</pre>";