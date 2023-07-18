<?php

session_start ();
if(isset($_SESSION['admin_username'])){
    header("location:admin_depan.php");
}
include("inc_koneksi.php");
$username = "";
$password = "";
$err = "";
if(isset($_POST['login'])){
    $username   = $_POST['username'];
    $password  = $_POST['password'];
    if($username == '' or $password == ''){
        $err .= "<li>Silahkan Masukan Username dan Password</>";
    }
    if (empty($err)) {
        $sql1 = "select * from admin where = '$username'";
        $q1 = mysql_query($koneksi, $sql1);
        $r1 = mysql_fetch_array($q1);
        if($r1['password'] != md5($password)){
            $err .= "<li>Akun Tidak Ditemukan</li>";
        }
    }
    if(empty($err)){
        $_SESSION ['admin_username'] = $username;
        header("location:admin_depan.pho");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
  <title>ANDA TEXTILLE - Company Profile</title>

  <style>
    .container {
      margin-top: 20px;
    }

    .row {
      margin-bottom: 20px;
    }

    .col-lg-4 {
      border: 1px solid #ccc;
      padding: 10px;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
      <a class="navbar-brand" href="#">ANDA TEXTILLE</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse navbar-light" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-5">
    <div class="row">
      <div class="col-lg-5">
        <img src="anda1.png" alt="Gambar Anda" class="img-fluid">
      </div>
        <?php
        if ($err){
            echo "<ul>$err</ul>";

        }
        ?>
      <div class="col-lg-6">
        <form method="POST" action="login.php"> <!-- Action ditambahkan dengan mengarahkan ke file PHP yang akan memproses login -->
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" value= "<?php echo $username ?>" id="username" placeholder="Enter your username" name="username"> <!-- Ditambahkan atribut name untuk mengirim data ke file PHP -->
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password"> <!-- Ditambahkan atribut name untuk mengirim data ke file PHP -->
          </div>
          <button type="submit" class="btn btn-primary">Login</button>
        </form>
      </div>
    </div>
  </div>

  <div class="container-fluid">
  <div class="navbar navbar-expand-lg navbar-light bg-primary">
    <span class="nav-item nav-link text-white">© 2023 ANDA TEXTILLE. All rights reserved.</span>
  </div>
</div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>