<?php
if(!isset($_SESSION['admin'])){
    echo'<script>alert("tidak diketahui")</script>';
    echo'<script>location="login.php"</script>';
}
?>
<h2>Selamat datang admin</h2>

<!-- <pre> -->
    <?php
   //     print_r($_SESSION);
    ?>
<!-- </pre> -->