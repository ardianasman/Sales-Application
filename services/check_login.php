<?php 

include $_SERVER['DOCUMENT_ROOT']."/ProyekManpro/services/database.php";

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $result = array(
        "status" => 1,
        "error" => "",
        'redirect' => ""
    );

    $username = $_POST['username'];
    $password = $_POST['password'];
    $plt = $_POST['posisi_lt'];
    $plg = $_POST['posisi_lg'];

    if ($username == '' || $password == '') {
        header("HTTP/1.1 400 Bad Request");
        $result['status'] = 0;
        $result['error'] = 'username & Password Must Have Value!';
    } else {
        $sql = "SELECT * FROM `sales` where username = ? and password = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username, $password]);

        $row_count = $stmt->rowCount();

        if ($row_count >= 1) {
            $result['redirect'] = '/ProyekManpro/index.php';
            $user = $stmt->fetch();
            //session_start();
            $_SESSION['id'] = $user['id_sales'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['email'] = $user['email'];
            $simpanid = $user['id_sales'];

            $sql_1 = "UPDATE sales SET track_lat = ?, track_lng = ? WHERE id_sales = ?";
            $test_2 = $pdo->prepare($sql_1);
            $test_2->execute([$plt,$plg,$simpanid]);
        } else {
            header("HTTP/1.1 400 Bad Request");
            $result['status'] = 0;
            $result['error'] = 'Wrong Username or Password';
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



?>