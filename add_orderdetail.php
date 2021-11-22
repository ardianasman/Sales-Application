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
        <link rel="stylesheet" href="css\managerorder.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        
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
                var iduang = sessionStorage.getItem("iduang");
                var iddiskon = sessionStorage.getItem("iddiskon");
                var idpajak = sessionStorage.getItem("idpajak");
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
                            var col3 = $("<td>" + item['harga_produk'] + "</td>");
                            var col4 = $("<td><input type='number' name='inp' id='inpqty' required value = '<?php echo 0 ?>'></input></td>");
                            
                            var btn = $('<td scope="col"></td>');
                            var add = $('<a href="#" id="add-btn"><svg class="bi me-2" width="16" height="16" style="color: black; margin-left: 10px;"><use xlink:href="#basket"/></svg></a>');
                            var add2 = $('<a href="#" id="inp-btn"><svg class="bi me-2" width="16" height="16" style="color: black; margin-left: 10px;"><use xlink:href="#basket"/></svg></a>');


                            col1.appendTo(row);
                            col2.appendTo(row);
                            col3.appendTo(row);
                            col4.appendTo(row);
                            add.appendTo(btn);
                            add2.appendTo(btn);
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

                $("#product-list").on("click", "[id='add-btn']", function(){
                    var id_produk = $(this).data('id_produk');
                    console.log(id_produk);
                    // $.ajax({
                    //     url: "./services/addorderdetail.php",
                    //     method: "POST",
                    //     data: {

                    //     },
                    // });
                });
                $("#inp-btn").on("click", function(){
                    var str = $('#qtyform').serializeArray();
                    //console.log(str);
                    var arr_id = [];
                    var detailorder_id;
                    var id_order = "<?php echo $_GET['ids'];?>"
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
                                        console.log(detailorder_id);
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
                                    detailorder_id : detailorder_id
                                },
                                success: function(data){
                                    //$('#qtyform')[0].reset();
                                    //console.log(arr_id);
                                    //console.log(data);
                                },
                                error: function(){
                                    alert('nono');
                                }
                            });
                        },
                        error: function(){
                            alert('fail');
                        }
                    });
                });
            });
            function getProductPerOrder(){
                var id_order = "<?php echo $_GET['ids'];?>"
                console.log(id_order);
                $.ajax({
                    url: "./services/getProductPerOrder.php",
                    method: "POST",
                    data: {
                        id_order : id_order
                    },
                    success: function(res){
                        $("#product-order").html('');
                        var table = $("<table id='data_table' class='table'></table>");
                        var title = $("<thead><tr style=text-align:center;><td><b>Product</b></td><td><b>Quantity</b></td><td><b>Harga</b></td><td><b>Sub Total</b></td><td><b> </b></td></tr></thead>");
                        table.append(title);
                        res = JSON.parse(res);
                        res.forEach(function(item){
                            var html = $(`
                                <tr class="centerd">
                                <td class="centerd">`+ item['nama_produk'] +`</td>
                                <td class="centerd">`+ item['kuantitas'] +`</td>
                                <td class="centerd">`+ item['harga_produk'] +`</td>
                                <td class="centerd">`+ item['kuantitas']*item['harga_produk'] +`</td>
                                </tr>
                            `);
                            table.append(html);
                        })
                    $("#product-order").append(table);
                    },
                    error: function(){
                        alert('failx')
                    }
                });
            }
            function getProductId(){

            }
            function init(){
                getData();
                getProduct();
                getProductPerOrder();
            }
        </script>
</head>

<body onload="init()">
    <div class="container">
        <div class="transparent">
            <div>
                <form id="qtyform">
                    <table id="tableImage" class="table table-hover table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width="5%" data-sortable="true">#</th>
                                <th width="30%" data-sortable="true">Nama Produk</th>
                                <th width="30%" data-sortable="true">Harga</th>
                                <th width="25%" data-sortable="true">Quantity</th>
                                <th wdith="15%" data-sortable="true">Attributes</th>
                            </tr>
                        </thead>
                        <tbody id="product-list">
                                
                        </tbody>
                    </table>
                </form>
            </div>
            <div><button class="btn btn-danger" id="inp-btn">Submit</button></div>
            <div>
                Added Items
                <div id="product-order"></div>
            </div>
        </div>
    </div>
</body>
</html>