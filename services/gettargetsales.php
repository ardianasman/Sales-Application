<?php

include "database.php";

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bulan=$_POST['bulan'];
    $tahun= $_POST['tahun'];
    $sql = "SELECT s.nama,t.target,t.status FROM `target_penjualan` t JOIN `sales` s ON t.id_sales=s.id_sales WHERE t.bulan = $bulan AND t.tahun = $tahun";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

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

    echo json_encode($error);
}
?>