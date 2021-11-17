<?php
    include "./services/database.php";
    if(!isset($_SESSION['id'])){
        header("Location: login.php");
    }
    $id = $_SESSION['id'];
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
        <!--<link rel="stylesheet" href="css\managerorder.css"> -->

        <script>
            function getCustId(){
                $.ajax({
                    url: "./services/getcustid.php",
                    method: "POST",
                    success: function(res){
                        $("#data-list").html('');
                        var opt = $("<select required></select>");
                        var data = [];
                        res.forEach(function(item){
                            var html = $(`
                                <option>`+ item['id_customer'] +`</option>
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
        </script>
</head>

<body onload="getCustId()">
    <div class="transparent">
            <form method="POST" action="./services/addorder.php" enctype="multipart/form-data">
                <div class="form-content">  
                    <div class="form-group">
                            <div class="w-25" style="margin-left: auto; margin-right: auto">
                                <label for="idorder"><b">ID Order</b></label>
                                <input type="text" class="form-control" style="text-align:center" name="idorder" id="idorder" value="<?php echo $id_order; ?>" readonly>
                            </div>
                            <div class="w-25" style="margin-left: auto; margin-right: auto">
                                <label for="idsales"><b">ID Sales</b></label>
                                <input type="text" class="form-control" style="text-align:center" name="idsales" id="idsales" value="<?php echo $id; ?>" readonly>
                            </div>
                            <div class="w-25" style="margin-left: auto; margin-right: auto">
                                <label for="namasales"><b">Nama Sales</b></label>
                                <input type="text" class="form-control" style="text-align:center" name="idsales" id="idsales" value="<?php echo $id; ?>" readonly>
                            </div>
                            <div class="w-25" style="margin-left: auto; margin-right: auto">
                                <label for="idorder"><b">ID Customer</b></label>
                                    <div id="data-list"> </div>
                            </div>
                            <div class="w-25" style="margin-left: auto; margin-right: auto">
                                <label for="idtglorder"><b">Tanggal Order</b></label>
                                <input type="date" class="form-control" style="text-align:center" name="idtglorder" id="idtglorder" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                            <div class="w-25" style="margin-left: auto; margin-right: auto">
                                <label for="idtempo"><b">Tanggal Jatuh Tempo</b></label>
                                <input type="date" class="form-control" style="text-align:center" name="idtempo" id="idtempo" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                            <div class="w-25" style="margin-left: auto; margin-right: auto">
                                <label for="matauang"><b">Mata Uang</b></label>
                                <input type="text" class="form-control" style="text-align:center" name="iduang" id="iduang" value="Rupiah" readonly>
                            </div>
                            <div class="w-25" style="margin-left: auto; margin-right: auto">
                                <label for="diskon"><b">Diskon</b></label>
                                <input type="number" class="form-control" style="text-align:center" name="iddiskon" id="iddiskon">
                            </div>
                            <div class="w-25" style="margin-left: auto; margin-right: auto">
                                <label for="pajak"><b">Pajak</b></label>
                                <input type="number" class="form-control" style="text-align:center" name="idpajak" id="idpajak">
                            </div>
                    </div>
                </div>
            </form>
    </div>
</body>
</html>