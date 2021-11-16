<?php 

include $_SERVER['DOCUMENT_ROOT']."/ProyekManpro/services/database.php";

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql = "SELECT *, FORMAT(target_penjualan.target,'C') as target_ok, sales.id_sales as x, MONTH(CURRENT_DATE) as mon, YEAR(CURRENT_DATE) as year FROM `sales`
    LEFT JOIN `target_penjualan` on sales.id_sales=target_penjualan.id_sales
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