<?php
    include "./database.php";
    $connect = mysqli_connect("localhost", "root", "", "salesapp");
    $number = count($_POST["str"]);
    $id_order = $_POST["id_order"];
    $id_detail = $_POST["detailorder_id"];
    if ($_SERVER['REQUEST_METHOD'] == "POST" && $number > 1)
    {
        for ($i=1;$i<$number;$i++){
            if(trim(implode("", $_POST["str"][$i]) != '')){
                $temp = mysqli_real_escape_string($connect, implode("", $_POST["str"][$i]));
                $temp = str_replace("inp", "", $temp);
                //echo $temp;
                //echo "\n";
                if($temp != 0){
                    $sql = "INSERT INTO `detail_order` VALUES (?, ?, ?, ?, ?, ?, ?)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$id_detail, $id_order, $_POST["arr_id"][$i - 1], $temp, '', '', '']);
                    $count = $count + 1;
                }
            }
        }
    }
    else
    {
        header("HTTP/1.1 400 Bad Request");
        $error = array(
            'error' => 'Method not Allowed'
        );

        echo json_encode($error);
    }
?>