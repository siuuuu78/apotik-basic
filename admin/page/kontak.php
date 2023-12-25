<div class="col-g-12"><h3>Data Kontak</h3></div>
<?php
    if(isset($_GET['action'])){
        if($_GET['action']=="hapus"){
            $id = $_GET['id'];
            $sql = mysqli_query($koneksi,"DELETE FROM kontak WHERE id_kontak = '$id'");
            if($sql){
                echo 'Pesan  berhasil dihapus';
            }else{
                echo 'Pesan gagal dihapus';
            }
        }
    }
?>
<div class="col-g-12">
    <section class="panel">
    <table class="table">
        <tr>
            <th>No</th>
            <th>Id Kontak</th>
            <th>Nama </th>
            <th>Email</th>
            <th>Pesan</th>
        </tr>
        <?php
        $sql = mysqli_query($koneksi, "SELECT * FROM kontak");
        $no=1;
        if($sql){
            while($result=mysqli_fetch_array($sql)){
                ?>
                <tr>
                    <td><?php echo $no ?></td>
                    <td><?php echo $result['id_kontak']; ?></td>
                    <td><?php echo $result['nama']; ?></td>
                    <td><?php echo $result['email']; ?></td>
                    <td><?php echo $result['pesan']; ?></td>
                    <td>
                        <a href="main.php?page=kontak&action=hapus&id=<?php echo $result['id_kontak']; ?>" onclick="
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