<?php
class Barang{


	private $mysqli;
	public function __construct($conn){
		$this->mysqli = $conn;
	}

	public function tampil($id = null){
		$sql = "SELECT * FROM tb_barang";
		if($id != null){
			$sql .= " WHERE id_brg = $id";
		}
		$query = $this->mysqli->conn->query($sql) or die ($this->mysqli->conn->error);
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