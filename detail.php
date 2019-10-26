<div id="kiri">
	<?php
		echo kategori($kategori_id);
	?>
</div>

<div id="kanan">
	<?php
		$barang_id = $_GET['barang_id'];

		$query = mysqli_query($koneksi, "SELECT * FROM barang WHERE barang_id='$barang_id' AND status='on'");
		$row = mysqli_fetch_assoc($query);

			echo "<div id='detail-barang'>";
			/**/
			echo "<h2>$row[nama_barang]</h2>";	
			echo "<div id='frame-gambar'>";	
			echo "<img src='".BASE_URL."images/barang/$row[gambar]'/>";		
			echo "</div>";
			/**/
			echo "<div id='frame-harga'>";
			echo "<span>".rupiah($row['harga'])."</span>";
			echo "<a href='".BASE_URL."tambah_keranjang.php?barang_id=$row[barang_id]'>+ Add To Cart </a>";	
			echo "</div>";
			/**/
			echo "<div id='keterangan'>";
			echo "<b>Keterangan : </b>".$row['spesifikasi'];
			//echo "<span>".$row['spesifikasi']."</span>";
			echo "</div>";
			/**/
			echo "</div>";
	?>

</div>