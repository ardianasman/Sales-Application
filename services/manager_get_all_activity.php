<?php 

include $_SERVER['DOCUMENT_ROOT']."/ProyekManpro/services/database.php";

//session_start();


header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql = "SELECT a.id_aktivitas, c.nama,s.nama AS nama_sales,a.status_kunjungan,a.foto_kunjungan, a.jadwal_kunjungan
    FROM aktivitas_sales a
    JOIN customer c ON a.id_customer = c.id_customer
    JOIN sales s ON a.id_sales = s.id_sales";
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