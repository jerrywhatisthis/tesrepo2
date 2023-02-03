<?php

session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

if( isset ($_POST["submit"] ) ) {

    // $judul_buku = $_POST["judul_buku"];
    // $nama_penulis = $_POST["nama_penulis"];
    // $tahun = $_POST["tahun"];    
    
    // $query = "INSERT INTO daftar_buku VALUES ('', '$judul_buku', '$nama_penulis', '$tahun')";

    // mysqli_query($conn, $query);

    if( tambah($_POST) > 0 ) {
        echo "<script>
            alert('DATA BERHASIL DITAMBAHKAN');
            document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('DATA GAGAL DITAMBAHKAN');
        </script>";
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menambah daftar buku</title>
</head>
<body>

    <h1>TAMBAH BUKU</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="judulBuku">JUDUL BUKU : </label>
                <input type="text" name="judulBuku" id="judulBuku" required>
            </li>
            <br>
            <li>
                <label for="penulis">NAMA PENULIS : </label>
                <input type="text" name="penulis" id="penulis" required>
            </li>
            <br>
            <li>
                <label for="tahun">TAHUN : </label>
                <input type="text" name="tahun" id="tahun" required>
            </li>
            
            <br>
            
            <li>
                <label for="gambar">GAMBAR : </label>
                <input type="file" name="gambar" id="gambar" required>
            </li>
            
            <br>
            
            <li>
                <button type="submit" name="submit">TAMBAH BUKU!</button>
            </li>
            
        </ul>
    </form>
    
</body>
</html>