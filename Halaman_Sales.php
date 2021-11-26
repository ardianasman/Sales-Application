<?php
    include $_SERVER['DOCUMENT_ROOT']."/ProyekManpro/services/database.php"; 
    if (!isset($_SESSION['id_manajer'])) {
        header("Location:login_manajer.php");
    }
?>
<!doctype html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!-- CSS Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

        <!-- FontAwesome -->
        <script src="https://kit.fontawesome.com/8762c0f933.js" crossorigin="anonymous"></script>

        <!-- Data Tables -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
        
        <title>Halaman Sales</title>

        <style>
            .bd-placeholder-img {
                font-size: 1.125rem;
                text-anchor: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                user-select: none;
            }
            @media (min-width: 768px) {
                .bd-placeholder-img-lg {
                font-size: 3.5rem;
                }
            }
            body {
                min-height: 100vh;
            }

            html {
                height: -webkit-fill-available;
            }

            nav {
                display: flex;
                flex-wrap: nowrap;
                height: 100vh;
                overflow-x: auto;
                overflow-y: hidden;
            }
            .grid-container {
                display: grid;
                /* grid-template-columns: auto auto auto auto; */
                grid-template-columns: max-content auto auto;
                grid-gap: 10px;
            }
            
            .b-example-divider {
                flex-shrink: 0;
                width: 1.5rem;
                height: 100vh;
                background-color: rgba(0, 0, 0, .1);
                border: solid rgba(0, 0, 0, .15);
                border-width: 1px 0;
                box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
            }

            .bi {
                vertical-align: -.125em;
                pointer-events: none;
                fill: currentColor;
            }

            .dropdown-toggle { outline: 0; }

            .nav-flush .nav-link {
                border-radius: 0;
            }

            .btn-toggle {
                display: inline-flex;
                align-items: center;
                padding: .25rem .5rem;
                font-weight: 600;
                color: rgba(0, 0, 0, .65);
                background-color: transparent;
                border: 0;
            }
            .btn-toggle:hover,
            .btn-toggle:focus {
                color: rgba(0, 0, 0, .85);
                background-color: #d2f4ea;
            }

            .btn-toggle::before {
                width: 1.25em;
                line-height: 0;
                content: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='rgba%280,0,0,.5%29' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 14l6-6-6-6'/%3e%3c/svg%3e");
                transition: transform .35s ease;
                transform-origin: .5em 50%;
            }

            .btn-toggle[aria-expanded="true"] {
                color: rgba(0, 0, 0, .85);
            }
            .btn-toggle[aria-expanded="true"]::before {
                transform: rotate(90deg);
            }

            .btn-toggle-nav a {
                display: inline-flex;
                padding: .1875rem .5rem;
                margin-top: .125rem;
                margin-left: 1.25rem;
                text-decoration: none;
            }
            .btn-toggle-nav a:hover,
            .btn-toggle-nav a:focus {
                background-color: #d2f4ea;
            }

            .scrollarea {
                overflow-y: auto;
            }

            .fw-semibold { font-weight: 600; }
            .lh-tight { line-height: 1.25; }
            hr {
                display: block;
                margin-top: 1em;
                margin-bottom: 0.5em;
                margin-left: auto;
                margin-right: auto;
                border-style: inset;
                border-width: 1px;
            }
        </style>
    </head>

    <body>
        <!-- SYMBOL -->
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="home" viewBox="0 0 16 16">
                <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
            </symbol>
            <symbol id="product" viewBox="0 0 16 16">
                <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z"/>
            </symbol>
            <symbol id="people" viewBox="0 0 16 16">
                    <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                    <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z"/>
                    <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
            </symbol>
            <symbol id="book" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M6 1h6v7a.5.5 0 0 1-.757.429L9 7.083 6.757 8.43A.5.5 0 0 1 6 8V1z"/>
                <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z"/>
                <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z"/>
            </symbol>
            <symbol id="people-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
            </symbol>
            <symbol id="gem" viewBox="0 0 16 16">
                <path d="M3.1.7a.5.5 0 0 1 .4-.2h9a.5.5 0 0 1 .4.2l2.976 3.974c.149.185.156.45.01.644L8.4 15.3a.5.5 0 0 1-.8 0L.1 5.3a.5.5 0 0 1 0-.6l3-4zm11.386 3.785-1.806-2.41-.776 2.413 2.582-.003zm-3.633.004.961-2.989H4.186l.963 2.995 5.704-.006zM5.47 5.495 8 13.366l2.532-7.876-5.062.005zm-1.371-.999-.78-2.422-1.818 2.425 2.598-.003zM1.499 5.5l5.113 6.817-2.192-6.82L1.5 5.5zm7.889 6.817 5.123-6.83-2.928.002-2.195 6.828z"/>
            </symbol>
            <symbol id="edit" viewBox="0 0 16 16">
                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
            </symbol>
            <symbol id="trash" viewBox="0 0 16 16">
                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
            </symbol>
            <symbol id="activity" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M6 2a.5.5 0 0 1 .47.33L10 12.036l1.53-4.208A.5.5 0 0 1 12 7.5h3.5a.5.5 0 0 1 0 1h-3.15l-1.88 5.17a.5.5 0 0 1-.94 0L6 3.964 4.47 8.171A.5.5 0 0 1 4 8.5H.5a.5.5 0 0 1 0-1h3.15l1.88-5.17A.5.5 0 0 1 6 2Z"/>
            </symbol>
            <symbol id="basket" viewBox="0 0 16 16">
                <path d="M5.071 1.243a.5.5 0 0 1 .858.514L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 6h1.717L5.07 1.243zM3.5 10.5a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3z"/>
            </symbol>
            <symbol id="door" viewBox="0 0 16 16">
                <path d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15H1.5zM11 2h.5a.5.5 0 0 1 .5.5V15h-1V2zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z"/>
            </symbol>
            <symbol id="home" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
            </symbol>
        </svg>

        <div class="d-flex">
            <!-- SIDEBAR -->
            <nav class="flex-column flex-shrink-0 p-3 text-white" style="width: 20%; background-color: #61a3d6; position: fixed;">
            <img src="image\LogoWhite.png" width="160px" style="margin-left: auto; margin-right: auto;" class="d-flex mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <hr style="width: 98%; text-align: left;">
                <ul class="nav nav-pills flex-column mb-auto">
                    <li>
                        <a href="Home_Manajer.php" class="nav-link text-white">
                        <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"/></svg>
                        Home
                        </a>
                    </li>
                    <li>
                        <a href="Profile_Manajer.php" class="nav-link text-white">
                        <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"/></svg>
                        Profile
                        </a>
                    </li>
                    <li>
                        <a href="DataProduct_Manajer.php" class="nav-link text-white">
                        <svg class="bi me-2" width="16" height="16"><use xlink:href="#product"/></svg>
                        Product
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="DataSales_Manajer.php" class="nav-link active" aria-current="page">
                        <svg class="bi me-2" width="16" height="16"><use xlink:href="#people"/></svg>
                        Sales
                        </a>
                    </li>
                    <li>
                        <a href="laporan.php" class="nav-link text-white">
                        <svg class="bi me-2" width="16" height="16"><use xlink:href="#book"/></svg>
                        Report
                        </a>
                    </li>
                    <li>
                        <a href="Customer_Manajer.php" class="nav-link text-white">
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#gem"/></svg>
                            Customers
                        </a>
                    </li>
                    <li>
                        <a href="manager_show_all_activity.php" class="nav-link text-white">
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#activity"/></svg>
                            Sales Activities
                        </a>
                    </li>
                    <li>
                        <a href="manager_show_order.php" class="nav-link text-white">
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#basket"/></svg>
                            Orders
                        </a>
                    </li>
                    <li>
                        <a href="logout_manajer.php" class="nav-link text-white">
                            <svg class="bi me-2" width="16" height="16"><use xlink:href="#door"/></svg>
                            Logout
                        </a>
                    </li>
                </ul>
            </nav>
        
            <!-- <div class="col-md-9 col-lg-8 m-3"> -->
            <div class="p-3" style="margin-left: 20%;width:80%; position: static;">
                <form class="grid-container p-1">
                    <div><img src="image/profile.jpg" alt="profile" width="280px"></div>
                    <div class="mt-5 ml-3" id="sales-content">
                        
                    </div>
                    <div class="mt-4 ml-3" style="text-align: right;">
                        <?php $sql="SELECT DAY(CURRENT_DATE), MONTHNAME(CURRENT_DATE), YEAR(CURRENT_DATE)"; 
                            $stmt=$pdo->prepare($sql);
                            $stmt->execute();
                            $res=$stmt->fetch();  
                            echo $res['DAY(CURRENT_DATE)'], " ", $res['MONTHNAME(CURRENT_DATE)'], " ", $res['YEAR(CURRENT_DATE)']?>
                    </div>
                </form>
                
                <div class="row pt-4">
                    <div class="col-12 table-responsive-sm">
                        <table class="table table-hover table-striped table-bordered" id="sortTable">
                            <thead>
                                <tr>
                                    <th width="25%" scope="col">Nama Customer</th>
                                    <th width="20%" scope="col">Jadwal Kunjungan</th>
                                    <th width="20%" scope="col">Action</th>

                                </tr>
                            </thead>
                            <tbody id="user-content">

                            </tbody>
                        </table>
                    </div>
                </div>
                <a href="DataSales_Manajer.php"><button class="btn btn-danger">Back</button></a>
            </div>
        </div>
        
         <!-- JS -->
        <script src="assets/jquery/jquery-3.5.1.min.js"></script>
        <script src="assets/popper/popper.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.js"></script>

      
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

        <!-- DataTable Query -->
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>


        <script>
            function load_data() {
                var id = <?php echo $_GET['id'] ?>;
                $.ajax({
                    url: "/ProyekManpro/services/get_sales.php",
                    method: "GET",
                    success: function(data) {
                        var cek=false;
                        var co = 1;
                        $("#sales-content").html('');
                        data.forEach(function(sales){
                            if(sales['id_sales'] == id){
                                var col1 = $("<h2 class='mb-3'>" + sales['nama'] + "</h2>");
                                var col2 = $("<div class='mb-2' style='font-size: 20px;'> Email : " + sales['email'] + "</div>");
                                var col3 = $("<div class='mt-2 mb-2' style='font-size: 20px;'>No Telp : " + sales['no_telp'] + "</div>");
                                var col4 = $("<div class='mt-2 mb-2' style='font-size: 20px;'>Alamat : " + sales['alamat'] + "</div>");
                                
                                $("#sales-content").append(col1);
                                $("#sales-content").append(col2);
                                $("#sales-content").append(col3);
                                $("#sales-content").append(col4);

                                $.ajax({
                                    url: "services/get_penjualan.php",
                                    method: "GET",
                                    success: function(data) {
                                        var penjualan;
                                        data.forEach(function(order){
                                            if(order['id_sales']==sales['id_sales']){
                                                // alert();
                                                penjualan = order['total'];
                                            }
                                        })
                                        if(penjualan){
                                            var col5 = $("<div class='mt-2 mb-2' style='font-size: 20px;'>Penjualan Bulan Ini : Rp. " + penjualan + "</div>");
                                        }else{
                                            var col5 = $("<div class='mt-2 mb-2' style='font-size: 20px;'>Penjualan Bulan Ini : Rp. 0</div>");
                                        }
                                        
                                        $("#sales-content").append(col5);
                                    },
                                    error: function(data) {

                                    }
                                });

                                // var col5 = $("<div class='mt-2 mb-2' style='font-size: 20px;'>Penjualan : " + penjualan + "</div>");
                                
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
                                            btn.appendTo(row)
                                            $("#user-content").append(row);
                                        })
                                    $('#sortTable').DataTable();
                                    },
                                    error: function(data) {

                                    }
                                });                                
                            }
                            cek = true;
                            co++;
                        });
                    },
                    error: function(data) {
                        alert("load data error!");
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

    </body>
</html>