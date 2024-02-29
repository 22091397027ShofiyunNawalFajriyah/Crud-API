<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "dbrest";
$con = mysqli_connect ($server, $username, $password) or die("<h1>Koneksi Mysqli Error : </h1>" .mysqli_connect());
mysqli_select_db($con, $database) or die ("<h1>Koneksi ke database error : </h1>" .mysqli_error($con));

@$operasi = $_GET['operasi'];
switch ($operasi) {
	case "view":
		$query_tampil_tbl_user = mysqli_query($con,"SELECT * FROM produk") or die ($mysqli_error($con));
	$data_array = array();

		while ($data = mysqli_fetch_assoc($query_tampil_tbl_user)){
			$data_array[]=$data;
		}
		echo json_encode($data_array);


		break;

		case "insert":
		@$id 			= $_GET['id'];
		@$nama_produk 		= $_GET['nama_produk'];
		@$harga 			= $_GET['harga'];
		@$tipe_produk 		= $_GET['tipe_produk'];
		@$stok 			= $_GET['stok'];

		$query_insert_data = mysqli_query($con, "INSERT INTO produk (id,nama_produk,harga,tipe_produk,stok) VALUES ('$id', '$nama_produk', '$harga', '$tipe_produk', '$stok')");

		if ($query_insert_data) {
			echo "Data Berhasil Disimpan";
		}
		else {
			echo "Maaf insert ke dalam database error" . mysqli_error($con);
		}
		break;

		case "get_produk_by_id":
		@$id = (int)$_GET['id'];
		$query_tampil_produk = mysqli_query($con, "SELECT * FROM produk WHERE id='$id'") or die (mysqli_error($con));
		$data_array = array();
		$data_array = mysqli_fetch_assoc($query_tampil_produk);
		echo "[" .json_encode($data_array) . "]";
		break;

		case "update":
		@$id 			= $_GET['id'];
		@$nama_produk 	= $_GET['nama_produk'];
		@$harga			= $_GET['harga'];
		@$tipe_produk 	= $_GET['tipe_produk'];
		@$stok			= $_GET['stok'];

		$query_update_produk = mysqli_query($con,  "UPDATE produk SET id = '$id', nama_produk = '$nama_produk',
		harga = '$harga', tipe_produk = '$tipe_produk', stok = '$stok'");

		if ($query_update_produk) {
				echo "Update Data Berhasil";
		}
		else{
			echo mysqli_error($con);
		}
		break;

		case "delete":
		@$id = $_GET['id'];
		$query_delete_produk = mysqli_query($con, "DELETE FROM produk WHERE id='$id'");
		if ($query_delete_produk) {
			echo "Data Berhasil Dihapus";
		}
		else {
			echo mysqli_error($con);
		}
		break;
		default;
		break;
	}
	?>