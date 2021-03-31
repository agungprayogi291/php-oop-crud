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
  					<td>akjdhjksdjasd</td>
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
      
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah"></button>
      <div id="tambah" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"></button>
              <h4 class="modal-title">Tambah Data Barang</h4>
            </div>
            <form action="" method="post" enctype="mulipart/form-data">
              <div class="modal-body">
                <div class="form-group">
                  <label for="nm_brg" class="control=label">Nama Barang</label>
                  <input type="text" name="nm_brg" class="form-control" id="nm_brg" required> 
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
  	</div>
  </div>