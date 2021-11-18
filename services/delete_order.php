<?php 

include "./database.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id_order = $_POST['id_order'];

    $sql = "DELETE FROM `order` WHERE `id_order` = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_order]);
}
?>