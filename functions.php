<?php
$conn = mysqli_connect("localhost", "root", "", "db_absensi");



function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	return $rows;
}

function simpan_karyawan($data){
		global $conn;
	
		$nik = htmlspecialchars($data["nik"]);
		$result_nik = mysqli_query($conn, "SELECT nik FROM users WHERE nik = '$nik'");

		if( mysqli_fetch_assoc($result_nik) ) {
			echo "<script>
					alert('NIK sudah terdaftar!')
				</script>";
			return false;
		}
		$nama = htmlspecialchars($data["nama"]);
		$telp = htmlspecialchars($data["telp"]);
		$email = htmlspecialchars($data["email"]);
		$foto = 'no-foto.png';
		$divisi = htmlspecialchars($data["divisi"]);
		$username = htmlspecialchars($data["username"]);
		$result_username = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");

		if( mysqli_fetch_assoc($result_username) ) {
			echo "<script>
					alert('Username sudah terdaftar!')
				</script>";
			return false;
		}
		$password = mysqli_real_escape_string($conn, $data["password"]);
		$password2 = mysqli_real_escape_string($conn, $data["password2"]);
		if( $password !== $password2 ) {
			echo "<script>
					alert('konfirmasi password tidak sesuai!');
				  </script>";
			return false;
		}
		$password = password_hash($password, PASSWORD_DEFAULT);
		$level  = 'karyawan';
		$query = "INSERT INTO users
				VALUES
			  ('', '$nik','$nama','$telp','$email','$foto','$divisi','$username','$password','$level')";
		mysqli_query($conn, $query);

		return mysqli_affected_rows($conn);

		

}
 function edit_karyawan($data){
	global $conn;
	$id = $data["id"];
	$nik = htmlspecialchars($data["nik"]);

	$nama = htmlspecialchars($data["nama"]);
	$telp = htmlspecialchars($data["telp"]);
	$email = htmlspecialchars($data["email"]);
	$divisi = htmlspecialchars($data["divisi"]);
	$username = htmlspecialchars($data["username"]);
	
	$query = "UPDATE users SET
				nik = '$nik',
				nama = '$nama',
				telp = '$telp',
				email = '$email',
				divisi = '$divisi',
				username = '$username'
			  WHERE id_user = '$id'
			";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}
function hapus_karyawan($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM users WHERE id_user = $id");
	return mysqli_affected_rows($conn);
}
function simpan_divisi($data){
	global $conn;
	$nama_divisi = htmlspecialchars($data['nama_divisi']);
	mysqli_query($conn,"INSERT INTO divisi VALUES ('','$nama_divisi')");
	return mysqli_affected_rows($conn);
}

function edit_divisi($data){
	global $conn;
	$id_divisi = $data['id_divisi'];
	$nama_divisi = htmlspecialchars($data['nama_divisi']);
	$query = "UPDATE  divisi SET nama_divisi = '$nama_divisi'  where id_divisi = '$id_divisi'";
	mysqli_query($conn,$query);
	return mysqli_affected_rows($conn);
}
function hapus_divisi($id) {
	global $conn;
	mysqli_query($conn, "DELETE FROM divisi WHERE id_divisi = $id");
	return mysqli_affected_rows($conn);
}
function edit_jam($data){
	global $conn;
	$id_jam = $data['id_jam'];
	$jam_mulai = htmlspecialchars($data['jam_mulai']);
	$jam_selesai = htmlspecialchars($data['jam_selesai']);
	$query = "UPDATE  jam SET start = '$jam_mulai',  finish = '$jam_selesai'  where id_jam = '$id_jam'";
	mysqli_query($conn,$query);
	return mysqli_affected_rows($conn);
}

function absen_masuk($data){
	global $conn;
	$id_user = $data['id_user'];
	$tgl = $data['tgl'];
	$waktu = $data['waktu'];
	$keterangan = 'Masuk';
	$result3 = mysqli_query($conn, "SELECT finish FROM jam where keterangan = 'Masuk' ");
	$jam_limit = mysqli_fetch_array($result3);
	$jam_lmt = $jam_limit['finish'];
	if($jam_lmt < $waktu){
		echo "<script>
					alert('Anda Terlambat Absen!');
				</script>";
			return false;
	}
	$query = "INSERT INTO absensi VALUES('','$tgl','$waktu','$keterangan','$id_user')";
	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);

}
function absen_pulang($data){
	global $conn;
	$id_user = $data['id_user'];
	$tgl = $data['tgl'];
	$waktu = $data['waktu'];
	$keterangan = 'Pulang';
	$result4 = mysqli_query($conn, "SELECT finish FROM jam where keterangan = 'Pulang' ");
	$jam_limit2 = mysqli_fetch_array($result4);
	$jam_lmt2 = $jam_limit2['finish'];
	if($jam_lmt2 < $waktu){
		echo "<script>
					alert('Anda Terlambat Absen!');
				</script>";
	return false;
	}
	$query = "INSERT INTO absensi VALUES('','$tgl','$waktu','$keterangan','$id_user')";
	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);

}
function upload() {

	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];

	if( $error === 4 ) {
		echo "<script>
				alert('pilih gambar terlebih dahulu!');
			  </script>";
		return false;
	}

	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
		echo "<script>
				alert('yang anda upload bukan gambar!');
			  </script>";
		return false;
	}

	// cek jika ukurannya terlalu besar
	if( $ukuranFile > 1000000 ) {
		echo "<script>
				alert('ukuran gambar terlalu besar!');
			  </script>";
		return false;
	}

	// lolos pengecekan, gambar siap diupload
	// generate nama gambar baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;
	move_uploaded_file($tmpName, 'assets/img/profil/' . $namaFileBaru);

	return $namaFileBaru;
}

function update_foto($data){
	global $conn;

	$id = $data['id'];
	$gambar_lama = $data['gambar_lama'];
	if( $_FILES['gambar']['error'] === 4 ) {
		$gambar = $gambar_lama;
	} else {
		$gambar = upload();
	};
	$query = "UPDATE users SET
	foto = '$gambar'
  	WHERE id_user = $id";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}
function update_profil($data){
	global $conn;
	$id = $data["id"];
	$nik = htmlspecialchars($data["nik"]);

	$nama = htmlspecialchars($data["nama"]);
	$telp = htmlspecialchars($data["telp"]);
	$email = htmlspecialchars($data["email"]);
	$username = htmlspecialchars($data["username"]);

	
	$query = "UPDATE users SET
				nik = '$nik',
				nama = '$nama',
				telp = '$telp',
				email = '$email',
				username = '$username'
			  WHERE id_user = '$id'
			";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

}

?>