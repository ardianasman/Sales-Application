<?php
    include "./database.php";
    if($_SERVER['REQUEST_METHOD'] == "POST"){

        $id_customer = $_POST['id_customer'];
        $id_manager = $_POST['id_manager'];
        $id_aktivitas = $_POST['id_aktivitas'];
        $tanggal_kunjungan = $_POST['jadwal_kunjungan'];

        $sql = "INSERT INTO `aktivitas_sales` VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id_aktivitas, $_SESSION['id'], $id_manager, $id_customer, '', $tanggal_kunjungan, '', '', '']);
    }

?>