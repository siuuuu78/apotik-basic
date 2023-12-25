<?php
require_once("config/koneksi.php");
session_start();

if (isset($_POST['kirim'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $pesan = $_POST['pesan'];
    if (empty($nama) || empty($email)) {
        echo '<div class="warning">Data tidak boleh kosong</div>';
    } else {
        $insert = mysqli_query($koneksi, "INSERT INTO kontak (nama, email, pesan) VALUES ('$nama', '$email', '$pesan')");
        if ($insert) {
            echo '<div class="success">Pesan berhasil dikirim</div>';
        } else {
            echo '<div class="error">Pesan gagal dikirim</div>';
        }
    }
}

if (isset($_SESSION['email'])) {
    $user_id = $_SESSION['email'];
} else {
    $user_id = '';
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
               <!-- lOGO TEXT  -->
               <a href="" class="navbar-brand">Apotik Brody</a>
          </div>
          <!-- MENU LINKS -->
          <div class="collapse navbar-collapse">
               <ul class="nav navbar-nav navbar-nav-first">
                    <li class="active"><a href="index.php">Home</a></li>
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


     <!-- HOME -->
     <section id="home">
          <div class="row">
               <div class="owl-carousel owl-theme home-slider">
                    <div class="item item-first">
                         <div class="caption">
                              <div class="container">
                                   <div class="col-md-6 col-sm-12">
                                        <h1>Produk Lengkap</h1>
                                        <h3>Mulai dari produk kesehatan, produk bayi, sampai produk kecantikan tersedia.</h3>
                                   </div>
                              </div>
                         </div>
                    </div>

                    <div class="item item-second">
                         <div class="caption">
                              <div class="container">
                                   <div class="col-md-6 col-sm-12">
                                        <h1>Pengiriman terbaik</h1>
                                        <h3>Pengiriman cepat dan aman.</h3>
                                   </div>
                              </div>
                         </div>
                    </div>

                    <div class="item item-third">
                         <div class="caption">
                              <div class="container">
                                   <div class="col-md-6 col-sm-12">
                                        <h1>Diskon Terbaik</h1>
                                        <h3>Diskon terbaik bagi pelanggan setia kami.</h3>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </section>

     <main>
          <section>
               <div class="container">
                    <div class="row">
                         <div class="col-md-12 col-sm-12">
                              <div class="text-center">
                                   <h2>About us</h2>

                                   <br>

                                   <p class="lead">
                                   Toko apotik kami adalah tempat yang siap melayani kebutuhan kesehatan Anda. 
                                   Kami menawarkan berbagai jenis obat-obatan, suplemen, serta produk kesehatan berkualitas tinggi. 
                                   Apoteker kami yang berlisensi siap memberikan saran dan informasi terkait penggunaan obat dengan aman, serta memberikan solusi kesehatan yang terbaik untuk Anda. 
                                   Kami berkomitmen untuk memberikan layanan terbaik dalam menjaga kesehatan Anda dan keluarga. Selain itu, kami juga menyediakan berbagai produk perawatan kesehatan, seperti alat-alat kesehatan, perawatan kulit, dan produk kesehatan lainnya. 
                                   Kunjungi toko apotik kami dan percayakan kesehatan Anda kepada kami.
                                   </p>
                              </div>
                         </div>
                    </div>
               </div>
          </section>

<section>
               <div class="container">
                    <div class="row">
                         <div class="col-md-12 col-sm-12">
                              <div class="section-title text-center">
                                   <h2>Kerja Sama <small>Kami bekerja sama dengan perusahaan obat ternama demi menunjang persediaan produk kami</small></h2>
                              </div>
                         </div>

                         <div class="col-md-4 col-sm-4">
                              <div class="courses-thumb courses-thumb-secondary">
                                   <div class="courses-top">
                                        <div class="courses-image">
                                             <img src="images/logo1.jpg" class="img-responsive" alt="">
                                        </div>
                                   </div>

                                   <div class="courses-detail">
                                        <h3><a href="produk-detail.php">Kimia Farma</a></h3>


                                        <p>Medical / Health </p>
                                   </div>

                              </div>
                         </div>

                         <div class="col-md-4 col-sm-4">
                              <div class="courses-thumb courses-thumb-secondary">
                                   <div class="courses-top">
                                        <div class="courses-image">
                                             <img src="images/logo2.jpg" class="img-responsive" alt="">
                                        </div>
                                   </div>

                                   <div class="courses-detail">
                                        <h3><a href="produk-detail.php">Johnson & Johnson</a></h3>


                                        <p>Medical / Health </p>
                                   </div>

                              </div>
                         </div>

                         <div class="col-md-4 col-sm-4">
                              <div class="courses-thumb courses-thumb-secondary">
                                   <div class="courses-top">
                                        <div class="courses-image">
                                             <img src="images/logo3.jpg" class="img-responsive" alt="">
                                        </div>
                                   </div>

                                   <div class="courses-detail">
                                        <h3><a href="produk-detail.php">Kalbe Farma</a></h3>


                                        <p>Medical / Health </p>
                                   </div>

                              </div>
                         </div>

                    </div>
               </div>
          </section>          

          <section id="testimonial">
               <div class="container">
                    <div class="row">

                         <div class="col-md-12 col-sm-12">
                              <div class="section-title text-center">
                                   <h2>Testimoni </h2>
                              </div>

                              <div class="owl-carousel owl-theme owl-client">
                                   <div class="col-md-4 col-sm-4">
                                        <div class="item">
                                             <div class="tst-image">
                                                  <img src="images/profil1.jpg" class="img-responsive" alt="">
                                             </div>
                                             <div class="tst-author">
                                                  <h4>Fajar</h4>
                                             </div>
                                             <p>Terimakasih sudah mempermudah untuk mencari obat yang akan saya cari.</p>
                                             <div class="tst-rating">
                                                  <i class="fa fa-star"></i>
                                                  <i class="fa fa-star"></i>
                                                  <i class="fa fa-star"></i>
                                                  <i class="fa fa-star"></i>
                                                  <i class="fa fa-star"></i>
                                             </div>
                                        </div>
                                   </div>

                                   <div class="col-md-4 col-sm-4">
                                        <div class="item">
                                             <div class="tst-image">
                                                  <img src="images/tst-image-2-200x216.jpg" class="img-responsive" alt="">
                                             </div>
                                             <div class="tst-author">
                                                  <h4>Tania</h4>
                                             </div>
                                             <p>Untuk obat-obat tertentu masih ada beberapa yang belum ada di daftar obat!</p>
                                             <div class="tst-rating">
                                                  <i class="fa fa-star"></i>
                                                  <i class="fa fa-star"></i>
                                                  <i class="fa fa-star"></i>
                                             </div>
                                        </div>
                                   </div>

                                   <div class="col-md-4 col-sm-4">
                                        <div class="item">
                                             <div class="tst-image">
                                                  <img src="images/profil2.jpg" class="img-responsive" alt="">
                                             </div>
                                             <div class="tst-author">
                                                  <h4>Daus Jelek</h4>
                                             </div>
                                             <p>Pelayanannya bagus, kakak apotekernya cantik😍.</p>
                                             <div class="tst-rating">
                                                  <i class="fa fa-star"></i>
                                                  <i class="fa fa-star"></i>
                                                  <i class="fa fa-star"></i>
                                                  <i class="fa fa-star"></i>
                                             </div>
                                        </div>
                                   </div>

                                   <div class="col-md-4 col-sm-4">
                                        <div class="item">
                                             <div class="tst-image">
                                                  <img src="images/tst-image-4-200x216.jpg" class="img-responsive" alt="">
                                             </div>
                                             <div class="tst-author">
                                                  <h4>Rayhan</h4>
                                             </div>
                                             <p>Pelayanan yang sangat efektif dan program yg mudah di pakai.</p>
                                             <div class="tst-rating">
                                                  <i class="fa fa-star"></i>
                                                  <i class="fa fa-star"></i>
                                                  <i class="fa fa-star"></i>
                                                  <i class="fa fa-star"></i>
                                             </div>
                                        </div>
                                   </div>

                              </div>
                        </div>
                    </div>
               </div>
          </section> 
     </main>

   
     <!-- CONTACT -->
     <section id="contact">
          <div class="container">
               <div class="row">

                    <div class="col-md-6 col-sm-12">
                         <form id="contact-form" role="form" action="" method="post">
                              <div class="col-md-12 col-sm-12">

                                   <input type="hidden" class="form-control" placeholder="Enter full name" name="id_kontak" required>
                                   <input type="text" class="form-control" placeholder="Enter full name" name="nama" required>
                    
                                   <input type="email" class="form-control" placeholder="Enter email address" name="email" required>

                                   <textarea class="form-control" rows="6" placeholder="Tell us about your message" name="pesan" required></textarea>
                              </div>

                              <div class="col-md-4 col-sm-12">
                                   <input type="submit" class="form-control" name="kirim" value="Kirim">
                              </div>

                         </form>
                    </div>

                    <div class="col-md-6 col-sm-12">
                         <div class="contact-image">
                              <img src="images/contact-1-600x400.jpg" class="img-responsive" alt="">
                         </div>
                    </div>

               </div>
          </div>
     </section>    

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
                                   <p>Copyright &copy; 2023 Aptoik Brody</p>
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