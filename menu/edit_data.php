<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "ubl_cell";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}
$id        = "";
$nama   ="";
$jenis       = "";
$spesifikasi     = "";
$harga   = "";
$sukses ="";
$error      = "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if($op == 'delete'){
    $no         = $_GET['no'];
    $sql1       = "delete from data_cell where no = '$no'";
    $q1         = mysqli_query($koneksi,$sql1);
    if($q1){
        $sukses = "Berhasil hapus data";
    }else{
        $error  = "Gagal melakukan delete data";
    }
}
if ($op == 'edit') {
    $no         = $_GET['no'];
    $sql1       = "select * from data_cell where no = '$no'";
    $q1         = mysqli_query($koneksi, $sql1);
    $r1         = mysqli_fetch_array($q1);
    $id        = $r1['id'];
    $nama       = $r1['nama'];
    $jenis     = $r1['jenis'];
    $spesifikasi   = $r1['spesifikasi'];
    $harga   = $r1['harga'];

    if ($id == '') {
        $error = "Data tidak ditemukan";
    }
}
if (isset($_POST['simpan'])) { //untuk create
    $id        = $_POST['id'];
    $nama       = $_POST['nama'];
    $jenis     = $_POST['jenis'];
    $spesifikasi     = $_POST['spesifikasi'];
    $harga   = $_POST['harga'];

    if ($id && $nama && $jenis && $spesifikasi && $harga) {
        if ($op == 'edit') { //untuk update
            $sql1       = "update data_cell set id = '$id',
                                                    nama='$nama',
                                                    jenis = '$jenis',
                                                    spesifikasi='$spesifikasi',
                                                    harga='$harga' where no = '$no'";
            $q1         = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses = "Data berhasil diupdate";
            } else {
                $error  = "Data gagal diupdate";
            }
        } else { //untuk insert
            $sql1   = "insert into data_cell(id,nama,jenis,spesifikasi,harga) values ('$id','$nama','$jenis','$spesifikasi','$harga')";
            $q1     = mysqli_query($koneksi, $sql1);
            if ($q1) {
                $sukses     = "Berhasil memasukkan data baru";
            } else {
                $error      = "Gagal memasukkan data";
            }
        }
    } else {
        $error = "Silakan masukkan semua data";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 800px
        }

        .card {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="mx-auto">
        <!-- untuk memasukkan data -->
        <div class="card">
            <div class="card-header">
                Edit Data
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                <?php
                    header("refresh:5;url=simpan_data.php");//5 : detik
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $sukses ?>
                    </div>
                <?php
                    header("refresh:5;url=table_data.php");
                }
                ?>
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="nim" class="col-sm-2 col-form-label">Id Barang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="id" name="id" value="<?php echo $id ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama Barang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="jenis" class="col-sm-2 col-form-label">Jenis Barang</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="jenis" id="jenis">
                                <option value="">- Pilih Jenis Barang -</option>
                                <option value="android" <?php if ($jenis == "android") echo "selected" ?>>Android</option>
                                <option value="ios" <?php if ($jenis == "ios") echo "selected" ?>>IOS</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="spesifikasi" class="col-sm-2 col-form-label">RAM/Internal</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="spesifikasi" name="spesifikasi" value="<?php echo $spesifikasi ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="harga" class="col-sm-2 col-form-label">Harga</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="harga" name="harga" value="<?php echo $harga ?>">
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
