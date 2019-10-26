<?php
$pagination = isset($_GET["pagination"]) ? $_GET["pagination"] : 1;
$data_per_halaman = 5;
$mulai_dari = ($pagination-1) * $data_per_halaman;

if($level == "superadmin"){

$queryPesanan = mysqli_query($koneksi, "SELECT pesanan.*, user.nama FROM pesanan JOIN user ON pesanan.user_id=user.user_id ORDER BY pesanan.tanggal_pemesanan DESC LIMIT $mulai_dari, $data_per_halaman");

}else{

	$queryPesanan = mysqli_query($koneksi, "SELECT pesanan.*, user.nama FROM pesanan JOIN user ON pesanan.user_id=user.user_id WHERE pesanan.user_id='$user_id' ORDER BY pesanan.tanggal_pemesanan DESC");
}

if (mysqli_num_rows($queryPesanan) == 0) {
	
	echo "<h3>Maaf saat ini belum ada data pesanan</h3>";

}else{

	echo "<table class='table-list'>";
	echo "<tr class='baris-title'>";
	echo "<th class='kiri'>Nomor Pesanan</th>";
	echo "<th class='kiri'>Status</th>";
	echo "<th class='kiri'>Nama</th>";
	echo "<th class='kiri'>Action</th>";
	echo "</tr>";
	
	//$adminButton = "";
	while ($row = mysqli_fetch_assoc($queryPesanan)) {

		if($level == "superadmin"){

			$adminButton = "<a class='tombol-action' href='".BASE_URL."index.php?page=my_profile&module=pesanan&action=status&pesanan_id=".$row["pesanan_id"]."'>Update Pesanan </a>";
		}else{

			$adminButton = "";
		}
		$status = $row["status"];
		echo "<tr>";
		echo "<td class='kiri'>".$row["pesanan_id"]."</td>";
		echo "<td class='kiri'>".$arrayStatusPemesanan[$status]."</td>";
		echo "<td class='kiri'>".$row["nama"]."</td>";
		echo "<td class='kiri'>";
		echo "<a class='tombol-action' href='".BASE_URL."index.php?page=my_profile&module=pesanan&action=detail&pesanan_id=".$row["pesanan_id"]."'>Detail Pesanan </a>";
		echo $adminButton;
		echo "</td>";
		echo "</tr>";
	}

	echo "</table>";

	$queryHitungPesanan = mysqli_query($koneksi, "SELECT * FROM pesanan");
		pagination($queryHitungPesanan, $data_per_halaman, $pagination, "index.php?page=my_profile&module=pesanan&action=list");
}

?>