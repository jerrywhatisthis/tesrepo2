<?php

require 'functions.php';
    
    if( isset($_POST["register"]) ) {
        if ( registrasi($_POST) > 0 ) {
            echo "<script>alert('USER BARU BERHASIL DITAMBAHKAN')</script>";
            header("Location: login.php");
        } else {
            echo mysqli_error($conn);
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
</head>
<body>

    <h1>Halaman Registrasi</h1>

    <form action="" method="post">
    
    <ul>
        <li>
            <label for="username">USERNAME :</label>
            <input type="text" name="username" id="username">
        </li>
        <br>
        <li>
            <label for="password">PASSWORD :</label>
            <input type="password" name="password" id="password">
        </li>
        <br>
        <li>
            <label for="password2">KONFIRMASI PASSWORD</label>
            <input type="password" name="password2" id="password2">
        </li>
        <br>
        <li>
            <button type="submit" name="register">REGISTER!</button>
        </li>
    </ul>

    </form>
    
</body>
</html>