<?php
    include "./database.php";
    $connect = mysqli_connect("localhost", "root", "", "salesapp");
    
    $number = count($_POST["str"]);
    $total = 0;
    $harga = $_POST['arr_harga'];
    for ($i=1;$i<$number;$i++){
        if(trim(implode("", $_POST["str"][$i]) != '')){
            $temp = mysqli_real_escape_string($connect, implode("", $_POST["str"][$i]));
            $temp = str_replace("inp", "", $temp);
            // echo $temp;
            // echo "\n";
            $total = $total + ($harga[$i-1] * $temp);
        }
    }
    echo $total;
?>