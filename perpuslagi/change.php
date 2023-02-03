<?php

session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

$id = $_GET["id"];

$books = query("SELECT * FROM books WHERE idBuku = $id")[0];
// var_dump($books);

if( isset ($_POST["submit"] ) ) {

    if( ubah($_POST) > 0 ) {
        echo "<script>
            alert('DATA BERHASIL DIUBAH');
            document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('DATA GAGAL DIUBAH');
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
    <title>Ubah data buku</title>
</head>
<body>

    <h1>UBAH DATA BUKU</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="idBuku" value="<?= $books["idBuku"] ?>">
        <input type="hidden" name="gambarLama" value="<?= $books["gambar"] ?>">
        <ul>
            <li>
                <label for="judulBuku">JUDUL BUKU : </label>
                <input type="text" name="judulBuku" id="judulBuku" required value="<?= $books["judulBuku"]; ?>">
            </li>
            <br>
            <li>
                <label for="penulis">NAMA PENULIS : </label>
                <input type="text" name="penulis" id="penulis" required value="<?= $books["penulis"]; ?>">
            </li>
            <br>
            <li>
                <label for="tahun">TAHUN : </label>
                <input type="text" name="tahun" id="tahun" required value="<?= $books["tahun"]; ?>">
            </li>

            <br>
            
            <li>
                <label for="gambar">GAMBAR : </label>
                <img src="img/<?= $books['gambar']; ?>" width="250" alt="">
                <input type="file" name="gambar" id="gambar">
            </li>
            
            <br>

            <li>
                <button type="submit" name="submit">PERBARUI DATA BUKU!</button>
            </li>
        </ul>
    </form>
    
</body>
</html>