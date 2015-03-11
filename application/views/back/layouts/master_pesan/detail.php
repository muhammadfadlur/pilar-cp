<?php 
	if(!empty($list)){
?>
<table class="table table-hover table-bordered table-condensed table-striped">
	<tr>
		<th width="70px">Pengirim</th>
		<td><?php echo $list['nama']?></td>
	</tr>
	<tr>
		<th width="">Email</th>
		<td><?php echo $list['email']?></td>
	</tr>
	<tr>
		<th width="">Pesan</th>
		<td><?php echo $list['pesan']?></td>
	</tr>							
</table>	
<?php 
	}else{
?>
<span style="color:red;">Ups, tidak bisa mengambil data</span>
<?php
	}
?>