<?php

include "database.php";

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tanggal_mulai_order=$_POST['tanggalmulaiorder'];
    $tanggal_selesai_order=$_POST['tanggalselesaiorder'];
    $tanggal_mulai_tempo=$_POST['tanggalmulaitempo'];
    $tanggal_selesai_tempo=$_POST['tanggalselesaitempo'];
    $filternama=$_POST['filternama'];
    $status_order=$_POST['statusorder'];


    $sql = "SELECT * FROM `order` o JOIN sales s ON o.id_sales=s.id_sales JOIN customer c ON o.id_customer=c.id_customer";
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