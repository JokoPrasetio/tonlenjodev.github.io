<?php 
session_start();
include 'admin/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pelanggan</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
     <!-- navbar -->
    <?php 
        include 'menu.php';
    ?>

    <!-- login  -->
    <div class="container login">
        <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
             <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Login Pelanggan</h3>
                </div>
                <div class="panel-body">
                    <form method="post">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" placeholder="Masukan Email" name="email" required>   
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Masukan Password" required>
                        </div>
                        <button class="btn btn-primary" name="login">Login</button>
                    </form>
                </div>
             </div>
            </div>
        </div>
    </div>

    <?php 
    //jika tombol masuk ditekan
    if(isset($_POST['login'])){

        $email=$_POST['email'];
        $password=$_POST['password'];

        //lakukan kuery pengecekan akun di tabel pelanggan db
        $ambil=mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE email_pelanggan='$email' AND password_pelanggan='$password' ");
        $cocok=$ambil->num_rows;

        if($cocok==1){
            //login berhasil
            //mendapatkan akun dalam bentuk array
            $akun=$ambil->fetch_assoc();
            //simpan di session pelanggan
            $_SESSION['pelanggan'] =$akun;

            echo'<script>alert("berhasil")</script>';

            //jika sudah belanja
            if(isset($_SESSION['keranjang']) OR !empty($_SESSION['keranjang'])){
                echo'<script>location="keranjang.php"</script>';
                
            }else{
                echo'<script>location="riwayat.php"</script>';
            }
            

        }else{
            //login gagal
            echo'<script>alert("Login Gagal")</script>';
            echo'<script>location="login.php"</script>';
        }

    }
    ?>

</body>
</html>