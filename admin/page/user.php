<div class="col-g-12"><h3>Data User</h3></div>
<?php
    if(isset($_GET['action'])){
        if($_GET['action']=="hapus"){
            $id = $_GET['id'];
            $sql = mysqli_query($koneksi,"DELETE FROM users WHERE id_user = '$id'");
            if($sql){
                echo 'Pelanggan berhasil dihapus';
            }else{
                echo 'Pelanggan gagal dihapus';
            }
        }
    }
?>
<div class="col-g-12">
    <section class="panel">
    <table class="table">
        <tr>
            <th>No</th>
            <th>Nama </th>
            <th>Email</th>
            <th>No Telepon</th>
            <th>Alamat</th>
            <th>Password</th>
        </tr>
        <?php
        $sql = mysqli_query($koneksi, "SELECT * FROM users");
        $no=1;
        if($sql){
            while($result=mysqli_fetch_array($sql)){
                ?>
                <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $result['nama']; ?></td>
                    <td><?php echo $result['email']; ?></td>
                    <td><?php echo $result['notelp']; ?></td>
                    <td><?php echo $result['alamat']; ?></td>
                    <td><?php echo $result['password']; ?></td>
                    <td>
                        <a href="main.php?page=web&action=hapus&id=<?php echo $result['id_user']; ?>" onclick="
                        return confirm('yakin?')"
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