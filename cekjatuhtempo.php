<?php 

session_start();

if (!isset($_SESSION['id'])) {
    header("Location:login.php");
}

?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="css/navbar.css"> 

        <!-- CSS Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <!-- FontAwesome -->
        <script src="https://kit.fontawesome.com/8762c0f933.js" crossorigin="anonymous"></script>

        <!-- Data Tables -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">

        <style>
            td,th{
                text-align: center;
            }
        </style>
    </head>
    <body>

    <nav class="navbar navbar-expand-lg navbar-dark ">
        <a class="judul" href="#">Prototype Sales</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown"><a class="nav-link" id="navbarDropdownMenuLink"aria-haspopup="true" aria-expanded="false">Activity</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="show_activity.php">Sales Activity</a>
                        <a class="dropdown-item" href="add_rencanakungjungan.php">Visit Plan</a>
                        <a class="dropdown-item" href="lihat_status_kunjungan.php">Plan Status</a>
                    </div>
                </li>
                <li class="nav-item active">
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
            <div class="row pt-4">
                <div class="col-6">
                    <h3 class="title">List Nota</h3>
                </div>
            </div>
            <div class="row pt-4">
                <div class="col-12 table-responsive-sm">
                    <table class="table table-hover table-striped table-bordered" id="sortTable">
                        <thead>
                            <tr>
                                <th width="10%">No Orderan</th>
                                <th width="10%">ID Sales</th>
                                <th width="10%">ID Customer</th>
                                <th width="25%">Tanggal Order</th>
                                <th width="25%">Tanggal Jatuh Tempo</th>
                                <th width="20%">Total Harga</th>
                            </tr>
                        </thead>
                        <tbody id="user-content">

                        </tbody>
                    </table>
                </div>
            </div>
             <a href="ListCustomer.php"><button class="btn btn-danger">Back</button></a>
        </div>


         <!-- JS -->
        <script src="assets/jquery/jquery-3.5.1.min.js"></script>
        <script src="assets/popper/popper.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.js"></script>

      
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <!-- DataTable Query -->
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

        <script>
            
            function load_data() {
                var id = <?php echo $_GET['id'] ?>;
                $.ajax({
                    url: "services/get_detail_nota.php?id="+id,
                    method: "GET",
                    success: function(data) {
                        $("#user-content").html('');
                        data.forEach(function(nota){
                            var row = $("<tr></tr>");
                            var col2 = $("<td>" + nota['id_order'] + "</td>");
                            var col3 = $("<td>" + nota['id_sales'] + "</td>");
                            var col4 = $("<td>" + nota['id_customer'] + "</td>");
                            var col5 = $("<td>" + nota['tanggal_order'] + "</td>");
                            var col6 = $("<td>" + nota['tanggal_jatuh_tempo'] + "</td>");
                            var col7 = $("<td>" + nota['total_harga'] + "</td>");

                            col2.appendTo(row);
                            col3.appendTo(row);
                            col4.appendTo(row);
                            col5.appendTo(row);  
                            col6.appendTo(row);  
                            col7.appendTo(row);  

                            $("#user-content").append(row);
                        })
                            $('#sortTable').DataTable();
                        },
                    error: function(data) {

                    }
                });
            }

            $(document).ready(function(){
                load_data();
            });

            
        </script>

            </div>
        </div>

    </body>
</html>

