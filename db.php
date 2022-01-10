<?php

$host = 'localhost';
$db   = 'wp_gfmqi';
$user = 'wp_2r7p9';
$pass = 'Zk!#od5I9NtcBK2Y';
$port = "3306";
$charset = 'utf8';
// $pdo = "dsadsadsad"; 

$options = [
    \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
    \PDO::ATTR_EMULATE_PREPARES   => false,
];

$dsn = "mysql:host=$host;dbname=$db;charset=$charset;port=$port";

try {
     $pdo = new \PDO($dsn, $user, $pass, $options);
    //  echo "connection successfull";
} catch (\PDOException $e) {

    exit("connection unsuccessfull ". $e->getMessage());    
    // throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
