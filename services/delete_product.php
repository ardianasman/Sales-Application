<?php 

include $_SERVER['DOCUMENT_ROOT']."/ProyekManpro/services/database.php";

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $result = array(
        "status" => 1,
        "error" => ""
    );

    $id_produk = $_POST['id_produk'];

    $sql = "DELETE FROM produk WHERE id_produk = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_produk]);

    echo json_encode($result);
} else {
    header("HTTP/1.1 400 Bad Request");
    $error = array(
        'error' => 'Method not Allowed'
    );
    
    echo json_encode($error);
}