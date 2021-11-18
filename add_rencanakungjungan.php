<?php
    include "./services/database.php";
    if(!isset($_SESSION['id'])){
        header("Location: login.php");
    }
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM `aktivitas_sales` ORDER BY `id_aktivitas` DESC LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
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
            function getCustId(){
                $.ajax({
                    url: "./services/getcustid.php",
                    method: "POST",
                    success: function(res){
                        $("#data-list").html('');
                        var opt = $("<select style='height:40px; width: 125px; text-align: center' required></select>");
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
            function getManagerId(){
                $.ajax({
                    url: "./services/getmanagerid.php",
                    method: "POST",
                    success: function(res){
                        $("#datamanager-list").html('');
                        var opt = $("<select style='height:40px; width: 125px; text-align: center' required></select>");
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
            function addRencana(){
                console.log("masuk");
                var id_customer = $("#data-list").find(":selected").text();
                var id_manager = $("#datamanager-list").find(":selected").text();
                var id_aktivitas = $("#idktivitas").val();


                var date = new Date($("#idtglkunjung").val());
                var day = date.getDate();
                var month = date.getMonth() + 1;
                var year = date.getFullYear();
                var hour = date.getHours();
                var min = date.getMinutes();
                var sec = date.getSeconds();
                var jadwal_kunjungan1 = [year, month, day].join('-');
                var jadwal_kunjungan2 = [hour, min, sec].join(':');
                var jadwal_kunjungan = jadwal_kunjungan1 + " " + jadwal_kunjungan2;
                $.ajax({
                    url: "./services/add_rencana.php",
                    method: "POST",
                    data: {
                        id_customer : id_customer,
                        id_manager : id_manager,
                        id_aktivitas : id_aktivitas,
                        jadwal_kunjungan : jadwal_kunjungan
                    },
                    success: function(data){
                        alert("succq");
                    },
                    error: function(){
                        alert("fail");
                    }
                });
            }
            function start(){
                getCustId();
                getManagerId();
            }
    </script>
    <style>
        .btn{
            height: 50px;
            width: 150px;
        }
        .container{
            text-align: center;
        }
        .transparent{
            text-align: center;
        }
        .item-list{
            margin: auto;
        }
        .form-control{
            text-align: center;
        }
    </style>
</head>

<body onload="start()">
    <div class="container">
        <div class="transparent">
            <?php
                if($stmt->rowCount() == 1){
                    $item = $stmt->fetch() ?>
                        <div id="item-list" class="item-list">
                            <div class="w-25" style="margin-left: auto; margin-right: auto">
                                <label for="idktivits"><b">ID Aktivitas</b></label>
                                <input class = "form-control"  id="idktivitas" value = "<?php echo $item['id_aktivitas'] + 1; ?>" readonly> 
                            </div>
                            <div class="w-25" style="margin-left: auto; margin-right: auto">
                                <label for="idsales"><b">ID Sales</b></label>
                                <input class = "form-control"  value="<?php echo $id; ?>" readonly> 
                            </div>
                            <div class="w-25" style="margin-left: auto; margin-right: auto">
                                <label for="idmanager"><b">ID Manager</b></label>
                               <div id="datamanager-list" name="idmanager"></div>
                            </div>
                            <div class="w-25" style="margin-left: auto; margin-right: auto">
                                <label for="idcust"><b">ID Customer</b></label>
                               <div id="data-list" name="idcust"></div>
                            </div>
                            <div class="w-25" style="margin-left: auto; margin-right: auto">
                                <label for="namacust"><b">Nama Customer</b></label>
                                <input type="text" class="form-control" style="text-align:center" name="idnama" id="idnama" required>
                            </div>
                            <div class="w-25" style="margin-left: auto; margin-right: auto">
                                <label for="alamat"><b">Tanggal Kunjungan</b></label>
                                <input type="datetime-local" class="form-control" style="text-align:center" name="idtglkunjung" id="idtglkunjung" required>
                            </div>
                            <div class = "d-flex">
                                <button class="btn btn-outline-secondary p-2" onclick="window.history.go(-1)">Back</button>
                                <button class="btn btn-success ml-auto p-2 justify-content-center align-items-center" onclick="addRencana()">Add Customer</button>
                            </div>
                        </div>
                <?php }
                else {?>
                
                <?php } ?>
        </div>
    </div>
</body>
</html>