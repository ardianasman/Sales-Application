<?php
    include "./database.php";
    header("Content-Type: application/json");


    $idorder = $_POST["idorderget"];
    $total = $_POST["total"];
    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $sql = "UPDATE `order` SET total_harga = ? WHERE id_order = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$total, $idorder]);

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