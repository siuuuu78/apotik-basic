<?php
require_once("config/koneksi.php");
session_start();

if (isset($_SESSION['email'])) {
    $user_id = $_SESSION['email'];
} else {
    $user_id = '';
}

if(isset($_POST['order_btn'])){
   $name = $_POST['nama'];
   $number = $_POST['nohp'];
   $email = $_POST['email'];
   $flat = $_POST['alamat'];
   $street = $_POST['provinsi'];
   $city = $_POST['kota'];
   $pin_code = $_POST['kode_pos'];
   $method = $_POST['pembayaran'];

   // Fetch data keranjang
   $cart_query = mysqli_query($koneksi, "SELECT * FROM `keranjang`");
   $price_total = 0;
   $product_name = array();

   if(mysqli_num_rows($cart_query) > 0){
      while($product_item = mysqli_fetch_assoc($cart_query)){
         $product_price = $product_item['harga'] * $product_item['jumlah_produk'];
         $product_name[] = $product_item['nama'] .' ('. $product_item['jumlah_produk'] .') ';
         $price_total += $product_price;
      }
   }

  
   $total_product = implode(', ', $product_name);

   
   $detail_query = mysqli_query($koneksi, "INSERT INTO `checkout`(nama, nohp, email, alamat, provinsi, kota, kode_pos, pembayaran, harga, jumlah_produk) 
   VALUES('$name', '$number', '$email', '$flat', '$street', '$city', '$pin_code', '$method', '$price_total', '$total_product')");


   if ($cart_query && $detail_query) {
    echo "
    <div class='order-message-container'>
        <div class='card' style='background-color: #fff; border: 1px solid #ddd;'>
            <div class='card-body'>
                <h3 class='card-title'>Terima Kasih Sudah Berbelanja!</h3>
                <div class='order-detail'>
                    <p class='card-text'><strong>Produk:</strong> " . $total_product . "</p>
                    <p class='card-text'><strong>Total Harga:</strong> Rp" . $price_total . "</p>
                </div>
                <div class='customer-details'>
                    <h5 class='card-title'>Detail Pembeli</h5>
                    <p class='card-text'><strong>Nama:</strong> " . $name . "</p>
                    <p class='card-text'><strong>No Hp:</strong> " . $number . "</p>
                    <p class='card-text'><strong>Email:</strong> " . $email . "</p>
                    <p class='card-text'><strong>Alamat:</strong> " . $flat . ", " . $street . ", " . $city . ", - " . $pin_code . "</p>
                    <p class='card-text'><strong>Metode Pembayaran:</strong> " . $method . "</p>";

    // kondisi untuk pembayaran 
    if ($method == 'dana') {
        echo "<p class='card-text'>Silahkan bayar di Riwayat Pemesanan!</p>";
    }

    echo "
                    <p class='card-text'>*Bayar Ketika Produk Sampai</p>
                </div>
                <a href='produk.php' class='btn btn-primary'>Lanjut Belanja</a>
            </div>
        </div>
    </div>
    ";

    // query SQL DELETE untuk menghapus semua item dari keranjang
    $delete_cart_items = mysqli_query($koneksi, "DELETE FROM `keranjang`");

    // Kondisi  penghapusan
    if ($delete_cart_items) {
        echo "<script>alert('Pesanan berhasil! Keranjang telah dikosongkan.');</script>";
    } else {
        echo "<script>alert('Pesanan berhasil! Terjadi kesalahan dalam mengosongkan keranjang.');</script>";
    }
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
                    <a href="" class="navbar-brand">Apotik Brody</a>
               </div>
               <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-nav-first">
                         <li><a href="index.php">Home</a></li>
                         <li><a href="produk.php">Produk</a></li>
                         <li ><a href="about-us.php">About Us</a></li>
                         <li><a href="contact.php">Contact Us</a></li>
                         <li><a href="keranjang.php">Keranjang</a></li>
                         <li class="active"><a href="checkout.php">Checkout</a></li>
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
                    <h1>Checkout</h1>
                    <br>
               </div>
          </div>
     </section>

     <div class="container">
        <section class="checkout-form">
            <form action="" method="post">
                <div class="display-order">
                    <?php
                    $select_cart = mysqli_query($koneksi, "SELECT * FROM `keranjang`");
                    $grand_total = 0;

                    if (mysqli_num_rows($select_cart) > 0) {
                        echo "KERANJANG ANDA";
                        echo "<table>";
                        echo "<thead><tr><th>Nama Produk</th><th>Jumlah</th><th>Harga Satuan</th><th>Total Harga</th></tr></thead>";
                        echo "<tbody>";

                        while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                            $total_price = $fetch_cart['harga'] * $fetch_cart['jumlah_produk'];
                            $grand_total += $total_price;
                            ?>
                            <tr>
                                <td><?= $fetch_cart['nama']; ?></td>
                                <td><?= $fetch_cart['jumlah_produk']; ?></td>
                                <td>Rp<?= $fetch_cart['harga']; ?></td>
                                <td>Rp<?= $total_price; ?></td>
                            </tr>
                            <?php
                        }

                        echo "</tbody>";
                        echo "</table>";
                    } else {
                        echo "<div class='display-order'><span>Keranjang Anda Kosong!</span></div>";
                    }
                    ?>
                    <span class="grand-total"> Total Harga : Rp<?= $grand_total; ?> </span>
                </div>
                <div class="flex">
                    <div class="inputBox">
                        <span>Nama</span>
                        <input type="text" placeholder="Nama Lengkap" name="nama" required>
                    </div>
                    <div class="inputBox">
                        <span>No HP</span>
                        <input type="number" placeholder="No HP" name="nohp" required>
                    </div>
                    <div class="inputBox">
                        <span>Email</span>
                        <input type="email" placeholder="Email" name="email" required>
                    </div>
                    <div class="inputBox">
                        <span>Alamat</span>
                        <input type="text" placeholder="Alamat" name="alamat" required>
                    </div>
                    <div class="inputBox">
                        <span>Provinsi</span>
                        <input type="text" placeholder="Provinsi" name="provinsi" required>
                    </div>
                    <div class="inputBox">
                        <span>Kota</span>
                        <input type="text" placeholder="Kota" name="kota" required>
                    </div>
                    <div class="inputBox">
                        <span>Kode Pos</span>
                        <input type="text" placeholder="Kode Pos" name="kode_pos" required>
                    </div>
                    <div class="inputBox">
                    <span>Metode Pembayaran</span>
                    <select name="pembayaran" id="metodePembayaran" onchange="togglePaymentFields()">
                        <option value="cash on delivery" selected>Cash on Delivery</option>
                        <option value="dana">Dana</option>
                    </select>
                </div>

                    <div class="inputBox full-width">
                        <input type="submit" value="Pesan Sekarang" name="order_btn" class="btn">
                    </div>
                </div>
            </form>
        </section>
    </div>

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
