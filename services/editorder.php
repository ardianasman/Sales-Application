<?php
    include "./database.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $updatetglorder = $_POST['utglorder'];
        $updatetgltempo = $_POST['utgltempo'];
        $updatetotal = $_POST['utotal'];
        $updatestatus = $_POST['ustatus'];
        $id = $_POST['uid'];

        $update = "UPDATE `order` SET `tanggal_order` = ?, `tanggal_jatuh_tempo` = ?, `total_harga` = ?, `status_order` = ? WHERE `id_order` = ?";
        $update = $pdo->prepare($update);
        $update->execute([$updatetglorder,$updatetgltempo,$updatetotal,$updatestatus,$id]);
        header("Location: ../manage_order.php");
    }
?>