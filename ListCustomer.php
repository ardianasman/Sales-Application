<?php

// session_start();

// if(!isset($_SESSION['id'])){
//     header("Location: login.php");
// }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <!-- Bootstrap -->
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css"/>
        <link rel="stylesheet" href="assets/linearicons/style.css"/>

        <!-- JQuery Confirm -->
        <link rel="stylesheet" href="assets/jquery-confirm/jquery-confirm.css"/>
         <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="style4.css">
    </head>
    <body>
        <div class="wrapper">
                </nav>
                <div class="container">
            <div class="row pt-4">
                <div class="col-6">
                    <h3 class="title">List Customer</h3>
                </div>
            </div>
            <div class="row pt-4">
                <div class="col-12">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="10%">ID Customer</th>
                                <th width="40%">Nama </th>
                                <th width="30%">Alamat </th>
                                <th width="20%">No Telp</th>
                            </tr>
                        </thead>
                        <tbody id="user-content">  
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



         <!-- JS -->
        <script src="assets/jquery/jquery-3.5.1.min.js"></script>
        <script src="assets/popper/popper.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.js"></script>

      
        <!-- jQuery CDN -->
         <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
         <!-- Bootstrap Js CDN -->
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
         <!-- JQuery Confirm -->
        <script src="assets/jquery-confirm/jquery-confirm.js"></script>

        <script>

            function load_data() {
                $.ajax({
                    url: "/services/get_customer.php",
                    method: "GET",
                    success: function(data) {
                        $("#user-content").html('');
                        data.forEach(function(cst){
                            var row = $("<tr></tr>");
                            var col2 = $("<td>" + cst['id_customer'] + "</td>");
                            var col3 = $("<td>" + cst['nama'] + "</td>");
                            var col4 = $("<td>" + cst['alamat'] + "</td>");
                            var col5 = $("<td>" + cst['no_telp'] + "</td>");
                            
                            col2.appendTo(row);
                            col3.appendTo(row);
                            col4.appendTo(row);
                            col5.appendTo(row);

                            // Tools
                            var tools = $("<td></td>");
                            var btn = $('<a href="cekjatuhtempo.php?id='+cst['id_customer']+'"><button class="btn btn-success">Check</button></a>');
                            
                            btn.appendTo(tools);
                            tools.appendTo(row);
                            
                            $("#user-content").append(row);
                        });
                    },
                    error: function(data) {

                    }
                });
            }

            

            $(document).ready(function(){
                load_data();
            });

            
         </script>  
    </body>
</html>

