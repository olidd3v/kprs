<?php $this->load->view('element/head');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Kary Form
        <small>List Kary</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Kary Form</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
	
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="<?php echo site_url('kary/create');?>">Input Kary</a></li>
            <li role="presentation"><a href="<?php echo site_url('kary');?>">List Kary</a></li>
            <li role="presentation"><a href="<?php echo site_url('kary/history');?>">History</a></li>
          </ul>
		  <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Kary</h3>
              <?php if($this->session->flashdata('form_false')){?>
                <div class="alert alert-danger text-center">
                  <strong><?php echo $this->session->flashdata('form_false');?></strong>
                </div>
              <?php } ?>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php if(!empty($kary)){?>
            <form class="form-horizontal" action="<?php echo site_url('kary/save')."/".$kary['id_kary'];?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <?php }else{?>
            <form class="form-horizontal" action="<?php echo site_url('kary/save');?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <?php } ?>
              <div class="box-body">
                <?php if (uri_string() !== 'kary/create')  { ?>
                <div class="col-md-6">
                <?php }else{ ?>
                <div class="col-md-12">
                <?php } ?>
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="col-sm-4" for="name">NIK</label>
                    <div class="col-sm-8">
                      <input type="text" value="<?php echo !empty($kary) ? $kary['nik'] : '';?>" name="nik" placeholder="NIK" id="nik" class="form-control" required/>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="col-sm-4" for="name">Nama kary</label>
                    <div class="col-sm-8">
                      <input type="text" value="<?php echo !empty($kary) ? $kary['nama_kary'] : '';?>" name="nama_kary" placeholder="Nama kary" id="nama_kary" class="form-control" required/>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="col-sm-4" for="name">Alamat</label>
                    <div class="col-sm-8">
                      <textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control"><?php echo !empty($kary) ? $kary['alamat'] : '';?></textarea>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="col-sm-4" for="name">Tgl. Lahir</label>
                    <div class="col-sm-8">
                      <input type="date" value="<?php echo !empty($kary) ? $kary['tgl_lhr'] : '';?>" name="tgl_lhr" placeholder="Tgl Lahir" id="tgl_lhr" class="form-control" required/>
                    </div>
                  </div>
                </div>
                </div>
                <?php if (uri_string() !== 'kary/create')  { ?>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4" for="gambar1">1st Upload Transaction</label>
                    <div class="col-sm-8">
                      <?php if (!empty($uploads[0]['gambar'])) { ?>
                      <a href="<?php echo site_url('upload')."/".$uploads[0]['gambar']; ?>" target="_blank">
                      <center><img src="<?php echo site_url('upload')."/".$uploads[0]['gambar']; ?>" class="img-responsive" style="height: 200px;"></center>
                      </a>
                      <br>
                      <?php } ?>
                      <input type="file" name="gambar1" id="gambar1" class="form-control"/>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4" for="gambar2">2nd Upload Transaction</label>
                    <div class="col-sm-8">
                      <?php if (!empty($uploads[0]['gambar1'])) { ?>
                      <a href="<?php echo site_url('upload')."/".$uploads[0]['gambar1']; ?>" target="_blank">
                      <center><img src="<?php echo site_url('upload')."/".$uploads[0]['gambar1']; ?>" class="img-responsive" style="height: 200px;"></center>
                      </a>
                      <br>
                      <?php } ?>
                      <input type="file" name="gambar2" id="gambar2" class="form-control"/>
                    </div>
                  </div>
                </div>
                <?php } ?>
                </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="col-md-3 col-md-offset-4">
                  <a class="btn btn-default" href="<?php echo site_url('kary');?>">Cancel</a>
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