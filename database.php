<?php 

$host = "127.0.0.1"; // IP MySQL nya dimana
$db = "salesapp";
$user = "root";
$pass = "";
$charset = "utf8mb4";

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    //throw new \PDOExeption($e->getMessage(), (int)$e->getCode());
    echo "Error Connect to Database Msg: ".$e->getMessage();
}

//echo phpinfo();

?>