<!DOCTYPE html>
<html>
<head>
    <!-- Load file CSS Bootstrap offline -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <br>
    <h4>CRUD PHP Sederhana dengan OOP dan tampilan Bootstrap</h4>
<?php

    include "koneksi.php";

    //Cek apakah ada nilai dari method GET dengan nama id
    if (isset($_GET['id'])) {
        $id=htmlspecialchars($_GET["id"]);

        $sql="delete from tbl_mhs where id='$id' ";
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak
            if ($hasil) {
                header("Location:index.php");

            }
            else {
                echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";

            }
        }
?>


    <table class="table table-bordered table-hover">
        <br>
        <thead>
        <tr>
            <th>No</th>
            <th>Nim</th>
            <th>Nama Mahasiswa</th>
			<th>Jenis Kelamin</th>
            <th>Alamat</th>
			<th>Kota</th> 
            <th>Email</th>
            <th>Foto</th>
            <th colspan='2'>Aksi</th>

        </tr>
        </thead>
        <?php
        include "koneksi.php";
        $sql="select * from tbl_mhs order by id desc";

        $hasil=mysqli_query($kon,$sql);
        $no=0;
        while ($data = mysqli_fetch_array($hasil)) {
            $no++;

            ?>
            <tbody>
            <tr>
                <td><?=$no++?></td>
            <td><?=$data['nim']?></td>
            <td><?=$data['namamhs']?></td>
            <td><?=$data['jk']?></td>
            <td><?=$data['alamat']?></td>
            <td><?=$data['kota']?></td>
            <td><?=$data['email']?></td>
            <td><?=$data['foto']?></td>
            <td>
                    <a href="update.php?id=<?php echo htmlspecialchars($data['id']); ?>" class="btn btn-warning" role="button">Perbarui</a>
					<a href="index.php?hal=hapus&id=<?=$data['id']?>" onclick="return confirm('Apakah yakin ingin menghapus data ini?')" class="btn btn-danger"> Hapus </a>
                </td>
            </tr>
            </tbody>
            <?php
        }
        ?>
    </table>
    <a href="create.php" class="btn btn-primary" role="button">Tambah Data</a>

</div>
</body>
</html>