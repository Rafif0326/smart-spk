<?php
include "../config/koneksi.php";
include "../templates/header.php";
include "../templates/sidebar.php";

$id = $_GET['id'];

$data = mysqli_query($conn,"SELECT * FROM kriteria WHERE id_kriteria='$id'");
$row = mysqli_fetch_assoc($data);

// Update Data
if(isset($_POST['update'])){

    $nama   = $_POST['nama'];
    $bobot  = $_POST['bobot'];
    $tipe   = $_POST['tipe'];

    mysqli_query($conn,"
    UPDATE kriteria SET
    nama_kriteria='$nama',
    bobot='$bobot',
    tipe='$tipe'
    WHERE id_kriteria='$id'
    ");

    echo "
    <script>
    alert('Data berhasil diupdate');
    location='index.php';
    </script>";
}
?>

<div class="container-fluid">

<div class="card">

<div class="card-header bg-warning text-dark">
Edit Kriteria
</div>

<div class="card-body">

<form method="POST">

<div class="mb-3">

<label>Nama Kriteria</label>

<input
type="text"
name="nama"
class="form-control"
value="<?= $row['nama_kriteria']; ?>"
required>

</div>

<div class="mb-3">

<label>Bobot</label>

<input
type="number"
step="0.01"
name="bobot"
class="form-control"
value="<?= $row['bobot']; ?>"
required>

</div>

<div class="mb-3">

<label>Tipe</label>

<select
name="tipe"
class="form-control">

<option value="benefit"
<?= ($row['tipe']=="benefit") ? "selected" : ""; ?>>

Benefit

</option>

<option value="cost"
<?= ($row['tipe']=="cost") ? "selected" : ""; ?>>

Cost

</option>

</select>

</div>

<button
type="submit"
name="update"
class="btn btn-success">

Simpan Perubahan

</button>

<a
href="index.php"
class="btn btn-secondary">

Kembali

</a>

</form>

</div>

</div>

</div>

<?php
include "../templates/footer.php";
?>