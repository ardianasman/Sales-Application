<?php
include $_SERVER['DOCUMENT_ROOT'] . "/ProyekManpro/services/database.php";
if (!isset($_SESSION['id'])) {
    header("Location:login_manajer.php");
}
?>
<!doctype html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="Assets/jquery-confirm/jquery-confirm.css" />
    <script src="Assets/jquery-confirm/jquery-confirm.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.20/jspdf.plugin.autotable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <!-- <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script> -->
    <script src="    https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.19/api/sum().js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <title>Laporan</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sidebars/">
    <meta name="theme-color" content="#7952b3">

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
            grid-template-columns: max-content auto;
            grid-gap: 10px;
        }

        .modal-backdrop {
            z-index: -1;
            background-color: white;
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

        .dropdown-toggle {
            outline: 0;
        }

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

        .fw-semibold {
            font-weight: 600;
        }

        .lh-tight {
            line-height: 1.25;
        }

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
            <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z" />
        </symbol>
        <symbol id="product" viewBox="0 0 16 16">
            <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z" />
        </symbol>
        <symbol id="people" viewBox="0 0 16 16">
            <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
            <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z" />
            <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z" />
        </symbol>
        <symbol id="book" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M6 1h6v7a.5.5 0 0 1-.757.429L9 7.083 6.757 8.43A.5.5 0 0 1 6 8V1z" />
            <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
            <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
        </symbol>
        <symbol id="people-circle" viewBox="0 0 16 16">
            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
        </symbol>
        <symbol id="gem" viewBox="0 0 16 16">
            <path d="M3.1.7a.5.5 0 0 1 .4-.2h9a.5.5 0 0 1 .4.2l2.976 3.974c.149.185.156.45.01.644L8.4 15.3a.5.5 0 0 1-.8 0L.1 5.3a.5.5 0 0 1 0-.6l3-4zm11.386 3.785-1.806-2.41-.776 2.413 2.582-.003zm-3.633.004.961-2.989H4.186l.963 2.995 5.704-.006zM5.47 5.495 8 13.366l2.532-7.876-5.062.005zm-1.371-.999-.78-2.422-1.818 2.425 2.598-.003zM1.499 5.5l5.113 6.817-2.192-6.82L1.5 5.5zm7.889 6.817 5.123-6.83-2.928.002-2.195 6.828z" />
        </symbol>
        <symbol id="edit" viewBox="0 0 16 16">
            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
        </symbol>
        <symbol id="trash" viewBox="0 0 16 16">
            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
        </symbol>
        <symbol id="activity" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M6 2a.5.5 0 0 1 .47.33L10 12.036l1.53-4.208A.5.5 0 0 1 12 7.5h3.5a.5.5 0 0 1 0 1h-3.15l-1.88 5.17a.5.5 0 0 1-.94 0L6 3.964 4.47 8.171A.5.5 0 0 1 4 8.5H.5a.5.5 0 0 1 0-1h3.15l1.88-5.17A.5.5 0 0 1 6 2Z" />
        </symbol>
        <symbol id="basket" viewBox="0 0 16 16">
            <path d="M5.071 1.243a.5.5 0 0 1 .858.514L3.383 6h9.234L10.07 1.757a.5.5 0 1 1 .858-.514L13.783 6H15.5a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H15v5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V9H.5a.5.5 0 0 1-.5-.5v-2A.5.5 0 0 1 .5 6h1.717L5.07 1.243zM3.5 10.5a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3zm2.5 0a.5.5 0 1 0-1 0v3a.5.5 0 0 0 1 0v-3z" />
        </symbol>
        <symbol id="door" viewBox="0 0 16 16">
            <path d="M1.5 15a.5.5 0 0 0 0 1h13a.5.5 0 0 0 0-1H13V2.5A1.5 1.5 0 0 0 11.5 1H11V.5a.5.5 0 0 0-.57-.495l-7 1A.5.5 0 0 0 3 1.5V15H1.5zM11 2h.5a.5.5 0 0 1 .5.5V15h-1V2zm-2.5 8c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1z" />
        </symbol>
    </svg>

    <div class="d-flex">
        <!-- SIDEBAR -->
        <nav class="flex-column flex-shrink-0 p-3 text-white" style="width: 20%; background-color: #61a3d6; position: fixed;">
            <img src="image\LogoWhite.png" width="160px" class="d-flex ml-5 mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <hr style="width: 98%; text-align: left;">
            <ul class="nav nav-pills flex-column mb-auto">
                <li>
                    <a href="Profile_Manajer.php" class="nav-link text-white">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#people-circle" />
                        </svg>
                        Profile
                    </a>
                </li>
                <li>
                    <a href="DataProduct_Manajer.php" class="nav-link text-white">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#product" />
                        </svg>
                        Product
                    </a>
                </li>
                <li class="nav-item">
                    <a href="DataSales_Manajer.php" class="nav-link text-white" aria-current="page">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#people" />
                        </svg>
                        Sales
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link active">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#book" />
                        </svg>
                        Report
                    </a>
                </li>
                <li>
                    <a href="#" class="nav-link text-white">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#gem" />
                        </svg>
                        Customers
                    </a>
                </li>
                <li>
                    <a href="manager_show_all_activity.php" class="nav-link text-white">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#activity" />
                        </svg>
                        Sales Activities
                    </a>
                </li>
                <li>
                    <a href="manager_show_order.php" class="nav-link text-white">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#basket" />
                        </svg>
                        Orders
                    </a>
                </li>
                <li>
                    <a href="logout_manajer.php" class="nav-link text-white">
                        <svg class="bi me-2" width="16" height="16">
                            <use xlink:href="#door" />
                        </svg>
                        Logout
                    </a>
                </li>
            </ul>
        </nav>

        <!-- <div class="col-md-9 col-lg-8 m-3"> -->
        <div class="p-3" style="margin-left: 20%;width:80%; position: static;">
            <div class="container pt-5 pb-5">
                <div class="row">
                    <div class="col-12 col-md-6 selectedlaporan">
                        <div class="d-flex justify-content-md-end justify-content-center">
                            <a class="containeropsi d-flex justify-content-center selectedopsi align-items-center" href="#">
                                Laporan Penjualan Sales
                            </a>

                        </div>
                    </div>
                    <div class="col-12 col-md-6 selectedlaporan">
                        <div class="d-flex justify-content-md-start justify-content-center mt-3 mt-md-0">
                            <a class="containeropsi d-flex justify-content-center my-auto align-items-center" href="laporansales.php">
                                Laporan Target Sales
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-5 d-flex justify-content-center">
                        <h1>Sales App</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        <h4>Laporan Penjualan Sales</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="d-flex justify-content-center justify-content-md-end mt-4">
                            <label class="ml-md-4 mr-2 d-flex align-items-center">Dari:</label>
                            <input type="date" id="tanggalmulai" name="tanggalmulai">
                            <!-- <label class="ml-4 mr-2 d-flex align-items-center">Sampai:</label>
                    <input type="date" id="tanggalsampai" name="tanggalsampai">
                    <button type="button" class="btn btn-outline-secondary ml-4" id="updatebutton" onclick="load_data()">Update Tanggal</button> -->
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="d-flex justify-content-center justify-content-md-start mt-4">
                            <label class="ml-md-4 mr-2 d-flex align-items-center">Sampai:</label>
                            <input type="date" id="tanggalsampai" name="tanggalsampai">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="d-flex justify-content-center mt-3">
                            <button type="button" class="btn btn-outline-secondary ml-md-4" id="updatebutton" onclick="updatetanggal()">Update Tanggal</button>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12 d-flex justify-content-center">
                        <table cellpadding="3" cellspacing="0" border="0" style="width: 67%; margin: 0 auto 2em auto;">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th class="d-flex justify-content-center">Search</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="filter_global">
                                    <td class="d-flex justify-content-end">Global search</td>
                                    <td align="center"><input type="text" class="global_filter" id="global_filter"></td>
                                </tr>
                                <!-- <tr id="filter_col1" data-column="0">
                        <td class="d-flex justify-content-end">Column - Name</td>
                        <td align="center"><input type="text" class="column_filter" id="col0_filter"></td>
                    </tr> -->
                                <tr id="filter_col2" data-column="1">
                                    <td class="d-flex justify-content-end">Nama Sales</td>
                                    <td align="center"><input type="text" class="column_filter" id="col1_filter"></td>
                                </tr>
                                <tr id="filter_col3" data-column="2">
                                    <td class="d-flex justify-content-end">Nama Costumer</td>
                                    <td align="center"><input type="text" class="column_filter" id="col2_filter"></td>
                                </tr>
                                <!-- <tr id="filter_col4" data-column="3">
                        <td class="d-flex justify-content-end">Tanggal Order</td>
                        <td align="center"><input type="text" class="column_filter" id="col3_filter"></td>
                    </tr>
                    <tr id="filter_col5" data-column="4">
                        <td class="d-flex justify-content-end">Tanggal Jatuh Tempo</td>
                        <td align="center"><input type="text" class="column_filter" id="col4_filter"></td>
                    </tr> -->
                                <tr id="filter_col6" data-column="6">
                                    <td class="d-flex justify-content-end">Status Order</td>
                                    <td align="center">
                                        <select id="dropdown1">
                                            <option value=""></option>
                                            <option value="Terbayar">Terbayar</option>
                                            <option value="Belum Terbayar">Belum Terbayar</option>
                                        </select>
                                    </td>
                                    <!-- <td class="d-flex justify-content-end">Status Order</td>
                                    <td align="center"><input type="text" class="column_filter" id="col6_filter"></td> -->
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <table id="tablelaporan" class="table table-striped table-hover" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Sales</th>
                                    <th>Nama Customer</th>
                                    <th>Tanggal Order</th>
                                    <th>Tanggal Jatuh Tempo</th>
                                    <th>Total Harga(Rp)</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        <h4>Total Seluruh Pendapatan: <span id="totalpendapatan"></span></h4>
                    </div>
                </div>


                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        <div id="piechart"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        <button type="button" class="btn btn-primary" id="downloadbutton" onclick="HTMLtoPDF()">Download as PDF</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        var test = 10;
        var selector = "";
        var angkaselector = "";

        function updatependapatan() {
            var sum = 0;
            $('#tablelaporan tbody tr').each(function(i, tr) {
                var val = parseInt($(tr).find("td:nth-child(6)").text().replace(/,/g, ''));
                sum += val;
            });
            // var sum = $('#tablelaporan').DataTable().rows({filter:'applied'}).column(5).data().sum();
            $('#totalpendapatan').html(sum.toLocaleString());

        }
        //function to sort each column
        function comparer(index) {
            return function(a, b) {
                var valA = getCellValue(a, index),
                    valB = getCellValue(b, index)
                return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.toString().localeCompare(valB)
            }
        }

        function getCellValue(row, index) {
            return $(row).children('td').eq(index).text()
        }

        function filterGlobal() {
            $('#tablelaporan').DataTable().search(
                $('#global_filter').val(),
                false,
                true
            ).draw();
            google.charts.setOnLoadCallback(drawChartsalesman);
            updatependapatan();
        }

        function filterColumn(i) {
            $('#tablelaporan').DataTable().column(i).search(
                $('#col' + i + '_filter').val(),
                false,
                true
            ).draw();
            google.charts.setOnLoadCallback(drawChartsalesman);
            updatependapatan();
        }

        //add commas to string


        function updatetanggal(){
            load_data();
            //reset all filter
            $('#global_filter').val('');
            $('#col1_filter').val('');
            $('#col2_filter').val('');
            $('#dropdown1').val('');
        }

        function load_data() {
            $('#dropdown1').on('change', function() {
                console.log(this.value);
                $('#tablelaporan').DataTable().columns(6).search($(this).val()).draw();
            });
            // console.log("loading data");
            var tanggal_mulai_order = $('#tanggalmulai').val();
            var tanggal_selesai_order = $('#tanggalsampai').val();
            // console.log(tanggal_mulai_order);
            // console.log(tanggal_selesai_order);
            var today = new Date();
            var dulu = new Date();
            tanggal_selesai_order = tanggal_selesai_order || today.getFullYear() + '/' + (today.getMonth() + 1) + '/' + today.getDate();
            today = new Date(tanggal_selesai_order);
            dulu.setDate(today.getDate());
            dulu.setMonth(today.getMonth());
            dulu.setYear(today.getFullYear() - 2);

            //format date
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();

            hariini = yyyy + '-' + mm + '-' + dd;


            tanggal_mulai_order = tanggal_mulai_order || dulu.getFullYear() + '/' + (dulu.getMonth() + 1) + '/' + dulu.getDate();
            dulu = new Date(tanggal_mulai_order);

            //format date buat sampai
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1).padStart(2, '0');
            var yyyy = today.getFullYear();
            sampaihari = yyyy + '-' + mm + '-' + dd;
            //format date buat dari
            dd = String(dulu.getDate()).padStart(2, '0');
            mm = String(dulu.getMonth() + 1).padStart(2, '0');
            yyyy = dulu.getFullYear();
            darihari = yyyy + '-' + mm + '-' + dd;

            $('#tanggalsampai').val(hariini);
            $('#tanggalmulai').val(darihari);

            tanggal_mulai_order = dulu.getFullYear() + '/' + (dulu.getMonth() + 1) + '/' + dulu.getDate();
            tanggal_selesai_order = today.getFullYear() + '/' + (today.getMonth() + 1) + '/' + today.getDate();



            $.ajax({
                url: "services/getlaporan.php",
                method: "POST",
                data: {
                    tanggal_mulai_order: tanggal_mulai_order,
                    tanggal_selesai_order: tanggal_selesai_order
                },
                success: function(data) {
                    $('#tablelaporan tbody').html('');
                    $('#tablelaporan').dataTable().fnClearTable();
                    $('#tablelaporan').dataTable().fnDestroy();
                    var co = 1;
                    html = "";
                    var i;
                    data.forEach(function(line) {
                        var stats = "Terbayar"
                        if (line['status_order'] == "0") {
                            stats = "Belum Terbayar"
                        }
                        var row = $("<tr></tr>");
                        var col1 = $("<td>" + line['id_order'] + "</td>");
                        var col2 = $("<td>" + line['nama_sales'] + "</td>");
                        var col3 = $("<td>" + line['nama_customer'] + "</td>");
                        var col4 = $("<td>" + line['tanggal_order'] + "</td>");
                        var col5 = $("<td>" + line['tanggal_jatuh_tempo'] + "</td>");
                        var col6 = $("<td>" + line['total_harga'].toLocaleString() + "</td>");
                        var col7 = $("<td>" + stats + "</td>");
                        col1.appendTo(row);
                        col2.appendTo(row);
                        col3.appendTo(row);
                        col4.appendTo(row);
                        col5.appendTo(row);
                        col6.appendTo(row);
                        col7.appendTo(row);
                        $("#tablelaporan tbody").append(row);
                        html += row;

                    })
                    $('#tablelaporan').DataTable({
                        dom: 'lrtip',
                        // "processing": true,
                        // "serverSide": false,
                        // "stateSave": true,
                        "autoWidth": false,
                        "scrollX": true
                    });
                    google.charts.setOnLoadCallback(drawChartsalesman);
                    updatependapatan();
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }



        $(document).ready(function() {
            // $('#tablelaporan').DataTable();
            load_data();
            // var oTable = $('#tablelaporan').DataTable({
            //     "columnDefs": [{
            //         "targets": [1, 2, 3, 4, 5, 6, 7, 8],
            //         "searchable": false
            //     }]
            // });


            google.charts.load('current', {
                'packages': ['corechart']
            });
            // google.charts.setOnLoadCallback(drawChartsalesman);

            // $("#myInput").on("keyup", function() {
            //     var value = $(this).val().toLowerCase();
            //     $("#tablelaporan tbody tr").filter(function() {
            //         $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            //     });
            // });



            // $('#tablelaporan tfoot th').each(function() {
            //     var title = $(this).text();
            //     $(this).html('<input type="text" placeholder="Search ' + title + '" />');
            // });

            // // DataTable
            // var table = $('#tablelaporan').DataTable({
            //     initComplete: function() {
            //         // Apply the search
            //         this.api().columns().every(function() {
            //             var that = this;

            //             $('input', this.footer()).on('keyup change clear', function() {
            //                 if (that.search() !== this.value) {
            //                     that
            //                         .search(this.value)
            //                         .draw();
            //                 }
            //             });
            //         });
            //     }
            // });

            //individual search
            $('input.global_filter').on('keyup click', function() {
                filterGlobal();
            });

            $('input.column_filter').on('keyup click', function() {
                filterColumn($(this).parents('tr').attr('data-column'));
            });





            // function filterRows() {
            //     var from = $('#tanggalmulai').val();
            //     var to = $('#tanggalsampai').val();

            //     if (!from && !to) { // no value for from and to
            //         return;
            //     }

            //     from = from || '1970/01/01'; // default from to a old date if it is not set
            //     to = to || '2999/12/31';

            //     var dateFrom = moment(from);
            //     var dateTo = moment(to);

            //     $('#tablelaporan tbody tr').each(function(i, tr) {
            //         var val = $(tr).find("td:nth-child(5)").text();
            //         console.log(val)
            //         var dateVal = moment(val, "DD/MM/YYYY");
            //         var visible = (dateVal.isBetween(dateFrom, dateTo, null, [])) ? "" : "none"; // [] for inclusive
            //         console.log(visible)
            //         $(tr).css('display', visible);
            //     });
            // }

            // function filterTabel() {
            //     var from = $('#tanggalmulai').val();
            //     var to = $('#tanggalsampai').val();


            //     to = to || moment(moment().toDate()).format('YYYY/MM/DD');
            //     from = from || to.subtract(2, 'years');

            //     var dateFrom = moment(from);
            //     var dateTo = moment(to);

            //     var rex = new RegExp($('#myInput').val(), 'i');

            //     $('#tablelaporan tbody tr').hide();
            //     $('#tablelaporan tbody tr').filter(function(i, v) {
            //         //filter tanggal
            //         var val = $(this).find("td:nth-child(4)").text();
            //         var dateVal = moment(val, "YYYY/MM/DD");
            //         var visible = (dateVal.isBetween(dateFrom, dateTo, null, [])) ? true : false;

            //         //filter nama
            //         var $t = $(this).children(":eq(" + "0" + ")");
            //         // console.log(visible);
            //         return rex.test($t.text()) && visible;
            //     }).show();

            //     google.charts.setOnLoadCallback(drawChartsalesman);

            // }
            // $('#tanggalmulai').on("change", filterTabel);
            // $('#tanggalsampai').on("change", filterTabel);


            // $('#myInput').keyup(filterTabel);

            // $('#myInput').keyup(function() {
            //     var from = $('#tanggalmulai').val();
            //     var to = $('#tanggalsampai').val();

            //     from = from || '1970-01-01'; // default from to a old date if it is not set
            //     to = to || '2999-12-31';

            //     var dateFrom = moment(from);
            //     var dateTo = moment(to);

            //     var rex = new RegExp($(this).val(), 'i');
            //     $('#tablelaporan tbody tr').hide();
            //     $('#tablelaporan tbody tr').filter(function(i, v) {
            //         //filter tanggal
            //         var val = $(this).find("td:nth-child(5)").text();
            //         var dateVal = moment(val, "DD/MM/YYYY");
            //         var visible = (dateVal.isBetween(dateFrom, dateTo, null, [])) ? true : false;

            //         //filter nama
            //         var $t = $(this).children(":eq(" + "0" + ")");
            //         return rex.test($t.text()) && visible;
            //     }).show();

            //     // //ini untuk mengakses table yang aktif(setelah filter)
            //     // jQuery.each($('#tablelaporan tbody tr'), function(i, val) {
            //     //     if ($(this).css('display') != 'none') {
            //     //         console.log(i);
            //     //     }
            //     // })
            // })

            //filter bulan/tahun
            // $(document).on('change', '#selectortahun', function() {
            //     $("#selectorbulan option").remove();
            //     var value = $(this).find(":selected").html();
            //     selector = value;
            //     if (value == "Bulan") {
            //         for (let i = 1; i <= 12; i++) {
            //             $("#selectorbulan").append(
            //                 `
            //                 <option>${i}</option>
            //                 `
            //             )
            //         }
            //     } else if (value == "Tahun") {
            //         for (let i = 1960; i <= 2021; i++) {
            //             $("#selectorbulan").append(
            //                 `
            //                 <option>${i}</option>
            //                 `
            //             )
            //         }
            //     } else {
            //         $("#selectorbulan").append(
            //             `
            //                 <option>Select Selector</option>
            //                 `
            //         )
            //     }
            // });

            //table sorting
            $('th').click(function() {
                var table = $(this).parents('table').eq(0)
                var rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()))
                this.asc = !this.asc
                if (!this.asc) {
                    rows = rows.reverse()
                }
                for (var i = 0; i < rows.length; i++) {
                    table.append(rows[i])
                }
            })


            // $(document).on('change', '#selectorbulan', function() {
            //     var value = $(this).find(":selected").html();
            //     angkaselector = value;
            //     console.log(selector.toString() + " " + angkaselector.toString());
            // });

            //download as pdf
            // $("#downloadbutton").click(function(){
            //     var tabel=$("#tablelaporan").html();
            //     console.log(tabel);
            //     html2pdf().from(invoice);
            // });



        });

        //buat chart
        function drawChartsalesman() {
            var arr = [];
            var arr2 = [
                ['Name', 'Deal']
            ]
            $("#tablelaporan tbody tr td:nth-child(2)").each(function() {
                if ($.inArray($(this).text(), arr) == -1)
                    arr.push($(this).text());
            });
            $.each(arr, function(index, value) {
                var many = $('#tablelaporan tbody tr').filter(function(index2, value2) {
                    return $(value2).find('td:nth-child(2)').html() == value
                }).length;
                arr2.push([value, many]);
            });
            var data = google.visualization.arrayToDataTable(arr2);

            // Optional; add a title and set the width and height of the chart
            var options = {
                'title': 'Salesman Productivity Percentage',
                'width': 550,
                'height': 400
            };

            // Display the chart inside the <div> element with id="piechart"
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            google.visualization.events.addListener(chart, 'ready', function() {
                var content = '<img style="display:none" src="' + chart.getImageURI() + '">';
                $('#piechart').append(content);
            })
            chart.draw(data, options);
        }

        //function download html to PDF
        function HTMLtoPDF() {
            var lengthnow = $('.dataTables_length select').val();
            var table = $('#tablelaporan').DataTable();
            table.page.len(1000).draw();
            var from = $('#tanggalmulai').val();
            var to = $('#tanggalsampai').val();

            from = from || '1970/01/01';
            to = to || moment(moment().toDate()).format('YYYY/MM/DD');

            var dateFrom = moment(from);
            var dateTo = moment(to);


            window.jsPDF = window.jspdf.jsPDF;
            window.html2canvas = html2canvas

            var doc = new jsPDF('p', 'pt', 'a4');
            //print table
            doc.setFontSize(25);
            var text = "Laporan PT.Sales App";
            var xOffset = (doc.internal.pageSize.width / 2) - (doc.getStringUnitWidth(text) * doc.internal.getFontSize() / 2);
            doc.setFontSize(15)
            var texttanggal = from + " - " + to;
            var xOffset2 = (doc.internal.pageSize.width / 2) - (doc.getStringUnitWidth(texttanggal) * doc.internal.getFontSize() / 2);

            doc.setFontSize(25);
            doc.text(text, xOffset, 75);
            doc.setFontSize(15)
            doc.text(texttanggal, xOffset2, 90)
            doc.autoTable({
                html: '#tablelaporan',
                startY: 115
            });

            //jumlah penjualan
            var jumlahtotal = $('#totalpendapatan').html();
            doc.autoTable({
                html: '#table'
            });
            let finalY = doc.lastAutoTable.finalY; // The y position on the page
            doc.text(43, finalY, "Total Penjualan: " + jumlahtotal);

            //print image
            var img = $("#piechart img");
            var chart1 = img.attr('src');
            doc.addPage();
            doc.addImage(chart1, 'png', 0, 0, parseInt(img.width), parseInt(img.height), undefined, 'none');
            //convert to pdf
            var savename = "LaporanSales_" + from + " - " + to + ".pdf";
            doc.save(savename);
            // table.page.len(lengthnow).draw();





            // html2canvas(document.querySelector("#capture")).then(canvas => {
            //     var img=canvas.toDataURL("image/png");
            //     var doc=new jsPDF();
            //     doc.addImage(img,'PNG',20);
            //     doc.save("test.pdf");
            // });





            // // var pdf = new jsPDF();
            // // Default export is a4 paper, portrait, using millimeters for units
            // const doc = new jsPDF();
            // // var tabel = $("#tablelaporan").html();

            // doc.text("Hello world!", 10, 10);
            // doc.save("a4.pdf");




            // 
            // const doc = document.getElementsByTagName('div')[0];

            // if (doc) {
            //     console.log("div is ");
            //     console.log(doc);
            //     console.log("hellowww");



            //     pdf.html($("#tablelaporan").html(), {
            //         callback: function(pdf) {
            //             pdf.save('DOC.pdf');
            //         }
            //     })
            // }
        }

        //chart resizing
        $(window).resize(function() {
            console.log('resize');
            drawChartsalesman();
        });
    </script>
    <style>
        #tablelaporan th {
            cursor: pointer;
        }

        .containeropsi {
            width: 200px;
            cursor: pointer;
            border: 3px solid rgb(97, 163, 214);
            color: black;
            border-radius: 10px;
            height: 50px;
            transition: ease .5s;
        }

        .containeropsi.selectedopsi {
            color: white;
            background: rgb(97, 163, 214);
        }

        .containeropsi:hover {
            text-decoration: none;
            background-color: rgb(97, 163, 214);
            color: white;
            transition: ease .5s;
        }

        .table {
            margin-bottom: 0px !important;
        }

        #dropdown1{
            width: 189px;
            height: 30px;
        }
    </style>
</body>

</html>