	<!-- Add modal -->
	<div class="modal modal-l" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Tambah Pesan</h4>
	      </div>
	      <div class="modal-body">
	      <form id="addForm" class="form-horizontal">
	      	<div class="form-group">
              <label class="col-sm-2 control-label">Pengirim</label>
              <div class="col-sm-8">
                <input type="text" id="nama" name="nama" class="form-control input-sm" placeholder="Nama Lengkap Anda">
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-2 control-label">Email</label>
              <div class="col-sm-8">
                <input type="text" id="email" name="email" class="form-control input-sm" placeholder="Email aktif Anda">
              </div>
          </div>
          <div class="form-group">
              <label class="col-sm-2 control-label">Pesan</label>
              <div class="col-sm-10">
              <textarea id="pesan" name="pesan" class="form-control" placeholder="Tulisakan pesan Anda"></textarea>
              </div>
          </div>
          </form>
	      </div>
	      <div class="modal-footer">
	      <span class="pull-left jqload"><i class="fa fa-refresh fa-spin"></i> Tunggu...</span>
	      <span class="pull-left jqerror"><i class="fa fa-warning"></i> Maaf, terjadi kesalahan</span>
	        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Batal</button>
	        <button type="button" id="simpan" class="btn btn-primary btn-flat"><i class="simpanIcon fa fa-floppy-o"></i>  Simpan</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Detail modal -->
	<div class="modal modal-l" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Detail Pesan</h4>
	      </div>
	      <div class="modal-body" style="height:120px">
	      	<div class="jqload" style="text-align:center !important;padding-top:35px;"><i class="fa fa-refresh fa-spin"></i> Tunggu...</div>
	      	<span id="detail"></span>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Tutup</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Edit modal -->
	<div class="modal modal-l" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Edit Pesan</h4>
	      </div>
	      <div class="modal-body" style="min-height:200px">
	      	<div class="jqload" style="text-align:center !important;padding-top:35px;"><i class="fa fa-refresh fa-spin"></i> Tunggu...</div>
	      	<span id="edit"></span>
	      </div>
	      <div class="modal-footer">
	      	<span class="pull-left jqloadUpdate"><i class="fa fa-refresh fa-spin"></i> Tunggu...</span>
	     	 	<span class="pull-left jqerrorUpdate"><i class="fa fa-warning"></i> Maaf, terjadi kesalahan</span>
	        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Batal</button>
	        <button type="button" id="update" class="btn btn-primary btn-flat"><i class="updateIcon fa fa-floppy-o"></i> Update</button>
	      </div>
	    </div>
	  </div>
	</div>

	<!-- Hapus modal -->
	<div class="modal modal-l" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel" style="color:red;">Konfirmasi Hapus</h4>
	      </div>
	      <div class="modal-body" style="min-height:160px">
	      	<div class="jqload" style="text-align:center !important;padding-top:35px;"><i class="fa fa-refresh fa-spin"></i> Tunggu...</div>
	      	<span id="hapus"></span>
	      </div>
	      <div class="modal-footer">
	      	<span class="pull-left jqloadDelete"><i class="fa fa-refresh fa-spin"></i> Tunggu...</span>
	     	 	<span class="pull-left jqerrorDelete"><i class="fa fa-warning"></i> Maaf, terjadi kesalahan</span>
	        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Batal</button>
	        <button type="button" id="hapus-btn" class="btn btn-danger btn-flat"><i class="hapusIcon fa fa-exclamation-triangle"></i> Yakin</button>
	      </div>
	    </div>
	  </div>
	</div>

	<div class="row">
	    <div class="col-xs-12">
	        <div class="box box-primary">
	            <div class="box-header">
	                <h3 class="box-title">Pesan</h3>
	                <span class="box-title pull-right">
	                	<a data-toggle="modal" data-target="#addModal" class="btn btn-xs btn-primary btn-flat"><i class="ion-plus-round"></i>&nbsp;&nbsp;Tambah</a>
	                </span>
	            </div><!-- /.box-header -->
	            <div class="box-body table-responsive">
	            	<span id="dynamic">
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
										if (!empty($list)) {
											$i=1;
											foreach ($list as $row) {
										?>
										<tr>
											<td width="3%" align="center"><?php echo $i++?></td>
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
										} else {
										?>
										<tr>
											<td colspan="4" align="center">Belum ada pesan</td>
										</tr>
										<?php
										}
										?>
									</table>
								</span>
	            </div><!-- /.box-body -->	            
	        </div><!-- /.box -->
	    </div>
	</div>

<script>
	$(".jqload").hide();
	$(".jqloadUpdate").hide();
	$(".jqloadDelete").hide();
	$(".jqerror").hide();
	$(".jqerrorUpdate").hide();
	$(".jqerrorDelete").hide();

	//auto focus
	$('#addModal').on('shown.bs.modal', function (e) {
	    $("#nama").focus();
	})

	//save
	$("#simpan").click(function() {
		//jika valid
		if($("#addForm").valid()){
			var form_data = {
        nama: $("#nama").val(),
        email: $("#email").val(),
        pesan: $("#pesan").val(),
        // ini harus ada, untuk scurity CI
        <?php echo $this->security->get_csrf_token_name();?>: '<?php echo $this->security->get_csrf_hash();?>'
      };

			$.ajax({
	      type: "POST",
	      data: form_data,
	      url: "<?php echo site_url('master_pesan/save');?>",
	      beforeSend: function() {
	          $(".jqload").show();
	          $(".jqerror").hide();
	          $("#simpan").attr("disabled","disabled");
	          $('.simpanIcon').removeClass('fa-floppy-o').addClass('fa-circle-o-notch fa-spin');
	      },
	      success: function(e) {
	          $(".jqload").hide();
	          $('#addModal').modal('hide');
	          $("#simpan").removeAttr("disabled");
		        $('.simpanIcon').removeClass('fa-circle-o-notch fa-spin').addClass('fa-floppy-o');
	          $("#dynamic").load("<?php echo site_url('master_pesan/dynamic');?>");
	          $("#nama").val("");
	          $("#email").val("");
	          $("#pesan").val("");
	      },
	      error: function() {
	          $(".jqload").hide();
	          $(".jqerror").show();
	          $("#simpan").removeAttr("disabled");
		        $('.simpanIcon').removeClass('fa-circle-o-notch fa-spin').addClass('fa-floppy-o');
	      }
		  });
		}

	});

	//detail
  function detail(id){
		$(".jqload").show();
		$("#detail").load("<?php echo site_url('master_pesan/detail');?>/"+id, function() {
		    $('.jqload').hide();
		});
	}

	$('#detailModal').on('hidden.bs.modal', function (e) {
	    $("#detail").text("");
	})

	//edit
	function edit(id){
		$(".jqload").show();
		$("#edit").load("<?php echo site_url('master_pesan/edit');?>/"+id, function() {
		    $('.jqload').hide();
		    $("#namaUpdate").focus();
		});
	}

	$('#editModal').on('hidden.bs.modal', function (e) {
	    $("#edit").text("");
	})

	//update
	$(document).ajaxComplete(function(){
		$("#update").click(function() {
			//jika valid
			if($("#updateForm").valid()){
		    var form_data = {
		        nama: $("#namaUpdate").val(),
		        email: $("#emailUpdate").val(),
		        pesan: $("#pesanUpdate").val(),
		        id: $("#idUpdate").val(),
		        // ini harus ada, untuk scurity CI
		        <?php echo $this->security->get_csrf_token_name();?>: '<?php echo $this->security->get_csrf_hash();?>'
		      };

		    $.ajax({
		        type: "POST",
		        data: form_data,
		        url: "<?php echo site_url('master_pesan/update');?>",
		        beforeSend: function() {
		            $(".jqloadUpdate").show();
		            $(".jqerrorUpdate").hide();
		            $("#update").attr("disabled","disabled");
		            $('.updateIcon').removeClass('fa-floppy-o').addClass('fa-circle-o-notch fa-spin');
		        },
		        success: function(e) {
		            $(".jqloadUpdate").hide();
		            $('#editModal').modal('hide');
		            $("#update").removeAttr("disabled");
		            $(".updateIcon").removeClass('fa-circle-o-notch fa-spin').addClass('fa-floppy-o');
		            $("#dynamic").load("<?php echo site_url('master_pesan/dynamic');?>");
		            $("#nama").val("");
		            $("#email").val("");
		            $("#pesan").val("");
		        },
		        error: function() {
		            $(".jqloadUpdate").hide();
		            $(".jqerrorUpdate").show();
		            $("#update").removeAttr("disabled");
		            $('.updateIcon').removeClass('fa-circle-o-notch fa-spin').addClass('fa-floppy-o');
		        }
		    });
		   	stopPropagation();
		  }
		});
	});

	//konfirmasi hapus
  function hapus(id){
		$(".jqload").show();
		$("#hapus").load("<?php echo site_url('master_pesan/delete_konfirm');?>/"+id, function() {
		    $('.jqload').hide();
		});
	}

	$('#hapusModal').on('hidden.bs.modal', function (e) {
	    $("#hapus").text("");
	})

	//aksi hapus
	$(document).ajaxComplete(function(){
  	$("#hapus-btn").click(function() {
	    var form_data = {
	        id: $("#idHapus").val(),
	        nama: $("#namaHapus").val(),
	        // ini harus ada, untuk scurity CI
	        <?php echo $this->security->get_csrf_token_name();?>: '<?php echo $this->security->get_csrf_hash();?>'
	      };

	    $.ajax({
	        type: "POST",
	        data: form_data,
	        url: "<?php echo site_url('master_pesan/delete');?>",
	        beforeSend: function() {
	            $(".jqloadDelete").show();
	            $(".jqerrorDelete").hide();
	            $("#hapus-btn").attr("disabled","disabled");
		          $('.hapusIcon').removeClass('fa-exclamation-triangle').addClass('fa-circle-o-notch fa-spin');
	        },
	        success: function(e) {
	            $(".jqloadDelete").hide();
	            $('#hapusModal').modal('hide');
	            $("#hapus-btn").removeAttr("disabled");
		          $('.hapusIcon').removeClass('fa-circle-o-notch fa-spin').addClass('fa-exclamation-triangle');
	            $("#dynamic").load("<?php echo site_url('master_pesan/dynamic');?>");
	        },
	        error: function() {
	            $(".jqloadDelete").hide();
	            $(".jqerrorDelete").show();
	            $("#hapus-btn").removeAttr("disabled");
		          $('.hapusIcon').removeClass('fa-circle-o-notch fa-spin').addClass('fa-exclamation-triangle');

	        }
	    });
	   	stopPropagation();
		});
  });

	$('#hapusModal').on('hidden.bs.modal', function (e) {
	    $("#hapus").text("");
	})

	//validasi
	jQuery.validator.addMethod("emailValid", function(value, element) {
    return this.optional(element) || /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(value);
  }, "Anda belum mengisi email dengan benar");

  $("#addForm").validate({
      errorElement: "em",
      rules: {
          nama: {
              required: true,
              minlength: 5
          },
          email: {
              required: true,
              emailValid: true
          },
          pesan: {
              required: true,
              minlength: 10
          }
      }
  });

  $(document).ajaxComplete(function(){
	  $("#updateForm").validate({
	      errorElement: "em",
	      rules: {
	          namaUpdate: {
	              required: true,
	              minlength: 5
	          },
	          emailUpdate: {
	              required: true,
	              emailValid: true
	          },
	          pesanUpdate: {
	              required: true,
	              minlength: 10
	          }
	      }
	  });
  });
</script>