<?php
session_start();

// Redirect to login.php if not logged in
if (!isset($_SESSION['login'])) {
    header('location:login.php');
    exit;
}

// Include the function.php file
require 'function.php';

// Retrieve data based on 'nis' from the URL
$nis = $_GET['nis'];

// Fetch student data from the database
$siswa = query("SELECT * FROM siswa WHERE nis = $nis")[0];

// Handle form submission
if (isset($_POST['ubah'])) {
    if (ubah($_POST) > 0) {
        echo "<script>
                alert('Data siswa berhasil diubah!');
                document.location.href = 'index.php';
            </script>";
    } else {
        echo "<script>
                alert('Data siswa gagal diubah!');
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
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <!-- AOS CSS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <title>Update Data</title>
</head>
<body background="img/bg/bck.png">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-uppercase">
        <div class="container">
            <a class="navbar-brand" href="index.php">Sistem Admin Data Siswa</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <!-- Container -->
    <div class="container">
        <div class="row my-2 text-light">
            <div class="col-md">
                <h3 class="fw-bold text-uppercase ubah_data"></h3>
            </div>
            <hr>
        </div>
        <div class="row my-2 text-light">
            <div class="col-md">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="gambarLama" value="<?= htmlspecialchars($siswa['gambar']); ?>">
                    
                    <div class="mb-3">
                        <label for="nis" class="form-label">NIS</label>
                        <input type="number" class="form-control w-50" id="nis" value="<?= htmlspecialchars($siswa['nis']); ?>"
                               name="nis" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control w-50" id="nama" value="<?= htmlspecialchars($siswa['nama']); ?>"
                               name="nama" autocomplete="off" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="tmpt_Lahir" class="form-label">Tempat Lahir</label>
                        <input type="text" class="form-control w-50" id="tmpt_Lahir"
                               value="<?= htmlspecialchars($siswa['tmpt_Lahir']); ?>" name="tmpt_Lahir" autocomplete="off" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="tgl_Lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control w-50" id="tgl_Lahir"
                               value="<?= htmlspecialchars($siswa['tgl_Lahir']); ?>" name="tgl_Lahir" autocomplete="off" required>
                    </div>
                    
                    <div class="mb-3">
                        <label>Jenis Kelamin</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jekel" id="Laki-Laki"
                                   value="Laki - Laki" <?= $siswa['jekel'] == 'Laki - Laki' ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="Laki-Laki">Laki - Laki</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jekel" id="Perempuan"
                                   value="Perempuan" <?= $siswa['jekel'] == 'Perempuan' ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="Perempuan">Perempuan</label>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="jurusan" class="form-label">Jurusan</label>
                        <select class="form-select w-50" id="jurusan" name="jurusan">
                            <option disabled selected value>--------------------------------------------Pilih Jurusan--------------------------------------------</option>
                            <option value="Perhotelan" <?= $siswa['jurusan'] == 'Perhotelan' ? 'selected' : ''; ?>>Perhotelan</option>
                            <option value="Teknik Jaringan Komputer dan Telekomunikasi" <?= $siswa['jurusan'] == 'Teknik Jaringan Komputer dan Telekomunikasi' ? 'selected' : ''; ?>>Teknik Jaringan Komputer dan Telekomunikasi</option>
                            <option value="Desain Komunikasi Visual" <?= $siswa['jurusan'] == 'Desain Komunikasi Visual' ? 'selected' : ''; ?>>Desain Komunikasi Visual</option>
                            <option value="Pengembangan Perangkat Lunak dan Gim" <?= $siswa['jurusan'] == 'Pengembangan Perangkat Lunak dan Gim' ? 'selected' : ''; ?>>Pengembangan Perangkat Lunak dan Gim</option>
                            <option value="Kuliner" <?= $siswa['jurusan'] == 'Kuliner' ? 'selected' : ''; ?>>Kuliner</option>
                            <option value="Pemasaran" <?= $siswa['jurusan'] == 'Pemasaran' ? 'selected' : ''; ?>>Pemasaran</option>
                            <option value="Manajemen Perkantoran dan Layanan Bisnis" <?= $siswa['jurusan'] == 'Manajemen Perkantoran dan Layanan Bisnis' ? 'selected' : ''; ?>>Manajemen Perkantoran dan Layanan Bisnis</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">E-Mail</label>
                        <input type="email" class="form-control w-50" id="email" value="<?= htmlspecialchars($siswa['email']); ?>"
                               name="email" autocomplete="off" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar <i>(Saat ini)</i></label> <br>
                        <img src="img/<?= htmlspecialchars($siswa['gambar']); ?>" width="50%" style="margin-bottom: 10px;">
                        <input class="form-control form-control-sm w-50" id="gambar" name="gambar" type="file">
                    </div>
                    
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control w-50" id="alamat" rows="5" name="alamat"
                                  autocomplete="off"><?= htmlspecialchars($siswa['alamat']); ?></textarea>
                    </div>
                    
                    <hr>
                    <a href="index.php" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-warning" name="ubah">Ubah</button>
                </form>
            </div>
        </div>
    </div>
    <!-- End Container -->

    <!-- Footer -->
    <div class="container-fluid">
        <div class="row bg-dark text-white text-center">
            <div class="col my-2" id="about">
                <br><br><br>
                <h4 class="fw-bold text-uppercase">About</h4>
                <p>By: Muhammad Khairul Ikhwan (12209244)</p>
            </div>
        </div>
    </div>
    <!-- End Footer -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>

    <!-- GSAP Animations -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/TextPlugin.min.js"></script>
    <script>
        gsap.registerPlugin(TextPlugin);
        gsap.to('.ubah_data', {
            duration: 2,
            delay: 1,
            text: '<i class="bi bi-pencil-square"></i> Ubah Data Siswa'
        });
        gsap.from('.navbar', {
            duration: 1,
            y: '-100%',
            opacity: 0,
            ease: 'bounce',
        });
    </script>
</body>
</html>
