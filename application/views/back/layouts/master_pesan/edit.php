<?php 
  if(!empty($list)){
?>
<form id="updateForm" class="form-horizontal">
  <input type="hidden" id="idUpdate" value="<?=$list['id']?>">
  <div class="form-group">
      <label class="col-sm-2 control-label">Pengirim</label>
      <div class="col-sm-8">
        <input value="<?=$list['nama']?>" type="text" id="namaUpdate" name="namaUpdate" class="form-control input-sm" placeholder="Nama Lengkap Anda">
      </div>                   
  </div>
  <div class="form-group">
      <label class="col-sm-2 control-label">Email</label>
      <div class="col-sm-8">
        <input value="<?=$list['email']?>" type="text" id="emailUpdate" name="emailUpdate" class="form-control input-sm" placeholder="Email aktif Anda">
      </div>                            
  </div>
  <div class="form-group">
      <label class="col-sm-2 control-label">Pesan</label>
      <div class="col-sm-10">
      <textarea id="pesanUpdate" name="pesanUpdate" class="form-control" placeholder="Tulisakan pesan Anda"><?=$list['pesan']?></textarea>
      </div>                            
  </div>
</form>
<?php 
  }else{
?>
<span style="color:red;">Ups, tidak bisa mengambil data</span>
<?php
  }
?>