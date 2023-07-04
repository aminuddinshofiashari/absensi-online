<?php
session_start();
$id = $_SESSION['id'];
$id_divisi = $_GET['id'];
if( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}
require 'functions.php';

$result = mysqli_query($conn, "SELECT * FROM users WHERE id_user = $id");
$data = mysqli_fetch_array($result);
if( isset($_POST["simpan"]) ) {

	if( edit_divisi($_POST) > 0 ) {
		echo "<script>
				alert('Divisi  berhasil diedit!');
			  </script>";
        header("location: divisi.php");
	} else {
        echo "<script>
				alert('Divisi  gagal diedit!');
			  </script>";
		echo mysqli_error($conn);
	}


}
$id_divisi = $_GET['id'];
$result_edit = mysqli_query($conn, "SELECT * FROM divisi WHERE id_divisi = $id_divisi");
$val = mysqli_fetch_array($result_edit);
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

    <title>Edit Divisi | Absensi Online</title>
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
                        <h1 class="h3 d-inline align-middle">Edit Divisi</h1>
                        </a>
                    </div>
                    <form action="" method="post">
                        <input type="hidden" name="id_divisi" value="<?= $val['id_divisi']?>">
                        <div class="row">
                            <div class="col-12 col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Nama Divisi</h5>
                                    </div>
                                    <div class="card-body">
                                        <input type="text" class="form-control" name="nama_divisi" id="nama_divisi"
                                            placeholder="Masukkan Nama Divisi" value="<?= $val['nama_divisi']?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="simpan" class="btn btn-primary" >Simpan <i
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