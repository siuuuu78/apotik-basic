<?php
   if(isset($_POST['submit_produk'])){
    $id_produk = $_POST['id_produk'];
    $nama = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok_produk'];
    $gambar_produk = $_FILES['gambar_produk']; 
    if($gambar_produk != ""){
        $ekstensi_diperbolehkan = array('png', 'jpg');
        $x = explode('.', $gambar_produk['name']);
        $ekstensi = strtolower(end($x));
        $file_tmp = $_FILES['gambar_produk']['tmp_name'];
        $angka_acak = rand(1, 999);
        $nama_gambar_baru = $angka_acak.'-'.$gambar_produk['name'];

        if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
            move_uploaded_file($file_tmp, '../../images'.$nama_gambar_baru);

            $insert = mysqli_query($koneksi,
            "INSERT INTO produk(id_produk, nama_produk, harga, stok_produk, gambar_produk)
            VALUES('$id_produk','$nama', '$harga', '$stok', '$nama_gambar_baru')");
        }
        if($insert){
            echo '<div class="success">Produk Berhasil disimpan</div>';
        }else{
            echo '<div class="error">Produk Gagal disimpan</div>';
        }
    }else{
        echo"Gambar hanya bisa jpg atau png";
    }
}

    ?>
    
    

<div class="col-lg-12">
    <section class="panel">
        <h2 align="center">Halaman Tambah Produk</h2>
        <a href="main.php?page=produk"> << Kembali ke Produk management</a>
        <form method="post" action="" enctype="multipart/form-data">
        <legend>Id Produk</legend>
            <input type="hidden"name="id_produk" placehorder="Id Produk" class="form-control"><br>
        <legend>Nama Produk</legend>
            <input type="text"name="nama_produk" placehorder="Nama Produk" class="form-control"><br>
            <legend>Harga</legend>
            <input type="text"name="harga" placehorder="Harga Produk" class="form-control"><br>
            <legend>Stok Produk</legend>
            <input type="text"name="stok_produk" placehorder="Stok" class="form-control"><br>
            <legend>Gambar Produk</legend>
            <input type="file" name="gambar_produk" placeholder="Gambar Produk" class="form-control"> <br>
            <input class="btn btn-info" type="submit" name="submit_produk" value="Tambah Produk" class="sumbit">
        </form>
    </section>
</div>