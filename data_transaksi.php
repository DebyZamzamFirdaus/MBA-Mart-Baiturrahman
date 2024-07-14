<?php
//session_start();
if (!isset($_SESSION['apriori_id'])) {
    header("location:index.php?menu=forbidden");
}

include_once "database.php";
include_once "fungsi.php";
include_once "import/excel_reader2.php";
?>


<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-fw fa-money-bill-wave"></i> Data Transaksi</h1>

	<div class="text-right">
	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalupload">
	<i class="fa fa-upload"></i> Upload Data 
	</button>
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modaladd">
	<i class="fa fa-plus"></i> Tambah Data 
	</button>
	</div>
</div>

<?php
$db_object = new database();

$pesan_error = $pesan_success = "";
if(isset($_GET['pesan_error'])){
    $pesan_error = $_GET['pesan_error'];
}
if(isset($_GET['pesan_success'])){
    $pesan_success = $_GET['pesan_success'];
}

if(isset($_POST['submit'])){
    $data = new Spreadsheet_Excel_Reader($_FILES['file_data_transaksi']['tmp_name']);

        $baris = $data->rowcount($sheet_index=0);
        $column = $data->colcount($sheet_index=0);

        for ($i=2; $i<=$baris; $i++) {
            for($c=1; $c<=$column; $c++){
                $value[$c] = $data->val($i, $c);
            }

                    $table = "transaksi";
                    // $produkIn = get_produk_to_in($temp_produk);
                    $temp_date = format_date($value[1]);
                    $produkIn = $value[2];
                    
                    //mencegah ada jarak spasi
                    $produkIn = str_replace(" ,", ",", $produkIn);
                    $produkIn = str_replace("  ,", ",", $produkIn);
                    $produkIn = str_replace("   ,", ",", $produkIn);
                    $produkIn = str_replace("    ,", ",", $produkIn);
                    $produkIn = str_replace(", ", ",", $produkIn);
                    $produkIn = str_replace(",  ", ",", $produkIn);
                    $produkIn = str_replace(",   ", ",", $produkIn);
                    $produkIn = str_replace(",    ", ",", $produkIn);
                    $sql = "INSERT INTO transaksi (transaction_date, produk) VALUES ";
                    $value_in = array();
                    $sql .= " ('$temp_date', '$produkIn')";
                    $db_object->db_query($sql);
        }
        ?>
        <script> location.replace("?menu=data_transaksi&pesan_success=Data berhasil disimpan"); </script>
        <?php
}

if (isset($_POST['simpan'])) {
  $transaction_date = $_POST['transaction_date'];
  $produk = $_POST['produk'];
  $sql = "INSERT INTO transaksi (id,transaction_date,produk) VALUES ('','$transaction_date','$produk')";
  $db_object->db_query($sql);
  if ($sql) {
    echo "<script> location.replace('?menu=data_transaksi&pesan_success=Data berhasil disimpan'); </script>";
  } else {
    echo "<script> location.replace('?menu=data_transaksi&pesan_success=Data gagal disimpan'); </script>";
  }
}


if(isset($_POST['delete'])){
    $sql = "TRUNCATE transaksi";
    $db_object->db_query($sql);
    ?>
        <script> location.replace("?menu=data_transaksi&pesan_success=Data transaksi berhasil dihapus"); </script>
        <?php
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $sql = "DELETE FROM transaksi WHERE id='$id'";
	$db_object->db_query($sql);
    if ($sql) {
        echo "<script> location.replace('?menu=data_transaksi&pesan_success=Data transaksi berhasil dihapus'); </script>";
    }
}

$sql = "SELECT
        *
        FROM
         transaksi";
$query=$db_object->db_query($sql);
?>     


<div class="modal fade" id="modalupload" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" action="">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-fw fa-upload"></i> Upload Data Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="file_data_transaksi" id="inputGroupFile01" required />
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Close</button>
                    <button name="submit" type="submit" class="btn btn-success"><i class="fas fa-fw fa-upload"></i> Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modaladd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="post" enctype="multipart/form-data" action="">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-fw fa-plus"></i> Tambah Data Transaksi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                <div class="col-12">
                    <label for="" class="font-weight-bold">Tanggal</label>
                    <div class="form-group">
                        <input type="date" name="transaction_date" class="form-control" required="" />
                    </div>
                </div>
				
				<div class="col-12">
                    <label for="" class="font-weight-bold">Produk</label>
                    <div class="form-group">
						<textarea class="form-control" name="produk" rows="3" required=""></textarea>
                    </div>
                </div>
				
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Close</button>
                    <button name="simpan" type="submit" class="btn btn-success"><i class="fas fa-fw fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="card shadow mb-4">
    <!-- /.card-header -->
    <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-success"><i class="fa fa-table"></i> Daftar Data Transaksi</h6>
		
		<form method="post" enctype="multipart/form-data" action="">
			<button name="delete" type="submit" class="btn btn-app btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fas fa-fw fa-trash"></i> Delete All Data</button>
		</form>
    </div>

    <div class="card-body">
        

            <?php
            if (!empty($pesan_error)) {
                display_error($pesan_error);
            }
            if (!empty($pesan_success)) {
                display_success($pesan_success);
            }
            ?>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead class="bg-success text-white">
                <tr align="center">
                <th>No</th>
                <th>Tanggal</th>
                <th>Produk</th>
				<th width="15%">Aksi</th>
                </tr>
			</thead>
                <?php
                    $no=1;
                    while($row=$db_object->db_fetch_array($query)){
				?>
                        <tr>
							<td class='text-center'> <?= $no ?></td>
                            <td class='text-center'> <?= format_date2($row['transaction_date']) ?></td>
                            <td> <?= $row['produk'] ?></td>
							<td class='text-center'>
							<div class='btn-group' role='group'>
								<a href="?menu=edit_transaksi&id=<?= $row['id'] ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
								<a href="?menu=data_transaksi&hapus=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm ('Apakah anda yakin untuk meghapus data ini')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
							</div>
							</td>
                        </tr>
                    
					<?php
						$no++;
                    }
                    ?>
            </table>
            </div>
            </div>


<?php
function get_produk_to_in($produk){
    $ex = explode(",", $produk);
    //$temp = "";
    for ($i=0; $i < count($ex); $i++) { 

        $jml_key = array_keys($ex, $ex[$i]);
        if(count($jml_key)>1){
            unset($ex[$i]);
        }

        //$temp = $ex[$i];
    }
    return implode(",", $ex);
}

?>
  