<?php 

include $_SERVER['DOCUMENT_ROOT']."/ProyekManpro/services/database.php";

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $result = array(
        "status" => 1,
        "error" => ""
    );

    $id_produk = $_POST['id_produk'];
    $nama_produk = $_POST['nama_produk'];
    $harga_produk = $_POST['harga_produk'];

    if ($nama_produk == '' || $harga_produk == '') {
        header("HTTP/1.1 400 Bad Request");
        $result['status'] = 0;
        $result['error'] = 'Data Harus Terisi Semua!';
    } else {
        $sql = "UPDATE produk 
        SET nama_produk = ?, harga_produk = ?
        WHERE id_produk = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nama_produk, $harga_produk, $id_produk]);
    }

    echo json_encode($result);
} else {
    header("HTTP/1.1 400 Bad Request");
    $error = array(
        'error' => 'Method not Allowed'
    );

    echo json_encode($error);
}