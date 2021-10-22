<?php

include "database.php";

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tanggal_mulai_order=$_POST['tanggal_mulai_order'];
    $tanggal_selesai_order=$_POST['tanggal_selesai_order'];
    // $tanggal_mulai_tempo=$_POST['tanggalmulaitempo'];
    // $tanggal_selesai_tempo=$_POST['tanggalselesaitempo'];
    // $filternama=$_POST['filternama'];
    // $status_order=$_POST['statusorder'];


    $sql = "SELECT o.id_order,s.nama as 'nama_sales',c.nama as 'nama_customer',o.tanggal_order,o.tanggal_jatuh_tempo,o.total_harga,o.status_order FROM `order` o JOIN sales s ON o.id_sales=s.id_sales JOIN customer c ON o.id_customer=c.id_customer WHERE o.tanggal_order BETWEEN '$tanggal_mulai_order' AND '$tanggal_selesai_order'";
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