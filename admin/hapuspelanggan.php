<?php 
$hapus=mysqli_query($koneksi, "DELETE FROM pelanggan WHERE id_pelanggan='$_GET[id]' ");

echo'<script>alert("Data pelanggan dihapus")</script>';
echo'<script>location="index.php?halaman=pelanggan"</script>';

?>