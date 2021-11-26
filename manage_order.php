<?php
    include "./services/database.php";
    if(!isset($_SESSION['id'])){
        header("Location: login.php");
    }
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM `order` ORDER BY id_order DESC LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
?>
<!doctype html>
<html lang="en">

<head>
        <title>Manage Order</title>
    <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
        <script src="https://use.fontawesome.com/504410ced2.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css\managerorder.css">
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">

        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="css/navbar.css"> 

        <!-- CSS Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


    <style>
        .centertd{
            text-align: center;
        }
        th {
            text-align: center;
        }
        button{
            margin-bottom: 15px;
        }
    </style>

    
           
    <script>
        function getItem()
        {
            $.ajax({
                url:"./services/getorderlist.php",
                method: "POST",
                success: function(res){
                    $("#order-list").html('');
                    
                    var count = 1;
                    res.forEach(function(item){
                            var row = $("<tr></tr>");
                            var col1 = $("<td style='text-align:center;'>" + count + "</td>");
                            var col2 = $("<td style='text-align:center;'>" + item['id_order'] + "</td>");
                            var col3 = $("<td style='text-align:center;'>" + item['nama'] + "</td>");
                            var col4 = $("<td style='text-align:center;'>" + item['tanggal_order'] + "</td>");
                            var idorderget = item['id_order'];
                            col1.appendTo(row);
                            col2.appendTo(row);
                            col3.appendTo(row);
                            col4.appendTo(row);
                            
                            $.ajax({
                                url: "./services/gettotal.php",
                                method: "POST",
                                data: {
                                    idorderget : idorderget
                                },
                                async: false,
                                success : function(res){
                                    var total = 0;
                                    var col5 = $("<td>" + total + "</td>");
                                    var disc = 1;
                                    res.forEach(function(data){
                                        var subtotal = data['kuantitas'] * data['harga_produk'];
                                        disc = data['diskon'];
                                        total = total + subtotal;
                                    });
                                    total = total - (total * disc / 100);
                                    //console.log(total);
                                    $.ajax({
                                        url: "./services/updatetotal.php",
                                        method: "POST",
                                        data: {
                                            idorderget : idorderget,
                                            total : total
                                        },
                                        async: false,
                                        success: function(res){

                                        }
                                    });
                                    col5 = $("<td style='text-align:center;'>" + total.toLocaleString() + "</td>");
                                    var btn = $('<td scope="col"></td>');
                                    var edit = $('<a href="./edit_order.php?ids='+ item['id_order'] +'" class="btn btn-primary" style="margin-left: 25px;">Edit</a>');
                                    var detail = $('<a href="./detail_order.php?ids='+ item['id_order'] +'" class="btn btn-primary" style="margin-left: 55px;">Detail</a>');

                                    col5.appendTo(row);
                                    edit.appendTo(btn);
                                    detail.appendTo(btn);
                                    btn.appendTo(row);
                                }
                            });
                            count++;
                            $("#order-list").append(row);
                    });
                    $("#tableImage").DataTable();
                },
                error: function(){
                    alert('fail');
                }
            });
        }
    </script>
</head>

<body onload="getItem()">
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
                <li class="nav-item active dropdown"><a class="nav-link" id="navbarDropdownMenuLink"aria-haspopup="true" aria-expanded="false">Activity</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="show_activity.php">Sales Activity</a>
                        <a class="dropdown-item" href="add_rencanakungjungan.php">Visit Plan</a>
                        <a class="dropdown-item" href="lihat_status_kunjungan.php">Plan Status</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ListCustomer.php">Customer <span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
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
    <div class="container">
        <div class="transparent">
            <?php
                $item = $stmt->fetch()?>
                <button class="btn btn-success" style="float: right; margin-right: 15px; margin-top: 15px;" onclick="location.href = `./add_order.php?ids=`+ <?php if($stmt->rowCount() == 0){$tot = 1;} else{$tot = $item['id_order'] + 1;} echo $tot; ?>">Add Order</button>
                <!-- <div id="order-list" class="transparent"> </div>-->

                <div>
                    <form>
                        <table id="tableImage" class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%" data-sortable="true">#</th>
                                    <th width="15%" data-sortable="true">Order ID</th>
                                    <th width="25%" data-sortable="true">Customer Name</th>
                                    <th width="25%" data-sortable="true">Tanggal Order</th>
                                    <th wdith="15%" data-sortable="true">Total</th>
                                    <th wdith="15%" data-sortable="true">Attributes</th>
                                </tr>
                            </thead>
                            <tbody id="order-list">
                                    
                            </tbody>
                        </table>
                    </form>
                </div>
        </div>
    </div>
</body>

</html>