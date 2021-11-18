<?php
    include "./database.php";
    
    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $id_sales = $_SESSION['id'];
        $id_customer = $_POST['uidcust'];
        $nama_cust = $_POST['idnama'];
        $alamat_cust = $_POST['idalamat'];
        $no_cust = $_POST['idno'];


        $sql = "INSERT INTO `customer` VALUES(?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id_customer, $id_sales, $nama_cust, $alamat_cust, $no_cust, "0000-00-00"]);
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