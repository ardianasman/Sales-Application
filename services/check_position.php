<?php 

include $_SERVER['DOCUMENT_ROOT']."/ProyekManpro/services/database.php";

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    date_default_timezone_set('Asia/Jakarta');

    $tanggal = date('Y-m-d h:i:sa');

    $result = array(
        "status" => 1,
        "error" => "",
        'redirect' => ""
    );

    $plt = $_POST['posisi_lt'];
    $plg = $_POST['posisi_lg'];
    $simpanid = $_SESSION['id'];

    $sql_1 = "UPDATE sales SET track_lat = ?, track_lng = ?, track_time = ? WHERE id_sales = ?";
    $test_2 = $pdo->prepare($sql_1);
    $test_2->execute([$plt,$plg,$tanggal,$simpanid]);

    echo json_encode($result);
} else {
    header("HTTP/1.1 400 Bad Request");
    $error = array(
        'error' => 'Method not Allowed'
    );

    echo json_encode($error);
}



?>