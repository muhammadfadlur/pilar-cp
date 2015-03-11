									<div class="balon-sukses alert alert-info alert-dismissable col-centered col-xs-5" <?php if(is_string($this->session->flashdata('sukses'))){echo 'style="display:block;margin-bottom:7px;"';}else{echo 'style="display:none;"';}?>>
									    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									    <?php echo $this->session->flashdata('sukses'); ?>
									</div>
									<div class="balon-sukses alert alert-danger alert-dismissable col-centered col-xs-5" <?php if(is_string($this->session->flashdata('gagal'))){echo 'style="display:block;margin-bottom:7px;"';}else{echo 'style="display:none;"';}?>>
									    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
									    <?php echo $this->session->flashdata('gagal'); ?>
									</div>

									<table class="table table-hover table-condensed table-striped">
										<thead>
										<tr>
											<th style="text-align:center;">#</th>
											<th>Pengirim</th>
											<th>Email</th>
											<th>Pesan</th>
										</tr>
										</thead>
										<?php 
											if(!empty($list)){
												$i = 1; 
												foreach ($list as $row) {
										?>
										<tr>
											<td width="3%" align="center"><?php echo $i++ ?></td>
											<td width="15%"><?php echo $row['nama']?></td>
											<td width="15%"><?php echo $row['email']?></td>
											<td>
												<?php echo $row['pesan']?>
												<span class="pull-right">
													<a onclick="detail(<?=$row['id']?>)" data-toggle="modal" data-target="#detailModal" title="Lihat detail pesan dari <?=$row['nama']?>" class="label label-success" >Lihat</a>
													<a onclick="edit(<?=$row['id']?>)" data-toggle="modal" data-target="#editModal" class="label label-warning" title="Edit pesan dari <?=$row['nama']?>">Edit</a>
													<a onclick="hapus(<?=$row['id']?>)" data-toggle="modal" data-target="#hapusModal" class="label label-danger" title="Hapus pesan dari <?=$row['nama']?>">Hapus</a>
												</span>
											</td>
										</tr>
										<?php 
												}
											}else{
										?>
										<tr>
											<td colspan="4" align="center">Belum ada pesan</td>
										</tr>
										<?php
											}
										?>							
									</table>