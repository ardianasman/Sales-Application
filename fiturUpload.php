<?php 
session_start()
?>
<!DOCTYPE html>
<html>
<head>

  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="css/navbar.css"> 

  <!-- CSS Bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- JQuery Confirm -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

  <title>Upload Images Testing</title>
  <style>
    input{
      margin-bottom: 20px;
    }
    
    h2{
      margin-bottom: 20px;
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
        <a class="nav-item nav-link " href="index.php">Home <span class="sr-only">(current)</span></a>
        <a class="nav-item nav-link active" href="show_image_upload.php">Activity</a>
        <a class="nav-item nav-link" href="#">Customer</a>
        <a class="nav-item nav-link" href="logout.php">Logout</a>
      </div>
    </div>
  </nav>


  <div>
    <div>
      <h2 class = "judul-status mt-4">Bukti Kunjungan</h2>
    </div>

    <div class ="col-12 m-sm-3">

        <div class="m-sm-3">
          <div class = "form-group ">
            <h3>Status</h2>
            <form action="upload_image.php" method="post" enctype="multipart/form-data">
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="flexRadioDefault" value="first" id="flexRadioDefault1" checked>
                <label class="form-check-label" for="flexRadioDefault1" style="margin-top: -20px;">
                  Ada Orangnya
                </label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input " type="radio" name="flexRadioDefault" value= "second" id="flexRadioDefault2" >
                <label class="form-check-label" for="flexRadioDefault2" style="margin-top: -20px;">
                  Tidak ada orangnya
                </label>
              </div> 
              

              <h3>Upload Bukti Kunjungan</h2>
              <label for="tanggal"><b>Tanggal :  </b></label>
              <input type="text" readonly class="form-control-plaintext" id="date" value="<?php date_default_timezone_set('Asia/Jakarta'); echo date('Y/m/d H:i:s'); ?>">
              <label for="confirm-id-pembelian"><b>Id Pembelian :  </b></label>
              <input type="text" id="confirm-id-pembelian" name="confirm-id-pembelian" class="form-control" placeholder="Konfirmasi Id Pembelian">
              <label for="confirm-id-pembelian"><b>Lokasi :  </b></label>
              <input type="text" id="lokasi" name="lokasi" class="form-control" placeholder="Masukkan Lokasi Kunjungan (Alamat)">
              <label for="upload-foto"><b>Masukkan Foto Bukti :  </b></label>
              <br>
              Select image to upload:
              <input type="file" name="fileToUpload" id="fileToUpload">
              <input type="submit" value="Upload Image" name="submit">
              <!-- <button type="button" id="submit-button" name="submit-button" class="btn btn-success"><i class="lnr lnr-plus-circle"></i> Submit</button> -->
            </form>
          </div>
          <a href="show_activity.php"><button id="add-user-btn" class="btn btn-secondary"></i> Back</button></a>
        </div>
    </div>
    
  </div>



<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<!-- JQuery Confirm -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

<!-- <script>
   
</script> -->



</body>
</html>