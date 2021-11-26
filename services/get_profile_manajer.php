<?php 

include $_SERVER['DOCUMENT_ROOT']."/ProyekManpro/services/database.php";


header("Content-Type: application/json");



if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $result = array(
        "nama" => "",
        "alamat" => "",
        "email" => "",
        "username" => "",
        "password" => "",
        "no_telp" => ""
    );

    $id_manajer = $_SESSION['id_manajer'];

    $sql = "SELECT * FROM manager
            WHERE id_manager=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_manajer]);
    $user = $stmt->fetch();

    $result["nama"] = $user['nama'];
    $result["alamat"] = $user['alamat'];
    $result["email"] = $user['email'];
    $result["username"] = $user['username'];
    $result["password"] = $user['password'];
    $result["no_telp"] = $user['no_telp'];
    
    echo json_encode($result);
} else {
    header("HTTP/1.1 400 Bad Request");
    $error = array(
        'error' => 'Method not Allowed'
    );

    echo json_encode($error);
}
?>