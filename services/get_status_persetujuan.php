<?php 

include $_SERVER['DOCUMENT_ROOT']."/ProyekManpro/services/database.php";

//session_start();


header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql = "SELECT a.id_customer, c.nama as nama_cust, a.jadwal_kunjungan, a.status_persetujuan
    FROM `aktivitas_sales` a
    JOIN customer c ON a.id_customer = c.id_customer";
    $stmt = $pdo->prepare();
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