<?php 

include $_SERVER['DOCUMENT_ROOT']."/ProyekManpro/services/database.php";

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $result = array(
        "status" => 1,
        "error" => ""
    );

    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $no_telp = $_POST['no_telp'];
    $email = $_POST['email'];
    $tanggal_mulai_kerja = $_POST['tanggal_mulai_kerja'];
    $tanggal_berhenti_kerja = $_POST['tanggal_berhenti_kerja'];
    

    if ($nama == '' || $alamat == '' || $no_telp == '' || $email == '' || $tanggal_mulai_kerja == '') {
        header("HTTP/1.1 400 Bad Request");
        $result['status'] = 0;
        $result['error'] = 'Data Harus Terisi Semua Kecuali Data Berhenti Kerja!';
    } else {
        $sql = "INSERT INTO sales (id_sales, id_manager, nama, alamat, no_telp, email, tanggal_mulai_kerja, tanggal_berhenti_kerja)
                VALUES(NULL, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_SESSION['id'], $nama, $alamat, $no_telp, $email, $tanggal_mulai_kerja, $tanggal_berhenti_kerja]);
    }

    echo json_encode($result);
} else {
    header("HTTP/1.1 400 Bad Request");
    $error = array(
        'error' => 'Method not Allowed'
    );

    echo json_encode($error);
}