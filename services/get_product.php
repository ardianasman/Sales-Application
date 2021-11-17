<?php 

include $_SERVER['DOCUMENT_ROOT']."/ProyekManpro/services/database.php";

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $sql = "SELECT id_produk, id_manager, nama_produk, FORMAT(harga_produk,'C') as harga_produk, harga_produk as har FROM `produk`
            WHERE id_manager=?";

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