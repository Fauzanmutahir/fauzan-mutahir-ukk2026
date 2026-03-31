<?php 
session_start();
if ($_SESSION['status_login'] != true ){
    echo '<script>window.location="login.php"</script>';
}
include 'db.php';
?>
<?php

$total = mysqli_query($conn,"SELECT COUNT(*) as jumlah FROM tb_input_aspirasi");
$total_data = mysqli_fetch_assoc($total);

$menunggu = mysqli_query($conn,"SELECT COUNT(*) as jumlah FROM tb_aspirasi WHERE status='menunggu'");
$data_menunggu = mysqli_fetch_assoc($menunggu);

$proses = mysqli_query($conn,"SELECT COUNT(*) as jumlah FROM tb_aspirasi WHERE status='proses'");
$data_proses = mysqli_fetch_assoc($proses);

$selesai = mysqli_query($conn,"SELECT COUNT(*) as jumlah FROM tb_aspirasi WHERE status='selesai'");
$data_selesai = mysqli_fetch_assoc($selesai);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>INputan aspirasi</title>
<link rel="stylesheet" href="css/style.css">
</head>

<body>

<div  class="bingo">
     <h1 class="bogoo">ASPIRASI SISWA</h1>
    <ul class="mubaa">
        
        
        <li><a href="page1.php">INPUT ASPIRASI</a></li>
        <li> <a href="index.php">Logout</a></li>
    </ul>
</div>
<div class="content">

<h2>Input Aspirasi</h2>

<div class="card-container">

<div class="card">
<h3>Total Aspirasi</h3>
<h1><?php echo $total_data['jumlah']; ?></h1>
</div>

<div class="card">
<h3>Menunggu</h3>
<h1><?php echo $data_menunggu['jumlah'] ?? 0; ?></h1>
</div>

<div class="card">
<h3>Proses</h3>
<h1><?php echo $data_proses['jumlah'] ?? 0; ?></h1>
</div>

<div class="card">
<h3>Selesai</h3>
<h1><?php echo $data_selesai['jumlah'] ?? 0; ?></h1>
</div>

</div>
<div>
  <a class="btnuu" href="page1.php"> ---> INPUT ASPIRASI ANDA <---</a>
  <a href=""></a>
  <a href=""></a>
</div>

<div class="tablel">
    <table border="1" cellpadding="10" cellspacing="0">
<tr>
<th>No</th>
<th>NIS</th>
<th>Kelas</th>
<th>Kategori</th>
<th>Lokasi</th>
<th>Aspirasi</th>
<th>Status</th>
<th>Feedback</th>
<th>Tanggal</th>
</tr>
<?php 
$no = 1;

$query = mysqli_query($conn,"
SELECT 
i.*, 
s.kelas, 
k.ket_kategori,
a.status,
a.feedback
FROM tb_input_aspirasi i
LEFT JOIN tb_siswa s ON i.nis = s.nis
LEFT JOIN tb_kategori k ON i.id_kategori = k.id_kategori
LEFT JOIN tb_aspirasi a ON i.id_pelaporan = a.id_pelaporan
");

while($data = mysqli_fetch_assoc($query)){
?>

<tr>

<td><?php echo $no++; ?></td>

<td><?php echo $data['nis'] ?? '-'; ?></td>

<td><?php echo $data['kelas'] ?? '-'; ?></td>

<td><?php echo $data['ket_kategori'] ?? '-'; ?></td>

<td><?php echo $data['lokasi'] ?? '-'; ?></td>

<td><?php echo $data['ket'] ?? '-'; ?></td>

<td><?php echo $data['status'] ?? 'Menunggu'; ?></td>

<td>
<?php echo !empty($data['feedback']) ? $data['feedback'] : 'Belum ada feedback'; ?>
</td>

<td>
<?php 
echo !empty($data['tgl_input']) 
? date('d-m-Y H:i:s', strtotime($data['tgl_input'])) 
: '-'; 
?>
</td>

</tr>

<?php } ?>
</table>
</div>






</div>

</body>
</html>