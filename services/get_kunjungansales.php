<?php

include "database.php";

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sales = $_GET["id"];
    $sql = "SELECT customer.nama, customer.id_customer ,aktivitas_sales.jadwal_kunjungan from customer LEFT JOIN aktivitas_sales on customer.id_customer = aktivitas_sales.id_customer where aktivitas_sales.id_sales = ? AND aktivitas_sales.status_persetujuan = 0";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$sales]);

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