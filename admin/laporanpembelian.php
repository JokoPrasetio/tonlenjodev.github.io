<?php 
// #1 validasi login mengecek apakah admin sudah login atau belum
if(!isset($_SESSION['admin'])){
    echo'<script>alert("tidak diketahui")</script>';
    echo'<script>location="login.php"</script>';
}

$semuadata=array();
$tgl_mulai="-";
$tgl_selesai="-";
if(isset($_POST['kirim'])){

    $tgl_mulai=$_POST['tglm'];
    $tgl_selesai=$_POST['tgls'];
    $ambil=$koneksi->query("SELECT * FROM pembelian LEFT JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE tanggal_pembelian BETWEEN '$tgl_mulai' AND '$tgl_selesai' ");
    while($pecah=$ambil->fetch_assoc()){
    
        $semuadata[]=$pecah;
    }

}

//echo'<pre>';
// print_r($semuadata);
// echo'</pre>';


?>

<h2>Laporan Pembelian <?= $tgl_mulai; ?> Sampai <?= $tgl_selesai;?></h2>
<hr>

<form action="" method="post">
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="">Tanggal Mulai</label>
                <input type="date" name="tglm" class="form-control" value="<?= $tgl_mulai;?>">
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="">Tanggal Selesai</label>
                <input type="date" name="tgls" class="form-control" value="<?= $tgl_selesai; ?>">
            </div>
        </div>
        <div class="col-md-2">
            <br>
            <button class="btn btn-primary" name="kirim">Lihat</button>
        </div>
    </div>
</form>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Pelanggan</th>
            <th>Tanggal</th>
            <th>Jumlah</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <?php $total=0; ?>
        <?php foreach ($semuadata as $key => $value) :?>
        <?php $total+=$value['total_pembelian']; ?>
        <tr>
            <td><?= $key=1; ?></td>
            <td><?= $value['nama_pelanggan'];?></td>
            <td><?= $value['tanggal_pembelian'];?></td>
            <td>Rp. <?= number_format($value['total_pembelian'])?></td>
            <td><?= $value['status_pembelian'];?></td>
        </tr>
        <?php endforeach ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3">Total</th>
            <th colspan="2">Rp.<?= number_format($total);?></th>
        </tr>
    </tfoot>
</table>