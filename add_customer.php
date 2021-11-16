<?php
    include "./services/database.php";
    if(!isset($_SESSION['id'])){
        header("Location: login.php");
    }
    $id = $_SESSION['id'];
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
        <script src="https://use.fontawesome.com/504410ced2.js"></script>
        <link rel="stylesheet" href="css\managerorder.css">

    
           
    <script>
        function getSalesId(){
                $.ajax({
                    url: "./services/getsalesid.php",
                    method: "POST",
                    success: function(res){
                        $("#data-list").html('');
                        var opt = $("<select required></select>");
                        var data = [];
                        res.forEach(function(item){
                            var html = $(`
                                <option>`+ item['id_sales'] +`</option>
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
        function getManagerId(){
                $.ajax({
                    url: "./services/getmanagerid.php",
                    method: "POST",
                    success: function(res){
                        $("#datamanager-list").html('');
                        var opt = $("<select required></select>");
                        var data = [];
                        res.forEach(function(item){
                            var html = $(`
                                <option>`+ item['id_manager'] +`</option>
                            `);
                            opt.append(html);
                        });
                        $("#datamanager-list").append(opt);
                    },
                    error: function(){
                        alert('fail');
                    }
                });
            }
        function start(){
            getSalesId();
            getManagerId();
        }
    </script>
</head>

<body onload="start()">
    <div class="container">
        <div class="transparent">
            <div class="w-25" style="margin-left: auto; margin-right: auto">
                <label for="idorder"><b">ID Sales</b></label>
                <div id="data-list"> </div>
            </div>
            <div class="w-25" style="margin-left: auto; margin-right: auto">
                <label for="idorder"><b">ID Manager</b></label>
                <div id="datamanager-list"> </div>
            </div>
            <div class="w-25" style="margin-left: auto; margin-right: auto">
                <label for="namacust"><b">Nama Lengkap</b></label>
                <input type="text" class="form-control" style="text-align:center" name="idnama" id="idnama">
            </div>
            <div class="w-25" style="margin-left: auto; margin-right: auto">
                <label for="alamat"><b">Alamat</b></label>
                <input type="text" class="form-control" style="text-align:center" name="idalamat" id="idalamat">
            </div>
            <div class="w-25" style="margin-left: auto; margin-right: auto">
                <label for="notelp"><b">Nomor Telepon</b></label>
                <input type="text" class="form-control" style="text-align:center" name="idno" id="idno">
            </div>
        </div>
    </div>
</body>

</html>