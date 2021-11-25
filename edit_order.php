<?php
    include "./services/database.php";
    if(!isset($_SESSION['id'])){
        header("Location: login.php");
    }
    $id = $_SESSION['id'];
    if(isset($_GET['ids']))
    {
        $id_order = $_GET['ids'];
        $sql = "SELECT m.id_order, m.id_sales, m.id_customer, m.tanggal_order, m.tanggal_jatuh_tempo, m.total_harga, m.status_order, n.nama FROM `order` m JOIN `customer` n ON m.id_customer = n.id_customer WHERE `id_order` = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id_order]);

        $stmtx = $pdo->prepare($sql);
        $stmtx->execute([$id_order]);

        $sqlsales = "SELECT * FROM `sales` WHERE `id_sales` = $id";
        $stmtsales = $pdo->prepare($sqlsales);
        $stmtsales->execute();
    }
?>
<!doctype html>
<html lang="en">

<head>
    <title>Edit Order</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
        <script src="https://use.fontawesome.com/504410ced2.js"></script>
         <!-- CSS -->
         <link rel="stylesheet" type="text/css" href="css/navbar.css"> 

        <!-- CSS Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


        <!--<script>
             function toggle(){
                $.ajax({
                    url: "./services/getstatus.php",
                    method: "POST",
                    data: {
                        id_order: $id_order
                    },
                    success: function(res){
                        console.log(res['status_order']);
                    }
                    $('#ustat').prop('readonly', true);
                }) masih error
            } 
        </script>-->

        <script>
            function deleteP(){
                <?php $itemx = $stmtx->fetch();?>
                var id_order = "<?php echo $itemx['id_order']; ?>"
                console.log(id_order);
                $.ajax({
                    url: "./services/deletedetailorder.php",
                    method: "POST",
                    data: {
                        id_order : id_order
                    },
                    success: function(data){

                    },
                    error: function(){
                        alert('failxxx');
                    }
                });
                $.ajax({
                    url: "./services/delete_order.php",
                    method: "POST",
                    data: {
                        id_order : id_order
                    },
                    success: function(data){

                    },
                    error: function(){
                        alert('failxxx');
                    }
                });
                window.history.go(-1);
            }
        </script>
        <style>
        .btn{
            height: 50px;
            width: 150px;
        }
        .transparent{
            margin: 15px;
        }
        </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <a class="judul" href="#">Prototype Sales</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown"><a class="nav-link" id="navbarDropdownMenuLink"aria-haspopup="true" aria-expanded="false">Activity</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="show_activity.php">Sales Activity</a>
                        <a class="dropdown-item" href="add_rencanakungjungan.php">Visit Plan</a>
                        <a class="dropdown-item" href="lihat_status_kunjungan.php">Plan Status</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ListCustomer.php">Customer <span class="sr-only"></span></a>
                </li>
                <li class="nav-item order">
                    <a class="nav-link" href="manage_order.php">Order <span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profile_sales.php">Profile <span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout <span class="sr-only"></span></a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="transparent">
                <?php
                    if($stmt->rowCount() == 1)
                    {
                        $item = $stmt->fetch();
                        $itemsales = $stmtsales->fetch();?>
                        <form action = "./services/editorder.php" method="POST">
                            <div id="item-list" class="item-list" style="width: 100%;">
                                <div class="row">
                                    <div class="col">
                                        <label>ID Order : </label>
                                        <input class="form-control" id="uid" name="uid" style="text-align:center" value="<?php echo $item['id_order']; ?>" readonly>
                                    </div>
                                    <div class="col"> 
                                        <label>ID Sales : </label>
                                        <input class="form-control" id="idsales" name="idsales" style="text-align:center" value="<?php echo $item['id_sales']; echo " - "; echo $itemsales['nama']; ?>" readonly>
                                    </div>  
                                    <div class="col"> 
                                        <label>ID Customer : </label>
                                        <input class="form-control" id="idcust" name="idcust" style="text-align:center" value="<?php echo $item['id_customer']; echo " - "; echo $item['nama'] ?>" readonly>
                                    </div>     
                                </div>
                                <div class="row">         
                                    <div class="col">
                                        <label>Tanggal Order : </label>
                                        <input type="date" class="form-control" id="utglorder" name="utglorder" value="<?php echo $item['tanggal_order']; ?>">
                                    </div>           
                                    <div class="col">
                                        <label>Tanggal Jatuh Tempo : </label>
                                        <input type="date" class="form-control" id="utgljatuhtempo" name="utgltempo" value="<?php echo $item['tanggal_jatuh_tempo']; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Total Harga : </label>
                                    <input class="form-control w-25" name="utotal" value="<?php echo number_format($item['total_harga'],0,'','.') ;?>" readonly>
                                </div> 
                                <div class="form-group">
                                    <label>Status Order : </label>
                                    <input class="form-control w-25" id="ustat" name="ustatus" value="<?php echo $item['status_order']; ?>">
                                </div>
                                <div class="d-flex justify-content-between">
                                    <button class="btn btn-outline-secondary p-2" onclick="window.history.go(-1)">Back</button>
                                    <button class="btn btn-warning p-2">Edit</button>
                                    <button class="btn btn-danger p-2" onclick="deleteP()">Delete</button>
                                </div>
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