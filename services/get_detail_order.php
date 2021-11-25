<?php
    include "./database.php";
    header("Content-Type: application/json");


    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $id = $_SESSION['ids'];
        $sql = "SELECT m.kuantitas, m.mata_uang, m.diskon, m.pajak, n.nama_produk, n.harga_produk FROM `detail_order` m JOIN `produk` n ON m.id_produk = n.id_produk WHERE m.id_order = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);

        $result = array();
        while($row = $stmt->fetch()){
            array_push($result,$row);
        }
        echo json_encode($result);
    }
    else
    {
        header("HTTP/1.1 400 Bad Request");
        $error = array(
            'error' => 'Method not Allowed'
        );

        echo json_encode($error);
    }
?>