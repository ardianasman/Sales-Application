<?php 

include $_SERVER['DOCUMENT_ROOT']."/ProyekManpro/services/database.php";

header("Content-Type: application/json");



if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $result = array(
        "status" => 1,
        "error" => ""
    );

    date_default_timezone_set('Asia/Jakarta');

    $tanggal = date('Y/m/d H:i:s');
    $conf_id = $_POST['confirm-id-pembelian'];
    $lokasi = $_POST['lokasi'];
    $visited="";
    $radioVal = $_POST["flexRadioDefault"];

    if($radioVal == "first")
    {
        $visited=1;
    }
    else if ($radioVal == "second")
    {
        $visited=0;
    }

    if ($conf_id == ''|| $lokasi == '') {
        
        header("HTTP/1.1 400 Bad Request");
        $result['status'] = 0;
        $result['error'] = 'Tanggal & Id Pembelian & Lokasi Must Have Value!';
        
    } else {
       

        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            //echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
        //echo "Sorry, file already exists.";
        $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $sql = "UPDATE aktivitas_sales SET jadwal_kunjungan= ?, status_kunjungan= ?, lokasi = ? ,foto_kunjungan= ? WHERE id_order=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$tanggal,$visited,$lokasi,$target_file,$conf_id]);
            
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
        }

    }

    echo json_encode($result);
    header("Location:show_activity.php");
} else {
    header("HTTP/1.1 400 Bad Request");
    $error = array(
        'error' => 'Method not Allowed'
    );

    echo json_encode($error);
}
?>