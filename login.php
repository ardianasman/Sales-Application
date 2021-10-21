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
    <h1 style = "text-align : center"> Testing </h1>
<br>
<div style ="display : flex ;justify-content : center"> 
    <button type="button" id="tombol" class="btn btn-info btn-lg" data-toggle="modal" data-target="#sign-in-modal">Open Modal</button>
</div>

<!-- Login Modal -->
<div class="modal fade" id="sign-in-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Sign In</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-lsabel="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="username"><b>Username :  </b></label>
                        <input type="username" id="username" name="username" class="form-control" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="password"><b>Password :  </b></label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                    </div>
                </div>
                <div class="modal-footer">
                    <p id="buat_akun" style = "text-align : center; justify-content : center;display:flex; cursor:pointer;" data-dismiss="modal" data-toggle="modal" data-target="#register-modal" onMouseOver="this.style.color='blue'" onMouseOut="this.style.color='black'" > Create New Account </p></a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="sign-in-button" name="sign-in-button" class="btn btn-success"><i class="lnr lnr-plus-circle"></i> Sign In</button>
                </div>
            </div>
        </div>
</div>

<!-- Register Modal -->
<div class="modal fade" id="register-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Register</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-lsabel="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama"><b>Nama Lengkap :  </b></label>
                        <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama Lengkap">
                    </div>
                    <div class="form-group">
                        <label for="email_regist"><b>Email :  </b></label>
                        <input type="email" id="email_regist" name="email_regist" class="form-control" placeholder="EmailPribadi@gmail.com">
                    </div>
                    <div class="form-group">
                        <label for="no_hp"><b>Nomor Handphone :  </b></label>
                        <input type="text" id="no_hp" name="no_hp" class="form-control" placeholder="08XXXXXXXXX">
                    </div>
                    <div class="form-group">
                        <label for="id_line"><b>Id Line :  </b></label>
                        <input type="text" id="id_line" name="id_line" class="form-control" placeholder="Id Line">
                    </div>
                    <div class="form-group">
                        <label for="password_regist"><b>Password :  </b></label>
                        <input type="password" id="password_regist" name="password_regist" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="password_confirm"><b>Confirm Password :  </b></label>
                        <input type="password" id="password_confirm" name="password_confirm" class="form-control" placeholder="Confirm Password">
                    </div>

                </div>
                <div class="modal-footer">
                    <p style = "text-align : center; justify-content : center;display :flex;cursor:pointer;" data-dismiss="modal" data-toggle="modal" data-target="#sign-in-modal" onMouseOver="this.style.color='blue'" onMouseOut="this.style.color='black'"> Already Have Account? Login here</p>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="register-button" name="register-button" class="btn btn-success"><i class="lnr lnr-plus-circle"></i> Register</button>
                </div>
            </div>
        </div>
</div>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>



<!-- Script -->
<script>
$(document).ready(function() {

$("#tombol").click(function(){
    $("#sign-in-modal").modal();
});

$("#sign-in-button").click(function() {
  var username = $("#username").val();
  var password = $("#password").val();

  $.ajax({
    url: '/ProyekManpro/services/check_login.php',
    method: 'POST',
    dataType: 'json',
    data: {
      username: username,
      password: password
    },
    success: function(data){
        window.location = data['redirect'];
    },
    error: function (request, status, error) {
        alert(request.responseText);
    }
  });
});

$("#register-button").click(function() {
  var nama = $("#nama").val();
  var email_regist = $("#email_regist").val();
  var no_hp = $("#no_hp").val();
  var id_line =$("#id_line").val();
  var password_regist = $("#password_regist").val();
  var password_confirm = $("#password_confirm").val();

  $.ajax({
    url: '/bharatika/register.php',
    method: 'POST',
    dataType: 'json',
    data: {
      nama: nama,
      email_regist: email_regist,
      no_hp: no_hp,
      id_line: id_line,
      password_regist: password_regist,
      password_confirm: password_confirm
    },
    success: function(data){
        $.confirm({
            title: 'Success!',
            content: 'You Have Successfully create an account',
            type: 'Blue',
            typeAnimated: true,
            buttons: {
                close: function () {
                }
            }
        });
        $("#nama").val('');
        $("#email_regist").val('');
        $("#no_hp").val('');
        $("#id_line").val('');
        $("#password_regist").val('');
        $("#password_confirm").val('');
    },
    error: function($xhr, textStatus, errorThrown) {
        $.confirm({
            title: 'Error!',
            content: $xhr.responseJSON['error'],
            type: 'red',
            typeAnimated: true,
            buttons: {
                close: function () {
                }
            }
        });
        //$.alert({
        //    title: 'Alert!',
        //    content: $xhr.responseJSON['error'],
        //});
        //alert($xhr.responseJSON['error']);
    }
  });
});

});




</script>



</body>
</html>