<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <!-- Bootstrap -->
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css"/>
        <link rel="stylesheet" href="assets/linearicons/style.css"/>


         <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <!-- Our Custom CSS -->
        <link rel="stylesheet" href="style4.css">
        <!-- JQuery Confirm -->
        <link rel="stylesheet" href="assets/jquery-confirm/jquery-confirm.css"/>
    </head>
    <body>
        <div class="wrapper">
            
            <!-- Page Content Holder -->
            <div id="content">

                <div class="container">
            <div class="row pt-4">
                <div class="col-6">
                    <h3 class="title">List Nota</h3>
                </div>
            </div>
            <div class="row pt-4">
                <div class="col-12">
                    <table class="table table-hover">
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

      
        <!-- jQuery CDN -->
         <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
         <!-- Bootstrap Js CDN -->
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
         <!-- JQuery Confirm -->
        <script src="assets/jquery-confirm/jquery-confirm.js"></script>

        <script>
            
            function load_data() {
                var id = <?php echo $_GET['id'] ?>;
                $.ajax({
                    url: "/services/get_detail_nota.php?id="+id,
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

            </div>
        </div>

    </body>
</html>

