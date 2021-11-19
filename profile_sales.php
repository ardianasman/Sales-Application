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
    <title>Profile Sales</title>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/navbar.css"> 

    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/8762c0f933.js" crossorigin="anonymous"></script>

    <!-- JQuery Confirm -->
    <link rel="stylesheet" href="assets/jquery-confirm/jquery-confirm.css"/>

    <style>
        body {
            background: #eee
        }

        .card {
            border: none;
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            cursor: pointer
        }

        .card:before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            width: 4px;
            height: 100%;
            background-color: #d4a985;
            transform: scaleY(1);
            transition: all 0.5s;
            transform-origin: bottom
        }

        .card:after {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            width: 4px;
            height: 100%;
            background-color: #937861;
            transform: scaleY(0);
            transition: all 0.5s;
            transform-origin: bottom
        }

        .card:hover::after {
            transform: scaleY(1)
        }

        .fonts {
            font-size: 14px
        }

        .social-list {
            display: flex;
            list-style: none;
            justify-content: center;
            padding: 0
        }

        .social-list li {
            padding: 10px;
            color: #937861;
            font-size: 19px
        }

        .buttons button:nth-child(1) {
            border: 1px solid #937861 !important;
            color: #937861;
            height: 40px
        }

        .buttons button:nth-child(1):hover {
            border: 1px solid #937861 !important;
            color: #fff;
            height: 40px;
            background-color: #937861
        }

        .buttons button:nth-child(2) {
            border: 1px solid #937861 !important;
            background-color: #937861;
            color: #fff;
            height: 40px
        }
    </style>

</head>
<body>

<!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark ">
        <a class="judul" href="index.php">Prototype Sales</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ml-auto">
                <a class="nav-item nav-link " href="index.php">Home <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link" href="show_activity.php">Activity</a>
                <a class="nav-item nav-link" href="ListCustomer.php">Customer</a>
                <a class="nav-item nav-link active" href="#">Profile</a>
                <a class="nav-item nav-link" href="logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-7">
            <div class="card p-3 py-4">
                <div class="text-center"> <img src="image/profile.jpg" width="100" class="rounded-circle"> </div>
                <div class="text-center">
                    <h5 id="namasales"class="mt-2 mb-0"></h5> <span>Sales</span>
                    <div class="px-4 mt-3">
                        <p class="fonts" id="emailsales"></p>
                        <p class="fonts" id="emailsales"></p>
                        <p class="fonts" id="usernamesales"></p>
                        <p class="fonts" id="passwordsales"></p>
                        <p class="fonts" id="targetsales"></p>
                    </div>
                    <div class="buttons"> <button id = "change-pass-btn" class="btn btn-outline-primary px-4">Change Password</button> </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Change Password Modal -->
    <div class="modal fade" id="change-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Student</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="new-pass">New Password: </label>
                            <input type="password" id="new-pass" name="new-pass" class="form-control" placeholder="New Password">
                        </div>
                        <div class="form-group">
                            <label for="confirm-pass">Confirm Password: </label>
                            <input type="password" id="confirm-pass" name="confirm-pass" class="form-control" placeholder="Confirm Password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="submit-user-button" name="submit" class="btn btn-success"><i class="lnr lnr-plus-circle"></i> Add</button>
                    </div>
                </div>
            </div>
        </div>


<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<!-- JQuery Confirm -->
<script src="assets/jquery-confirm/jquery-confirm.js"></script>

<script>

function load_data() {
    var id = <?php echo $_SESSION['id'] ?>;
    $.ajax({
            url: '/ProyekManpro/services/get_profile_sales.php',
            method: 'GET',
            data: {
                id: id
            },
            success: function(data) {
                $('#namasales').text(data['nama']);
                $('#emailsales').text("Email Sales : " + data['email']);
                $('#usernamesales').text("Username Sales : " + data['username']);
                $('#passwordsales').text("Password Sales : " + data['password']);
                $('#targetsales').text("Target Yang Harus dipenuhi : Rp " + data['target']);
                console.log(data)
            },
            error: function($xhr, textStatus, errorThrown) {
                alert($xhr.responseJSON['error']);
            }
        });
}

$(document).ready(function(){
    load_data();
    // 
});

$("#change-pass-btn").click(function(){
    $("#change-modal").modal();
});

$("#submit-user-button").click(function(){
    var newpass = $("#new-pass").val();
    var confpass = $("#confirm-pass").val();
    $.ajax({
        url: '/ProyekManpro/services/edit_pass_sales.php',
        method: 'POST',
        data: {
            newpass: newpass,
            confpass: confpass
        },
        success: function(data) {
            $("#new-pass").val('');
            $("#confirm-pass").val('');
            $("#change-modal").modal('toggle');
            $.alert({
                title: 'Success!',
                content: 'Password Has Been Changed!',
            });
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