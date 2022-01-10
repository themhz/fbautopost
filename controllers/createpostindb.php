<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once "../db.php";

if(checkValues($_REQUEST["txturl"]) &&
    checkValues($_REQUEST["txtdate"]) &&
    checkValues($_REQUEST["txttime"])
){    
    createpostindb($pdo);
}else{
    echo "some values are not set"; 
}


function checkValues($value){
    if(isset($value) && trim($value) !=""){
        return true;
    }else{
        return false;
    }
}


function createpostindb($pdo){
    
    $url = $_REQUEST["txturl"];    
    $post_date = str_replace("-","/",$_REQUEST["txtdate"].' '.$_REQUEST["txttime"]);
    
    $reg_date = getRegdate();
    // echo str_replace("-","/",$post_date);

    $sql = "INSERT INTO posts (`url`, post_date, reg_date, posted) VALUES (?,?,?,?)";
    // print_r($pdo);
    // die();
    $stmt= $pdo->prepare($sql);
    
    $stmt->execute([$url, $post_date, $reg_date, 0]);
}

function getRegdate(){
        $date = new DateTime();
        return $date->format('Y/m/d H:i:s');
}