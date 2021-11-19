<?php
    include "./database.php";
    header("Content-Type: application/json");
    if ($_SERVER['REQUEST_METHOD'] == "GET")
    {
        $bulan=$_GET['bulan'];
        $tahun=$_GET['tahun'];
        $id_sales=$_GET['id_sales'];
        $sql = "SELECT *, FORMAT(SUM(total_harga),'C') as total FROM `order`
        WHERE status_order=1 AND MONTH(tanggal_order)=$bulan AND YEAR(tanggal_order)=$tahun
        AND id_sales=$id_sales";
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