<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Uploaded Image</title>
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/navbar.css"> 

    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Data Tables -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">

</head>
<body>


    <div class="container">
        <div class="row pt-4">
            <div class="col-6">
                <h3 class="title">Transaksi Penjualan Sales</h3>
            </div>
            <div class="col-6">
                <div class="text-right">
                    <a href="#"><button id="add-user-btn" class="btn btn-secondary"></i> Back</button></a>
                </div>
            </div>
        </div>
        <div class="row pt-4">
            <div class="col-12 table-responsive-sm">
                <table id="tableImage" class="table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th width="5%" data-sortable="true">No</th>
                            <th width="5%" data-sortable="true">ID Order</th>
                            <th width="15%" data-sortable="true">Nama Sales</th>
                            <th width="25%" data-sortable="true">Nama Customer</th>
                            <th width="15%" data-sortable="true">Tanggal Order</th>
                            <th wdith="20%" data-sortable="true">Tanggal Jatuh Tempo</th>
                            <th wdith="15%" data-sortable="true">Total Harga</th>
                        </tr>
                    </thead>
                    <tbody id="user-content">

                    </tbody>
                </table>
            </div>
        </div>

        
    </div>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<!-- DataTable Query -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

<script>

function load_data() {
    $.ajax({
        url: "/ProyekManpro/services/manager_get_all_order.php",
            method: "GET",
            success: function(data) {
            var co = 1;
            $("#user-content").html('');
            data.forEach(function(aktivitas){
                var row = $("<tr></tr>");
                var col1 = $("<td>" + co + "</td>");
                var col2 = $("<td>" + aktivitas['id_order'] + "</td>");
                var col3 = $("<td>" + aktivitas['nama_sales'] + "</td>");
                var col4 = $("<td>" + aktivitas['nama_cust'] + "</td>");
                var col5 = $("<td>" + aktivitas['tanggal_order'] + "</td>");
                var col6 = $("<td>" + aktivitas['tanggal_jatuh_tempo'] + "</td>");
                //var changeHarga = 
                var col7 = $("<td>" + aktivitas['total_harga'] + "</td>");

                col1.appendTo(row);
                col2.appendTo(row);
                col3.appendTo(row);
                col4.appendTo(row);
                col5.appendTo(row);
                col6.appendTo(row);
                col7.appendTo(row);

                co++;
                $("#user-content").append(row);
            })
            $('#tableImage').DataTable();
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