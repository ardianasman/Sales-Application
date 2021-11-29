<?php
    include "./services/database.php";
    if(!isset($_SESSION['id'])){
        header("Location: login.php");
    }
    $id = $_SESSION['id'];
    $sql = "SELECT `nama` FROM `sales` WHERE `id_sales` = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    if(isset($_GET['ids']))
    {
        $id_order = $_GET['ids'];
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
        <link rel="stylesheet" href="css\managerorder.css">
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="css/navbar.css"> 

        <!-- CSS Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        
        <style>
            .centertd{
                text-align: center;
            }
        </style>

        <script>
            function getCustId(){
                $.ajax({
                    url: "./services/getcustid.php",
                    method: "POST",
                    success: function(res){
                        $("#data-list").html('');
                        var opt = $("<select style='height:40px; width: 555px;text-align: center' required></select>");
                        var data = [];
                        res.forEach(function(item){
                            var html = $(`
                                <option>`+ item['id_customer'] + " - " + item['nama'] +`</option>
                            `);
                            opt.append(html);
                        });
                        $("#data-list").append(opt);
                    },
                    error: function(){
                        alert('fail');
                    }
                });
            }
            function addorder(){
                var id_order = "<?php echo $_GET['ids'];?>"
                sessionStorage.setItem("idorder", id_order);
                var id_customer = $("#data-list").find(":selected").text();
                sessionStorage.setItem("idcust", id_customer);
                //
                var matauang = $("#iduang").val();
                sessionStorage.setItem("iduang", matauang);
                var pajak = $("#idpajak").val();
                sessionStorage.setItem("idpajak", pajak);
                var diskon = $("#iddiskon").val();
                diskon = diskon.substring(0,2);
                sessionStorage.setItem("iddiskon", diskon);
                //
                
                var date = new Date($("#idtglorder").val());
                var day = date.getDate();
                var month = date.getMonth() + 1;
                var year = date.getFullYear();
                var tanggal_order = [year, month, day].join('-');

                var date1 = new Date($("#idtempo").val());
                var day1 = date1.getDate();
                var month1 = date1.getMonth() + 1;
                var year1 = date1.getFullYear();
                var tanggal_jatuh_tempo = [year1, month1, day1].join('-');

                $.ajax({
                    url:"./services/addorder.php",
                    method: "POST",
                    data: {
                        id_order : id_order,
                        id_customer : id_customer,
                        tanggal_order : tanggal_order,
                        tanggal_jatuh_tempo : tanggal_jatuh_tempo
                    },
                    success: function(data){
                        
                    },
                    error: function(){
                        alert('fail');
                    }
                });
                window.location.replace("add_orderdetail.php?ids=" + id_order);
            }
            function init(){
                getCustId();
            }
        </script>
</head>
<style>
    #btn-add{
        width: 30%;
        margin-right: 35%;
        margin-left: 35%; 
    }
    .w-50{
        margin-bottom:10px;
    }
    .navbar{
        margin-bottom:20px;
    }
</style>

<body onload="init()">
    <nav class="navbar navbar-expand-lg navbar-dark ">
        <a class="judul" href="#">Prototype Sales</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ml-auto">
                <ul>
                    <li><a class="nav-item nav-link " href="index.php">Home <span class="sr-only">(current)</span></a></li>
                    <li class="nav-item dropdown"><a class="nav-link" id="navbarDropdownMenuLink"aria-haspopup="true" aria-expanded="false">Activity</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="show_activity.php">Sales Activity</a>
                            <a class="dropdown-item" href="add_rencanakungjungan.php">Visit Plan</a>
                            <a class="dropdown-item" href="lihat_status_kunjungan.php">Plan Status</a>
                        </div>
                    </li>
                    <li><a class="nav-item nav-link" href="ListCustomer.php">Customer</a></li>
                    <li><a class="nav-item nav-link active" href="manage_order.php">Order</a></li>
                    <li><a class="nav-item nav-link" href="profile_sales.php">Profile</a></li>
                    <li><a class="nav-item nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="transparent">
            <h4 style="text-align: center; margin-bottom: 25px;"><b>Add Order</b></h4>
                <form method="POST" action="./services/addorder.php" enctype="multipart/form-data">
                    <div class="form-content">  
                        <div class="form-group">
                                <div class="w-50" style="margin-left: auto; margin-right: auto">
                                    <label for="idorder"><b">ID Order</b></label>
                                    <input type="text" class="form-control" style="text-align:center" name="idorder" id="idorder" value="<?php echo $id_order; ?>" readonly>
                                </div>
                                <div class="w-50" style="margin-left: auto; margin-right: auto">
                                    <label for="idsales"><b">ID Sales</b></label>
                                    <input type="text" class="form-control" style="text-align:center" name="idsales" id="idsales" value="<?php echo $id; ?>" readonly>
                                </div>
                                <?php $item = $stmt->fetch()?>
                                <div class="w-50" style="margin-left: auto; margin-right: auto">
                                    <label for="namasales"><b">Nama Sales</b></label>
                                    <input type="text" class="form-control" style="text-align:center" name="idnamasales" id="idnamasales" value="<?php echo $item['nama']; ?>" readonly>
                                </div>
                                <div class="w-50" style="margin-left: auto; margin-right: auto">
                                    <label for="idorder"><b">ID Customer</b></label>
                                        <div id="data-list"> </div>
                                </div>
                                <div class="w-50" style="margin-left: auto; margin-right: auto">
                                    <label for="idtglorder"><b">Tanggal Order</b></label>
                                    <input type="date" class="form-control" style="text-align:center" name="idtglorder" id="idtglorder" value="<?php echo date('Y-m-d'); ?>">
                                </div>
                                <div class="w-50" style="margin-left: auto; margin-right: auto">
                                    <label for="idtempo"><b">Tanggal Jatuh Tempo</b></label>
                                    <input type="date" class="form-control" style="text-align:center" name="idtempo" id="idtempo" value="<?php echo date('Y-m-d', strtotime('+30 days')); ?>">
                                </div>
                                <div class="w-50" style="margin-left: auto; margin-right: auto">
                                    <label for="diskon"><b">Diskon</b></label>
                                    <input type="number" class="form-control" style="text-align:center" name="iddiskon" id="iddiskon" min="" max="99" placeholder="Dalam %">
                                </div>
                                <div class="w-50" style="margin-left: auto; margin-right: auto">
                                    <label for="pajak"><b">Pajak</b></label>
                                    <input type="text" class="form-control" style="text-align:center" name="idpajak" id="idpajak" value="10%" readonly>
                                </div>
                        </div>
                    </div>
                </form>
                <button class= "btn btn-primary" id="btn-add" onclick="addorder()">Add</button>
                    
        </div>
    </div>
</body>
</html>