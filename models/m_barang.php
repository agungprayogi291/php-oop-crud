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
		$db =$this->mysqli->conn;
		$db->query("INSERT INTO tb_barang VALUES('','$nm_brg','$hrg_brg','$stc_brg','$gbr_brg')") or die($db->error);

	}
	public function edit($sql){
		$db = $this->mysqli->conn;
		$db->query($sql) or die ($db->error);
	}
}

?>