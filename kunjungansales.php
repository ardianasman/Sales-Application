<?php
    include $_SERVER['DOCUMENT_ROOT']."/ProyekManpro/services/database.php"; 
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

        <style>
            td,th{
                text-align: center;
            }
        </style>
    </head>
    <body>

        <nav class="navbar navbar-expand-lg navbar-dark ">
        <a class="judul" href="index.php">Prototype Sales</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ml-auto">
                <a class="nav-item nav-link " href="index.php">Home <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link active" href="show_activity.php">Activity</a>
                <a class="nav-item nav-link" href="#">Customer</a>
                <a class="nav-item nav-link" href="logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container">

            <div class="row pt-4">
                <div class="col-6">
                    <?php $id = $_GET['id']; ?>
                        <?php $sql="SELECT nama FROM sales WHERE id_sales = '$id'"; 
                            $stmt=$pdo->prepare($sql);
                            $stmt->execute();
                            $res=$stmt->fetch();
                            echo "<h3>".$res["nama"]."</h3>"
                        ?>
                </div>
            </div>
            <div class="row pt-4">
                <div class="col-12 table-responsive-sm">
                    <table class="table table-hover table-striped table-bordered" id="sortTable">
                        <thead>
                            <tr>
                                <th scope="col">Nama Customer</th>
                                <th scope="col">Jadwal Kunjungan</th>
                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody id="user-content">

                        </tbody>
                    </table>
                </div>
            </div>
             <a href="DataSales_Manajer.php"><button class="btn btn-danger">Back</button></a>
    </div>


         <!-- JS -->
        <script src="assets/jquery/jquery-3.5.1.min.js"></script>
        <script src="assets/popper/popper.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.js"></script>

      
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>   
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

        <!-- DataTable Query -->
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

        <script>
            
            function load_data() {
                var id = <?php echo $_GET['id'] ?>;
                $.ajax({
                    url: "services/get_kunjungansales.php?id="+id,
                    method: "GET",
                    success: function(data) {
                        $("#user-content").html('');
                        data.forEach(function(sales){
                            var row = $("<tr></tr>");
                            var col2 = $("<td>" + sales['nama'] + "</td>");
                            var col3 = $("<td>" + sales['jadwal_kunjungan'] + "</td>");
                            var btn = $('<td scope="col"></td>');
                            var btnacc = $(`<button data-id="` + sales['id_customer'] + `" id="accept_btn" class="btn btn-success">Terima</button>`);
                            var btnreject = $(`<button data-id="` + sales['id_customer'] + `" id="reject_btn" class="btn btn-danger">Tolak</button>`);
                            col2.appendTo(row);
                            col3.appendTo(row);
                            btnacc.appendTo(btn);
                            btnreject.appendTo(btn);
                            btn.appendTo(row);

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

            $("#user-content").on("click", "[id='reject_btn']", function(){
                var id_sales = <?php echo $_GET['id'] ?>;
                var id_customer = $(this).attr('data-id');

                $.ajax({
                    url: '/ProyekManpro/services/tolakkunjungan.php',
                    method: 'POST',
                    data: {
                        id_sales : id_sales,
                        id_customer : id_customer
                    },
                    success: function(data) {
                        load_data();
                    },
                    error: function($xhr, textStatus, errorThrown) {
                        alert($xhr.responseJSON['error']);
                    }
                });

            });

            $("#user-content").on("click", "[id='accept_btn']", function(){
                var id_sales = <?php echo $_GET['id'] ?>;
                var id_customer = $(this).attr('data-id');
                
                $.ajax({
                    url: '/ProyekManpro/services/terimakunjungan.php',
                    method: 'POST',
                    data: {
                        id_sales : id_sales,
                        id_customer : id_customer
                    },
                    success: function(data) {
                        load_data();
                    },
                    error: function($xhr, textStatus, errorThrown) {
                        alert($xhr.responseJSON['error']);
                    }
                });

            });

            
        </script>

            </div>
        </div>

    </body>
</html>

