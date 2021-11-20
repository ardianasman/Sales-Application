<?php 

include $_SERVER['DOCUMENT_ROOT']."/ProyekManpro/services/database.php";

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql = "SELECT target_penjualan.id_sales, target_penjualan.id_target, target_penjualan.id_manager, 
            target_penjualan.bulan, 
            CASE
            WHEN target_penjualan.bulan=1 THEN 'Januari'
            WHEN target_penjualan.bulan=2 THEN 'Februari'
            WHEN target_penjualan.bulan=3 THEN 'Maret'
            WHEN target_penjualan.bulan=4 THEN 'April'
            WHEN target_penjualan.bulan=5 THEN 'Mei'
            WHEN target_penjualan.bulan=6 THEN 'Juni'
            WHEN target_penjualan.bulan=7 THEN 'Juli'
            WHEN target_penjualan.bulan=8 THEN 'Agustus'
            WHEN target_penjualan.bulan=9 THEN 'September'
            WHEN target_penjualan.bulan=10 THEN 'Oktober'
            WHEN target_penjualan.bulan=11 THEN 'November'
            WHEN target_penjualan.bulan=12 THEN 'Desember'
            WHEN target_penjualan.bulan=11 THEN 'November'
            ELSE '-'
            END as mon, target_penjualan.tahun, target_penjualan.target, FORMAT(target_penjualan.target,'C') as tar, target_penjualan.status, 
            sales.nama FROM `target_penjualan`
            LEFT JOIN sales on target_penjualan.id_sales=sales.id_sales
            WHERE (target_penjualan.id_manager=? AND bulan=MONTH(CURRENT_DATE) AND tahun=YEAR(CURRENT_DATE)) OR (target_penjualan.id_manager=? AND status=0)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_SESSION['id'], $_SESSION['id']]);

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