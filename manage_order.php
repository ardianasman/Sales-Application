<?php
    include "./services/database.php";
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
        <script src="https://use.fontawesome.com/504410ced2.js"></script>
        <link rel="stylesheet" href="css\managerorder.css">
           
    <script>
        function getItem()
        {
            $.ajax({
                url:"./services/getorderlist.php",
                method: "POST",
                success: function(res){
                    console.log(res);
                    $("#order-list").html('');
                    var table = $("<table id='data_table' class='table'></table>");
                    var title = $("<thead><tr><td><b>Order ID</b></td><td><b>Sales ID</b></td></tr></thead>");
                    table.append(title);
                    res.forEach(function(item){
                        var html = $(`
                            <tr>
                            <td>`+ item['id_order'] +`</td>
                            <td>` + item['id_sales'] + `</td>
                            </tr>
                        `);                           
                        table.append(html);
                    });
                    $("#order-list").append(table);
                },
                error: function(){
                    alert('fail');
                }
            });
        }
    </script>
</head>

<body onload="getItem()">
    <div class="container">
        <div class="transparent">
            <div id="order-list" class="transparent">
            </div>
        </div>
    </div>
</body>

</html>