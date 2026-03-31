<?php
session_start();

// cek login
if (!isset($_SESSION['status_login']) || $_SESSION['status_login'] != true) {
    echo '<script>window.location="index.php"</script>';
    exit;
}

include 'db.php';

// tampilkan error (biar gampang debug)
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASPIRASI SISWA</title>
         <link rel="stylesheet" href="css/style.css">
</head>
<body class="bgxx">



<div  class="sidebarxx">
     <h1 class="logoxx">ASPIRASI SISWA</h1>
    <ul class="menuxx">
        <li><a href="dashboard.php">Dashboard</a></li>
     <li>   <a href="umpan-admin.php">Umpan Balik</a></li>
        <li> <a href="index.php">Logout</a></li>
    </ul>
</div>

<div class="contentxx">
    <div class="tableboxx">
    <table class="tablexx">
        <thead>
            <tr>
                <th>No</th>
                <th>NIS Siswa</th>
                <th>Kelas</th>
                <th>Kategori</th>
                <th>Lokasi</th>
                <th>Keterangan</th>
                <th>Status</th>
                <th>Feedback</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>

        <?php
        $query = mysqli_query($conn,"
        SELECT 
            i.*,
            s.nis,
            s.kelas,
            k.ket_kategori,
            a.feedback,
            a.status 
        FROM tb_input_aspirasi i
        JOIN tb_siswa s ON i.nis = s.nis
        JOIN tb_kategori k ON i.id_kategori = k.id_kategori
        LEFT JOIN tb_aspirasi a ON i.id_pelaporan = a.id_pelaporan
        ");

        if(!$query){
            die("Query error: " . mysqli_error($conn));
        }

        $no = 1;

        while ($data = mysqli_fetch_assoc($query)) {
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
                <?php echo !empty(  $data['feedback']) ? $data['feedback'] : 'Belum ada feedback'; ?>
            </td>
            <td>
                <a href="edit.php?id=<?php echo $data['id_pelaporan']; ?>">Edit</a>
            </td>
        </tr>

        <?php } ?>

        </tbody>
    </table>
    </div>
</div>

</body>
</html>