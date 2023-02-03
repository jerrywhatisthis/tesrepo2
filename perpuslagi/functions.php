<?php 

// FUNGSI TAMPIL

$conn = mysqli_connect("localhost", "root", "", "perpuslagi");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}

// FUNGSI TAMBAH

function tambah($data) {
    global $conn;
    $judulBuku = htmlspecialchars($data["judulBuku"]);
    $penulis = htmlspecialchars($data["penulis"]);
    $tahun = htmlspecialchars($data["tahun"]);

    $gambar = upload();
    if( !$gambar ) {
        return false;
    }    
    
    $query = "INSERT INTO books VALUES ('', '$judulBuku', '$penulis', '$tahun', '$gambar')";

    mysqli_query($conn, $query);

   return mysqli_affected_rows($conn);
}

// FUNGSI UPLOAD

function upload() {
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    if( $error === 4 ) {
        echo "<script>
        alert('PILIH GAMBAR TERLEBIH DAHULU');
        </script>";
        return false;
    }

    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
        echo "<script>
        alert('YANG ANDA UPLOAD BUKAN GAMBAR!');
        </script>";
    }

    if( $ukuranFile > 8388608 ) {
        echo "<script>
        alert('UKURAN GAMBAR TERLALU BESAR!');
        </script>";
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}

// FUNGSI HAPUS

function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM books WHERE idBuku = $id");

    return mysqli_affected_rows($conn);
}

// FUNGSI UBAH

function ubah($data) {
    global $conn;
    $id = $data["idBuku"];
    $judulBuku = htmlspecialchars($data["judulBuku"]);
    $penulis = htmlspecialchars($data["penulis"]);
    $tahun = htmlspecialchars($data["tahun"]);    
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    if( $_FILES['gambar']['error'] === 4 ) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }
    
    $query = "UPDATE books SET judulBuku = '$judulBuku', penulis = '$penulis', tahun = '$tahun', gambar = '$gambar' WHERE idBuku = $id";

    mysqli_query($conn, $query);

   return mysqli_affected_rows($conn);

}

// FUNGSI CARI

function cari($keyword) {
    $query = "SELECT * FROM books WHERE
    judulBuku LIKE '%$keyword%' OR
    penulis LIKE '%$keyword%'
    ";

    return query($query);
}

// FUNGSI REGISTRASI

function registrasi($data) {
    global $conn;
    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 =  mysqli_real_escape_string($conn, $data["password2"]);

    $result = mysqli_query($conn, "SELECT username FROM userAdmin WHERE username = '$username'");
    if( mysqli_fetch_assoc($result) ) {
        echo "<script>alert('USERNAME SUDAH TERDAFTAR')</script>";
        return false;
    }

    if( $password !== $password2 ) {
        echo "<script>alert('PASSWORD TIDAK SESUAI')</script>";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);
    
    mysqli_query($conn, "INSERT INTO userAdmin VALUES('', '$username', '$password')");

    return mysqli_affected_rows($conn);
}

// FUNGSI PINJAM

function pinjam($data) {
    global $conn;
    $nama = htmlspecialchars($data["nama"]);
    $judul = htmlspecialchars($data["judulBuku"]);
    $author = htmlspecialchars($data["penulis"]);
    $bid = htmlspecialchars($data["bid"]);
    $appdate = htmlspecialchars($data["appdate"]);
    $due = htmlspecialchars($data["due"]);

    $query = "INSERT INTO pinjam VALUES ('', '$nama', '$judul', '$author', '$bid', '$appdate', '$due')";

    mysqli_query($conn, $query);

   return mysqli_affected_rows($conn);
}

?>