 <?php
include "models/m_barang.php";

$barang = new Barang($connection);

 ?>
 <div class="row">
 	  <div class="col-lg-12 ">
 	  	 <h1>Barang</h1>
	 	  	<a href="index.html" class="breadcrumb"><i class="icon-dashboard"></i>Barang</a></li>
 	  </div>
 </div>

  <div class="row">
  	<div class="col-lg-12">
  		<div class="table-responsive">
  			<table class="table table-bordered table-hover table-striped">
  				<tr>
  					<th>No.</th>
  					<th>Nama Barang</th>
  					<th>Harga Barang</th>
  					<th>Stock Barang</th>
  					<th>Gambar Barang</th>
  					<th>Opsi</th>
  				</tr>
          <?php
          $no = 1;
          $tampil = $barang->tampil();
          $getData = $tampil->fetch_All(MYSQLI_ASSOC);
          foreach($getData as $data){
          ?>
  				<tr>
  					<td><?php echo $no++ ."." ;?></td>
  					<td><?php echo $data['nama_brg'] ;?></td>
  					<td><?php echo $data['harga_brg'] ;?></td>
  					<td><?php echo $data['stok_brg'] ;?></td>
  					<td class="text-center"><img src="assets/img/barang/<?php echo $data['gambar_brg'];?>" alt="" width="80px" ></td>
  					<td align="center">
  						<button class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</button>
  						<button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>  Delete</button>
  					</td>
  				</tr>
          <?php
          }
          ?>
  			</table>
  		</div>

      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah">Tambah Barang</button>

      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah"></button>

      <div id="tambah" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">

              <button type="button" class="close ml-0" data-dismiss="modal">&times;</button>
              <h4 class="modal-title ">Tambah Data Barang</h4>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="form-group">
                  <label for="nm_brg" class="control-label">Nama Barang</label>
                  <input type="text" name="nm_brg" class="form-control" id="nm_brg" placeholder="nama-barang" required> 
                </div>
                <div class="form-group">
                  <label for="hrg_brg" class="control-label">Harga Barang</label>
                  <input type="number" name="hrg_brg" class="form-control" id="hrg_brg" placeholder="Rp." required>
                </div>
                <div class="form-group">
                  <label for="stc_brg" class="control-label">Stock Barang</label>
                  <input type="number" name="stc_brg" class="form-control" id="stc_brg" placeholder="-" required>
                </div>
                <div class="form-group">
                  <label for="gbr_brg" class="control-label">Gambar barang</label>
                  <input type="file" class="form-control" name="gbr_brg" id="gbr_brg" accept="image/*" required>
                </div>
              </div>
              <div class="modal-footer">
                <button type="reset" class="btn btn-danger">reset</button>
                <input type="submit" class="btn btn-primary" name="tambah" value="simpan">
              </div>
            </form>
            <?php
            if(@$_POST['tambah']){
              $nm_brg = $connection->conn->real_escape_string($_POST['nm_brg']);
              $hrg_brg =  $connection->conn->real_escape_string($_POST['hrg_brg']);
              $stc_brg = $connection->conn->real_escape_string($_POST['stc_brg']);

              $extensi = explode(".". $_FILES['gbr_brg']['name']);
              $gbr_brg = "brg-".round(microtime(true)).".".end($extensi);
              $sumber = $_FILES['gbr_brg']['tmp_name'];
              $upload = move_uploaded_file($sumber, "assets/img/barang/".$gbr_brg);
              if($upload){
                $barang->tambah($nm_brg,$hrg_brg,$stc_brg,$gbr_brg);
                header("Location: ?page=barang");
              }else{
                echo "<script>alert('Upload gambar gagal!')</script>";
              }
            }
            ?>

              <button type="button" class="close" data-dismiss="modal"></button>
              <h4 class="modal-title">Tambah Data Barang</h4>
            </div>
            <form action="" method="post" enctype="mulipart/form-data">
              <div class="modal-body">
                <div class="form-group">
                  <label for="nm_brg" class="control-label">Nama Barang</label>
                  <input type="text" name="nm_brg" class="form-control" id="nm_brg" required> 
                  <label for="hrg_brg" class="control-label">Harga Barang</label>
                  <input type="text" name="hrg_brg" class="form-control" id="hrg_brg" required>
                </div>
              </div>
            </form>

          </div>
        </div>
      </div>
  	</div>
  </div>