<?php $this->load->view('element/head');?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            History Index
            <small>List History</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <i class="fa fa-dashboard"></i>
                    History Index</a>
            </li>
            <li class="active">Here</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <ul class="nav nav-tabs">
                    <li role="presentation">
                        <a href="<?php echo site_url('kary/create');?>">Input Kary</a>
                    </li>
                    <li role="presentation">
                        <a href="<?php echo site_url('kary');?>">List Kary</a>
                    </li>
                    <li role="presentation" class="active">
                        <a href="<?php echo site_url('kary/history');?>">History</a>
                    </li>
                </ul>
                <div class="box">
                    <div class="box-header">
                    <?php if($this->session->flashdata('form_false')){?>
                        <div class="alert alert-danger text-center">
                        <strong><?php print_r($this->session->flashdata('form_false')[0]);?></strong>
                        </div>
                    <?php } ?>
                        <h3 class="box-title">History Transaction</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="<?php echo site_url('kary/history?search=true');?>" method="GET">
                            <input type="hidden" class="form-control" name="search" value="true"/>
                            <div class="box-body pad">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <input type="text" class="form-control" value="<?php if (!empty($_GET['id'])) { print_r($_GET['id']); };?>" name="id" placeholder="Pencarian NIK" autocomplete="off"/>
                                        <label for="submit">&nbsp</label>
                                        <input type="submit" value="Cari" class="form-control btn btn-primary">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php if(isset($result_kary) && is_array($result_kary)){ ?>
                        <?php foreach($result_kary as $kary){?>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Nama</label>
                            </div>
                            <div class="col-md-8">
                            <?php echo $kary->nama_kary; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Gambar</label>
                            </div>
                            <div class="col-md-4">
                            <img src="<?php echo site_url('upload')?>/<?php echo $kary->gambar; ?>" alt="<?php echo $kary->gambar; ?>" class="img-responsive" style="height: 300px; ">
                            </div>
                            <div class="col-md-4">
                            <img src="<?php echo site_url('upload')?>/<?php echo $kary->gambar1; ?>" alt="<?php echo $kary->gambar1; ?>" class="img-responsive" style="height: 300px; ">
                            </div>
                        </div>
                        <?php } ?>
                        <?php } ?>
                    </div>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $this->load->view('element/footer');?>