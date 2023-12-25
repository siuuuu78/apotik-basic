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

                    <!-- lOGO TEXT  -->
                    <a href="" class="navbar-brand">Apotik Brody</a>
               </div>

               <!-- MENU LINKS -->
               <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-nav-first">
                         <li><a href="index.php">Home</a></li>
                         <li><a href="produk.php">Produk</a></li>
                         <li class="active"><a href="about-us.php">About Us</a></li>
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
                    <h1>About Us</h1>

                    <br>

                    <p class="lead">Tentang Apotik Brody</p>
               </div>
          </div>
     </section>

     <section class="section-background">
          <div class="container">
               <div class="row">
                    <div class="col-md-offset-1 col-md-4 col-xs-12 pull-right">
                         <img src="images/about-1-720x720.jpg" class="img-responsive img-circle" alt="">
                    </div>

                    <div class="col-md-7 col-xs-12">
                         <div class="about-info">
                              <h2>Kenapa Harus Apotik Kami ?</h2>

                              <figure>
                                   <figcaption>
                                        <p> Kami memiliki apoteker berlisensi yang siap memberikan saran dan informasi yang akurat tentang obat-obatan dan produk kesehatan. 
                                             Kami selalu mengutamakan keamanan dan kesehatan Anda.
                                        <p>Kami hanya menyediakan obat-obatan berkualitas tinggi dan produk-produk kesehatan yang telah terbukti efektif. 
                                             Kepercayaan Anda adalah prioritas kami.
                                             Kami menyediakan berbagai macam obat-obatan, suplemen, serta produk perawatan kesehatan, sehingga Anda memiliki banyak pilihan untuk memenuhi kebutuhan kesehatan Anda.</p>
                                   </figcaption>
                              </figure>
                         </div>
                    </div>
               </div>
          </div>
     </section>

     <section>
          <div class="container">
               <div class="row">
                    <div class="col-md-4 col-xs-12">
                         <img src="images/apotik1.jpg" class="img-responsive img-circle" alt="">
                    </div>

                    <div class="col-md-offset-1 col-md-7 col-xs-12">
                         <div class="about-info">
                              <h2>Sejarah Apotik Brody</h2>

                              <figure>
                                   <figcaption>
                                        <p>Toko apotik kami didirikan pada tahun 2023 oleh Daus di Medan Tuntungan. Daus adalah seorang apoteker berbakat yang memiliki visi untuk mendirikan apotik yang tidak hanya menyediakan obat-obatan, 
                                             tetapi juga memberikan perhatian pribadi kepada setiap pelanggan.
                                        <p>Selama bertahun-tahun, toko apotik kami telah tumbuh dan berkembang. Kami selalu memprioritaskan pelayanan pelanggan, 
                                             memberikan informasi yang akurat tentang penggunaan obat, serta menawarkan produk-produk kesehatan berkualitas tinggi. 
                                             Inilah yang membuat toko apotik kami menjadi pilihan utama bagi masyarakat setempat.</p>
                                   </figcaption>
                              </figure>
                         </div>
                    </div>
               </div>
          </div>
     </section>

     <section class="section-background">
          <div class="container">
               <div class="row">
                    <div class="col-md-12 col-sm-12">
                         <div class="text-center">
                              <h2>Apotik Brody</h2>

                              <br>

                              <p class="lead">Selamat datang di Apotik Brody, sebuah destinasi yang didedikasikan untuk memenuhi kebutuhan kesehatan Anda dengan cara yang efisien, aman, dan terpercaya. Sebagai toko apotek daring, kami berkomitmen untuk memberikan akses yang mudah dan cepat ke berbagai produk kesehatan berkualitas tinggi. 
                                             Kami menghadirkan pilihan lengkap obat-obatan, suplemen, dan perawatan kesehatan lainnya, semua dipilih dengan teliti untuk memastikan keamanan dan efektivitasnya. Dengan layanan profesional dan tim yang berpengalaman di bidang kesehatan, kami siap membantu Anda dengan informasi yang akurat dan solusi yang tepat. 
                                             Ketelitian dan keamanan adalah inti dari filosofi kami. Setiap produk yang kami tawarkan  melalui proses seleksi yang ketat untuk memastikan kepatuhan terhadap standar kualitas tertinggi. Kami percaya bahwa kemudahan akses terhadap produk kesehatan yang berkualitas adalah hak setiap individu dan hal inilah yang menjadi motivasi kami untuk terus memberikan pelayanan terbaik. 
                                             Lebih dari sekedar toko, kami adalah mitra kesehatan Anda. Dengan menggabungkan teknologi inovatif dan layanan yang ramah, kami berupaya menciptakan pengalaman belanja online yang menyenangkan dan memberikan solusi perawatan kesehatan yang disesuaikan dengan kebutuhan unik Anda. 
                                             Terima kasih telah memilih kami sebagai mitra kesehatan Anda. Kami berkomitmen untuk terus meningkatkan layanan dan produk kami sehingga Anda dapat menjalani hidup yang lebih sehat dan bermakna.</p>
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