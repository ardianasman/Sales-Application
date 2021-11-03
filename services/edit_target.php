<?php 

include $_SERVER['DOCUMENT_ROOT']."/ProyekManpro/services/database.php";

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $result = array(
        "status" => 1,
        "error" => ""
    );

    $id_target = $_POST['id_target'];
    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];
    $target = $_POST['target'];
    $status = $_POST['status'];

    if ($bulan == 'Pilih' || $tahun == '' || $target == '' || $status == 'Pilih') {
        header("HTTP/1.1 400 Bad Request");
        $result['status'] = 0;
        $result['error'] = 'Data Harus Terisi Semua Kecuali Data Berhenti Kerja!';
    } else {
        $sql = "UPDATE target_penjualan 
        SET bulan = ?, tahun = ?, target = ?, status = ?
        WHERE id_target = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$bulan, $tahun, $target, $status, $id_target]);
    }

    echo json_encode($result);
} else {
    header("HTTP/1.1 400 Bad Request");
    $error = array(
        'error' => 'Method not Allowed'
    );

    echo json_encode($error);
}