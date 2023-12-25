<?php
require_once("config/koneksi.php");
session_start();

if (isset($_SESSION['email'])) {
     $user_id = $_SESSION['email'];
 } else {
     $user_id = '';
 }

if(isset($_POST['tambah_keranjang'])){
    if (isset($_SESSION['email'])) {
        $id_produk = $_POST['id_produk'];
        $nama_produk = $_POST['nama_produk'];
        $harga = $_POST['harga'];
        $gambar_produk = $_POST['gambar_produk'];
        $jumlah = $_POST['jumlah_produk'];

        $sql = mysqli_query($koneksi, "SELECT * FROM keranjang WHERE nama = '$nama_produk' AND id_produk = '$id_produk'");

        if(mysqli_num_rows($sql) > 0){
            echo 'Produk Sudah Ditambah !';
        } else {
            mysqli_query($koneksi, "INSERT INTO keranjang ( id_produk, nama, harga, gambar_produk, jumlah_produk)
            VALUES ( '$id_produk', '$nama_produk', '$harga', '$gambar_produk', '$jumlah')");
            echo 'Produk Ditambah !';
        }
    } else {
        echo 'Anda harus login untuk menambahkan ke keranjang.';
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
                    <li class="active"><a href="produk.php">Produk</a></li>
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
    
    <section>
        <div class="container">
            <div class="text-center">
                <h1>Daftar Produk</h1>
                <br>
            </div>
        </div>
    </section>

    <div class="col-lg-12 col-md-12">
    <div class="row">
        <?php
        $sql = mysqli_query($koneksi, "SELECT * FROM produk");
        while ($result = mysqli_fetch_array($sql)) { ?>
            <div class="col-lg-3 col-md-3">
                <div class="card">
                  <center> <img src="/images<?php echo $result['gambar_produk']; ?>" class="card-img-top" alt="Product Image" style="height: 150px"> </center> 
                    <div class="card-body">
                        <h5 class="card-title text-center"><?= $result['nama_produk']; ?></h5>
                        <p class="card-text text-center">Rp<?= number_format($result['harga']); ?></p>
                        <p class="card-text text-center">Stok <?= $result['stok_produk']; ?></p>
                        <form method="post" action="produk.php?id=<?= $result['id_produk'] ?>">
                            <div class="form-group">
                                <label for="jumlah_produk">Jumlah:</label>
                                <input type="number" class="form-control" id="jumlah_produk" name="jumlah_produk" min="1" value="1">
                            </div>
                            <input type="hidden" name="id_produk" value="<?php echo $result['id_produk']; ?>">
                            <input type="hidden" name="gambar_produk" value="<?php echo $result['gambar_produk']; ?>">
                            <input type="hidden" name="nama_produk" value="<?php echo $result['nama_produk']; ?>">
                            <input type="hidden" name="harga" value="<?php echo $result['harga']; ?>">
                            <button type="submit" name="tambah_keranjang" class="btn btn-info btn-block">Tambah Ke Keranjang</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php }
        ?>
    </div>
</div>


    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br

 <!-- FOOTER -->
 <footer id="footer">
          <div class="container">
               <div class="row">

                    <div class="col-md-4 col-sm-6">
                         <div class="footer-info">
                              <div class="section-title">
                                   <h2>MEDAN</h2>
                              </div>
                              <address>
                                   <p>Medan Tuntungan <br>Jl. Lap Golf, Pancur Batu</p>
                              </address>

                              <ul class="social-icon">
                                   <li><a href="#" class="fa fa-facebook-square" attr="facebook icon"></a></li>
                                   <li><a href="#" class="fa fa-twitter"></a></li>
                                   <li><a href="#" class="fa fa-instagram"></a></li>
                              </ul>

                              <div class="copyright-text"> 
                                   <p>Copyright &copy; 2020 Aptoik Brody</p>
                              </div>
                         </div>
                    </div>

                    <div class="col-md-4 col-sm-6">
                         <div class="footer-info">
                              <div class="section-title">
                                   <h2>Contact Info</h2>
                              </div>
                              <address>
                                   <p>+62 81234567890</p>
                                   <p><a href="mailto:contact@company.com">ApotikBrody@gmail.com</a></p>
                              </address>

                              <div class="footer_menu">
                                   <h2>Quick Links</h2>
                                   <ul>
                                        <li><a href="index.php">Home</a></li>
                                        <li><a href="about-us.php">About Us</a></li>
                                        <li><a href="contact.php">Contact Us</a></li>
                                        <li><a href="produk.php">Produk</a></li>
                                   </ul>
                              </div>
                         </div>
                    </div>

                    <div class="col-md-4 col-sm-12">
                         <div class="footer-info newsletter-form">
                              <div class="section-title">
                                   <h2>Newsletter Signup</h2>
                              </div>
                              <div>
                                   <div class="form-group">
                                        <form action="#" method="get">
                                             <input type="email" class="form-control" placeholder="Enter your email" name="email" id="email" required>
                                             <input type="submit" class="form-control" name="submit" id="form-submit" value="Send me">
                                        </form>
                                        <span><sup>*</sup> Please note - we do not spam your email.</span>
                                   </div>
                              </div>
                         </div>
                    </div>
                    
               </div>
          </div>
     </footer>

    <!-- SCRIPTS -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/smoothscroll.js"></script>
    <script src="js/custom.js"></script>

</body>
</html>
