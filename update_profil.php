<?php
    require_once("config/koneksi.php");
    session_start();

    

    if(isset($_POST['update_profile'])){
        $user_id = $_SESSION['email'];
        $nama = $_POST['nama']; 
        $notelp = $_POST['notelp']; 
        $alamat = $_POST['alamat']; 

       

        if(empty($nama) || empty($notelp) || empty($alamat)){
            echo '<div class="warning">Data tidak boleh kosong</div>';
        } else {
          
            $update_profile = mysqli_query($koneksi, "UPDATE users SET nama='$nama', notelp='$notelp', alamat='$alamat' WHERE email='$user_id'");
            
            if($update_profile){
                echo '<div class="success">Profil berhasil diperbarui</div>';
            } else {
                echo '<div class="error">Profil gagal diperbarui</div>';
            }
        }
    }


    $user_id = $_SESSION['email'];
    $select_profile_query = mysqli_query($koneksi, "SELECT * FROM `users` WHERE email = '$user_id'");
    $fetch_profile = mysqli_fetch_assoc($select_profile_query);
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
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-cGg1LVkmUBDHnrI8qTu9UAup8IMCPjxgO2nZbOkrDSiS/F8zBRQ6Qsh+5bR9Z4vLAdAC4Eh8Q5l3V3ddiiplIQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />


     <!-- MAIN CSS -->
     <link rel="stylesheet" href="css/style.css">

</head>
<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">

     <!-- PRE LOADER -->
     <section class="preloader">
          <div class="spinner">
               <span class="spinner-rotate"></span>
          </div>
     </section>


     <!-- MENU -->
     <section class="navbar custom-navbar navbar-fixed-top" role="navigation">
     <div class="container">
          <div class="navbar-header">
               <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
                    <span class="icon icon-bar"></span>
               </button>
               <!-- lOGO TEXT HERE -->
               <a href="" class="navbar-brand">Apotik Brody</a>
          </div>
          <!-- MENU LINKS -->
          <div class="collapse navbar-collapse">
               <ul class="nav navbar-nav navbar-nav-first">
                    <li ><a href="index.php">Home</a></li>
                    <li><a href="produk.php">Produk</a></li>
                    <li><a href="about-us.php">About Us</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                    <li><a href="keranjang.php">Keranjang</a></li>
                    <li><a href="checkout.php">Checkout</a></li>
               </ul>
               <ul class="nav navbar-nav navbar-right">
                    <!-- PROFILE DROPDOWN -->
                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person" viewBox="0 0 15 15">
                     <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
                    </svg> 
                    </a>
                    <ul class="dropdown-menu">
                         <?php
                         if (isset($_SESSION['email'])) {
                              $select_profile_query = mysqli_query($koneksi, "SELECT * FROM `users` WHERE email = '$user_id'");
                              if ($select_profile_query && mysqli_num_rows($select_profile_query) > 0) {
                                   $fetch_profile = mysqli_fetch_assoc($select_profile_query);
                                   ?>
                                   <li><a href="profile.php"><?= $fetch_profile['nama']; ?></a></li>
                                   <li><a href="order.php">Riwayat Pemesanan</a></li>
                                   <li><a href="logout.php" onclick="return confirm('Logout from this website?');">Logout</a></li>
                              <?php
                              }
                         } else {
                              ?>
                              <li><a href="login.php">Login</a></li>
                         <?php
                         }
                         ?>
                    </ul>
                    </li>

               </ul>
          </div>
     </div>
</section>

<center>
<div class="center-card">
    <div class="card mt-5">
        <div class="card-header">
            <h3>Update Profil</h3>
        </div>
        <div class="card-body">
            <form method="post" action="">
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama" value="<?php echo $fetch_profile['nama']; ?>">
                </div>

                <div class="mb-3">
                    <label for="notelp" class="form-label">Nomor Telepon</label>
                    <input type="text" name="notelp" class="form-control" id="notelp" placeholder="Nomor Telepon" value="<?php echo $fetch_profile['notelp']; ?>">
                </div>

                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" name="alamat" class="form-control" id="alamat" placeholder="Alamat" value="<?php echo $fetch_profile['alamat']; ?>">
                </div>

                <button type="submit" name="update_profile" class="btn btn-info">Perbarui Profil</button>
            </form>
        </div>
    </div>
</div>
</center>



    <!-- SCRIPTS -->
    <script src="js/jquery.js"></script>
     <script src="js/bootstrap.min.js"></script>
     <script src="js/owl.carousel.min.js"></script>
     <script src="js/smoothscroll.js"></script>
     <script src="js/custom.js"></script>s

</body>
</html>