<?php $this->load->view('element/head');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pegawai Form
        <small>List Pegawai</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Pegawai Form</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
	
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="<?php echo site_url('pegawai/create');?>">Input Pegawai</a></li>
            <li role="presentation"><a href="<?php echo site_url('pegawai');?>">List Pegawai</a></li>
          </ul>
		  <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Pegawai</h3>
              <?php if($this->session->flashdata('form_false')){?>
                <div class="alert alert-danger text-center">
                  <strong><?php echo $this->session->flashdata('form_false');?></strong>
                </div>
              <?php } ?>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php if(!empty($pegawai)){?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('pegawai/save').'/'.$pegawai['id'];?>">
            <?php }else{?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('pegawai/save');?>">
            <?php } ?>
              <div class="box-body">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-sm-4" for="jabatan">Jabatan </label>
                        <div class="col-sm-8">
                        <select name="id_jabatan" id="id_jabatan" class="form-control select2">
                            <option value="">== PILIH JABATAN ==</option>
                                <?php if(isset($jabatan) && is_array($jabatan)){?>
                                <?php foreach($jabatan as $item){?>
                                    <option value="<?php echo $item->id;?>" <?php if(!empty($pegawai) && $item->id == $pegawai['id_jabatan']) echo 'selected="selected"';?>>
                                    <?php echo $item->nama_jabatan;?>
                                    </option>
                                <?php }?>
                            <?php }?>
                        </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4" for="name">Nama pegawai</label>
                    <div class="col-sm-8">
                      <input type="text" value="<?php echo !empty($pegawai) ? $pegawai['nama'] : '';?>" name="nama" placeholder="Nama Pegawai" id="nama" class="form-control" required/>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4" for="name">NIK</label>
                    <div class="col-sm-8">
                      <input type="text" value="<?php echo !empty($pegawai) ? $pegawai['nik'] : '';?>" name="nik" placeholder="NIK" id="nik" class="form-control" max="20" required/>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4" for="name">Jenis Kelamin</label>
                    <div class="col-sm-8">
                        <select name="jk" id="jk" class="form-control">
                            <option value="">== PILIH JENIS KELAMIN ==</option>
                                <option value="LAKI-LAKI" <?php if($pegawai['jk'] == "LAKI-LAKI") echo 'selected="selected"';?>>
                                LAKI-LAKI
                                </option>
                                <option value="PEREMPUAN" <?php if($pegawai['jk'] == "PEREMPUAN") echo 'selected="selected"';?>>
                                PEREMPUAN
                                </option>
                        </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4" for="name">Alamat</label>
                    <div class="col-sm-8">
                      <textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control" autocomplete="off" required><?php echo !empty($pegawai) ? $pegawai['alamat'] : '';?></textarea>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4" for="name">Gaji</label>
                    <div class="col-sm-8">
                      <input type="number" value="<?php echo !empty($pegawai) ? $pegawai['gaji'] : '';?>" name="gaji" id="gaji" class="form-control" autocomplete="off" required/>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="col-md-3 col-md-offset-4">
                  <a class="btn btn-default" href="<?php echo site_url('pegawai');?>">Cancel</a>
                  <button class="btn btn-info pull-right" type="submit">Save</button>
                </div>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
		</div>
        <!-- /.col -->
      </div>
	  <!-- row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $this->load->view('element/footer');?>