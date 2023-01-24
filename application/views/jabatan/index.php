<?php $this->load->view('element/head');?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Jabatan Index
            <small>List Jabatan</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <i class="fa fa-dashboard"></i>
                    Jabatan Index</a>
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
                        <a href="<?php echo site_url('jabatan/create');?>">Input Jabatan</a>
                    </li>
                    <li role="presentation" class="active">
                        <a href="<?php echo site_url('jabatan');?>">List Jabatan</a>
                    </li>
                </ul>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Data Table Jabatan</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="<?php echo site_url('jabatan?search=true');?>" method="GET">
                            <input type="hidden" class="form-control" name="search" value="true"/>
                            <div class="box-body pad">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <input type="text" class="form-control" name="id" placeholder="Pencarian Nama Jabatan" autocomplete="off"/>
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
                                    <th>Nama Jabatan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($jabatans) && is_array($jabatans)){ ?>
                                <?php foreach($jabatans as $jabatan){?>
                                <tr>
                                    <td><?php echo $jabatan->id;?></td>
                                    <td><?php echo $jabatan->nama_jabatan;?></td>
                                    <td>
                                        <a
                                            href="<?php echo site_url('jabatan/edit').'/'.$jabatan->id;?>"
                                            class="btn btn-xs btn-primary">Edit</a>
                                        <a
                                            onclick="return confirm('Are you sure you want to delete this jabatan?');"
                                            href="<?php echo site_url('jabatan/delete').'/'.$jabatan->id;?>"
                                            class="btn btn-xs btn-danger">Delete</a>
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
<?php $this->load->view('element/footer');?>