<?php 

include $_SERVER['DOCUMENT_ROOT']."/ProyekManpro/services/database.php";

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $result = array(
        "status" => 1,
        "error" => ""
    );

    $np = $_POST['newpass'];
    $cp = $_POST['confpass'];
    $id_sales = $_SESSION['id'];

    if ($np == '' || $cp == '') {
        header("HTTP/1.1 400 Bad Request");
        $result['status'] = 0;
        $result['error'] = 'New Pass & Confirm Pass Must Have Value!';
    } else {

        if ($np != $cp) {
            header("HTTP/1.1 400 Bad Request");
            $result['status'] = 0;
            $result['error'] = 'New Pass & Confirm Pass Must Have Same Value!';
        } else{
            $sql = "UPDATE sales SET `password` = ? WHERE id_sales = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$np, $id_sales]);
        }
        
    }

    echo json_encode($result);
} else {
    header("HTTP/1.1 400 Bad Request");
    $error = array(
        'error' => 'Method not Allowed'
    );

    echo json_encode($error);
}