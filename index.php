<!--ini buat nyambungin dari koneksi.php-->
<?php
  include 'koneksi.php';  // Menghubungkan dengan file koneksi database
  $query = "SELECT * FROM tb_buku;";  // Query untuk mengambil semua data buku dari tabel tb_buku
  $sql = mysqli_query($conn, $query);  // Eksekusi query dan simpan hasilnya dalam variabel $sql
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="fontawesome/css/font-awesome.min.css">

    <!-- jQuery (required for DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables CSS and JS -->
    <link rel="stylesheet" href="datatables/datatables.css">
    <script type="text/javascript" src="datatables/datatables.js"></script>

    <title>PERPUSTAKAAN</title>
</head>

<script type="text/javascript">
    $(document).ready(function() {
      $('#dt').DataTable();
    });
</script>

<body>
    <!-- Navbar -->
    <nav class="navbar bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">PERPUSTAKAAN</a>
        </div>
    </nav>

  

    <!-- Judul dan Deskripsi -->
    <div class="container">
        <h2 class="mt-4">DATA BUKU</h2>
        <p><em>data buku dalam database</em></p>
        <a href="kelola.php" type="button" class="btn btn-primary mb-3">
            <i class="fa fa-plus"></i> TAMBAH BUKU
        </a>

        <!-- Tabel Data Buku -->
        <div class="table-responsive">
            <table id="dt" class="table align-middle table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>JUDUL</th>
                        <th>PENULIS</th>
                        <th>PENERBIT</th>
                        <th>TAHUN TERBIT</th>
                        <th>GENRE</th>
                        <th>FOTO BUKU</th>
                        <th>JUMLAH</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                  // Mengambil dan menampilkan data buku dari hasil query
                  while($result = mysqli_fetch_assoc($sql)){
                ?>
                    <tr>
                        <td><?php echo $result['id_buku']; ?></td>
                        <td><?php echo $result['judul']; ?></td>
                        <td><?php echo $result['penulis']; ?></td>
                        <td><?php echo $result['penerbit']; ?></td>
                        <td><?php echo $result['tahun_terbit']; ?></td>
                        <td><?php echo $result['genre']; ?></td>
                        <td><img src="img/<?php echo $result['foto_buku']; ?>" style="width: 75px;"></td>
                        <td><?php echo $result['jumlah']; ?></td>
                        <td>
                            <!-- Tombol untuk mengubah data buku -->
                            <a href="kelola.php?ubah=<?php echo $result['id_buku']; ?>" type="button" class="btn btn-success">
                                <i class="fa fa-pencil"></i>
                            </a>

                            <!-- Tombol untuk menghapus data buku -->
                            <a href="proses.php?hapus=<?php echo $result['id_buku']; ?>" type="button" class="btn btn-danger" 
                               onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php
                  }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
