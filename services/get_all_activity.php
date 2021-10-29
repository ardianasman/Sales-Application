<?php 

include $_SERVER['DOCUMENT_ROOT']."/ProyekManpro/services/database.php";

//session_start();


header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id_sales = $_SESSION['id'];
    $sql = "SELECT c.nama as nama_customer,a.id_aktivitas,c.no_telp, c.alamat as alamat_customer
    FROM aktivitas_sales a 
    JOIN sales s ON a.id_sales = s.id_sales
    JOIN customer c ON a.`id_customer` = c.id_customer
    WHERE a.id_sales = ? AND a.status_kunjungan = 0";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_sales]);

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