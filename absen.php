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

date_default_timezone_set("Asia/Jakarta");
$tgl = date('Y-m-d');
$dt1 = strtotime($tgl);
$dt2 = date("l", $dt1);
$dt3 = strtolower($dt2);
$wkt = date('H:i:s');

if( isset($_POST["absen_masuk"]) ) {

	if( absen_masuk($_POST) > 0 ) {
		echo "<script>
				alert('Anda  berhasil absen!');
			  </script>";
        header("location: absen.php");
	} else {
        echo "<script>
				alert('Anda  gagal absen!');
			  </script>";
		echo mysqli_error($conn);
	}


}
if( isset($_POST["absen_pulang"]) ) {

	if( absen_pulang($_POST) > 0 ) {
		echo "<script>
				alert('Anda  berhasil absen!');
			  </script>";
        header("location: absen.php");
	} else {
        echo "<script>
				alert('Anda  gagal absen!');
			  </script>";
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
                        <h1 class="h3 d-inline align-middle">Absen Harian</h1>
                        </a>
                    </div>
                    <div class="row">
                        <div class="col-12 col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-hover">
                                        <?php     if(($dt3 == "saturday" ) || ($dt3 == "sunday")): ?>
                                        <thead>
                                            <tr>
                                                <th>Status</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="bg-light text-danger" colspan="4">Hari ini libur. Tidak Perlu
                                                    absen
                                                </td>
                                        </tbody>
                                        <?php else: ?>
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Absen Masuk</th>
                                                <th>Absen Pulang</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $tgll = date('d-m-Y'); 
                                             ?>
                                            <td><?= $tgll?></td>
                                            <?php
                                            
                                            $result1 = mysqli_query($conn, "SELECT * FROM absensi WHERE id_user = '$id' AND tgl = '$tgl' AND keterangan = 'Masuk'");
                                            $absen_masuk = mysqli_num_rows($result1);
                                            $abs_msk = mysqli_fetch_array($result1);
                                            $result2 = mysqli_query($conn, "SELECT * FROM absensi WHERE id_user = '$id' AND tgl = '$tgl' AND keterangan = 'Pulang'");
                                            $absen_klr = mysqli_num_rows($result2);
                                            $abs_klr = mysqli_fetch_array($result2);    
                                            $result3 = mysqli_query($conn, "SELECT start FROM jam where keterangan = 'Masuk' ");
                                            $jam_limit = mysqli_fetch_array($result3);
                                            $jam_lmt = $jam_limit['start'];              
                                            $result4 = mysqli_query($conn, "SELECT start FROM jam where keterangan = 'Pulang' ");
                                            $jam_limit2 = mysqli_fetch_array($result4);
                                            $jam_lmt2 = $jam_limit2['start'];
                                            if($jam_lmt < $wkt):

                                                if( $absen_masuk == null ) :
                                                ?>

                                                <td>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="id_user" id="id_user" value="<?= $id?>">
                                                        <input type="hidden" name="tgl" id="tgl" value="<?= $tgl?>">
                                                        <input type="hidden" name="waktu" id="waktu" value="<?= $wkt?>">
                                                        <input type="submit" name="absen_masuk" class="btn btn-success"
                                                            value="Absen">
                                                    </form>
                                                </td>

                                                <?php else : ?>
                                                <td>
                                                    <address>
                                                        <strong>Anda Sudah Absen</strong><br>
                                                        Jam : <?= $abs_msk['waktu']?>
                                                    </address>
                                                </td>
                                                <?php endif?>
                                            <?php else : ?>
                                                <td><span>Belum Masuk Waktu Absen</span></td>
                                            <?php endif ?>
                                            <?php
                                            if($jam_lmt2 < $wkt):
                                                if( $absen_klr== null ) :
                                                ?>
                                                <td>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="id_user" id="id_user" value="<?= $id?>">
                                                        <input type="hidden" name="tgl" id="tgl" value="<?= $tgl?>">
                                                        <input type="hidden" name="waktu" id="waktu" value="<?= $wkt?>">
                                                        <input type="submit" name="absen_pulang" class="btn btn-success"
                                                            value="Absen">
                                                    </form>
                                                </td>
                                                <?php else : ?>
                                                <td>

                                                    <address>
                                                        <strong>Anda Sudah Absen</strong><br>
                                                        Jam : <?= $abs_klr['waktu']?>
                                                    </address>
                                                </td>
                                                <?php endif ?>
                                            <?php else : ?>
                                                    <td>
                                                        <span>Belum Masuk Waktu Absen</span>
                                                    </td>
                                                    <?php endif ?>
                                        </tbody>
                                        <?php endif ?>
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