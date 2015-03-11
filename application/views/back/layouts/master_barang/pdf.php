<!DOCTYPE html>
<html>
<head>
	
	<title>Data Barang Raksa Abadi Informatika</title>
	<style type="text/css">
	body {
		background-color: #CCC;
		font-size: 11pt;
		font-family: arial, verdana;
		line-height: 1.4;
	}
	@media all {
 	.page-break { display: none; }
	}
	@media print {
 	.page-break { display: block; page-break-before: always; }
	}
	.clearfix {
		clear: both;
	}
	.coba {
		background-color: #00ff00;
	}
	.containerf4 {
		background-color: #FFF;
		height: 33cm;
		width: 21.6cm;
		margin: 0 auto;
		border-bottom: 0px solid #ccc;
	}
	.judul {
		text-align: center;
	}
	.text-center {
		text-align: center;
	}
	.text-bold {
		font-weight: bold;
	}
	.justify {
		text-align: justify;
	}
	h1 {
		font-size: 16pt;
	}
	h2 {
		font-size: 13pt;
		margin-bottom: 10px;
		margin-top: 20px;
	}
	.table-full {
		width: 100%;
	}
	table {
		border-collapse: collapse;
		border-color: #000;
	}
	table tr td, table tr th {
		padding: 3px 5px;
		vertical-align: top;
	} 
	.numbering {
		margin: 0;
		padding: 0;
		list-style-type: decimal;
	}
	.numbering li {
		margin-left: 35px;
		line-height: 1.5;
	}
	</style>

</head>

<body>
<!-- ================================== awal halaman ======================================= -->
<div class="containerf4">
	<div class="clearfix"></div>
	<h2>Data Barang Raksa Abadi Informatika</h2>
	<table class="table-full" border="1">
		<tr>
			<td style="width:10px;">No</td>
			<td style="width:50px;">ID Prod</td>
			<td style="width:100px;">Nama</td>
			<td style="width:450px;">Keterangan</td>
		</tr>
		<?php 
		$no=1;
		foreach ($results as $value) {
		?>
		<tr>
			<td><?=$no++?></td>
			<td><?=$value['id_produksi']?></td>
			<td><?=$value['nama']?></td>
			<td><?=$value['ket']?></td>
		</tr>
		<?php
		}
		?>
	</table>
</div>
<!-- ================================== akhir halaman ======================================= -->

</body>
</html>