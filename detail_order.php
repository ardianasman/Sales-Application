<?php
    include "./services/database.php";
    if(!isset($_SESSION['id'])){
        header("Location: login.php");
    }
    $id = $_SESSION['id'];
    $_SESSION['ids'] = $_GET['ids'];
?>
<!doctype html>
<html lang="en">

<head>
    <title>Detail Order</title>
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


        <script>
            function getDetail()
            {
                $.ajax({
                    url: "./services/get_detail_order.php",
                    method: "POST",
                    success: function(res){
                        $('#detail-list').html('');
                        var table = $("<table id='data_table' class='table'></table>");
                        var title = $("<thead><tr style=text-align:center;><td><b>Product</b></td><td><b>Harga</b></td><td><b>Kuantitas</b></td><td><b>Mata Uang</b></td><td><b>Diskon</b></td><td><b>Pajak</b></td><td><b> </b></td></tr></thead>");
                        table.append(title);
                        res.forEach(function(item){
                            var html = $(`
                                <tr class="centertd">
                                <td style=text-align:center;>` + item['nama_produk'] + `</td>
                                <td style=text-align:center;>` + item['harga_produk'].toLocaleString() + `</td>
                                <td style=text-align:center;>`+ item['kuantitas'] +`</td>
                                <td style=text-align:center;>`+ item['mata_uang'] +`</td>
                                <td style=text-align:center;>`+ item['diskon'] +`</td>
                                <td style=text-align:center;>`+ item['pajak'] +`</td>
                                </tr>
                            `);
                            table.append(html);
                        });
                        $("#detail-list").append(table);
                    },
                    error: function(){
                        alert('fail');
                    }
                });
            }
        </script>
        <style>
            .btn{
                height: 50px;
                width: 150px;
            }
            .transparent{
                margin: 15px;
                text-align: center;
            }
        </style>
</head>

<body onload="getDetail()">
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
                <li class="nav-item active">
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
            <div id="detail-list" class="transparent"> </div>
                <button class="btn btn-outline-secondary" onclick="window.history.go(-1)">Back</button>
        </div>
    </div>  
</body>
</html>