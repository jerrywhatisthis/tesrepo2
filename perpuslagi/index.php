<?php

session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}
require 'functions.php';

$book = query("SELECT * FROM books");

if( isset($_POST["cari"]) ) {
    $book = cari($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>
</head>
<body>
    
    <h1><a href="logout.php">Logout</a></h1>

    <h1 style="text-align: center;">Daftar buku yang terdapat di perpustakaan</h1>

    <h2 style="text-align: center;"><a href="create.php">Tambah buku</a></h2>

    <center>
    <form action="" method="post">
        <input type="text" name="keyword" size="50" autofocus placeholder="Masukkan judul buku atau nama penulis..." autocomplete="off">
        <button type="submit" name="cari">Cari Buku!</button>
    </form>
    </center>

    <br>

    <table border="1" cellpadding="10" cellspacing="0" align="center">
        <tr>
            <th>NO.</th>
            <th>COVER</th>
            <th>JUDUL BUKU</th>
            <th>PENULIS</th>
            <th>TAHUN TERBIT</th>
            <th>AKSI</th>
        </tr>

    <?php $i = 1; ?>
    <?php foreach( $book as $row ) : ?>
        <tr>
            <td><?= $i; ?></td>
            <td><img src="img/<?= $row["gambar"]; ?>" width="250"></td>
            <td><?= $row["judulBuku"]; ?></td>
            <td><?= $row["penulis"]; ?></td>
            <td><?= $row["tahun"]; ?></td>
            <td>
                <a href="change.php?id=<?= $row["idBuku"]; ?>">UBAH DATA!</a>
                <a href="delete.php?id=<?= $row["idBuku"]; ?>" onclick="return confirm ('YAKIN INGIN MENGHAPUS?')">HAPUS DATA!</a>
            </td>
        </tr>
    <?php $i++; ?>
    <?php endforeach; ?>
    </table>

</body>
</html>