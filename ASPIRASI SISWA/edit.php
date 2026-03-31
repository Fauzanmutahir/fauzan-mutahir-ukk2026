<?php
session_start();
include 'db.php';

// CEK ID
if(!isset($_GET['id'])){
    die("ID tidak ditemukan");
}

$id = mysqli_real_escape_string($conn, $_GET['id']);

// AMBIL DATA
$query = mysqli_query($conn, "
SELECT 
    i.*, 
    s.kelas,
    k.ket_kategori,
    a.status,
    a.feedback
FROM tb_input_aspirasi i
JOIN tb_siswa s ON i.nis = s.nis
JOIN tb_kategori k ON i.id_kategori = k.id_kategori
LEFT JOIN tb_aspirasi a ON i.id_pelaporan = a.id_pelaporan
WHERE i.id_pelaporan = '$id'
");

$data = mysqli_fetch_assoc($query);

if(!$data){
    die("Data tidak ditemukan");
}

// UPDATE DATA

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Umpan Balik</title>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/style.css">
</head>

<body>

<!-- HEADER -->
<div class="bingo">
    <h2 class="bogoo">ASPIRASI SISWA</h2>
    <ul class="mubaa">
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="umpan-balik.php">Umpan Balik</a></li>
        <li><a href="histori.php">Histori</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</div>

<!-- CONTENT -->
<div class="tbi">



<form method="POST">

<input type="hidden" name="id_pelaporan" value="<?php echo $data['id_pelaporan']; ?>">

<label>NIS</label>
<input type="text" value="<?php echo $data['nis']; ?>" readonly>

<label>Kelas</label>
<input type="text" value="<?php echo $data['kelas']; ?>" readonly>

<label>Lokasi</label>
<input type="text" value="<?php echo $data['lokasi']; ?>" readonly>

<label>Keterangan</label>
<textarea readonly><?php echo $data['ket']; ?></textarea>

<label>Status</label>
<select name="status">
    <option value="Menunggu" <?php if($data['status']=='Menunggu') echo 'selected'; ?>>Menunggu</option>
    <option value="Proses" <?php if($data['status']=='Proses') echo 'selected'; ?>>Proses</option>
    <option value="Selesai" <?php if($data['status']=='Selesai') echo 'selected'; ?>>Selesai</option>
</select>

<label>Feedback</label>
<textarea name="feedback"><?php echo $data['feedback']; ?></textarea>

<br><br>
<button type="submit" name="submit" class="btn">Kirim</button>

</form>

</div>

</body>
<?php 
if(isset($_POST['submit'])){
    $status = $_POST['status'];
    $feedback = $_POST['feedback'];
    $id_pelaporan = $_POST['id_pelaporan'];

    $update = mysqli_query($conn,"UPDATE tb_aspirasi SET
        status='$status',
        feedback='$feedback',
        tgl_aspirasi = NOW()
        WHERE id_pelaporan='$id_pelaporan'");

    if($update){
        echo "<script>alert('Data berhasil di update')</script>";
        echo "<script>window.location='umpan-admin.php'</script>";
        exit;
    } else {
        echo mysqli_error($conn);
    }
}
?>
</html>