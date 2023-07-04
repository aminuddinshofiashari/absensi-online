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
$jam = query("SELECT * FROM jam ");


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

    <title>Jam Kerja | Absensi Online</title>
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
                        <h1 class="h3 d-inline align-middle">Jam Kerja</h1>
                        </a>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Keterangan</th>
                                                <th>Jam Mulai</th>
                                                <th>Jam Selesai</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                            <?php foreach( $jam as $row ) : ?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td>
                                                    <div class="row">

                                                        <div class="col-8 pl-1 mt-3">
                                                            <span
                                                                class="font-weight-bold"><?= $row['keterangan']?></span>
                                                            <br>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">

                                                        <div class="col-8 pl-1 mt-3">
                                                            <span class="font-weight-bold"><?= $row['start']?></span>
                                                            <br>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="row">

                                                        <div class="col-8 pl-1 mt-3">
                                                            <span class="font-weight-bold"><?= $row['finish']?></span>
                                                            <br>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <a href="edit-jam.php?id=<?= $row['id_jam']?>"
                                                        class="btn btn-warning"><span><i class="align-middle"
                                                                data-feather="edit"></i></span></a>
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