<?php 

include $_SERVER['DOCUMENT_ROOT']."/ProyekManpro/services/database.php";

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $result = array(
        "status" => 1,
        "error" => ""
    );

    $id_manajer = 1;
    $id_sales = $_POST['id_sales'];
    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];
    $target = $_POST['target'];
    $status = 0;

    if ($bulan == 'Pilih' || $tahun == '' || $target == '') {
        header("HTTP/1.1 400 Bad Request");
        $result['status'] = 0;
        $result['error'] = 'Data Harus Terisi Semua Kecuali Data Berhenti Kerja!';
    } else {
        $sql = "INSERT INTO target_penjualan (id_target, id_sales, id_manager, bulan, target, tahun, status)
                VALUES(NULL, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id_sales, $id_manajer, $bulan, $target, $tahun, $status]);
    }

    echo json_encode($result);
} else {
    header("HTTP/1.1 400 Bad Request");
    $error = array(
        'error' => 'Method not Allowed'
    );

    echo json_encode($error);
}