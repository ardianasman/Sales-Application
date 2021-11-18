<?php 

include $_SERVER['DOCUMENT_ROOT']."/ProyekManpro/services/database.php";

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $result = array(
        "status" => 1,
        "error" => ""
    );

    $id_target = $_POST['id_target'];

    $sql = "DELETE FROM target_penjualan WHERE id_target = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_target]);

    echo json_encode($result);
} else {
    header("HTTP/1.1 400 Bad Request");
    $error = array(
        'error' => 'Method not Allowed'
    );
    
    echo json_encode($error);
}