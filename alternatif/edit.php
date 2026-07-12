<?php

include "../config/koneksi.php";

$id = $_GET['id'];

$data = mysqli_query($conn,
"SELECT * FROM alternatif
WHERE id_alternatif='$id'");

$row = mysqli_fetch_assoc($data);

include "../templates/header.php";
include "../templates/sidebar.php";

?>

<div class="container-fluid">

<h2>Edit Alternatif</h2>

<form method="POST">

<div class="mb-3">

<label>Nama Alternatif</label>

<input
type="text"
name="nama"
class="form-control"
value="<?= $row['nama']; ?>"
required>

</div>

<button
type="submit"
name="update"
class="btn btn-primary">

Update

</button>

<a
href="index.php"
class="btn btn-secondary">

Kembali

</a>

</form>

</div>

<?php

if(isset($_POST['update'])){

$nama=$_POST['nama'];

mysqli_query($conn,

"UPDATE alternatif

SET nama='$nama'

WHERE id_alternatif='$id'"

);

echo "

<script>

alert('Data berhasil diupdate');

location='index.php';

</script>

";

}

include "../templates/footer.php";

?>