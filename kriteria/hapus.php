<?php

include "../config/koneksi.php";

$id = $_GET['id'];

mysqli_query($conn,"DELETE FROM kriteria WHERE id_kriteria='$id'");

echo "
<script>

alert('Data berhasil dihapus');

location='index.php';

</script>
";

?>