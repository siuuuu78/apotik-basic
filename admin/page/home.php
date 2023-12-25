<?php

require_once("../config/koneksi.php")

?>

<link rel="stylesheet" href="css/admin.css">
<div class="row">
    <div class="col-lg-3 col-md-3">
        <div class="card">
            <?php
            $total_completes = 0;
            $select_completes = mysqli_query($koneksi, "SELECT * FROM `checkout` WHERE payment_status = 'completed'");
            while ($fetch_completes = mysqli_fetch_assoc($select_completes)) {
                $total_completes += $fetch_completes['harga'];
            }
            ?>
            <div class="card-body">
                <h3 class="card-title"><span>Rp </span><?= number_format($total_completes) ; ?><span></span></h3>
                <p class="card-text">Total Penjualan</p>
                <a href="main.php?page=checkout" class="btn btn-primary">Detail</a>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-3">
        <div class="card">
            <?php
            $get_user = "SELECT * FROM users"; 
            $run_user = mysqli_query($koneksi, $get_user);
            $count_user = mysqli_num_rows($run_user);
            ?>
            <div class="card-body">
                <h3 class="card-title"><span><?= $count_user ?></span></h3> 
                <p class="card-text">Total User</p>
                <a href="main.php?page=user" class="btn btn-primary">Detail</a>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3">
        <div class="card">
            <?php
            $get_produk = "SELECT * FROM produk"; 
            $run_produk = mysqli_query($koneksi, $get_produk);
            $count_produk = mysqli_num_rows($run_produk);
            ?>
            <div class="card-body">
                <h3 class="card-title"><span><?= $count_produk ?></span></h3> 
                <p class="card-text">Total Produk</p>
                <a href="main.php?page=produk" class="btn btn-primary">Detail</a>
            </div>
        </div>
    </div>
</div>

        