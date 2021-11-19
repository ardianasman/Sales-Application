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
        "target" => "",
        "status" => 1,
        "error" => ""
    );

    $id_sales = $_SESSION['id'];

    $sql = "SELECT s.nama,s.alamat,s.email, s.username, s.password, FORMAT(t.target, 'C') AS target_penjualan,t.bulan
    FROM sales s 
    JOIN target_penjualan t ON s.id_sales = t.id_sales
    WHERE s.id_sales = ? AND t.bulan = MONTH(DATE(NOW()))";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_sales]);
    $user = $stmt->fetch();
    $result["nama"] = $user['nama'];
    $result["alamat"] = $user['alamat'];
    $result["email"] = $user['email'];
    $result["username"] = $user['username'];
    $result["password"] = $user['password'];
    $result["target"] = $user['target_penjualan'];

    echo json_encode($result);
} else {
    header("HTTP/1.1 400 Bad Request");
    $error = array(
        'error' => 'Method not Allowed'
    );

    echo json_encode($error);
}
?>