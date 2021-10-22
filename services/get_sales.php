<?php 

include $_SERVER['DOCUMENT_ROOT']."/ProyekManpro/services/database.php";

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql = "SELECT sales.id_sales, sales.id_manager, sales.nama, sales.alamat, sales.no_telp, sales.email, sales.tanggal_mulai_kerja,  sales.tanggal_berhenti_kerja, target_penjualan.target, target_penjualan.status FROM `sales`
    LEFT JOIN target_penjualan ON sales.id_sales=target_penjualan.id_sales
    WHERE sales.id_manager=1";

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