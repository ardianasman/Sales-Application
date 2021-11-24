<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script> -->
    <title>Aplikasi Sales</title>
</head>

<body>
    <div class="container-fluid p-5">
        <div class="row">
            <div class="col-12 col-lg-6 d-flex justify-content-md-end">
                <div class="row cards">
                    <div class="col-12 motto">
                        Optimalkan Sales Dari Perusahaan Anda di Lapangan
                    </div>
                    <div class="col-12 daftar">
                        <div class="row">
                            <div class="col-8 daftartext d-flex justify-content-left align-items-center">Apakah anda manajer?</div>
                            <div class="col-4">
                                <a class="buttondaftar d-flex justify-content-center align-items-center" href="login_manajer.php">Login Manajer</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6 p-5 justify-content-center">
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        <img class="yodalogo" src="../assets/pics/googlelogo.png" alt="Aplikasi Sales Logo">
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <h2 style="font-weight: normal">Masuk ke akun Anda</h2>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <p style="font-size:14px;font-weight:450">Masukan data untuk melanjutkan</p>
                    </div>
                    <div class="col-12 mt-5 d-flex justify-content-center">
                        <div class="insidecontainer">
                            <!-- <form class="login-form" method="POST"> -->
                            <div class="form-group">
                                <div class="inputcontainer">
                                    <p>
                                        Username
                                    </p>
                                    <div class="row">
                                        <div class="col-12">
                                            <input type="text" class="form-control" id="username" name="username" required>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <div class="inputcontainer">
                                    <p>
                                        Password
                                    </p>
                                    <div class="row">
                                        <div class="col-12">
                                            <input type="password" class="form-control" id="password" name="password" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button disabled class="signinbutton">
                                Masuk
                            </button>
                            <!-- </form> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


    <script>
        $(document).ready(function() {
            var cekemail = false;
            var cekpass = false;
            $("#username").on("input", function() {
                if ($(this).val() != "") {
                    cekemail = true;
                } else {
                    cekemail = false;
                }

                if (cekemail == true && cekpass == true) {
                    $(".signinbutton").attr("disabled", false);
                    $(".signinbutton").css("cursor", "pointer");
                } else {
                    $(".signinbutton").attr("disabled", true);
                    $(".signinbutton").css("cursor", "default");
                }
            });
            $("#password").on("input", function() {
                if ($(this).val() != "") {
                    cekpass = true;
                } else {
                    cekpass = false;
                }

                if (cekemail == true && cekpass == true) {
                    $(".signinbutton").attr("disabled", false);
                    $(".signinbutton").css("cursor", "pointer");
                } else {
                    $(".signinbutton").attr("disabled", true);
                    $(".signinbutton").css("cursor", "default");
                }
            });
        });
        $(".signinbutton").click(function() {
            console.log('hello')
            var username = $("#username").val();
            var password = $("#password").val();

            $.ajax({
                    url: '/ProyekManpro/services/check_login.php',
                    method: 'POST',
                    data: {
                        username: username,
                        password: password
                    },
                    success: function(data) {
                        window.location = data['redirect'];
                    },
                    error: function($xhr, textStatus, errorThrown) {
                        alert($xhr.responseJSON['error']);
                    }
            });
            
            
            
        });
    </script>


</body>

</html>

