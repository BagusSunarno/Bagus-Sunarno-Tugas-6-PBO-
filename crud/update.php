<!DOCTYPE html>
<html>
<head>
    <title>Form Pendaftaran Anggota</title>
    <!-- Load file CSS Bootstrap offline -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

</head>
<body>
<div class="container">
    <?php

    //Include file koneksi, untuk koneksikan ke database
    include "koneksi.php";

    //Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    //Cek apakah ada nilai yang dikirim menggunakan methos GET dengan nama id_anggota
    if (isset($_GET['id'])) {
        $id=input($_GET["id"]);

        $sql="select * from tbl_mhs where id=$id";
        $hasil=mysqli_query($kon,$sql);
        $data = mysqli_fetch_assoc($hasil);
    }

    //Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id=htmlspecialchars($_POST["id"]);
        $nim=input($_POST["nim"]);
        $namamhs=input($_POST["namamhs"]);
        $jk=input($_POST["jk"]);
        $alamat=input($_POST["alamat"]);
		$kota=input($_POST["kota"]);
        $email=input($_POST["email"]);
        $foto=input($_POST["foto"]);

        //Query update data pada tabel anggota
        $sql="update tbl_mhs set
			nim='$nim',
			namamhs='$namamhs',
			jk='$jk',
			alamat='$alamat',
			kota='$kota',
			email='$email',
			foto='$foto'
			where id=$id";

        //Mengeksekusi atau menjalankan query diatas
        $hasil=mysqli_query($kon,$sql);

        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:index.php");
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal diupdate.</div>";

        }

    }

    ?>
    <h2>Form Perbarui Data Mahasiswa Sistem Informasi 2020B</h2>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="form-group">
            <label>Nim:</label>
            <input type="text" name="nim" class="form-control" placeholder="Masukan NIM" required />
        </div>
		
        <div class="form-group">
            <label>Nama Mahasiswa:</label>
            <input type="text" name="namamhs" class="form-control" placeholder="Masukan Nama Mahasiswa" required/>
        </div>
		
		<div class="form-group">
            <label>Jenis Kelamin:</label>
            <input type="text" name="jk" class="form-control" placeholder="Masukan Jenis Kelamin (L/P)" required/>
        </div>
		
        <div class="form-group">
            <label>Alamat:</label>
            <textarea name="alamat" class="form-control" rows="5"placeholder="Masukan Alamat" required></textarea>
        </div>
		
        <div class="form-group">
            <label>Kota:</label>
            <input type="text" name="kota" class="form-control" placeholder="Masukan Kota" required/>
        </div>
		
        <div class="form-group">
            <label>Email:</label>
            <input type="email" name="email" class="form-control" placeholder="Masukan Email" required/>
        </div>
		
        <div class="form-group">
            <label>Foto</label>
            <input type="file" name="tfoto" value="<?=@$vfoto?>" required="" multiple >
            <p style="color: red">Ekstensi yang diperbolehkan .png | .jpg | .jpeg | .gif</p> 
        </div>

        <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>