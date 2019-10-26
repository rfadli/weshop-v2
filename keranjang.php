<?php
if($totalBarang == 0){
	echo "<h3>Saat ini belum ada barang di dalam keranjang belanja";
}else{

	$no=1;
	echo "<table class='table-list'>";

	echo "<tr class='baris-title'>";
	echo "<th class='tengah'>No</th>";
	echo "<th class='kiri'>Image</th>";
	echo "<th class='kiri'>Nama Barang</th>";
	echo "<th class='tengah'>Qty</th>";
	echo "<th class='kanan'>Harga Satuan</th>";
	echo "<th class='kanan'>Total</th>";
	echo "</tr>";

	$subtotal = 0;

	foreach ($keranjang as $key => $value) {
		$barang_id = $key;

		//var_dump($barang_id);

		$nama_barang = $value["nama_barang"];
		$quantity 	 = $value["quantity"];
		$gambar 	 = $value["gambar"];
		$harga 		 = $value["harga"];

		$total = $quantity * $harga;
		$subtotal = $subtotal + $total;

		echo "<tr>";
		echo "<td class='tengah'>".$no."</th>";
		echo "<td class='kiri'><img src='".BASE_URL."images/barang/$gambar' height='100px' /></td>";
		echo "<td class='kiri'>".$nama_barang."</td>";
		echo "<td class='tengah'><input type='text' name='$barang_id' value='$quantity' class='update-quantity' /></td>";
		echo "<td class='kanan'>".rupiah($harga)."</td>";
		echo "<td class='kanan hapus_item'>".rupiah($total)."<a href='".BASE_URL."hapus_item.php?barang_id=$barang_id'>X</a></td>";
		echo "</tr>";

	$no++;
	}

		echo "<tr>";
		echo "<td colspan='5' class='kanan'><b>Sub Total</b></td>";
		echo "<td class='kanan'><b>".rupiah($subtotal)."</b></td>";
		echo "</tr>";

	echo "</table>";

	echo "<div id='frame-button-keranjang'>";
	echo "<a id='lanjut-belanja' href='".BASE_URL."index.php'> < Lanjut Belanja </a>";
	echo "<a id='lanjut-pemesanan' href='".BASE_URL."data_pemesan.html'> Lanjut Pemesanan > </a>";
	echo "</div>";
}
?>

<script>
	$(".update-quantity").on("input", function(e){
		var barang_id = $(this).attr("name");
		var value = $(this).val();
		//console.log(barang_id +"---"+ value);

		$.ajax({
			method: "POST",
			url: "update_keranjang.php",
			data: "barang_id="+barang_id+"&value="+value
		})
		.done(function(data){
			location.reload();
		});
	});
</script>