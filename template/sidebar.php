<?php
date_default_timezone_set("Asia/jakarta");
$role = $_SESSION['level'];

function active($currect_page){
  $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
  $url = end($url_array);  
  if($currect_page == $url){
      echo 'active'; //class name in css 
  } 
}
?>
<?php if($role == 'Karyawan'){ ?>
<ul class="sidebar-nav">
	<li class="sidebar-header">
			<h2 class="text-center" id="jam" style="color:#fff;">
	</li>

	<li class="sidebar-item <?php active('index.php')?>">
		<a class="sidebar-link" href="index.php">
			<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
		</a>
	</li>
	<li class="sidebar-item <?php active('absen.php')?>">
		<a class="sidebar-link" href="absen.php">
			<i class="align-middle" data-feather="layers"></i> <span class="align-middle">Absensi</span>
		</a>
	</li>
	<li class="sidebar-item <?php active('data-absensi.php')?>">
		<a class="sidebar-link" href="data-absensi.php">
			<i class="align-middle" data-feather="trending-up"></i> <span class="align-middle">Laporan</span>
		</a>
	</li>
</ul>
<?php } else { ?>
	<ul class="sidebar-nav">
	<li class="sidebar-header">
			<h2 class="text-center" id="jam" style="color:#fff;">
	</li>
	<li class="sidebar-item <?php active('index.php')?>">
		<a class="sidebar-link" href="index.php">
			<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
		</a>
	</li>
	<li class="sidebar-item <?php active('karyawan.php')?>">
		<a class="sidebar-link" href="karyawan.php">
			<i class="align-middle" data-feather="users"></i> <span class="align-middle">Karyawan</span>
		</a>
	</li>
	<li class="sidebar-item <?php active('divisi.php')?>">
		<a class="sidebar-link" href="divisi.php">
			<i class="align-middle" data-feather="git-branch"></i> <span class="align-middle">Divisi</span>
		</a>
	</li>
	<li class="sidebar-item <?php active('jam_kerja.php')?>">
		<a class="sidebar-link" href="jam_kerja.php">
			<i class="align-middle" data-feather="clock"></i> <span class="align-middle">Jam Kerja</span>
		</a>
	</li>
	<li class="sidebar-item <?php active('absen.php')?>">
		<a class="sidebar-link" href="absen.php">
			<i class="align-middle" data-feather="layers"></i> <span class="align-middle">Absensi</span>
		</a>
	</li>
	<li class="sidebar-item <?php active('laporan.php')?>">
		<a class="sidebar-link" href="laporan.php">
			<i class="align-middle" data-feather="trending-up"></i> <span class="align-middle">Laporan</span>
		</a>
	</li>
</ul>
<?php } ?>