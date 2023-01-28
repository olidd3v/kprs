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
            <form class="form-horizontal" method="POST" action="<?php echo site_url('kary/save').'/'.$kary['id_kary'];?>">
            <?php }else{?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('kary/save');?>">
            <?php } ?>
              <div class="box-body">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4" for="name">NIK</label>
                    <div class="col-sm-8">
                      <input type="text" value="<?php echo !empty($kary) ? $kary['nik'] : '';?>" name="nik" placeholder="NIK" id="nik" class="form-control" required/>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4" for="name">Nama kary</label>
                    <div class="col-sm-8">
                      <input type="text" value="<?php echo !empty($kary) ? $kary['nama_kary'] : '';?>" name="nama_kary" placeholder="Nama kary" id="nama_kary" class="form-control" required/>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4" for="name">Alamat</label>
                    <div class="col-sm-8">
                      <textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control"><?php echo !empty($kary) ? $kary['alamat'] : '';?></textarea>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4" for="name">Tgl. Lahir</label>
                    <div class="col-sm-8">
                      <input type="date" value="<?php echo !empty($kary) ? $kary['tgl_lhr'] : '';?>" name="tgl_lhr" placeholder="Tgl Lahir" id="tgl_lhr" class="form-control" required/>
                    </div>
                  </div>
                </div>
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