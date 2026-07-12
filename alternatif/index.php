<?php
include "../config/koneksi.php";
include "../templates/header.php";
include "../templates/sidebar.php";
?>

<div class="container-fluid">

    <h2 class="mb-4">Data Alternatif</h2>

    <button
        class="btn btn-primary mb-3"
        data-bs-toggle="modal"
        data-bs-target="#modalTambah">

        + Tambah Alternatif

    </button>

</div>

<table class="table table-bordered table-hover">

    <thead class="table-primary">

        <tr>

            <th width="70">No</th>
            <th>Nama Alternatif</th>
            <th width="180">Aksi</th>

        </tr>

    </thead>

    <tbody>

        <?php

        $no=1;

        $data=mysqli_query($conn,"SELECT * FROM alternatif");

        while($row=mysqli_fetch_assoc($data)){

        ?>

        <tr>

            <td><?= $no++ ?></td>

            <td><?= $row['nama'] ?></td>

            <td>

                <a
                href="edit.php?id=<?= $row['id_alternatif'] ?>"
                class="btn btn-warning btn-sm">

                Edit

                </a>

                <a
                href="hapus.php?id=<?= $row['id_alternatif'] ?>"
                class="btn btn-danger btn-sm"
                onclick="return confirm('Yakin ingin menghapus data ini?')">

                Hapus

                </a>

            </td>

        </tr>

        <?php } ?>

    </tbody>

</table>

<div
class="modal fade"
id="modalTambah">

<div class="modal-dialog">

<div class="modal-content">

<form method="POST">

<div class="modal-header">

<h5>Tambah Alternatif</h5>

<button
type="button"
class="btn-close"
data-bs-dismiss="modal">
</button>

</div>

<div class="modal-body">

<label>Nama Alternatif</label>

<input
type="text"
name="nama"
class="form-control"
required>

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

if(isset($_POST['simpan'])){

    $nama=$_POST['nama'];

    mysqli_query($conn,

    "INSERT INTO alternatif(nama)

    VALUES('$nama')"

    );

    echo "

    <script>

    alert('Data berhasil ditambahkan');

    location='index.php';

    </script>

    ";

}

?>

<?php
include "../templates/footer.php";
?>