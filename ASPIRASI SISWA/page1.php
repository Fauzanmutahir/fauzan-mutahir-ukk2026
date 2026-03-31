<?php 
    session_start();
    if ($_SESSION['status_login'] != true ){
        echo '<script>window.location="login.php"</script>';

       }
        include 'db.php';
?>

<?php
if (isset($_POST['submit'])) {
    $nis= mysqli_real_escape_string($conn, $_POST['nis']);
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
    $lokasi = mysqli_real_escape_string($conn, $_POST['lokasi']);
    $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);


    if (mysqli_query($conn, "INSERT INTO tb_input_aspirasi (nis, id_kategori, lokasi, ket) 
              VALUES ('$nis','$kategori', '$lokasi', '$deskripsi')")) {

        $last_id = mysqli_insert_id($conn);

        mysqli_query($conn, "INSERT INTO tb_aspirasi (id_pelaporan, status, feedback) 
                            VALUES ('$last_id', 'menunggu', '')");

        echo "<script>alert('Aspirasi berhasil dikirim!');</script>";
        echo '<script>window.location="page-siswa.php"</script>';
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <h2>Form Input Aspirasi</h2>
<div class="tbi">
    <form method="POST" action="">

      <a href="page-siswa.php" class="btnv">Kembali</a><br><br>
       <label>Kategori Aspirasi:</label><br>
<select name="kategori" required>
    <option value="">-- Pilih Kategori --</option>
    
    <?php
    $queryKategori = mysqli_query($conn, "SELECT * FROM tb_kategori ORDER BY ket_kategori ASC");
    
    while ($dataKategori = mysqli_fetch_assoc($queryKategori)) {
        echo "<option value='" . $dataKategori['id_kategori'] . "'>" 
            . $dataKategori['ket_kategori'] . 
            "</option>";
    }
    ?>
    
</select>
<br><br>
        <br>
        <label>NIS:</label><br>
        <input type="text" name="nis" value="<?php echo $_SESSION['a_global']->nis; ?>">
        <br><br>       

        <label>Lokasi Kejadian:</label><br>
        <input type="text" name="lokasi" required>
        <br><br>

        <label>Tanggal Kejadian:</label><br>
        <input type="date" name="tanggal" required>
        <br><br>

        <label>Deskripsi:</label><br>
        <textarea name="deskripsi" rows="5" cols="40" required></textarea>
        <br><br>

        <button type="submit" name="submit">Kirim Aspirasi</button>
    </form>
</div>
</body>
</html>