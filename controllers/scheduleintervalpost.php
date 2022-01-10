<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../db.php";
deleteAutoPosts($pdo);

foreach($_POST["fields"] as $field){ 
    echo $field["id"]."<br>";
    echo $field["url"]."<br>";    
    insertAutoPost($field["url"], $pdo);
}


function insertAutoPost($url, $pdo){    

    $sql = "INSERT INTO Ld6irglhf_autoposts_scheduleintervalpost (`url`, posted) VALUES (?,?)";    
    $stmt= $pdo->prepare($sql);
    
    $stmt->execute([$url, 10]);
}

function deleteAutoPosts($pdo){
	$sql = "DELETE FROM Ld6irglhf_autoposts_scheduleintervalpost";    
    $stmt= $pdo->prepare($sql);   
    $stmt->execute();
}
//header("Location: https://epenthitis.gr/fbautopost/index.php?page=fetchdailyposts");