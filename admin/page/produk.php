<div class="col-g-12"><h3>Data Produk</h3></div>
<?php
    if(isset($_GET['action'])){
        if($_GET['action']=="hapus"){
            $id = $_GET['id'];
            $sql = mysqli_query($koneksi,"DELETE FROM produk WHERE id_produk = '$id'");
            if($sql){
                echo 'Produk berhasil dihapus';
            }else{
                echo 'Produk gagal dihapus';
            }
        }
    }
?>
<div class="col-g-12">
    <section class="panel">
        <a href="main.php?page=adm_tambah_produk" class="btn btn-success">TAMBAH</a>
    <table class="table">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Gambar</th>
        </tr>
        <?php
        $sql = mysqli_query($koneksi, "SELECT * FROM produk");
        $no=1;
        if($sql){
            while($result=mysqli_fetch_array($sql)){
                ?>
                <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $result['nama_produk']; ?></td>
                    <td><?php echo $result['harga']; ?></td>
                    <td><?php echo $result['stok_produk']; ?></td>
                    <td><img src="../../images<?php echo $result['gambar_produk']; ?>"style='height:150px;'></td>
                    <td>     
                        <a href="main.php?page=adm_edit_produk&id=<?php echo $result['id_produk']; ?>"
                        class="btn btn-warning">EDIT</a>
                        <a href="main.php?page=produk&action=hapus&id=<?php echo $result['id_produk']; ?>"
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