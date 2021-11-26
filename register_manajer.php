<?php 

include $_SERVER['DOCUMENT_ROOT']."/ProyekManpro/services/database.php"; 
    if (!isset($_SESSION['id_manajer'])) {
        header("Location:login_manajer.php");
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prototype Sales</title>
    <!-- CSS -->
    <!-- Main css -->
    <link rel="stylesheet" href="css/register_manajer.css">

    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- FontAwesome -->
    <script src="https://kit.fontawesome.com/8762c0f933.js" crossorigin="anonymous"></script>

    <!-- JQuery Confirm -->
    <link rel="stylesheet" href="assets/jquery-confirm/jquery-confirm.css"/>


</head>
<body>
    
   
<!-- Sign up form -->
    <div class="container">
        <div class="signup-content">
            <div class="signup-form">
                <h2 class="form-title">Sign up</h2>
                <div method="POST" class="register-form" id="register-form">
                <div class="form-group">
                    <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                    <input type="text" name="name" id="name" placeholder="Your Name"/>
                </div>
                <div class="form-group">
                    <label for="email"><i class="zmdi zmdi-email"></i></label>
                    <input type="email" name="email" id="email" placeholder="Your Email"/>
                </div>
                <div class="form-group">
                    <label for="address"><i class="zmdi zmdi-email"></i></label>
                    <input type="text" name="address" id="address" placeholder="Your address"/>
                </div>
                <div class="form-group">
                    <label for="no_telp"><i class="zmdi zmdi-email"></i></label>
                    <input type="text" name="no_telp" id="no_telp" placeholder="Your Phone Number"/>
                </div>
                <div class="form-group">
                    <label for="username"><i class="zmdi zmdi-email"></i></label>
                    <input type="username" name="username" id="username" placeholder="Your Username"/>
                </div>
                <div class="form-group">
                    <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                    <input type="password" name="pass" id="pass" placeholder="Password"/>
                 </div>
                <div class="form-group">
                    <label for="conf_pass"><i class="zmdi zmdi-lock-outline"></i></label>
                    <input type="password" name="conf_pass" id="conf_pass" placeholder="Repeat your password"/>
                </div>
                <div class="form-group form-button">
                    <div class="text-left">
                        <button id="add-user-btn" class="btn btn-info"><i class="lnr lnr-plus-circle"></i> Register</button>
                        <a href ="Home_Manajer.php"><button id="back-to-btn" class="btn btn-info"><i class="lnr lnr-plus-circle"></i> Back</button></a>
                    </div>
                    </div>
                            
                </div>
            </div>
            <div class="signup-image">
                <figure><img src="image/signup-image.jpg" alt="sign up image"></figure>
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
$("#add-user-btn").click(function() {
    var nama = $('#name').val();
    var email = $('#email').val();
    var address = $('#address').val();
    var hp = $('#no_telp').val();
    var username = $('#username').val();
    var password = $('#pass').val();
    var re_pass = $('#conf_pass').val();

    $.ajax({
        url: '/ProyekManpro/services/manager_register.php',
        method: 'POST',
         data: {
            nama: nama,
            email: email,
            address: address,
            hp: hp,
            username: username,
            password: password,
            re_pass: re_pass
            },
        success: function(data) {
            $.alert({
                title: 'Success!',
                content: 'New Manager Has Been Registered!',
            });
            $('#name').val("");
            $('#email').val("");
            $('#address').val("");
            $('#no_telp').val("");
            $('#username').val("");
            $('#pass').val("");
            var re_pass = $('#conf_pass').val("");

        },
        error: function($xhr, textStatus, errorThrown) {
            alert($xhr.responseJSON['error']);
        }
    });

    
});
</script>

</body>
</html>