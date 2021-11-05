<?php 
include $_SERVER['DOCUMENT_ROOT']."/ProyekManpro/services/database.php";
    if(isset($_POST['id_'])){
        $_SESSION["id_"]=$_POST['id_'];
    }
    else {
        echo "fail";
    }
    
?>