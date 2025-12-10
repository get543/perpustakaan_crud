<!DOCTYPE html>

<?php
    include 'koneksi.php';  // Menghubungkan ke file koneksi database
    
    // Inisialisasi variabel untuk digunakan dalam form
    $id_buku = '';     
    $judul = '';
    $penulis = '';
    $penerbit = '';
    $tahun_terbit = '';
    $genre = '';
    $fotobuku = '';
    $jumlah = '';

    // Memeriksa apakah form ini digunakan untuk mengubah data
    if(isset($_GET['ubah'])){
        $id_buku = $_GET['ubah'];
        
        // Mengambil data buku berdasarkan ID yang dipilih
        $query = "SELECT * FROM tb_buku WHERE id_buku = '$id_buku';";
        $sql = mysqli_query($conn, $query);
        $result = mysqli_fetch_assoc($sql);

        // Mengisi variabel dengan data yang diambil dari database
        $judul = $result['judul'];
        $penulis = $result['penulis'];
        $penerbit = $result['penerbit'];
        $tahun_terbit = $result['tahun_terbit'];
        $genre = $result['genre'];
        $fotobuku = $result['foto_buku'];
        $jumlah = $result['jumlah'];
    }

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Menyertakan Bootstrap untuk styling dan komponen -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>
    <!-- Menyertakan Font Awesome untuk ikon -->
    <link rel="stylesheet" href="fontawesome/css/font-awesome.min.css">
    
    <title>PERPUSTAKAAN</title>
</head>
<body>
    <!-- Navbar untuk navigasi -->
    <nav class="navbar bg-dark border-bottom border-body mb-5" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                PERPUSTAKAAN
            </a>
        </div>
    </nav>

    <div class="container">
        <!-- Form untuk menambah atau mengubah data buku -->
        <form method="POST" action="proses.php" enctype="multipart/form-data">
            <!-- Menyimpan ID buku sebagai hidden input (hanya jika ada) -->
            <input type="hidden" name="id_buku" value="<?php echo $id_buku; ?>">

            <!-- Input untuk judul buku -->
            <div class="mb-3 row">
                <label for="judul" class="col-sm-2 col-form-label">
                    JUDUL
                </label>
                <div class="col-sm-10">
                    <input type="text" required name="judul" class="form-control" id="judul" placeholder="Ex: akulah sang badai" value="<?php echo $judul; ?>">
                </div>
            </div>

            <!-- Input untuk penulis buku -->
            <div class="mb-3 row">
                <label for="penulis" class="col-sm-2 col-form-label">PENULIS</label>
                <div class="col-sm-10">
                    <input type="text" required name="penulis" class="form-control" id="penulis" placeholder="Ex: Tere Liye" value="<?php echo $penulis; ?>">
                </div>
            </div>

            <!-- Input untuk penerbit buku -->
            <div class="mb-3 row">
                <label for="penerbit" class="col-sm-2 col-form-label">PENERBIT</label>
                <div class="col-sm-10">
                    <input type="text" required name="penerbit" class="form-control" id="penerbit" placeholder="Ex: Gramedia" value="<?php echo $penerbit; ?>">
                </div>
            </div>

            <!-- Input untuk tahun terbit buku -->
            <div class="mb-3 row">
                <label for="tahun_terbit" class="col-sm-2 col-form-label">TAHUN TERBIT</label>
                <div class="col-sm-10">
                    <input type="text" required name="tahun_terbit" class="form-control" id="tahun_terbit" placeholder="Ex: 2000" value="<?php echo $tahun_terbit; ?>">
                </div>
            </div>

            <!-- Input untuk genre buku -->
            <div class="mb-3 row">
                <label for="genre" class="col-sm-2 col-form-label">GENRE</label>
                <div class="col-sm-10">
                    <input type="text" required name="genre" class="form-control" id="genre" placeholder="Ex: aksi" value="<?php echo $genre; ?>">
                </div>
            </div>

            <!-- Input untuk foto buku -->
            <div class="mb-3 row">
                <label for="fotobuku" class="col-sm-2 col-form-label">FOTO BUKU</label>
                <div class="col-sm-10">
                    <!-- Foto buku bersifat opsional saat menambah data baru -->
                    <input class="form-control" <?php if (!isset($_GET['ubah'])){ echo "required";} ?> type="file" name="foto_buku" id="foto">
                </div>
            </div>

            <!-- Input untuk jumlah buku -->
            <div class="mb-3 row">
                <label for="jumlah" class="col-sm-2 col-form-label">JUMLAH</label>
                <div class="col-sm-10">
                    <input type="text" name="jumlah" class="form-control" id="jumlah" placeholder="Ex: 3" value="<?php echo $jumlah; ?>">
                </div>
            </div>

            <!-- Tombol submit untuk menyimpan data atau perubahan -->
            <div class="mb-3 row mt-5">
                <div class="col">
                    <!-- Jika form digunakan untuk mengubah data -->
                    <?php
                        if(isset($_GET['ubah'])){
                    ?>
                        <button type="submit" name="aksi" value="edit" class="btn btn-primary">
                            SIMPAN PERUBAHAN
                        </button>
                    <?php
                        } else {  // Jika form digunakan untuk menambah data baru
                    ?>
                        <button type="submit" name="aksi" value="add" class="btn btn-primary">
                            TAMBAHKAN
                        </button>
                    <?php
                        }
                    ?>
                    <!-- Tombol untuk membatalkan dan kembali ke halaman utama -->
                    <a href="index.php" type="button" class="btn btn-danger">
                        <i class="fa fa-backward" aria-hidden="true"></i>
                        Batal
                    </a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
