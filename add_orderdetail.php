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
    $sql = "SELECT n.nama FROM `order` m JOIN `customer` n ON m.id_customer = n.id_customer WHERE m.id_order = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id_order]);
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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="css/navbar.css"> 

        <!-- CSS Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        
        <style>
        .centertd{
            text-align: center;
        }
        </style>

        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="basket" viewBox="0 0 16 16">
                <path d="M5.071 1.243a.5.5 0 0 1 .858.514L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 6h1.717L5.07 1.243zM3.5 10.5a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3z"/>
            </symbol>
        </svg>

        <script>
            function getData(){
                var idorder = sessionStorage.getItem("idorder");
                var idcust = sessionStorage.getItem("idcust");
                //
                //
            }
            function getProduct(){
                $.ajax({
                    url:"./services/getproductlist.php",
                    method: "GET",
                    success: function(res){
                        $("#product-list").html('');
                        var count = 1;
                        console.log(res);
                        res.forEach(function(item){
                            var row = $("<tr></tr>");
                            var col1 = $("<td>" + count + "</td>");
                            var col2 = $("<td>" + item['nama_produk'] + "</td>");
                            var col3 = $("<td>" + item['harga_produk'].toLocaleString() + "</td>");
                            var col4 = $("<td><input type='number' name='inp' id='inpqty' required value = '<?php echo 0 ?>'></input></td>");
                            
                            var btn = $('<td scope="col" hidden></td>');
                            var add = $('<a href="#" id="add-btn" hidden><svg class="bi me-2" width="16" height="16" style="color: black; margin-left: 10px;"><use xlink:href="#basket"/></svg></a>');
                            var add2 = $('<a href="#" id="inp-btn" hidden><svg class="bi me-2" width="16" height="16" style="color: black; margin-left: 10px;"><use xlink:href="#basket"/></svg></a>');


                            col1.appendTo(row);
                            col2.appendTo(row);
                            col3.appendTo(row);
                            col4.appendTo(row);
                            // add.appendTo(btn);
                            // add2.appendTo(btn);
                            btn.appendTo(row);
                            count++;
                            $("#product-list").append(row);
                            add.data('id_produk', item['id_produk']);
                            add2.data('qty', $("#inpqty").val());

                            console.log("Product ID ->" + item['id_produk']);
                            console.log(("Qty ->") + $("#inpqty").val());
                        });
                        $("#tableImage").DataTable();
                    },
                    error: function(){
                        alert('fail');
                    }
                });
            }
            $(document).ready(function(){
                $("#inp-btn").on("click", function(){
                    var str = $('#qtyform').serializeArray();
                    //console.log(str);
                    var arr_id = [];
                    var detailorder_id;
                    var id_order = "<?php echo $_GET['ids'];?>"
                    var iduang = sessionStorage.getItem("iduang");
                    var iddiskon = sessionStorage.getItem("iddiskon");
                    var idpajak = sessionStorage.getItem("idpajak");
                    $.ajax({
                        url:"./services/getproductlist.php",
                        method: "GET",
                        success: function(res){
                            res.forEach(function(item){
                                arr_id.push(item['id_produk']);
                            });

                            $.ajax({
                                url: "./services/getdetailorderlist.php",
                                method: "POST",
                                success: function(res){
                                    res.forEach(function(item){
                                        detailorder_id = item['id_detail_order'] + 1;
                                        
                                    });
                                }
                            });
                            
                            $.ajax({
                                url: "./services/addorderdetail.php",
                                method: "POST",
                                data: {
                                    str : str,
                                    arr_id : arr_id,
                                    id_order : id_order,
                                    detailorder_id : detailorder_id,
                                    iduang : iduang,
                                    idpajak : idpajak,
                                    iddiskon : iddiskon
                                },
                                success: function(data){
                                    window.location.href = "manage_order.php";
                                },
                                error: function(data){
                                    alert(data);
                                }
                            });
                        },
                        error: function(){
                            alert('fail');
                        }
                    });
                });
                $("#calctotal").on("click", function(){
                    var str = $('#qtyform').serializeArray();
                    var arr_harga = [];
                    $.ajax({
                        url: "./services/getlistharga.php",
                        method: "GET",
                        success: function(res){
                            res.forEach(function(item){
                                arr_harga.push(item['harga_produk']);
                            });
                            
                            $.ajax({
                                url: "./services/gettemptotal.php",
                                method: "POST",
                                data: {
                                    str : str,
                                    arr_harga : arr_harga
                                },
                                success: function(res){
                                    $('#calctotaltext').val(res);
                                },
                                error: function(data){
                                    alert(data);
                                }
                            });
                        }
                    });
                });
            });
            function init(){
                getData();
                getProduct();
            }
        </script>
        <style>
            .input-group{
                margin-top: 25px;
            }
            .input-group-prepend {
                width : 15%;
                padding : 0px;
            }
            .input-group-prepend span{
                width: 100%;
            }
            #inpi{
                background-color: white;
            }
            .inpc{
                width: 10%;
            }
            .inpc:read-only{
                background-color: white;
            }
            #basic-addon1{
                width: 10%;
            }
            .navbar{
                margin-bottom:15px;
            }
        </style>
</head>

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
            <?php $item = $stmt->fetch();?>
            <h4 style="text-align: center; margin-bottom: 15px;"><b>Add Customer Product</b></h4>
            

            <div class="input-group mb-3">
                <div class="input-group-prepend col-sm">
                    <span class="input-group-text"><b>ID Order</b></span>
                </div>
                <input type="text" class="form-control" id="inpi" value="<?php echo $id_order;?>" style="margin-right: 10px;" readonly>
                <div class="input-group-prepend col-sm">
                    <span class="input-group-text"><b>Customer Name</b></span>
                </div>
                <input type="text" class="form-control" id="inpi" value="<?php echo $item['nama']?>" readonly>
            </div>

            <div>
                <form id="qtyform">
                    <table id="tableImage" class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width="5%" data-sortable="true">#</th>
                                <th width="30%" data-sortable="true">Nama Produk</th>
                                <th width="30%" data-sortable="true">Harga</th>
                                <th width="25%" data-sortable="true">Quantity</th>
                                <th wdith="15%" data-sortable="true" hidden>Attributes</th>
                            </tr>
                        </thead>
                        <tbody id="product-list">
                                
                        </tbody>
                    </table>
                </form>
            </div>
            <div>
                
                <div class="input-group">
                    <div class="input-group-prepend col-sm">
                        <button class="btn btn-danger" id="calctotal" style="float: left; margin-right: 15px;">Calculate</button>
                        <span class="input-group-text" id="basic-addon1">Total</span>
                        <input type="text" class="form-control inpc" id="calctotaltext" placeholder="0" readonly>
                        <button class="btn btn-danger col-md-4 offset-md-4" id="inp-btn">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>