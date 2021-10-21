<?php
include "../services/database.php";

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.20/jspdf.plugin.autotable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<body>
    <div class="container pt-5 pb-5" id="capture">
        <div class="col-12">
            <!-- <input class="form-control" id="myInput" type="text" placeholder="Masukan Nama..."> -->
            <div class="d-flex justify-content-center mt-4">
                <label class="ms-4 me-2 d-flex align-items-center">Dari:</label>
                <!-- <select id="selectortahun">
                    <option></option>
                    <option>Tahun</option>
                    <option>Bulan</option>
                </select>
                <label class="mx-2">Pilih:</label>
                <select id="selectorbulan">
                    <option>Select selector</option>
                </select> -->
                <input type="date" id="tanggalmulai" name="tanggalmulai">
                <label class="ms-4 me-2 d-flex align-items-center">Sampai:</label>
                <input type="date" id="tanggalsampai" name="tanggalsampai">
                <!-- <button type="button" class="btn btn-primary ms-4" id="datefilterbutton">Filter</button> -->
                <button type="button" class="btn btn-primary ms-4" id="downloadbutton" onclick="HTMLtoPDF()">Download as PDF</button>
            </div>

        </div>
        

        <div class="col-12 d-flex justify-content-center">
            <table cellpadding="3" cellspacing="0" border="0" style="width: 67%; margin: 0 auto 2em auto;">
                <thead>
                    <tr>
                        <th></th>
                        <th class="d-flex justify-content-center">Search text</th>
                    </tr>
                </thead>
                <tbody>
                    <tr id="filter_global">
                        <td class="d-flex justify-content-end">Global search</td>
                        <td align="center"><input type="text" class="global_filter" id="global_filter"></td>
                    </tr>
                    <tr id="filter_col1" data-column="0">
                        <td class="d-flex justify-content-end">Column - Name</td>
                        <td align="center"><input type="text" class="column_filter" id="col0_filter"></td>
                    </tr>
                    <tr id="filter_col2" data-column="1">
                        <td class="d-flex justify-content-end">Column - Position</td>
                        <td align="center"><input type="text" class="column_filter" id="col1_filter"></td>
                    </tr>
                    <tr id="filter_col3" data-column="2">
                        <td class="d-flex justify-content-end">Column - Office</td>
                        <td align="center"><input type="text" class="column_filter" id="col2_filter"></td>
                    </tr>
                    <tr id="filter_col4" data-column="3">
                        <td class="d-flex justify-content-end">Column - Age</td>
                        <td align="center"><input type="text" class="column_filter" id="col3_filter"></td>
                    </tr>
                    <tr id="filter_col5" data-column="4">
                        <td class="d-flex justify-content-end">Column - Start date</td>
                        <td align="center"><input type="text" class="column_filter" id="col4_filter"></td>
                    </tr>
                    <tr id="filter_col6" data-column="5">
                        <td class="d-flex justify-content-end">Column - Salary</td>
                        <td align="center"><input type="text" class="column_filter" id="col5_filter"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-12 d-flex justify-content-center">
            <table id="tablelaporan" class="table table-striped table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Age</th>
                        <th>Start date</th>
                        <th>Salary</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Tiger Nixon</td>
                        <td>System Architect</td>
                        <td>Edinburgh</td>
                        <td>61</td>
                        <td>2011/04/25</td>
                        <td>$320,800</td>
                    </tr>
                    <tr>
                        <td>Garrett Winters</td>
                        <td>Accountant</td>
                        <td>Tokyo</td>
                        <td>63</td>
                        <td>2011/07/25</td>
                        <td>$170,750</td>
                    </tr>
                    <tr>
                        <td>Ashton Cox</td>
                        <td>Junior Technical Author</td>
                        <td>San Francisco</td>
                        <td>66</td>
                        <td>2009/01/12</td>
                        <td>$86,000</td>
                    </tr>
                    <tr>
                        <td>Cedric Kelly</td>
                        <td>Senior Javascript Developer</td>
                        <td>Edinburgh</td>
                        <td>22</td>
                        <td>2012/03/29</td>
                        <td>$433,060</td>
                    </tr>
                    <tr>
                        <td>Airi Satou</td>
                        <td>Accountant</td>
                        <td>Tokyo</td>
                        <td>33</td>
                        <td>2008/11/28</td>
                        <td>$162,700</td>
                    </tr>
                    <tr>
                        <td>Brielle Williamson</td>
                        <td>Integration Specialist</td>
                        <td>New York</td>
                        <td>61</td>
                        <td>2012/12/02</td>
                        <td>$372,000</td>
                    </tr>
                    <tr>
                        <td>Herrod Chandler</td>
                        <td>Sales Assistant</td>
                        <td>San Francisco</td>
                        <td>59</td>
                        <td>2012/08/06</td>
                        <td>$137,500</td>
                    </tr>
                    <tr>
                        <td>Rhona Davidson</td>
                        <td>Integration Specialist</td>
                        <td>Tokyo</td>
                        <td>55</td>
                        <td>2010/10/14</td>
                        <td>$327,900</td>
                    </tr>
                    <tr>
                        <td>Colleen Hurst</td>
                        <td>Javascript Developer</td>
                        <td>San Francisco</td>
                        <td>39</td>
                        <td>2009/09/15</td>
                        <td>$205,500</td>
                    </tr>
                    <tr>
                        <td>Sonya Frost</td>
                        <td>Software Engineer</td>
                        <td>Edinburgh</td>
                        <td>23</td>
                        <td>2008/12/13</td>
                        <td>$103,600</td>
                    </tr>
                    <tr>
                        <td>Jena Gaines</td>
                        <td>Office Manager</td>
                        <td>London</td>
                        <td>30</td>
                        <td>2008/12/19</td>
                        <td>$90,560</td>
                    </tr>
                    <tr>
                        <td>Quinn Flynn</td>
                        <td>Support Lead</td>
                        <td>Edinburgh</td>
                        <td>22</td>
                        <td>2013/03/03</td>
                        <td>$342,000</td>
                    </tr>
                    <tr>
                        <td>Charde Marshall</td>
                        <td>Regional Director</td>
                        <td>San Francisco</td>
                        <td>36</td>
                        <td>2008/10/16</td>
                        <td>$470,600</td>
                    </tr>
                    <tr>
                        <td>Haley Kennedy</td>
                        <td>Senior Marketing Designer</td>
                        <td>London</td>
                        <td>43</td>
                        <td>2012/12/18</td>
                        <td>$313,500</td>
                    </tr>
                    <tr>
                        <td>Tatyana Fitzpatrick</td>
                        <td>Regional Director</td>
                        <td>London</td>
                        <td>19</td>
                        <td>2010/03/17</td>
                        <td>$385,750</td>
                    </tr>
                    <tr>
                        <td>Michael Silva</td>
                        <td>Marketing Designer</td>
                        <td>London</td>
                        <td>66</td>
                        <td>2012/11/27</td>
                        <td>$198,500</td>
                    </tr>
                    <tr>
                        <td>Paul Byrd</td>
                        <td>Chief Financial Officer (CFO)</td>
                        <td>New York</td>
                        <td>64</td>
                        <td>2010/06/09</td>
                        <td>$725,000</td>
                    </tr>
                    <tr>
                        <td>Gloria Little</td>
                        <td>Systems Administrator</td>
                        <td>New York</td>
                        <td>59</td>
                        <td>2009/04/10</td>
                        <td>$237,500</td>
                    </tr>
                    <tr>
                        <td>Bradley Greer</td>
                        <td>Software Engineer</td>
                        <td>London</td>
                        <td>41</td>
                        <td>2012/10/13</td>
                        <td>$132,000</td>
                    </tr>
                    <tr>
                        <td>Dai Rios</td>
                        <td>Personnel Lead</td>
                        <td>Edinburgh</td>
                        <td>35</td>
                        <td>2012/09/26</td>
                        <td>$217,500</td>
                    </tr>
                    <tr>
                        <td>Jenette Caldwell</td>
                        <td>Development Lead</td>
                        <td>New York</td>
                        <td>30</td>
                        <td>2011/09/03</td>
                        <td>$345,000</td>
                    </tr>
                    <tr>
                        <td>Yuri Berry</td>
                        <td>Chief Marketing Officer (CMO)</td>
                        <td>New York</td>
                        <td>40</td>
                        <td>2009/06/25</td>
                        <td>$675,000</td>
                    </tr>
                    <tr>
                        <td>Caesar Vance</td>
                        <td>Pre-Sales Support</td>
                        <td>New York</td>
                        <td>21</td>
                        <td>2011/12/12</td>
                        <td>$106,450</td>
                    </tr>
                    <tr>
                        <td>Doris Wilder</td>
                        <td>Sales Assistant</td>
                        <td>Sydney</td>
                        <td>23</td>
                        <td>2010/09/20</td>
                        <td>$85,600</td>
                    </tr>
                    <tr>
                        <td>Angelica Ramos</td>
                        <td>Chief Executive Officer (CEO)</td>
                        <td>London</td>
                        <td>47</td>
                        <td>2009/10/09</td>
                        <td>$1,200,000</td>
                    </tr>
                    <tr>
                        <td>Gavin Joyce</td>
                        <td>Developer</td>
                        <td>Edinburgh</td>
                        <td>42</td>
                        <td>2010/12/22</td>
                        <td>$92,575</td>
                    </tr>
                    <tr>
                        <td>Jennifer Chang</td>
                        <td>Regional Director</td>
                        <td>Singapore</td>
                        <td>28</td>
                        <td>2010/11/14</td>
                        <td>$357,650</td>
                    </tr>
                    <tr>
                        <td>Brenden Wagner</td>
                        <td>Software Engineer</td>
                        <td>San Francisco</td>
                        <td>28</td>
                        <td>2011/06/07</td>
                        <td>$206,850</td>
                    </tr>
                    <tr>
                        <td>Fiona Green</td>
                        <td>Chief Operating Officer (COO)</td>
                        <td>San Francisco</td>
                        <td>48</td>
                        <td>2010/03/11</td>
                        <td>$850,000</td>
                    </tr>
                    <tr>
                        <td>Shou Itou</td>
                        <td>Regional Marketing</td>
                        <td>Tokyo</td>
                        <td>20</td>
                        <td>2011/08/14</td>
                        <td>$163,000</td>
                    </tr>
                    <tr>
                        <td>Michelle House</td>
                        <td>Integration Specialist</td>
                        <td>Sydney</td>
                        <td>37</td>
                        <td>2011/06/02</td>
                        <td>$95,400</td>
                    </tr>
                    <tr>
                        <td>Suki Burks</td>
                        <td>Developer</td>
                        <td>London</td>
                        <td>53</td>
                        <td>2009/10/22</td>
                        <td>$114,500</td>
                    </tr>
                    <tr>
                        <td>Prescott Bartlett</td>
                        <td>Technical Author</td>
                        <td>London</td>
                        <td>27</td>
                        <td>2011/05/07</td>
                        <td>$145,000</td>
                    </tr>
                    <tr>
                        <td>Gavin Cortez</td>
                        <td>Team Leader</td>
                        <td>San Francisco</td>
                        <td>22</td>
                        <td>2008/10/26</td>
                        <td>$235,500</td>
                    </tr>
                    <tr>
                        <td>Martena Mccray</td>
                        <td>Post-Sales support</td>
                        <td>Edinburgh</td>
                        <td>46</td>
                        <td>2011/03/09</td>
                        <td>$324,050</td>
                    </tr>
                    <tr>
                        <td>Unity Butler</td>
                        <td>Marketing Designer</td>
                        <td>San Francisco</td>
                        <td>47</td>
                        <td>2009/12/09</td>
                        <td>$85,675</td>
                    </tr>
                    <tr>
                        <td>Howard Hatfield</td>
                        <td>Office Manager</td>
                        <td>San Francisco</td>
                        <td>51</td>
                        <td>2008/12/16</td>
                        <td>$164,500</td>
                    </tr>
                    <tr>
                        <td>Hope Fuentes</td>
                        <td>Secretary</td>
                        <td>San Francisco</td>
                        <td>41</td>
                        <td>2010/02/12</td>
                        <td>$109,850</td>
                    </tr>
                    <tr>
                        <td>Vivian Harrell</td>
                        <td>Financial Controller</td>
                        <td>San Francisco</td>
                        <td>62</td>
                        <td>2009/02/14</td>
                        <td>$452,500</td>
                    </tr>
                    <tr>
                        <td>Timothy Mooney</td>
                        <td>Office Manager</td>
                        <td>London</td>
                        <td>37</td>
                        <td>2008/12/11</td>
                        <td>$136,200</td>
                    </tr>
                    <tr>
                        <td>Jackson Bradshaw</td>
                        <td>Director</td>
                        <td>New York</td>
                        <td>65</td>
                        <td>2008/09/26</td>
                        <td>$645,750</td>
                    </tr>
                    <tr>
                        <td>Olivia Liang</td>
                        <td>Support Engineer</td>
                        <td>Singapore</td>
                        <td>64</td>
                        <td>2011/02/03</td>
                        <td>$234,500</td>
                    </tr>
                    <tr>
                        <td>Bruno Nash</td>
                        <td>Software Engineer</td>
                        <td>London</td>
                        <td>38</td>
                        <td>2011/05/03</td>
                        <td>$163,500</td>
                    </tr>
                    <tr>
                        <td>Sakura Yamamoto</td>
                        <td>Support Engineer</td>
                        <td>Tokyo</td>
                        <td>37</td>
                        <td>2009/08/19</td>
                        <td>$139,575</td>
                    </tr>
                    <tr>
                        <td>Thor Walton</td>
                        <td>Developer</td>
                        <td>New York</td>
                        <td>61</td>
                        <td>2013/08/11</td>
                        <td>$98,540</td>
                    </tr>
                    <tr>
                        <td>Finn Camacho</td>
                        <td>Support Engineer</td>
                        <td>San Francisco</td>
                        <td>47</td>
                        <td>2009/07/07</td>
                        <td>$87,500</td>
                    </tr>
                    <tr>
                        <td>Serge Baldwin</td>
                        <td>Data Coordinator</td>
                        <td>Singapore</td>
                        <td>64</td>
                        <td>2012/04/09</td>
                        <td>$138,575</td>
                    </tr>
                    <tr>
                        <td>Zenaida Frank</td>
                        <td>Software Engineer</td>
                        <td>New York</td>
                        <td>63</td>
                        <td>2010/01/04</td>
                        <td>$125,250</td>
                    </tr>
                    <tr>
                        <td>Zorita Serrano</td>
                        <td>Software Engineer</td>
                        <td>San Francisco</td>
                        <td>56</td>
                        <td>2012/06/01</td>
                        <td>$115,000</td>
                    </tr>
                    <tr>
                        <td>Jennifer Acosta</td>
                        <td>Junior Javascript Developer</td>
                        <td>Edinburgh</td>
                        <td>43</td>
                        <td>2013/02/01</td>
                        <td>$75,650</td>
                    </tr>
                    <tr>
                        <td>Cara Stevens</td>
                        <td>Sales Assistant</td>
                        <td>New York</td>
                        <td>46</td>
                        <td>2011/12/06</td>
                        <td>$145,600</td>
                    </tr>
                    <tr>
                        <td>Hermione Butler</td>
                        <td>Regional Director</td>
                        <td>London</td>
                        <td>47</td>
                        <td>2011/03/21</td>
                        <td>$356,250</td>
                    </tr>
                    <tr>
                        <td>Lael Greer</td>
                        <td>Systems Administrator</td>
                        <td>London</td>
                        <td>21</td>
                        <td>2009/02/27</td>
                        <td>$103,500</td>
                    </tr>
                    <tr>
                        <td>Jonas Alexander</td>
                        <td>Developer</td>
                        <td>San Francisco</td>
                        <td>30</td>
                        <td>2010/07/14</td>
                        <td>$86,500</td>
                    </tr>
                    <tr>
                        <td>Shad Decker</td>
                        <td>Regional Director</td>
                        <td>Edinburgh</td>
                        <td>51</td>
                        <td>2008/11/13</td>
                        <td>$183,000</td>
                    </tr>
                    <tr>
                        <td>Michael Bruce</td>
                        <td>Javascript Developer</td>
                        <td>Singapore</td>
                        <td>29</td>
                        <td>2011/06/27</td>
                        <td>$183,000</td>
                    </tr>
                    <tr>
                        <td>Donna Snider</td>
                        <td>Customer Support</td>
                        <td>New York</td>
                        <td>27</td>
                        <td>2011/01/25</td>
                        <td>$112,000</td>
                    </tr>
                </tbody>
                <!-- <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Age</th>
                        <th>Start date</th>
                        <th>Salary</th>
                    </tr>
                </tfoot> -->
            </table>
        </div>
        <div class="row">
            <div class="col-lg-6 col-12 d-flex justify-content-center">
                <div id="piechart"></div>
            </div>
        </div>
    </div>

    <script>
        var test = 10;
        var selector = "";
        var angkaselector = "";

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



        $(document).ready(function() {
            // $('#tablelaporan').DataTable();
            $('#tablelaporan').dataTable({dom: 'lrtip'});

            // var oTable = $('#tablelaporan').DataTable({
            //     "columnDefs": [{
            //         "targets": [1, 2, 3, 4, 5, 6, 7, 8],
            //         "searchable": false
            //     }]
            // });


            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

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


            function filterRows() {
                var from = $('#tanggalmulai').val();
                var to = $('#tanggalsampai').val();

                if (!from && !to) { // no value for from and to
                    return;
                }

                from = from || '1970-01-01'; // default from to a old date if it is not set
                to = to || '2999-12-31';

                var dateFrom = moment(from);
                var dateTo = moment(to);

                $('#tablelaporan tbody tr').each(function(i, tr) {
                    var val = $(tr).find("td:nth-child(5)").text();
                    console.log(val)
                    var dateVal = moment(val, "DD/MM/YYYY");
                    var visible = (dateVal.isBetween(dateFrom, dateTo, null, [])) ? "" : "none"; // [] for inclusive
                    console.log(visible)
                    $(tr).css('display', visible);
                });
            }


            function filterTabel() {
                var from = $('#tanggalmulai').val();
                var to = $('#tanggalsampai').val();

                from = from || '1970-01-01'; // default from to a old date if it is not set
                to = to || '2999-12-31';

                var dateFrom = moment(from);
                var dateTo = moment(to);

                var rex = new RegExp($('#myInput').val(), 'i');

                $('#tablelaporan tbody tr').hide();
                $('#tablelaporan tbody tr').filter(function(i, v) {
                    //filter tanggal
                    var val = $(this).find("td:nth-child(5)").text();
                    var dateVal = moment(val, "YYYY/MM/DD");
                    var visible = (dateVal.isBetween(dateFrom, dateTo, null, [])) ? true : false;

                    //filter nama
                    var $t = $(this).children(":eq(" + "0" + ")");
                    // console.log(visible);
                    return rex.test($t.text()) && visible;
                }).show();
            }
            $('#tanggalmulai').on("change", filterTabel);
            $('#tanggalsampai').on("change", filterTabel);
            $('#myInput').keyup(filterTabel);

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


            $(document).on('change', '#selectorbulan', function() {
                var value = $(this).find(":selected").html();
                angkaselector = value;
                console.log(selector.toString() + " " + angkaselector.toString());
            });

            //download as pdf
            // $("#downloadbutton").click(function(){
            //     var tabel=$("#tablelaporan").html();
            //     console.log(tabel);
            //     html2pdf().from(invoice);
            // });



        });

        //buat chart
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                ['Work', test],
                ['Friends', 2],
                ['Eat', 2],
                ['TV', 2],
                ['Gym', 2],
                ['Sleep', 8]
            ]);

            // Optional; add a title and set the width and height of the chart
            var options = {
                'title': 'My Average Day',
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
            var lengthnow=$('.dataTables_length select').val();
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

            //print image
            var img = $("#piechart img");
            var chart1 = img.attr('src');
            doc.addPage();
            doc.addImage(chart1, 'png', 0, 0, parseInt(img.width), parseInt(img.height), undefined, 'none');
            //convert to pdf
            doc.save("yea.pdf");
            table.page.len(lengthnow).draw();





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
    </script>

</body>
<style>
    #tablelaporan th {
        cursor: pointer;
    }
</style>

</html>