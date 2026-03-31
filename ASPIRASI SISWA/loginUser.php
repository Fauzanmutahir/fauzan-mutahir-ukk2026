<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    <title>Login / AspirasiSiswa</title>
</head>
<body id="bg-login" class="bg-cantik">
    <div class="box-login">
        <h2>Login</h2>
        <form action="" method="POST">
            <img src="img/user-graduate-solid-full.svg" >
            <input type="text" name="user" placeholder="NIss" class="input-control">
            <input type="submit" name="submit" value="Login" class="btn">
        </form>
        <?php
        if (isset($_POST['submit'])){
            session_start();
            include 'db.php';

            $nis =mysqli_real_escape_string ($conn,$_POST ['user']) ;
            

            $cek = mysqli_query($conn, "SELECT * FROM tb_siswa WHERE nis = '".$nis."'");
            if(mysqli_num_rows($cek) > 0) {
                $d= mysqli_fetch_object($cek);
                $_SESSION['status_login'] =true;
                $_SESSION['a_global'] = $d;
                $_SESSION['id'] = $d->admin_id;

                echo '<script>window.location="page-siswa.php"</script>';
            } else{
                echo '<script>alert("Niss salah!")</script>';
            }
        }
        ?>
    </div>
</body>
</html>