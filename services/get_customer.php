<?php

include "database.php";

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_SESSION['id'];
    $sql = "SELECT id_customer,nama,alamat,no_telp FROM `customer` WHERE id_sales = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    $result = array();
    while($row = $stmt->fetch()) {
        array_push($result, $row);
    }

    echo json_encode($result);
} else {
    header("HTTP/1.1 400 Bad Request");
    $error = array(
        'error' => 'Method not Allowed'
    );

    echo json_encode($error);}
?>