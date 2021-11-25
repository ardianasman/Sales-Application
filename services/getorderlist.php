<?php
    include "./database.php";
    header("Content-Type: application/json");
    $id = $_SESSION['id'];
    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $sql = "SELECT d.id_order, d.tanggal_order, d.total_harga, p.nama FROM `order` d JOIN `customer` p ON d.id_customer = p.id_customer WHERE d.id_sales = $id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

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