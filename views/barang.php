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
              <a id="edit_brg" data-toggle="modal" data-target="#edit" data-id="<?php echo $data['id_brg'];?>"  data-nama="<?php echo $data['nama_brg'];?>"  data-harga="<?php echo $data['harga_brg'];?>"  data-stock="<?php echo $data['stok_brg'];?>"  data-gbr="<?php echo $data['gambar_brg'];?>">
                <button class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</button>
              </a>
  						<button class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>  Delete</button>
  					</td>
  				</tr>
          <?php
          }
          ?>
  			</table>
  		</div>

      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah">Tambah Barang</button>

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

              $extensi = explode(".", $_FILES['gbr_brg']['name']);
              
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

          </div>
        </div>
      </div>

      <div id="edit" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">

              <button type="button" class="close ml-0" data-dismiss="modal">&times;</button>
              <h4 class="modal-title ">Edit Data Barang</h4>
            </div>
            <form action=""  id="form" enctype="multipart/form-data">
              <div class="modal-body" id="modal-edit">
                <input type="hidden" name="id_brg" id="id_brg">
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
                  <div style="padding-bottom:10px;">
                     <img src="" width ="100px" id="picture">
                  </div>
                 
                  <input type="file" class="form-control" name="gbr_brg" id="gbr_brg" accept="image/*" >
                </div>
              </div>
              <div class="modal-footer">
                <input type="submit" class="btn btn-primary" name="edit" value="simpan">
              </div>
            </form>
          
           

          </div>
        </div>
      </div>
      <script src="assets/vendor/jquery/jquery.min.js" type="text/javascript">
      </script>
      <script type="text/javascript"> 
          $(document).on("click","#edit_brg",function(){
            var idbrg = $(this).data('id');
            var namabrg = $(this).data('nama');
            var hargabrg = $(this).data('harga');
            var stockbrg = $(this).data('stock');
            var gambarbrg = $(this).data('gbr');
            $("#modal-edit #id_brg").val(idbrg);
            $("#modal-edit  #nm_brg").val(namabrg);
            $("#modal-edit  #hrg_brg").val(hargabrg);
            $("#modal-edit  #stc_brg").val(stockbrg);
            $("#modal-edit  #picture").attr("src","assets/img/barang/"+ gambarbrg);
          })

          $(document).ready(function(e){
            $("#form").on("submit",(function(e){
              e.preventDefault();
              $.ajax({
                url:'models/proses_edit_barang.php',
                type :'POST',
                data : new FormData(this),
                contentType :false,
                cache :false,
                processData:false,
                success:function(msg){
                  $('.table').html(msg);
                }
              })
            }));
          })
       </script>
  	</div>
  </div>