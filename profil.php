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

if( isset($_POST["update_foto"]) ) {

	if( update_foto($_POST) > 0 ) {
		echo "<script>
				alert('Foto Profil Berhasil diUpdate!');
			  </script>";
        header("location:profil.php");
	} else {
		echo mysqli_error($conn);
	}

}
if( isset($_POST["update_profil"]) ) {

	if( update_profil($_POST) > 0 ) {
		echo "<script>
				alert('Profil Berhasil diUpdate!');
			  </script>";
        header("location:profil.php");
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

    <title>Profile | Absensi Online</title>
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
                        <h1 class="h3 d-inline align-middle">Profil</h1>
                        </a>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?= $data['id_user']?>">
                                <div class="card">
                                    <div class="card-header">
                                        <img src="assets/img/profil/<?= $data['foto']?>" alt="" height="100"
                                            width="100">
                                        <input type="hidden" value="<?= $data['foto']?>" name="gambar_lama">
                                    </div>
                                    <div class="card-body">
                                        <input type="file" class="form-control" name="gambar" id="gambar">
                                    </div>
                                </div>
                                <button type="submit" name="update_foto" class="btn btn-primary">Update Foto Profil <i
                                        class="align-middle" data-feather="save"></i></button>
                            </form>
                        </div>
                        <div class="col-12 col-lg-4">
                            <form action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $data['id_user']?>">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">NIK</h5>
                                    </div>
                                    <div class="card-body">
                                        <input type="text" class="form-control" name="nik" id="nik"
                                            placeholder="Masukkan NIK Karyawan" value="<?= $data['nik']?>">
                                    </div>
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">No Telp</h5>
                                    </div>
                                    <div class="card-body">
                                        <input type="text" class="form-control" name="telp" id="telp"
                                            placeholder="Masukkan no_telp Karyawan" value="<?= $data['telp']?>">
                                    </div>
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Username</h5>
                                    </div>
                                    <div class="card-body">
                                        <input type="text" class="form-control" name="username" id="username"
                                            placeholder="Masukkan username Karyawan" value="<?= $data['username']?>">
                                    </div>
                                </div>
                        </div>
                        <div class="col-12 col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Nama</h5>
                                </div>
                                <div class="card-body">
                                    <input type="text" class="form-control" name="nama" id="nama"
                                        placeholder="Masukkan nama Karyawan" value="<?= $data['nama']?>">
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Email</h5>
                                </div>
                                <div class="card-body">
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="Masukkan email Karyawan" value="<?= $data['email']?>">
                                </div>
                                <div class="card-header">
                                </div>
                            </div>
                            <input type="submit" value="Simpan" name="update_profil" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </main>

            <?php include 'template/footer.php' ?>

        </div>
    </div>
    <?php include 'template/js.php'?>

</body>

</html>