<?php
    include "./database.php";
    
    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $id_order = $_POST['id_order'];
        $id_customer = $_POST['id_customer'];
        $tanggal_order = $_POST['tanggal_order'];
        $tanggal_jatuh_tempo = $_POST['tanggal_jatuh_tempo'];


        $sql = "INSERT INTO `order` VALUES(?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id_order, $_SESSION['id'], $id_customer, $tanggal_order, $tanggal_jatuh_tempo, $id_order, $id_order]);
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