<?php 

session_start();

if (!isset($_SESSION['id'])) {
    header("Location:login.php");
}

?>

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
            <div class="navbar-nav ml-auto">
                <ul>
                    <li><a class="nav-item nav-link " href="index.php">Home <span class="sr-only">(current)</span></a></li>
                    <li class="nav-item dropdown"><a class="nav-link active" id="navbarDropdownMenuLink"aria-haspopup="true" aria-expanded="false">Activity</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="show_activity.php">Sales Activity</a>
                            <a class="dropdown-item" href="add_rencanakungjungan.php">Visit Plan</a>
                        </div>
                    </li>
                    <li><a class="nav-item nav-link" href="ListCustomer.php">Customer</a></li>
                    <li><a class="nav-item nav-link" href="manage_order.php">Order</a></li>
                    <li><a class="nav-item nav-link" href="profile_sales.php">Profile</a></li>
                    <li><a class="nav-item nav-link" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    

    <div class="container">
        <div class="row pt-4">
            <div class="col-6">
                <h3 class="title">List Of Unvisited Customer</h3>
            </div>
            <div class="col-6">
                <div class="text-right">
                    <a href="show_image_upload.php"><button id="add-user-btn" class="btn btn-info"><i class="lnr lnr-plus-circle"></i> Check History</button></a>
                </div>
            </div>
        </div>
        <div class="row pt-4">
            <div class="col-12 table-responsive-sm">
                <table class="table table-hover table-striped table-bordered" id="sortTable">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Nama Customer</th>
                            <th width="10%">Id Aktivitas</th>
                            <th width="15%">Nomor Telp</th>
                            <th width="20%">Alamat Customer</th>
                            <th width="15%">Check In Button</th>
                            <th wdith="15%">Tools</th>
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
        url: "/ProyekManpro/services/get_all_activity.php",
            method: "GET",
            success: function(data) {
            var co = 1;
            $("#user-content").html('');
            data.forEach(function(simpan){
                var row = $("<tr></tr>");
                var col1 = $("<td>" + co + "</td>");
                var col2 = $("<td>" + simpan['nama_customer'] + "</td>");
                var col3 = $("<td>" + simpan['id_aktivitas'] + "</td>");
                var col4 = $("<td>"+ simpan['no_telp'] +"</td>");
                var col5 = $("<td>"+ simpan['alamat_customer'] +"</td>");

                col1.appendTo(row);
                col2.appendTo(row);
                col3.appendTo(row);
                col4.appendTo(row);
                col5.appendTo(row);

                //Check-in Button
                var tools_1 = $("<td ></td>");
                var check_in = $('<button id="check-in-btn" class="btn btn-warning">Check-In<i class="lnr lnr-pencil"></i></button>');
                // Tools
                var tools = $("<td ></td>");
                var add_btn = $('<a href = "fiturUpload.php?id='+simpan['id_aktivitas']+'"><button type="button" class="btn btn-secondary" >Add  <i class="fas fa-plus-circle"></i></button></a>');

                check_in.appendTo(tools_1);            
                add_btn.appendTo(tools);
                tools_1.appendTo(row);
                tools.appendTo(row);

                co++;
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
    // 
});

$("#user-content").on("click", "[id='check-in-btn']", function(){
    var posisi_lt = 0;
    var posisi_lg = 0;
    var timestamp = 0;
    navigator.geolocation.getCurrentPosition(function(position){
        posisi_lt = position.coords.latitude;
        posisi_lg = position.coords.longitude;
        timestamp = position.timestamp;
        $.ajax({
            url: '/ProyekManpro/services/check_position.php',
            method: 'POST',
            data: {
                posisi_lt: posisi_lt,
                posisi_lg: posisi_lg
            },
            success: function(data) {
                alert("Success");
            },
            error: function($xhr, textStatus, errorThrown) {
                alert($xhr.responseJSON['error']);
            }
        });
        
    });        
            
});



</script>

<script>
    
</script>


</body>
</html>