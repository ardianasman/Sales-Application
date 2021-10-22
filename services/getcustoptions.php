<?php
    include "./database.php";
    header("Content-Type: application/json");
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $idsales = $_SESSION['id'];
        $sql = "SELECT * FROM `order` WHERE `id_sales` = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$idsales]);

        $result = array();
         while($row = $stmt->fetch()) {
            array_push($result, $row);
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