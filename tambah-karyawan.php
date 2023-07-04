<?php
session_start();
$id = $_SESSION['id'];
if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}
require 'functions.php';

$result = mysqli_query($conn, "SELECT * FROM users WHERE id_user = $id");
$data = mysqli_fetch_array($result);

if( isset($_POST["simpan"]) ) {

	if( simpan_karyawan($_POST) > 0 ) {
		echo "<script>
				alert('Karyawan baru berhasil ditambahkan!');
			  </script>";
            header("location:karyawan.php");
	} else {
		echo mysqli_error($conn);
	}

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/" />

    <title>Tambah Karyawan | Absensi Online</title>
    <?php
    include 'template/css.php';
    ?>
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar js-sidebar">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="index.php">
                    <span class="align-middle">Absensi Online</span>
                </a>
                <?php
			include 'template/sidebar.php';
			?>
            </div>
        </nav>
        <div class="main">
            <?php include 'template/header.php'?>

            <main class="content">
                <div class="container-fluid p-0">

                    <div class="mb-3">
                        <h1 class="h3 d-inline align-middle">Tambah Karyawan</h1>
                        </a>
                    </div>
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">NIK</h5>
                                    </div>
                                    <div class="card-body">
                                        <input type="text" class="form-control" name="nik" id="nik"
                                            placeholder="Masukkan NIK Karyawan">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Nama</h5>
                                    </div>
                                    <div class="card-body">
                                        <input type="text" class="form-control" name="nama" id="nama"
                                            placeholder="Masukkan Nama Karyawan">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">No. Telp</h5>
                                    </div>
                                    <div class="card-body">
                                        <input type="number" class="form-control" name="telp" id="telp"
                                            placeholder="Masukkan No. Telp Karyawan">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Email</h5>
                                    </div>
                                    <div class="card-body">
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="Masukkan Email Karyawan">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Divisi</h5>
                                    </div>
                                    <div class="card-body">
                                        <select name="divisi" id="divisi" class="form-control">
                                            <option value="" disabled selected>-- Pilih --</option>
                                            <?php 
                                        $divisi = query("SELECT * FROM divisi");
                                        
                                        foreach ($divisi as $div) :                                      
                                        ?>
                                            <option value="<?= $div['id_divisi']?>"><?= $div['nama_divisi']?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Username</h5>
                                    </div>
                                    <div class="card-body">
                                        <input type="text" class="form-control" name="username" id="username"
                                            placeholder="Masukkan Username Karyawan">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Password</h5>
                                    </div>
                                    <div class="card-body">
                                        <input type="password" class="form-control" name="password" id="password"
                                            placeholder="Masukkan Password Karyawan"><br>
                                        <input type="password" class="form-control" name="password2" id="password2"
                                            placeholder="Konfirmasi Password Karyawan">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="simpan" class="btn btn-primary" style="float: right;">Simpan <i
                                class="align-middle" data-feather="save"></i></button>
                    </form>
                </div>
            </main>

            <?php include 'template/footer.php' ?>

        </div>
    </div>
    <?php include 'template/js.php'?>

</body>

</html>