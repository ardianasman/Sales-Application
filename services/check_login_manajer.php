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

    if ($username == '' || $password == '') {
        header("HTTP/1.1 400 Bad Request");
        $result['status'] = 0;
        $result['error'] = 'username & Password Must Have Value!';
    } else {
        $sql = "SELECT * FROM `manager` where username = ? and password = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username, $password]);

        $row_count = $stmt->rowCount();

        if ($row_count >= 1) {
            $result['redirect'] = '/ProyekManpro/Profile_Manajer.php';
            $user = $stmt->fetch();
            //session_start();
            $_SESSION['id'] = $user['id_manager'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['email'] = $user['email'];
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