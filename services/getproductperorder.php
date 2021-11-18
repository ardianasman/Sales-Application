<?php 

    include "./database.php";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_order = $_POST['id_order'];
        
        $sql = "SELECT d.id_produk, p.nama_produk, d.kuantitas, p.harga_produk FROM detail_order d JOIN produk p ON d.id_produk = p.id_produk WHERE d.id_order = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id_order]);
        
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