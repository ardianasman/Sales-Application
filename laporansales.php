<?php
include "services/database.php";

// if (isset($_SESSION['email'])) {
// 	$usersql = "SELECT * FROM user WHERE email = ?";
// 	$userstmt = $pdo->prepare($usersql);
// 	$userstmt->execute([$_SESSION['email']]);
// 	$user = $userstmt->fetch();
// 	$admin=false;
// 	$loggedin = true;
// 	if($user['email']=="admin@bajuku.com"){
// 		$admin=true;
// 	}
// } else {
// 	$loggedin = false;
// 	$admin=false;
// 	header("Location: home.php");
// 	// exit();
// }

// if (isset($_GET['status'])) {
// 	$status = $_GET['status'];
// 	if ($status == 10) {
// 		echo "<script>alert('Sign Up Successful!')</script>";
// 	}
// 	if ($status == 20) {
// 		echo "<script>alert('Transaction Successful!')</script>";
// 	}
// 	if ($status == 30) {
// 		echo "<script>alert('Transaction Failed!')</script>";
// 	}
// }

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.20/jspdf.plugin.autotable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <!-- <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script> -->
    <script src="    https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.19/api/sum().js"></script>
    <link rel="stylesheet" type="text/css" href="css/navbar.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
                <a class="nav-item nav-link " href="#">Activity</a>
                <a class="nav-item nav-link" href="#">Customer</a>
                <a class="nav-item nav-link active" href="laporan.php">Laporan</a>
                <a class="nav-item nav-link" href="logout.php">Logout</a>
            </div>
        </div>
    </nav>
    <div class="container pt-5 pb-5">
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <h1>Sales App</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <h4>Laporan Target Sales</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="d-flex justify-content-center mt-4">
                    <div class="input-group mb-3" style="width:50%;">
                        <select class="custom-select" id="inputbulan">
                            <option value="1">Januari</option>
                            <option value="2">Febuari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                        <select class="custom-select ml-3" id="inputtahun">

                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <!-- <input class="form-control" id="myInput" type="text" placeholder="Masukan Nama..."> -->
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-primary ml-4" id="updatebutton" onclick="load_data()">Update Tanggal</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <table cellpadding="3" cellspacing="0" border="0" style="width: 67%; margin: 0 auto 2em auto;">
                    <thead>
                        <tr>
                            <th></th>
                            <th class="d-flex justify-content-center">Search text</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <tr id="filter_global">
                            <td class="d-flex justify-content-end">Global search</td>
                            <td align="center"><input type="text" class="global_filter" id="global_filter"></td>
                        </tr> -->
                        <!-- <tr id="filter_col1" data-column="0">
                        <td class="d-flex justify-content-end">Column - Name</td>
                        <td align="center"><input type="text" class="column_filter" id="col0_filter"></td>
                    </tr> -->
                        <tr id="filter_col2" data-column="1">
                            <td class="d-flex justify-content-end">Nama Sales</td>
                            <td align="center"><input type="text" class="column_filter" id="col1_filter"></td>
                        </tr>
                        <tr id="filter_col3" data-column="3">
                            <td class="d-flex justify-content-end">Status</td>
                            <td align="center">
                                <select id="dropdown1">
                                    <option value=""></option>
                                    <option value="Sudah Terpenuhi">Sudah Terpenuhi</option>
                                    <option value="Belum Terpenuhi">Belum Terpenuhi</option>
                                </select>
                            </td>

                        </tr>
                        <!-- <tr id="filter_col4" data-column="3">
                        <td class="d-flex justify-content-end">Tanggal Order</td>
                        <td align="center"><input type="text" class="column_filter" id="col3_filter"></td>
                    </tr>
                    <tr id="filter_col5" data-column="4">
                        <td class="d-flex justify-content-end">Tanggal Jatuh Tempo</td>
                        <td align="center"><input type="text" class="column_filter" id="col4_filter"></td>
                    </tr> -->
                        <!-- <tr id="filter_col6" data-column="6">
                            <td class="d-flex justify-content-end">Status Order</td>
                            <td align="center"><input type="text" class="column_filter" id="col6_filter"></td>
                        </tr> -->
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
                            <th>Target</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <h4>Total Seluruh Pendapatan: <span id="totalpendapatan"></span></h4>
            </div>
        </div> -->


        <!-- <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <div id="piechart"></div>
            </div>
        </div> -->

        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <button type="button" class="btn btn-primary ms-4" id="downloadbutton" onclick="HTMLtoPDF()">Download as PDF</button>
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
        }

        function filterColumn(i) {
            $('#tablelaporan').DataTable().column(i).search(
                $('#col' + i + '_filter').val(),
                false,
                true
            ).draw();
        }

        function filterterpenuhi() {
            $('#tablelaporan').DataTable().column(3).data(
                $('#col' + i + '_filter').val(),
                false,
                true
            ).draw();
        }

        //add opsi Tahun
        function addopsi() {
            var thisyear = new Date().getFullYear();
            var thismonth = new Date().getMonth();
            for (let i = thisyear - 50; i <= thisyear; i++) {
                var o = new Option(i, i);
                $(o).html(i);
                $("#inputtahun").append(o);
            }
            $('#inputbulan').val(thismonth);
            $('#inputtahun').val(thisyear);
        }

        function load_data() {
            $('#dropdown1').on('change', function() {
                console.log(this.value);
                $('#tablelaporan').DataTable().columns(3).search($(this).val()).draw();
            });

            var bulan = $('#inputbulan').val();
            var tahun = $('#inputtahun').val();
            console.log('hello')
            $.ajax({
                url: "services/gettargetsales.php",
                method: "POST",
                data: {
                    bulan: bulan,
                    tahun: tahun
                },
                success: function(data) {
                    console.log("hello2");
                    $('#tablelaporan tbody').html('');
                    $('#tablelaporan').dataTable().fnClearTable();
                    $('#tablelaporan').dataTable().fnDestroy();
                    var co = 1;
                    html = "";
                    var i;
                    data.forEach(function(line) {
                        var row = $("<tr></tr>");
                        var col1 = $("<td>" + co + "</td>");
                        var col2 = $("<td>" + line['nama'] + "</td>");
                        var col3 = $("<td>" + line['target'].toLocaleString() + "</td>");
                        stats = 'Sudah Terpenuhi';
                        if (line['status'] == 0) {
                            stats = 'Belum Terpenuhi';
                        }
                        var col4 = $("<td>" + stats + "</td>");
                        col1.appendTo(row);
                        col2.appendTo(row);
                        col3.appendTo(row);
                        col4.appendTo(row);
                        co++;
                        $("#tablelaporan tbody").append(row);
                        html += row;

                    })
                    $('#tablelaporan').DataTable({
                        dom: 'lrtip',
                        "autoWidth": false
                    });
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }



        $(document).ready(function() {
            addopsi();
            load_data();


            google.charts.load('current', {
                'packages': ['corechart']
            });
            // google.charts.setOnLoadCallback(drawChartsalesman);


            //individual search
            $('input.global_filter').on('keyup click', function() {
                filterGlobal();
            });

            $('input.column_filter').on('keyup click', function() {
                filterColumn($(this).parents('tr').attr('data-column'));
            });


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
            // var lengthnow = $('.dataTables_length select').val();
            // var table = $('#tablelaporan').DataTable();
            // table.page.len(1000).draw();
            // var from = $('#tanggalmulai').val();
            // var to = $('#tanggalsampai').val();

            // from = from || '1970/01/01';
            // to = to || moment(moment().toDate()).format('YYYY/MM/DD');

            // var dateFrom = moment(from);
            // var dateTo = moment(to);
            var bulan=$('#inputbulan').find(":selected").text();;
            var tahun=$('#inputtahun').val();

            window.jsPDF = window.jspdf.jsPDF;
            window.html2canvas = html2canvas

            var doc = new jsPDF('p', 'pt', 'a4');
            //print table
            doc.setFontSize(25);
            var text = "Laporan PT.Sales App";
            var xOffset = (doc.internal.pageSize.width / 2) - (doc.getStringUnitWidth(text) * doc.internal.getFontSize() / 2);
            doc.setFontSize(15)
            var texttanggal = "Target Sales Bulan "+bulan+" Tahun "+tahun;
            var xOffset2 = (doc.internal.pageSize.width / 2) - (doc.getStringUnitWidth(texttanggal) * doc.internal.getFontSize() / 2);

            doc.setFontSize(25);
            doc.text(text, xOffset, 75);
            doc.setFontSize(15)
            doc.text(texttanggal, xOffset2, 95)
            doc.autoTable({
                html: '#tablelaporan',
                startY: 115
            });

            // //jumlah penjualan
            // var jumlahtotal = $('#totalpendapatan').html();
            // doc.autoTable({
            //     html: '#table'
            // });
            // let finalY = doc.lastAutoTable.finalY; // The y position on the page
            // doc.text(43, finalY, "Total Penjualan: " + jumlahtotal);

            // //print image
            // var img = $("#piechart img");
            // var chart1 = img.attr('src');
            // doc.addPage();
            // doc.addImage(chart1, 'png', 0, 0, parseInt(img.width), parseInt(img.height), undefined, 'none');
            //convert to pdf
            var savename="LaporanTarget"+bulan+tahun+".pdf";
            doc.save(savename);

        }
    </script>

</body>
<style>
    #tablelaporan th {
        cursor: pointer;
    }
</style>

</html>