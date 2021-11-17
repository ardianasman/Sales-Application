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
    <title>Add Order</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
        <script src="https://use.fontawesome.com/504410ced2.js"></script>


        <script>
            function getDetail()
            {
                $.ajax({
                    url: "./services/get_detail_order.php",
                    method: "POST",
                    success: function(res){
                        $('#detail-list').html('');
                        var table = $("<table id='data_table' class='table'></table>");
                        var title = $("<thead><tr style=text-align:center;><td><b>Product ID</b></td><td><b>Kuantitas</b></td><td><b>Mata Uang</b></td><td><b>Diskon</b></td><td><b>Pajak</b></td><td><b> </b></td></tr></thead>");
                        table.append(title);
                        res.forEach(function(item){
                            var html = $(`
                                <tr class="centertd">
                                <td style=text-align:center;>` + item['id_produk'] + `</td>
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
</head>

<body onload="getDetail()">
    <div class="container">
        <div class="transparent">
            <div id="detail-list" class="transparent"> </div>
                <button class="btn btn-danger" onclick="window.history.go(-1)">Back</button>
        </div>
    </div>  
</body>
</html>