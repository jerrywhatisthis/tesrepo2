<?php

session_start();

if( !isset($_SESSION["login"]) ) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

// if( isset($_POST['submit']) ) {
//     $nama = $_POST['nama'];
//     $judul = $_POST['judul'];
//     $author = $_POST['author'];
//     $bid = $_SESSION['id'];
//     $appdate = $_POST['appdate'];
//     $due = $_POST['due'];

//     $query = mysqli_query($conn, "INSERT INTO pinjam(namaSiswa,judulBuku,penulis,idBuku,tanggalPinjam,tanggalKembali) VALUES ('$nama'. '$judul', '$author' '$bid', '$appdate', '$due')");

//     if($query) {
//         echo "<script>alert('Berhasil')</script>";
//     }
// }

if( isset ($_POST["submit"] ) ) {

    if( pinjam($_POST) > 0 ) {
        echo "<script>
            alert('BERHASIL MEMINJAM BUKU');
            document.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('GAGAL MEMINJAM BUKU');
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
    <title>Peminjaman Buku</title>

<!-- <script>
    function getbookr(val) {
	    $.ajax({
	    type: "POST",
	    url: "get_book.php",
	    data:'idBuku='+val,
	    success: function(data){
		    $("#judul").html(data);
	    }
	    });
    }
</script>	

<script>
    function getpenulis(val) {
        $.ajax({
        type: "POST",
        url: "get_book.php",
        data:'idBuku='+val,
        success: function(data){
            $("#penulis").html(data);
        }
        });
    }
</script> -->
</head>

<body>

    <h1>Peminjaman Buku!</h1>

    <form action="">

        <label for="nama">Nama Siswa</label>
        <input type="text" name="nama" value="" require="required">

        <br><br>

    <label for="judul">Judul Buku</label>
        <select name="judul" bid="id" onchange="getbook(this.value);" require="required">
            <option value="">Pilih Buku!</option>

            <?php $ret = mysqli_query($conn, "SELECT * FROM books");
                while($row = mysqli_fetch_array($ret)) {    
            ?>
            <option value="<?php echo htmlentities($row['judulBuku']); ?>">
                <?php echo htmlentities($row['judulBuku']); ?>
            </option>
            <?php } ?>
        </select>

        <br><br>
        
        <label for="author">Penulis</label>
        <input type="text" name="author">

        <br><br>

        <label for="appdate">Tanggal Pinjam</label>
        <input type="date" name="appdate" value="<?php echo date('Y-m-d'); ?>" />

        <br><br>

        <label for="due">Tanggal Kembali</label>
        <input type="date" name="due" value="<?php echo date('Y-m-d'); ?>" />

        <br><br>
        
        <label for="idBuku"></label>
        <input type="hidden" name="idBuku" value="<?= $book["idBuku"] ?>">

        <button type="submit" name="submit">PINJAM BUKU!</button>

    </form>

</body>
</html>