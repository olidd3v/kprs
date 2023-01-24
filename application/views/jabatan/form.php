<?php $this->load->view('element/head');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Jabatan Form
        <small>List Jabatan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Jabatan Form</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
	
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="<?php echo site_url('jabatan/create');?>">Input Jabatan</a></li>
            <li role="presentation"><a href="<?php echo site_url('jabatan');?>">List Jabatan</a></li>
          </ul>
		  <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Jabatan</h3>
              <?php if($this->session->flashdata('form_false')){?>
                <div class="alert alert-danger text-center">
                  <strong><?php echo $this->session->flashdata('form_false');?></strong>
                </div>
              <?php } ?>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php if(!empty($jabatan)){?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('jabatan/save').'/'.$jabatan['id'];?>">
            <?php }else{?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('jabatan/save');?>">
            <?php } ?>
              <div class="box-body">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="col-sm-2" for="name">Nama Jabatan</label>
                    <div class="col-sm-10">
                      <input type="text" value="<?php echo !empty($jabatan) ? $jabatan['nama_jabatan'] : '';?>" name="nama_jabatan" placeholder="Nama Jabatan" id="nama_jabatan" class="form-control" required/>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="col-md-3 col-md-offset-4">
                  <a class="btn btn-default" href="<?php echo site_url('jabatan');?>">Cancel</a>
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