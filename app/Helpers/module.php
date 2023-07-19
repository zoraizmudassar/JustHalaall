<?php

use Illuminate\Http\Request;
function printAll($data){
    echo "<pre>";
    print_r($data);
    die();
}

function getApiLoggedUserId($request){
    return $request->user_id;
}

function getOrderStatusId($status){
    if($status == "pending"){
        return 1;
    }
    else if($status == "accepted"){
        return 2;
    }
    else if($status == "delivered"){
        return 3;
    }
    else if($status == "rejected"){
        return 4;
    }
    else{
        return "";
    }
}

function getDistanceBetweenTwoCoOrdinates($origin, $destinations){
    $distance = google_distance($origin, $destinations);
    return ($distance/1000);
}
