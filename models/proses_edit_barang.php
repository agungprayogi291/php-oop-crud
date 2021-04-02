<?php
ob_start();
require_once('../config/+koneksi.php');
require_once('../models/database.php');
require "m_barang.php";

$connection = new Database($host,$user,$pass,$db);
$barang = new Barang($connection);

$id_brg = $_POST['id_brg'];
$nm_brg = $connection->conn->real_escape_string($_POST['nm_brg']);
$hrg_brg = $connection->conn->real_escape_string($_POST['hrg_brg']);
$stc_brg  = $connection->conn->real_escape_string($_POST['stc_brg']);
$pict = $_FILES['gbr_brg']['name'];
$extensi = explode(".",$_FILES['gbr_brg']['name']);
$gbr_brg = "brg-".round(microtime(true)).".".end($extensi);
$sumber = $_FILES['gbr_brg']['tmp_name'];

if($pict == ''){
	$barang->edit("UPDATE tb_barang SET nama_brg = '$nm_brg',harga_brg='$hrg_brg', stok_brg ='$stc_brg' WHERE  id_brg = '$id_brg' ");
	echo "<script>
	window.location='?page=barang';</script>";
}else{
	$gbr_awal = $barang->tampil($id_brg)->fetch_object()->gambar_brg;
	$file = unlink("../assets/img/barang/".$gbr_awal) ;
	if(!$file){
		$barang->edit("UPDATE tb_barang SET gambar_brg ='$gbr_brg' WHERE id_brg= '$id_brg'");
		move_uploaded_file($sumber,"../assets/img/barang/".$gbr_brg);
		echo "<script>window.location='?page=barang';</script>";
	}else{
		$upload = move_uploaded_file($sumber,"../assets/img/barang/".$gbr_brg);
		if($upload){
			$barang->edit("UPDATE tb_barang SET nama_brg = '$nm_brg', harga_brg='$hrg_brg', stok_brg = '$stc_brg',gambar_brg ='$gbr_brg' WHERE id_brg= '$id_brg'");
			echo "<script>window.location='?page=barang';</script>";
		}else{
			echo "<script>alert('upload gagal') ;</script>";
		}
	}
}
?>