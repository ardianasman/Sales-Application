<?php 

include $_SERVER['DOCUMENT_ROOT']."/ProyekManpro/services/database.php";

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql = "SELECT customer.id_customer, sales.nama as nama_sales, customer.nama, customer.alamat, customer.no_telp, customer.terakhir_dikunjungi, sales.id_manager FROM `customer`
JOIN sales ON customer.id_sales=sales.id_sales
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