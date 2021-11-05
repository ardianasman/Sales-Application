<?php 

include $_SERVER['DOCUMENT_ROOT']."/ProyekManpro/services/database.php";

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $result = array(
        "status" => 1,
        "error" => ""
    );

    $id_sales = $_POST['id_sales'];

    $sql = "DELETE FROM target_penjualan WHERE id_sales = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_sales]);

    echo json_encode($result);
} else {
    header("HTTP/1.1 400 Bad Request");
    $error = array(
        'error' => 'Method not Allowed'
    );
    
    echo json_encode($error);
}