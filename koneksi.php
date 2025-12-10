<?php
    // Informasi koneksi ke database
    $host = "localhost";  // Nama host
    $user = "root";       // Username database
    $pass = "";           // Password database
    $db = "db_perpustakaan"; // Nama database

    // Membuat koneksi ke database
    $conn = mysqli_connect($host, $user, $pass, $db);
    
    // ngecek apakah koneksi berhasil
    if ($conn) {
        echo ""; // Pesan jika koneksi sukses
    } else {
        die("Koneksi gagal: " . mysqli_connect_error()); // Pesan jika koneksi gagal
    }

    // Memilih database yang akan digunakan
    mysqli_select_db($conn, $db);
?>
