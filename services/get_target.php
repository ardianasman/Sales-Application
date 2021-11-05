<?php 

include $_SERVER['DOCUMENT_ROOT']."/ProyekManpro/services/database.php";

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql = "SELECT target_penjualan.id_sales, target_penjualan.id_target, target_penjualan.id_manager, 
            target_penjualan.bulan, target_penjualan.tahun, target_penjualan.target, target_penjualan.status, 
            sales.nama FROM `target_penjualan`
            LEFT JOIN sales on target_penjualan.id_sales=sales.id_sales
            WHERE sales.id_manager=?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION['id']]);

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