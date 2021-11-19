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
        "totalpenj" => "",
        "status" => 1,
        "error" => ""
    );

    $id_sales = $_SESSION['id'];

    $sql = "SELECT s.nama,s.alamat,s.email, s.username, s.password
    FROM sales s WHERE s.id_sales = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_sales]);
    $user = $stmt->fetch();

    $result["nama"] = $user['nama'];
    $result["alamat"] = $user['alamat'];
    $result["email"] = $user['email'];
    $result["username"] = $user['username'];
    $result["password"] = $user['password'];
    //$result["target"] = 0;

    $sql2 = "SELECT FORMAT(t.target, 'C') AS target_penjualan,t.bulan
    FROM sales s 
    JOIN target_penjualan t ON s.id_sales = t.id_sales
    WHERE s.id_sales = ? AND t.bulan = MONTH(DATE(NOW()))";
    $stmt2 = $pdo->prepare($sql2);
    $stmt2->execute([$id_sales]);
    

    if ($user2 = $stmt2->fetch()){
        $result["target"] = $user2['target_penjualan'];
    }else{
        $result["target"] = "(Belum Ada Target Bulan ini)";
    }

    $sql3 = "SELECT FORMAT(SUM(total_harga),'C') as total FROM `order`
    WHERE status_order=1 AND MONTH(tanggal_jatuh_tempo)=MONTH(CURRENT_DATE) AND YEAR(tanggal_jatuh_tempo)=YEAR(CURRENT_DATE) AND id_sales = ?";
    $stmt3 = $pdo->prepare($sql3);
    $stmt3->execute([$id_sales]);

    $user3 = $stmt3->fetch();
    $result["totalpenj"] = $user3['total'];

    // if (is_null($user3)) {
    //     $result["totalpenj"] = "(Belum Ada Penjualan bulan ini)";
    // }else{
    //     $result["totalpenj"] = $user3['total'];
    // }

    
    

    echo json_encode($result);
} else {
    header("HTTP/1.1 400 Bad Request");
    $error = array(
        'error' => 'Method not Allowed'
    );

    echo json_encode($error);
}
?>