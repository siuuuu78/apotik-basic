<?php
    if(isset($_POST['edit_produk'])){
        $id_produk = $_POST['id_produk'];
        $nama = $_POST['nama_produk'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok_produk'];
        if(empty($id_produk) || empty($nama) || empty($stok)){
            echo '<div class="warning">data tidak boleh kosong<?div>';
        }else{
            $edit = mysqli_query($koneksi, "UPDATE produk SET
            nama_produk ='$nama', stok_produk='$stok',  harga='$harga' WHERE id_produk='$id_produk'");
            if($edit){
                echo '<div class="success">Produk berhasil diedit</div>';
            }else{
                echo '<div class="error">Produk gagal diedit</div>';
            }
        }
    }


    $id_produk = $_GET['id'];
    $sql = mysqli_query($koneksi, "SELECT * FROM produk WHERE id_produk = '$id_produk'");
    $result = mysqli_fetch_array($sql);
 ?>
<div class="col-lg-12">
    <section class="panel">
        <form method="post" action="">
            <fieldset >
            <legend>Edit Produk</legend>
            <input type="hidden"name="id_produk" placehorder="Id produk" class="form-control" value="<?php echo $result['id_produk'];?>"><br>
            <legend>Nama Produk</legend>
            <input type="text"name="nama_produk" placehorder="Nama Produk" class="form-control"value="<?php echo $result['nama_produk'];?>"><br>
            <legend>Harga Produk</legend>
            <input type="text"name="harga" placehorder="Harga" class="form-control"value="<?php echo $result['harga'];?>"><br>
            <legend>Stok Produk</legend>
            <input type="text"name="stok_produk" placehorder="Stok" class="form-control"value="<?php echo $result['stok_produk'];?>"><br>
            <input class="btn btn-info" type="submit" name="edit_produk" value="Edit produk" class="sumbit">
            </fieldset>
        </form>
    </section>
</div>