<?php
    include "./services/database.php";
    if(!isset($_SESSION['id'])){
        header("Location: login.php");
    }
    $id = $_SESSION['id'];
?>
<!doctype html>
<html lang="en">

<head>
    <title>Add Order</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
        <script src="https://use.fontawesome.com/504410ced2.js"></script>
        <!--<link rel="stylesheet" href="css\managerorder.css"> -->

        <script>
            function getCustOptions(){
                $.ajax({
                    url: "./services/getcustoptions.php",
                    method: "POST",
                    success: function(res){
                        console.log(res);
                        $("#custid-list").html('');
                        var listidcust = [];
                        res.forEach(function(item){
                            var html = $(
                                item['id_customer']
                            );
                            listidcust.append(html);
                        });
                        $("#custid-list").append(listidcust);
                    },
                    error: function(){
                        alert('fail');
                    }
                })
            }
        </script>
</head>

<body onload = "getCustOptions()">
    <div class="transparent">
        <form class="order-list" method="POST" action="./services/addorder.php" enctype="multipart/form-data">
            <div class="form-content">  
                <div class="form-group">
                     <div class="col-12 col-md-10 col-lg-9" style="margin-left: auto; margin-right: auto">
                        <label for="idorder"><b>ID Order</b></label>
                        <input type="text" class="form-control" name="idorder" id="idorder" placeholder="Enter ID Order" required>
                    </div>
                </div>
                
            </div>
        </form>
    </div>
</body>
</html>