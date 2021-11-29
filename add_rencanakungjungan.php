<?php
include "./services/database.php";
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
}
$id = $_SESSION['id'];
$sql = "SELECT * FROM `aktivitas_sales` ORDER BY `id_aktivitas` DESC LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$sqlmanager = "SELECT m.id_manager, n.nama FROM `sales` m JOIN `manager` n ON m.id_manager = n.id_manager WHERE m.id_sales = $id";
$stmtmanager = $pdo->prepare($sqlmanager);
$stmtmanager->execute();
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
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/navbar.css">

    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">



    <script>
        function getCustId() {
            $.ajax({
                url: "./services/getcustid.php",
                method: "POST",
                success: function(res) {
                    $("#data-list").html('');
                    var opt = $("<select style='height:40px; width: 100%; text-align: center' required></select>");
                    var data = [];
                    res.forEach(function(item) {
                        var html = $(`
                                <option>` + item['id_customer'] + " - " + item['nama'] + `</option>
                            `);
                        opt.append(html);
                    });
                    $("#data-list").append(opt);
                },
                error: function() {
                    alert('fail');
                }
            });
        }
        // function getManagerId(){
        //     $.ajax({
        //         url: "./services/getmanagerid.php",
        //         method: "POST",
        //         success: function(res){

        //         },
        //         error: function(){
        //             alert('fail');
        //         }
        //     });
        // }
        function addRencana() {
            var id_customer = $("#data-list").find(":selected").text();
            var id_manager = $("#idmanager").val();
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
                    id_customer: id_customer,
                    id_manager: id_manager,
                    id_aktivitas: id_aktivitas,
                    jadwal_kunjungan: jadwal_kunjungan
                },
                success: function(data) {
                    
                },
                error: function() {
                    alert("fail");
                }
            });
        }

        function start() {
            getCustId();
            //getManagerId();
        }
        $(document).ready(function(){
            $("#btnsubmit").on("click", function(){
                var checkdate = $("#idtglkunjung").val();
                if(checkdate == ""){
                    alert("Date is not selected !");
                }
                else{
                    addRencana();
                    window.location.href = "lihat_status_kunjungan.php";
                }
            });
        });
    </script>
    <style>
        .btn {
            height: 50px;
            width: 150px;
        }

        .container {
            text-align: center;
        }

        .transparent {
            text-align: center;
        }

        .item-list {
            margin: auto;
        }

        .form-control {
            text-align: center;
        }

        .w-25 {
            margin-bottom: 10px;
        }
        .input-group-prepend {
            width : 15%; /*adjust as needed*/
        }
        .input-group-prepend span{
            width: 100%;
            overflow: hidden;
        }
        .form-control[readonly]{
            background-color: transparent;
        }
        .navbar{
            margin-bottom: 25px;
        }
    </style>
</head>

<body onload="start()">
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
                <li class="nav-item active dropdown"><a class="nav-link" id="navbarDropdownMenuLink" aria-haspopup="true" aria-expanded="false">Activity</a>
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
        <h4 style="text-align: left; margin-bottom: 35px;"><b>Rencana Kunjungan</b></h4>
            <?php
            if ($stmt->rowCount() == 1) {
                $item = $stmt->fetch();
                $itemmanager = $stmtmanager->fetch(); ?>
                <!-- <div id="item-list" class="item-list">
                    <div class="w-25" style="margin-left: auto; margin-right: auto">
                        <label for="idktivits">
                            <b">ID Aktivitas</b>
                        </label>
                        <input class="form-control" id="idktivitas" value="<?php echo $item['id_aktivitas'] + 1; ?>" readonly>
                    </div>
                    <div class="w-25" style="margin-left: auto; margin-right: auto">
                        <label for="idsales">
                            <b">ID Sales</b>
                        </label>
                        <input class="form-control" value="<?php echo $id; ?>" readonly>
                    </div>
                    <div class="w-25" style="margin-left: auto; margin-right: auto">
                        <label for="idmanager">
                            <b">ID Manager</b>
                        </label>
                        <input class="form-control" value="<?php echo $itemmanager['nama']; ?>" readonly>
                    </div>
                    <div class="w-25" style="margin-left: auto; margin-right: auto">
                        <label for="idcust">
                            <b">ID Customer</b>
                        </label>
                        <div id="data-list" name="idcust"></div>
                    </div>
                    <div class="w-25" style="margin-left: auto; margin-right: auto">
                        <label for="alamat">
                            <b">Tanggal Kunjungan</b>
                        </label>
                        <input type="datetime-local" class="form-control" style="text-align:center" name="idtglkunjung" id="idtglkunjung" required>
                    </div>
                    <div class="d-flex justify-content-center mt-5">
                        <div class="btn-group">
                            <button class="btn btn-outline-secondary p-2 mr-4" onclick="window.history.go(-1)">Back</button>
                            <button class="btn btn-success ml-auto p-2 ml-4 justify-content-center align-items-center" onclick="addRencana()">Add Plan</button>
                        </div>
                    </div>
                </div> -->

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">ID Aktivitas</span>
                    </div>
                    <input class="form-control" id="idktivitas" value="<?php echo $item['id_aktivitas'] + 1; ?>" readonly></input>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">ID Sales</span>
                    </div>
                    <input class="form-control" value="<?php echo $id; ?>" readonly></input>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Manager</span>
                    </div>
                    <input id="idmanager" class="form-control" value="<?php echo $itemmanager['id_manager']; echo " - "; echo $itemmanager['nama'];?>" readonly></input>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Customer</span>
                    </div>
                    <div style="width: 85%" id="data-list" name="idcust"></div>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Jadwal Kunjungan</span>
                    </div>
                    <input class="form-control" type="datetime-local" class="form-control" style="text-align:center" name="idtglkunjung" id="idtglkunjung" required>
                </div>
                <div class="d-flex justify-content-center mt-5">
                    <div class="btn-group">
                        <button class="btn btn-outline-secondary p-2 mr-4" onclick="window.history.go(-1)">Back</button>
                        <button id="btnsubmit" class="btn btn-success ml-auto p-2 ml-4 justify-content-center align-items-center">Add Plan</button>
                    </div>
                </div>
            <?php } else { ?>

            <?php } ?>
        </div>
    </div>
</body>

</html>