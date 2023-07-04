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
$users = query("SELECT * FROM users join divisi on users.divisi = divisi.id_divisi where level = 'karyawan' order by id_user desc");


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

    <title>Karyawan | Absensi Online</title>
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
                        <h1 class="h3 d-inline align-middle">Karyawan</h1>
                        </a>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <a href="tambah-karyawan.php" class="btn btn-primary" style="float: right;"><span>Tambah <i
                                                class="align-middle" data-feather="plus"></i></span></a>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Karyawan</th>
                                                <th>Kontak</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach( $users as $row ) : ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-4 pr-1">
                                                            <img src="assets/img/profil/<?= $row['foto']?>" alt="Img Profil"
                                                                class="img-thumbnail rounded-circle w-20" height="70"
                                                                width="70">
                                                        </div>
                                                        <div class="col-8 pl-1 mt-3">
                                                            <span class="font-weight-bold"><?= $row['nama']?></span> <br>
                                                            <span class="text-muted"><?= $row['nama_divisi']?></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <address>
                                                        <?= $row['email']?> <br>
                                                        <?= $row['telp']?>
                                                    </address>
                                                </td>
                                                <td>
                                                    <a href="edit-karyawan.php?id=<?= $row['id_user']?>" class="btn btn-warning"><span><i class="align-middle"
                                                                data-feather="edit"></i></span></a>
                                                    <a href="hapus-karyawan.php?id=<?= $row['id_user']?>" class="btn btn-danger"><span><i class="align-middle"
                                                                data-feather="trash"></i></span></a>
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
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