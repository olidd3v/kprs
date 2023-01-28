<?php $this->load->view('element/head');?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Kary Index
            <small>List Kary</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <i class="fa fa-dashboard"></i>
                    Kary Index</a>
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
                    <li role="presentation" class="active">
                        <a href="<?php echo site_url('kary');?>">List Kary</a>
                    </li>
                    <li role="presentation">
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
                        <h3 class="box-title">Data Table Kary</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="<?php echo site_url('kary?search=true');?>" method="GET">
                            <input type="hidden" class="form-control" name="search" value="true"/>
                            <div class="box-body pad">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <input type="text" class="form-control" name="id" placeholder="Pencarian NIK" autocomplete="off"/>
                                        <label for="submit">&nbsp</label>
                                        <input type="submit" value="Cari" class="form-control btn btn-primary">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NIK</th>
                                    <th>NAMA</th>
                                    <th>ALAMAT</th>
                                    <th>TGL. LAHIR</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($karys) && is_array($karys)){ ?>
                                <?php foreach($karys as $kary){?>
                                <tr>
                                    <td><?php echo $kary->id_kary;?></td>
                                    <td><?php echo $kary->nik;?></td>
                                    <td><?php echo $kary->nama_kary;?></td>
                                    <td><?php echo $kary->alamat;?></td>
                                    <td><?php echo $kary->tgl_lhr;?></td>
                                    <td>
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-default-<?php echo $kary->nik;?>">
                                    Upload
                                    </button>
                                    <?php if ($_SESSION['role'] !== "2") {?>
                                        <a
                                            href="<?php echo site_url('kary/edit').'/'.$kary->id_kary;?>"
                                            class="btn btn-sm btn-primary">Edit</a>
                                        <a
                                            onclick="return confirm('Are you sure you want to delete this kary?');"
                                            href="<?php echo site_url('kary/delete').'/'.$kary->id_kary;?>"
                                            class="btn btn-sm btn-danger">Delete</a>
                                    <?php } ?>
                                    </td>
                                </tr>
                                <?php } ?>
                                <?php } ?>
                            </tbody>
                            <tfoot></tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                    <div class="text-center">
                        <?php echo $paggination;?>
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
<?php if(isset($karys) && is_array($karys)){ ?>
<?php foreach($karys as $kary){?>
<div class="modal fade in" id="modal-default-<?php echo $kary->nik; ?>" style="padding-right: 17px;">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">×</span></button>
<h4 class="modal-title"><?php echo $kary->nik; ?></h4>
</div>
<?php echo form_open_multipart('kary/save_transaction');?>
<div class="modal-body">
<div class="form-group">
    <label class="col-sm-4" for="files">Upload File (.JPG)</label>
    <div class="col-sm-8">
        <input type="hidden" value="<?php echo $kary->nik; ?>" name="nik" class="form-control">
        <input type="file" name="files" id="files" class="form-control">
    </div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary">Save</button>
</div>
</form>
</div>
</div>
</div>
<?php } ?>
<?php } ?>
<?php $this->load->view('element/footer');?>