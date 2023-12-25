<div class="col-g-12"><h3>Data Pesanan</h3></div>
<?php
   if (isset($_POST['update_payment'])) {

    $order_id = $_POST['id_transaksi'];
    $payment_status = $_POST['payment_status'];
    $update_status = mysqli_prepare($koneksi, "UPDATE `checkout` SET payment_status = ? WHERE id_transaksi = ?");
    mysqli_stmt_bind_param($update_status, 'si', $payment_status, $order_id);
    mysqli_stmt_execute($update_status);
    $message[] = ' status updated!';
}

if(isset($_GET['action'])){
    if($_GET['action']=="hapus"){
        $id = $_GET['id'];
        $sql = mysqli_query($koneksi,"DELETE FROM checkout WHERE id_transaksi = '$id'");
        if($sql){
            echo 'Pesanan berhasil dihapus';
        }else{
            echo 'Pesanan gagal dihapus';
        }
    }
}
?>
<div class="col-g-12">
    <section class="panel">
    <table class="table">
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Nama</th>
            <th>No Hp</th>
            <th>Email</th>
            <th>Alamat</th>
            <th>Provinsi</th>
            <th>Kota</th>
            <th>Kode Pos</th>
            <th>Pembayaran</th>
            <th>Harga</th>
            <th>Jumlah Produk</th>
            <th>Bukti Pembayaran</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php
        $sql = mysqli_query($koneksi, "SELECT * FROM checkout");
        $no=1;
        if($sql){
            while($result=mysqli_fetch_array($sql)){
                ?>
                <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $result['tanggal']?></td>
                    <td><?php echo $result['nama']; ?></td>
                    <td><?php echo $result['nohp']; ?></td>
                    <td><?php echo $result['email']; ?></td>
                    <td><?php echo $result['alamat']; ?></td>
                    <td><?php echo $result['provinsi']; ?></td>
                    <td><?php echo $result['kota']; ?></td>
                    <td><?php echo $result['kode_pos']; ?></td>
                    <td><?php echo $result['pembayaran']; ?></td>
                    <td><?php echo $result['harga']; ?></td>
                    <td><?php echo $result['jumlah_produk']; ?></td>
                    <td><img src="../images/<?php echo $result['bukti_pembayaran']; ?>" style='height: 50px;'></td>
                    <td>
                    <form action="" method="POST">
                            <input type="hidden" name="id_transaksi" value="<?= $result['id_transaksi']; ?>">
                            <select name="payment_status" class="drop-down">
                                <option value="" selected disabled><?= $result['payment_status']; ?></option>
                                <option value="Pending">Pending</option>
                                <option value="verifikasi">Verifikasi</option>
                                <option value="dikemas">Dikemas</option>
                                <option value="dikirim">Dikirim</option>
                                <option value="completed">Completed</option>
                            </select>
                            <input type="submit" value="update" class="btn" name="update_payment">
            </form>
                        </td>
                        <td>     
                        <a href="main.php?page=checkout&action=hapus&id=<?php echo $result['id_transaksi']; ?>"
                        onclick="return confirm('yakin?')"
                        class="btn btn-danger">HAPUS</a>
                    </td>
                </tr>
                <?php
                $no++;
            }
        }
        ?>
    </table>
    </section>
</div>