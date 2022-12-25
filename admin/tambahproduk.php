<?php
if(!isset($_SESSION['admin'])){
    echo'<script>alert("tidak diketahui")</script>';
    echo'<script>location="login.php"</script>';
}
$datakategori=array();
$ambil=mysqli_query($koneksi, "SELECT * FROM kategori2");
while($tiap=$ambil->fetch_assoc()){
    $datakategori[]=$tiap;
}
?>
<h2>Tambah Produk</h2>

<form action="" enctype="multipart/form-data" method="post">
    <div class="form-group">
        <label for="">Kategori</label>
        <select name="id_kategori" id="" class="form-control">
            <option value="">Pilih Kategori</option>
            <?php foreach ($datakategori as $key => $value) : ?>
            <option value="<?= $value['id_kategori']; ?>"><?= $value['nama_kategori']; ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="form-group">
        <label>Nama</label>
        <input type="text" class="form-control" name="nama" required placeholder="masukan nama produk">
    </div>
    <div class="form-group">
        <label>Harga</label>
        <input type="number" class="form-control" name="harga" required placeholder="masukan harga produk">
    </div>
    <div class="form-group">
        <label>Berat</label>
        <input type="text" class="form-control" name="berat" required placeholder="masukan berat produk dengan satuan Gram">
    </div>
    <div class="form-group">
        <label>Deskripsi</label>
        <textarea type="text" class="form-control" name="deskripsi" required placeholder="masukan deskripsi produk"></textarea>
    </div>
    <div class="form-group">
        <label>foto</label>
        <div class="letak-input" style="margin-bottom:10px">
                <input type="file" class="form-control" name="foto[]" style="margin-bottom:9px"required>
        </div>
        <span class="btn btn-primary btn-tambah">
            <i class="fa fa-plus"></i>
        </span>
    </div>
    <div class="form-group">
        <label>Stok Produk</label>
        <input type="number" class="form-control" name="stok" required>
    </div>
    <button class="btn btn-primary" name="simpan">simpan</button>
</form>

<?php
    if(isset($_POST['simpan'])){
        //Input data
        $idkategori=$_POST['id_kategori'];
        $namaproduk=$_POST['nama'];
        $hargaproduk=$_POST['harga'];
        $berat      =$_POST['berat'];
        $deskripsi=$_POST['deskripsi'];
        $stok   =$_POST['stok'];
        //input data file gambar
        $namanamafoto=$_FILES['foto']['name'];
        $lokasilokasifoto=$_FILES['foto']['tmp_name'];
        

        //$namanamafoto='foto'.time();

        //$tipediizinkan= array('jpg','jpeg','png');

        /*if(!in_array($tipediizinkan)){
            //jika file inputan tidak sesuai
            echo'<script>alert("Format file tidak diizinkan")</script>';
        }else{*/
            move_uploaded_file($lokasilokasifoto[0],"../fotoproduk/".$namanamafoto[0]);

            $insert=mysqli_query($koneksi, "INSERT INTO produk VALUES(null, '".$idkategori."','".$namaproduk."', '".$hargaproduk."', '".$berat."','".$namanamafoto[0]."','".$deskripsi."','".$stok."')");

            //mendapatkan id produk barusan
            $idprodukbarusan=$koneksi->insert_id;

            foreach ($namanamafoto as $key => $tiapnama) {
                $tiap_lokasi=$lokasilokasifoto[$key];

                move_uploaded_file($tiap_lokasi,"../fotoproduk/".$tiapnama);

                //simpan ke mysql
                $koneksi->query("INSERT INTO produk_foto VALUES (null,'".$idprodukbarusan."','".$tiapnama."') ");

            }
            //if($insert){
                echo '<script>alert("data berhasil ditambahkan")</script>';
                echo '<script>location="index.php?halaman=produk"</script>';
            //}else{
               // echo "gagal" .mysqli_error($koneksi);
            }
      //  }
   // }
?>

<script>
    $(document).ready(function(){
        $(".btn-tambah").on("click",function(){
            $(".letak-input").append("<input type='file' class='form-control' name='foto[]' style='margin-bottom:9px'required>");
        })
    })
</script>