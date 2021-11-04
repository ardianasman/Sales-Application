<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


</head>
<body>
 
<div class="container">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4 pt-5">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center">Login</h2>
                        <hr>
                        <div class="form-group">
                            <label for="username">Username: </label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password: </label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                        </div>
                        <button id="login-button" class="btn btn-success btn-block">Login</button>
                    </div>
                </div>
            </div>
            <div class="col-4"></div>
        </div>
    </div>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>



<!-- Script -->
<script>
    $("#login-button").click(function(){
            var username = $("#username").val();
            var password = $("#password").val();

            $.ajax({
                url: '/ProyekManpro/services/check_login_manajer.php',
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