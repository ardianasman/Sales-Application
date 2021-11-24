<?php 

include $_SERVER['DOCUMENT_ROOT']."/ProyekManpro/services/database.php";

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $result = array(
        "status" => 1,
        "error" => "",
        'redirect' => ""
    );

    $plt = $_POST['posisi_lt'];
    $plg = $_POST['posisi_lg'];
    $simpanid = $_SESSION['id'];

    $sql_1 = "UPDATE sales SET track_lat = ?, track_lng = ? WHERE id_sales = ?";
    $test_2 = $pdo->prepare($sql_1);
    $test_2->execute([$plt,$plg,$simpanid]);

    echo json_encode($result);
} else {
    header("HTTP/1.1 400 Bad Request");
    $error = array(
        'error' => 'Method not Allowed'
    );

    echo json_encode($error);
}



?>