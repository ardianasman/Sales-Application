<?php

include "database.php";

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $cst = $_GET["id"];
    $sql = "SELECT id_order,id_sales,id_customer,tanggal_jatuh_tempo,tanggal_order,total_harga FROM `order` WHERE status_order = 0 AND id_customer = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$cst]);

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