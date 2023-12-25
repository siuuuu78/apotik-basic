<?php
require_once("config/koneksi.php");
session_start();

$user_id = isset($_SESSION['email']) ? $_SESSION['email'] : '';

if (isset($_POST['upload'])) {
    $id_transaksi = $_GET['id'];
    $gambar_produk = $_FILES['bukti_pembayaran'];

    if (!empty($gambar_produk['name'])) {
        $ekstensi_diperbolehkan = array('png', 'jpg');
        $x = explode('.', $gambar_produk['name']);
        $ekstensi = strtolower(end($x));
        $file_tmp = $gambar_produk['tmp_name'];
        $angka_acak = rand(1, 999);
        $nama_gambar_baru = $angka_acak . '-' . $gambar_produk['name'];

        if (in_array($ekstensi, $ekstensi_diperbolehkan)) {
            move_uploaded_file($file_tmp, 'images/' . $nama_gambar_baru);

            $update_status = mysqli_query($koneksi, "UPDATE checkout SET bukti_pembayaran ='$nama_gambar_baru', payment_status='verifikasi' WHERE id_transaksi = '$id_transaksi'");

            if ($update_status) {
                // Redirect ke halaman checkout.php setelah pembayaran selesai
                header("Location: bayar.php?id=$id_transaksi");
                exit();
            }
        }
    }
}

$id_transaksi = $_GET['id'];
$sql = mysqli_query($koneksi, "SELECT * FROM checkout WHERE id_transaksi = '$id_transaksi'");
$result = mysqli_fetch_array($sql);

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
               <!-- lOGO TEXT -->
               <a href="" class="navbar-brand">Apotik Brody</a>
          </div>
          <!-- MENU LINKS -->s
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
<section>
<div class="container">
    <div class="row justify-content-center">
        <?php
        if ($user_id == '') {
            echo '<p class="empty col-md-12">Please login to see your orders</p>';
        } else {
            if ($result) {
                ?>
                <div class="col-md-6"> <!-- Card -->
                    <form action="" method="POST" enctype="multipart/form-data">
                        <?php
                        $fetch_orders = $result;
                        ?>
                        <div class="card">
                            <div class="card-body">
                            <p class="card-text">Tanggal: <span><?= $fetch_orders['tanggal']; ?></span></p>
                            <p class="card-text">Name: <span><?= $fetch_orders['nama']; ?></span></p>
                            <p class="card-text">Email: <span><?= $fetch_orders['email']; ?></span></p>
                            <p class="card-text">No Telepon: <span><?= $fetch_orders['nohp']; ?></span></p>
                            <p class="card-text">Alamat: <span><?= $fetch_orders['alamat']; ?></span></p>
                            <p class="card-text">Metode Pembayaran: <span><?= $fetch_orders['pembayaran']; ?></span></p>
                            <p class="card-text">Pesanan: <span><?= $fetch_orders['jumlah_produk']; ?></span></p>
                            <p class="card-text">Total Harga: <span>Rp<?= number_format($fetch_orders['harga']); ?></span></p>
                            <p class="card-text">Status Pembayaran: 
                                <span style="color:<?php echo ($fetch_orders['payment_status'] == 'pending') ? 'red' : 'green'; ?>">
                                    <?= $fetch_orders['payment_status']; ?>
                                </span>
                            </p>
                        </div>
                        <?php
                        //  kondisi untuk menampilkan atau menyembunyikan input gambar
                        if ($fetch_orders['payment_status'] == 'pending') {
                            ?>
                            <p>Bukti Pembayaran</p>
                            <input type="file" name="bukti_pembayaran" placeholder="Bukti Pembayaran" class="form-control">
                            <button type="submit" name="upload" class="btn btn-success">Kirim</button>
                            <?php
                        } else {
                            // Jika status pembayaran tidak 'pending', sembunyikan input gambar
                            ?>
                            <p>Bukti Pembayaran telah diunggah dan status pembayaran sedang diverifikasi.</p>
                            <?php
                        }
                        ?>
                    </div>
                </form>
                </div>

                <div class="col-md-6"> <!-- Kolom untuk Gambar -->
                <img src="images/contoh.jpg" alt="Your Image" class="img-fluid" style='height:510px;'>
                <h5>Scan Barcode Di atas Ini Untuk Pembayaran Pesanan Anda</h5>
                </div>
                <?php
            } else {
                echo '<p class="empty col-md-12">No orders placed yet!</p>';
            }
        }
        ?>
    </div>
</div>
</section>



<!-- SCRIPTS -->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/smoothscroll.js"></script>
<script src="js/custom.js"></script>


</body>
</html>
