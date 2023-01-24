<?php $this->load->view('element/head');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <?php if($this->session->flashdata('msg')){?>
		<div class="alert alert-success alert-dismissible">
			<button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
			<h4>
				<i class="icon fa fa-check"></i>Login Success!
			</h4>
			<?php echo $this->session->flashdata('msg');?>, <?php echo $this->username;?>!
		</div>
	  <?php } ?>
      <h1>
        Dashboard
        <small>Home Dashboard</small>
      </h1>
     <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Here</li>
      </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">
		<div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-teal"><i class="fa fa-institution"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Resto</span>
              <span class="info-box-number"><?php echo $restos;?></span>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon"><i class="fa fa-cart-arrow-down"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Supplier</span>
              <span class="info-box-number"><?php echo $suppliers;?></span>
            </div>
          </div>
        </div>

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">

        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-sitemap"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Satuan</span>
              <span class="info-box-number"><?php echo $satuans;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="fa fa-shopping-cart"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Barang</span>
              <span class="info-box-number"><?php echo $products;?></span>
            </div>
          </div>
        </div>
        <!-- /.col -->
      </div>


      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-purple"><i class="fa fa-user"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Operator</span>
              <span class="info-box-number"><?php echo $operators;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>
        <!-- /.col -->
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php $this->load->view('element/footer');?>