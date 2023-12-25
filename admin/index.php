<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("../config/koneksi.php");

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validasi login
    $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) > 0) {
        // Login berhasil
        session_start();
        $_SESSION['username'] = $username;
        header("Location: main.php"); // Ganti ini dengan halaman setelah login
        exit();
    } else {
        $error_message = "Username atau password salah!";
    }
}
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
     <link rel="stylesheet" href="css/owl.carousel.css">
     <link rel="stylesheet" href="css/owl.theme.default.min.css">

     <!-- MAIN CSS -->
     <link rel="stylesheet" href="../css/style.css">

</head>
<body>
    <div class="container">
        <form class="login-container" method="post" action="index.php">
            <h3 class="textJudul mb-5">Masuk</h3>

            <?php
            if (isset($error_message)) {
                echo '<div class="alert alert-danger" role="alert">' . $error_message . '</div>';
            }
            ?>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label textForm">Username</label>
                <input type="username" class="form-control" name="username" id="exampleInputEmail1" aria-describedby="emailHelp" required>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label textForm">Password</label>
                <input type="password" class="form-control" name="password" id="exampleInputPassword1" required>
            </div>
            <div class="text-end">
                <a href="#" class="textForm text-hover">Lupa Password?</a>
            </div>
            <div class="d-grid textForm mt-5">
                <button type="submit" class="btn btn-primary">Masuk</button>
            </div>
        </form>
    </div>
</body>
</html>
