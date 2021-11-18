<?php
    include "./database.php";
    header("Content-Type: application/json");
    if ($_SERVER['REQUEST_METHOD'] == "GET")
    {
        $sql = "SELECT *, FORMAT(SUM(total_harga),'C') as total FROM `order`
        WHERE status_order=1 AND MONTH(tanggal_jatuh_tempo)=MONTH(CURRENT_DATE) AND YEAR(tanggal_jatuh_tempo)=YEAR(CURRENT_DATE)
        GROUP BY id_sales";
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