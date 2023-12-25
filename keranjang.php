<?php
        include 'config/koneksi.php';
        session_start();

        if (isset($_SESSION['email'])) {
          $user_id = $_SESSION['email'];
      } else {
          $user_id = '';
      }

  
        if(isset($_POST['update_cart'])){
            $update_jumlah = $_POST['cart_quantity'];
            $update_id = $_POST['cart_id'];
            mysqli_query($koneksi, "UPDATE `keranjang` SET jumlah_produk = '$update_jumlah' WHERE id = '$update_id'") ;
           echo 'cart quantity updated successfully!';
         }
         
         if(isset($_GET['remove'])){
            $remove_id = $_GET['remove'];
            mysqli_query($koneksi, "DELETE FROM `keranjang` WHERE id = '$remove_id'") ;
            header('location:keranjang.php');
         }
           
         if(isset($_GET['delete_all'])){
          mysqli_query($koneksi, "DELETE FROM `keranjang`");
          header('location:keranjang.php');
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

                    <!-- lOGO TEXT -->
                    <a href="" class="navbar-brand">Apotik Brody</a>
               </div>

               <!-- MENU LINKS -->
               <div class="collapse navbar-collapse">
               <ul class="nav navbar-nav navbar-nav-first">
                    <li ><a href="index.php">Home</a></li>
                    <li><a href="produk.php">Produk</a></li>
                    <li><a href="about-us.php">About Us</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                    <li class="active"><a href="keranjang.php">Keranjang</a></li>
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
                    <h1>Daftar Keranjang</h1>

                    <br>

               </div>
          </div>
     </section>

<section>
<div class="container keranjang">
<table>
  <thead>
      <tr>
          <th>Gambar</th>
          <th>Nama Produk</th>
          <th>Harga</th>
          <th>Jumlah</th>
          <th>Total Harga</th>
          <th>Action</th>
      </tr>
  </thead>
  <tbody>
      <?php
          $grand_total = 0;

          $sql = "SELECT * FROM keranjang";
          $query = mysqli_query($koneksi, $sql);

          if (mysqli_num_rows($query) > 0) {
              while ($result = mysqli_fetch_assoc($query)) {
                  $sub_total = $result['harga'] * $result['jumlah_produk'];
                  $grand_total += $sub_total;
      ?>
                  <tr>
                      <td><img src="/images<?php echo $result['gambar_produk']; ?>" style="height: 120px"/></td>
                      <td class="text-center"><?php echo $result['nama']; ?></td>
                      <td>Rp<?= number_format($result['harga'],); ?></td>
                      <td>
                          <form action="" method="post">
                              <input type="hidden" name="cart_id" value="<?php echo $result['id']; ?>">
                              <input type="number" min="1" name="cart_quantity" value="<?php echo $result['jumlah_produk']; ?>">
                              <input type="submit" name="update_cart" value="Update" class="option-btn">
                          </form>
                      </td>
                      <td>Rp <?php echo number_format($sub_total, 0, ',', '.'); ?></td>
                      <td><a href="keranjang.php?remove=<?php echo $result['id']; ?>" class="delete-btn" onclick="return confirm('Hapus barang?');">Remove</a></td>
                  </tr>
      <?php
              }
          } else {
              echo "Tidak Ada Barang Di Keranjang.";
          }
      ?>
      <tr class="table-bottom">
          <td colspan="4">Grand Total:</td>
          <td>Rp <?php echo number_format($grand_total, 0, ',', '.'); ?></td>
          <td><a href="keranjang.php?delete_all=true" onclick="return confirm('Hapus semua barang?');" class="delete-btn <?php echo ($grand_total > 1) ? '' : 'disabled'; ?>">Delete All</a></td>
      </tr>
  </tbody>
</table>
<div class="cart-btn">
  <a href="checkout.php" class="btn btn-info" name="checkout"> Checkout</a>
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
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>