<?php
require_once("config/koneksi.php");
session_start();

if (isset($_POST['submit'])) {
    $id_user = $_POST['id_user'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $verify_query = mysqli_query($koneksi, "SELECT email FROM users WHERE email='$email'");

    if (mysqli_num_rows($verify_query) != 0) {
        echo "<div class='message-error'>
                  <p>Alamat email ini sudah digunakan, <br>daftar dengan alamat email lain!</p>
              </div> <br>";
        echo "<a href='javascript:self.history.back()'><button class='btn'>Daftar kembali</button>";
    } else {
        $insert_query = "INSERT INTO users (id_user, nama, email, password) VALUES ('$id_user', '$nama', '$email', '$password')";
        $result = mysqli_query($koneksi, $insert_query);

        if ($result) {
            echo "<script>alert('Pendaftaran berhasil! Silakan login.');</script>";
            echo "<script>window.location.href='login.php';</script>";
            exit();
        } else {
            echo "Error: " . $insert_query . "<br>" . mysqli_error($koneksi);
        }
        
        
        
    }
} else {
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">

    <title>Apotik Brody</title>
</head>
<body>

<div class="container">
    <form class="form-container" action="" method="post">
        <h3 class="text-judul">Daftar</h3>

        <input type="hidden" name="id_user" placeholder="Id User" class="form-control"><br>

        <div class="row mt-5">
    <div class="col-md-7">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i ></i></span>
                <input type="text" name="nama" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Nama lengkap">
            </div>
        </div>
    </div>
    <div class="col-md-7"> 
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">E-mail</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i ></i></span>
                <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="E-mail">
            </div>
        </div>
    </div>
</div>

        <div class="mb-3">
            <label for="email" class="form-label">Password</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1"><i ></i></span>
                <input type="text" name="password" class="form-control" placeholder="Password">
            </div>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Saya menyetujui <span class="text-merah">Syarat & Ketentuan</span> Yang Berlaku <span class="text-merah">*</span></label>
        </div>

        <div class="mt-4">
            <div class="row">
                <div class="col-md-6">
                    <button type="submit" name="submit" class="btn btn-outline-primary">Daftar</button>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <label>Sudah punya akun? <a href="login.php" class="text-login">Login Disini</a></label>
        </div>
    </form>
</div>
<?php } ?>

<script src="js/bootstrap.min.js"></script>

</body>
</html>
