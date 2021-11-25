<?php 

include $_SERVER['DOCUMENT_ROOT']."/ProyekManpro/services/database.php";

//session_start();


header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql = "SELECT `order`.`id_order`, s.nama AS nama_sales, s.id_manager, c.nama AS nama_cust, `order`.`tanggal_order`, `order`.`tanggal_jatuh_tempo`,FORMAT(`order`.`total_harga`,'C') as total_harga
    FROM `order`
    JOIN sales s ON s.id_sales = `order`.`id_sales`
    JOIN customer c ON c.id_customer = `order`.`id_customer`
    WHERE s.id_manager=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION['id_manajer']]);

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