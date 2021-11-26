<?php 

include $_SERVER['DOCUMENT_ROOT']."/ProyekManpro/services/database.php";

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $result = array(
        "status" => 1,
        "error" => ""
    );

    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $no_telp = $_POST['no_telp'];
    $id_manager = $_SESSION['id_manajer'];

    if ($nama == '' || $email == '' || $alamat == '' || $no_telp == '') {
        header("HTTP/1.1 400 Bad Request");
        $result['status'] = 0;
        $result['error'] = 'Data harus terisi semua!';
    } else {
        $sql = "UPDATE manager SET nama = ?, email = ?, alamat = ?, no_telp = ? WHERE id_manager = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nama, $email, $alamat, $no_telp, $id_manager]);
    }

    echo json_encode($result);
} else {
    header("HTTP/1.1 400 Bad Request");
    $error = array(
        'error' => 'Method not Allowed'
    );

    echo json_encode($error);
}