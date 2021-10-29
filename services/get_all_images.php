<?php 

include $_SERVER['DOCUMENT_ROOT']."/ProyekManpro/services/database.php";

//session_start();


header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id_sales = $_SESSION['id'];
    $sql = "SELECT a.id_aktivitas,c.nama AS Nama_Cust ,s.nama,a.jadwal_kunjungan,a.foto_kunjungan
    FROM aktivitas_sales a 
    JOIN sales s ON a.id_sales = s.id_sales
    JOIN `order` ON a.id_order = `order`.`id_order`
    JOIN customer c ON `order`.`id_customer` = c.id_customer
    WHERE a.id_sales = ? AND a.status_kunjungan = 1";
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