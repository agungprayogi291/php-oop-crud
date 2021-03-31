<?php
class Barang{


	 private $mysqli;
	// private $nama,$harga,$stock,$gambar,$db;
	public function __construct($conn){
		$this->mysqli = $conn;
	}
	public function tampil($id = null){
		$db = $this->mysqli->conn;
		$sql = "SELECT * FROM tb_barang";
		if($id != null){
			$sql .= " WHERE id_brg = $id";
		}
		$query = $db->query($sql) or die ($db->error);
		return $query;
	}
	public function tambah($nm_brg,$hrg_brg,$stc_brg,$gbr_brg){
		// $this->nama = $nm_brg;
		// $this->harga = $hrg_brg;
		// $this->stock = $stc_brg;
		// $this->gambar = $gbr_brg;
		$db =$this->mysqli->conn;
		$db->query("INSERT INTO tb_barang VALUES('','$nm_brg','$hrg_brg','$stc_brg','$gbr_brg')") or die($db->error);

	}
}

?>