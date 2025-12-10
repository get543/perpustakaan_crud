<?php
// Menghubungkan ke database
include 'koneksi.php';

// Mengecek apakah ada request dari form melalui metode POST
if (isset($_POST['aksi'])) {
    // Menangani proses tambah data
    if ($_POST['aksi'] == 'add') {
        // Menyimpan data yang dikirimkan dari form ke variabel
        $judul = $_POST['judul'];
        $penulis = $_POST['penulis'];
        $penerbit = $_POST['penerbit'];
        $tahun_terbit = $_POST['tahun_terbit'];
        $genre = $_POST['genre'];
        $fotobuku = $_FILES['foto_buku']['name']; // Nama file gambar buku yang diunggah
        $jumlah = $_POST['jumlah'];

        // Menentukan direktori untuk menyimpan gambar buku
        $dir = "img/";
        $tmp = $_FILES['foto_buku']['tmp_name']; // Direktori sementara file yang diunggah

        // Memindahkan file gambar dari direktori sementara ke direktori tujuan
        move_uploaded_file($tmp, $dir.$fotobuku);

        // Menyusun query untuk menambah data buku baru ke database
        $query = "INSERT INTO tb_buku VALUES (null, '$judul', '$penulis', '$penerbit', '$tahun_terbit', '$genre', '$fotobuku', '$jumlah')";
        $sql = mysqli_query($conn, $query); // Menjalankan query

        // Jika query berhasil dijalankan, kembali ke halaman utama
        if ($sql) {
            header('location: index.php');
        } else {
            // Jika gagal, tampilkan query untuk debug
            echo $query;
        }

    // Menangani proses edit data
    } else if ($_POST['aksi'] == 'edit') {
        // Menyimpan data yang dikirimkan dari form ke variabel
        $id_buku = $_POST['id_buku'];
        $judul = $_POST['judul'];
        $penulis = $_POST['penulis'];
        $penerbit = $_POST['penerbit'];
        $tahun_terbit = $_POST['tahun_terbit'];
        $genre = $_POST['genre'];
        $fotobuku = $_FILES['foto_buku']['name']; // Nama file gambar buku baru jika ada
        $jumlah = $_POST['jumlah'];

        // Mengambil data lama dari database untuk membandingkan foto
        $queryshow = "SELECT * FROM tb_buku WHERE id_buku = '$id_buku';";
        $sqlshow = mysqli_query($conn, $queryshow);
        $result = mysqli_fetch_assoc($sqlshow); // Hasil dari data lama

        // Jika tidak ada gambar baru yang diunggah, gunakan gambar lama
        if ($_FILES['foto_buku']['name'] == '') {
            $fotobuku = $result['foto_buku']; // Menggunakan foto lama
        } else {
            // Jika ada gambar baru, hapus gambar lama dari direktori
            if (file_exists('img/' . $result['foto_buku'])) {
                unlink('img/' . $result['foto_buku']);
            }
            // Pindahkan gambar baru ke direktori tujuan
            move_uploaded_file($_FILES['foto_buku']['tmp_name'], 'img/' . $fotobuku);
        }

        // Menyusun query untuk memperbarui data buku dalam database
        $query = "UPDATE tb_buku SET judul = '$judul', penulis = '$penulis', penerbit = '$penerbit', tahun_terbit = '$tahun_terbit', genre = '$genre', jumlah = '$jumlah', foto_buku = '$fotobuku' WHERE id_buku = '$id_buku';";
        $sql = mysqli_query($conn, $query); // Menjalankan query

        // Jika query berhasil dijalankan, kembali ke halaman utama
        if ($sql) {
            header('location: index.php');
        } else {
            // Jika gagal, tampilkan pesan error untuk debug
            echo "Error: " . mysqli_error($conn);
        }
    }
}

// Mengecek apakah ada permintaan penghapusan data melalui GET
if (isset($_GET['hapus'])) {
    // Mengamankan input dari pengguna dengan `mysqli_real_escape_string`
    $id_buku = mysqli_real_escape_string($conn, $_GET['hapus']);

    // Mengambil data buku dari database berdasarkan ID untuk mendapatkan nama file foto
    $queryshow = "SELECT * FROM tb_buku WHERE id_buku = '$id_buku';";
    $sqlshow = mysqli_query($conn, $queryshow);
    $result = mysqli_fetch_assoc($sqlshow);

    // Jika file foto ada di direktori, hapus file tersebut
    if (file_exists('img/' . $result['fotobuku'])) {
        unlink('img/' . $result['fotobuku']);
    }

    // Menyusun query untuk menghapus data buku dari database
    $query = "DELETE FROM tb_buku WHERE id_buku = '$id_buku'";
    $sql = mysqli_query($conn, $query); // Menjalankan query

    // Jika query berhasil dijalankan, kembali ke halaman utama
    if ($sql) {
        header('location: index.php');
        exit(); // Menghentikan script setelah penghapusan berhasil
    } else {
        // Jika gagal, tampilkan pesan error untuk debug
        echo "Error: " . mysqli_error($conn);
    }
}
?>
