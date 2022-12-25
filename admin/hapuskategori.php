<?php 

$hapus=mysqli_query($koneksi, "DELETE FROM kategori2 WHERE id_kategori='$_GET[id]' ");

echo'<script>alert("Data Kategori Dihapus")</script>';
echo'<script>location="index.php?halaman=kategori"</script>';
?>