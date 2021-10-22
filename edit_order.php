<?php
    include "./services/database.php";
    if(!isset($_SESSION['id'])){
        header("Location: login.php");
    }
    $id = $_SESSION['id'];
    if(isset($_GET['ids']))
    {
        $id_order = $_GET['ids'];
        $sql = "SELECT * FROM `order` WHERE `id_order` = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id_order]);
    }
?>
<!doctype html>
<html lang="en">

<head>
    <title>Add Order</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
        <script src="https://use.fontawesome.com/504410ced2.js"></script>
        <!--<link rel="stylesheet" href="css\managerorder.css"> -->

        <script>
            
        </script>
</head>

<body onload>
    <div class="transparent">
                <?php
                    if($stmt->rowCount() == 1)
                    {
                        $item = $stmt->fetch();?>
                        <form action = "../services/editorder.php" method="POST">
                            <div id="item-list" class="item-list" style="text-align:center; width: 100%;">
                                <div class="form-group">
                                    <label>ID Order : </label>
                                    <input class="form-control" name="idorder" value="<?php echo $item['id_order']; ?>">
                                </div>
                                <div class="form-group"> 
                                    <label>ID Sales : </label>
                                    <input class="form-control" id="idsales" name="idsales" value="<?php echo $item['id_sales']; ?>">
                                </div>  
                                <div class="form-group"> 
                                    <label>ID Customer : </label>
                                    <input class="form-control" id="idcust" name="idcust" value="<?php echo $item['id_customer']; ?>">
                                </div>              
                                <div class="form-group">
                                    <label>Tanggal Order : </label>
                                    <input type="date" class="form-control" id="tglorder" name="tglorder" value="<?php echo $item['tanggal_order']; ?>">
                                </div>           
                                <div class="form-group">
                                    <label>Tanggal Jatuh Tempo : </label>
                                    <input type="date" class="form-control" id="tgljatuh" name="tgljatuh" value="<?php echo $item['tanggal_jatuh_tempo']; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Total Harga : </label>
                                    <input class="form-control" name="totalharga" value="<?php echo $item['total_harga']; ?>">
                                </div>
                                <div class="form-group">
                                    <label>Status Order : </label>
                                    <input class="form-control" name="status" value="<?php echo $item['status_order']; ?>">
                                </div>
                                <button class="btn btn-warning">Edit Product</button>
                            </div>
                        </form>
                <?php }
                    else
                    {?>
                        <div id="item-list" class="item-list">
                            Item Unavailable
                        </div>
                    <?php } ?>
    </div>
</body>
</html>