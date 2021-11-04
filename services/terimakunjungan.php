<?php 

include $_SERVER['DOCUMENT_ROOT']."/ProyekManpro/services/database.php";

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $result = array(
        "status" => 1,
        "error" => ""
    );

    $id_sales = $_POST['id_sales'];
    $id_customer = $_POST['id_customer'];
    
        $sql = "UPDATE aktivitas_sales 
        SET status_persetujuan = 2
        WHERE id_sales = ? AND id_customer = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id_sales,$id_customer]);

    echo json_encode($result);
} else {
    header("HTTP/1.1 400 Bad Request");
    $error = array(
        'error' => 'Method not Allowed'
    );

    echo json_encode($error);
}