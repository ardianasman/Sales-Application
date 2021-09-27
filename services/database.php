<?php
session_start();
$host = "127.0.0.1"; // IP MySQL nya dimana
$db = "salesapp";
$user = "root";
$pass = "";
$charset = "utf8mb4";

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Data dikembalikan dalam bentuk object bukan array
    PDO::ATTR_EMULATE_PREPARES   => false,
];


try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    echo "Error Connect to Database Msg: ".$e->getMessage();
}

//echo phpinfo();

?>