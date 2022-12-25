<?php
    include 'admin/db.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
      <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php 
        include 'menu.php';
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Buat Akun</h3>
                    </div>
                    <div class="panel-body">
                            <form action="" method="post" class="form-horizontal">
                                    <div class="form-group">
                                        <label for="" class="control-label col-md-3">Nama</label>
                                        <div class="col-md-7">
                                            <input type="text" class="form-control" name="nama" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="control-label col-md-3">Email</label>
                                        <div class="col-md-7">
                                            <input type="email" class="form-control" name="email" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="control-label col-md-3">Password</label>
                                        <div class="col-md-7">
                                            <input type="password" class="form-control" name="password" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Alamat</label>
                                        <div class="col-md-7">
                                            <textarea name="alamat"  class="form-control" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">No.Telepon/WA</label>
                                        <div class="col-md-7">
                                            <input type="number" class="form-control" name="telepon" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-7 col-md-offset-3">
                                            <button class="btn btn-primary" name="daftar">Daftar</button>
                                        </div>
                                    </div>
                            </form>
                        <!-- jika tombol daftar di tekan -->
                        <?php
                            if(isset($_POST['daftar'])){
                                //mengambil data

                                $nama=$_POST['nama'];
                                $email=$_POST['email'];
                                $password=$_POST['password'];
                                $alamat=$_POST['alamat'];
                                $telepon=$_POST['telepon'];

                                //mengecek email apakah sudah digunakan
                                $ambil=$koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email' ");
                                $yangcocok=$ambil->num_rows;

                                if($yangcocok == 1){
                                    
                                    echo'<script>alert("Email sudah digunakan")</script>';
                                    echo'<script>location="daftar.php"</script>';
                                }else{
                                    //jika email belum ada yang digunakan
                                    $koneksi->query("INSERT INTO pelanggan (email_pelanggan,password_pelanggan,nama_pelanggan,telepon_pelanggan,alamat) VALUES ('$email','$password','$nama', '$telepon','$alamat') ");

                                    echo'<script>alert("akun berhasil didaftarkan")</script>';
                                    echo'<script>Location=login.php</script>';
                                }
                            }

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>