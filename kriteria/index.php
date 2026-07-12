<?php
include "../config/koneksi.php";
include "../templates/header.php";
include "../templates/sidebar.php";

// Simpan Data
if(isset($_POST['simpan'])){

    $nama   = $_POST['nama'];
    $bobot  = $_POST['bobot'];
    $tipe   = $_POST['tipe'];

    mysqli_query($conn,"
    INSERT INTO kriteria
    (nama_kriteria,bobot,tipe)
    VALUES
    ('$nama','$bobot','$tipe')
    ");

    echo "
    <script>
    alert('Data berhasil ditambahkan');
    location='index.php';
    </script>";
}
?>

<div class="container-fluid">

<div class="d-flex justify-content-between align-items-center mb-4">

<h2>Data Kriteria</h2>

<button
class="btn btn-primary"
data-bs-toggle="modal"
data-bs-target="#modalTambah">

+ Tambah Kriteria

</button>

</div>

<table class="table table-bordered table-hover">

<thead class="table-primary">

<tr>

<th width="60">No</th>

<th width="80">Kode</th>

<th>Nama Kriteria</th>

<th width="120">Bobot</th>

<th width="120">Tipe</th>

<th width="180">Aksi</th>

</tr>

</thead>

<tbody>

<?php

$no=1;

$data=mysqli_query($conn,"
SELECT *
FROM kriteria
ORDER BY id_kriteria ASC
");

while($row=mysqli_fetch_assoc($data)){

?>

<tr>

<td><?= $no++; ?></td>

<td>C<?= $no-1; ?></td>

<td><?= $row['nama_kriteria']; ?></td>

<td><?= $row['bobot']; ?></td>

<td>

<?php

if($row['tipe']=="benefit"){

?>

<span class="badge bg-success">

Benefit

</span>

<?php

}else{

?>

<span class="badge bg-danger">

Cost

</span>

<?php } ?>

</td>

<td>

<a
href="edit.php?id=<?= $row['id_kriteria']; ?>"
class="btn btn-warning btn-sm">

Edit

</a>

<a
href="hapus.php?id=<?= $row['id_kriteria']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Yakin ingin menghapus data?')">

Hapus

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

<!-- ========================= -->
<!-- Modal Tambah -->
<!-- ========================= -->

<div
class="modal fade"
id="modalTambah">

<div class="modal-dialog">

<div class="modal-content">

<form method="POST">

<div class="modal-header">

<h5 class="modal-title">

Tambah Kriteria

</h5>

<button
type="button"
class="btn-close"
data-bs-dismiss="modal">

</button>

</div>

<div class="modal-body">

<label>

Nama Kriteria

</label>

<input
type="text"
name="nama"
class="form-control"
required>

<br>

<label>

Bobot

</label>

<input
type="number"
step="0.01"
name="bobot"
class="form-control"
required>

<br>

<label>

Tipe

</label>

<select
name="tipe"
class="form-control">

<option value="benefit">

Benefit

</option>

<option value="cost">

Cost

</option>

</select>

</div>

<div class="modal-footer">

<button
type="button"
class="btn btn-secondary"
data-bs-dismiss="modal">

Batal

</button>

<button
type="submit"
name="simpan"
class="btn btn-primary">

Simpan

</button>

</div>

</form>

</div>

</div>

</div>

<?php
include "../templates/footer.php";
?>