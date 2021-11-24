<?php
    include "./database.php";
    header("Content-Type: application/json");

    $idorder = $_POST["idorderget"];
    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $sql = "SELECT d.id_order, q.id_produk, q.kuantitas, w.harga_produk, q.diskon FROM `order` d
        JOIN `sales` p ON d.id_sales = p.id_sales
        JOIN `detail_order` q ON d.id_order = q.id_order
        JOIN `produk` w ON q.id_produk = w.id_produk
        WHERE d.id_order = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$idorder]);

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