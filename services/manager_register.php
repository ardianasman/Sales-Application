<?php 

include $_SERVER['DOCUMENT_ROOT']."/ProyekManpro/services/database.php";

header("Content-Type: application/json");



if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $result = array(
        "status" => 1,
        "error" => "",
        'redirect' => ""
    );

    date_default_timezone_set('Asia/Jakarta');

    $tanggal = date('Y/m/d');

    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $hp = $_POST['hp'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $re_pass = $_POST['re_pass'];
    

    if ($nama == '' || $email == '' || $address == '' || $hp == '' || $username == '' || $password == '') {
        header("HTTP/1.1 400 Bad Request");
        $result['status'] = 0;
        $result['error'] = 'All Data Must Have Value!';
    }
    if($password != $re_pass){
        header("HTTP/1.1 400 Bad Request");
        $result['status'] = 0;
        $result['error'] = 'Make Sure Your Password and Confirmation Password are the same!';
    }
    else {
        $sql = "INSERT INTO manager(id_manager,nama,alamat,no_telp,username,email,password,tanggal_mulai_kerja)
        VALUES(NULL, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nama,$address,$hp,$username,$email,$password,$tanggal]);
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