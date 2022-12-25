 <nav class="navbar navbar-default">
        <div class="container">
        <a class="navbar-brand" href="index.php">Tonlen || Jodev</a>
        <ul class="nav navbar-nav">
            <li><a href="index.php">home</a></li>
            <li><a href="keranjang.php">keranjang</a></li>
            <li><a href="checkout.php">checkout</a></li>
            <?php if(isset($_SESSION['pelanggan'])): ?>
            <li><a href="riwayat.php">riwayat</a></li>
            <li><a href="logout.php">logout</a></li>
            <?php else : ?>
            <li><a href="daftar.php">Daftar</a></li>
            <li><a href="login.php">login</a></li>
            <?php endif ?>
        </ul>
        <form action="pencarian.php" method="get" class="navbar-form navbar-right">
            <input type="text" class="form-control" name="keyword">
            <button class="btn btn-primary">Cari</button>
        </form>
        </div>
    </nav>