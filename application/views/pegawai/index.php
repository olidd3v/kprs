<?php $this->load->view('element/head');?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pegawai Index
            <small>List Pegawai</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <i class="fa fa-dashboard"></i>
                    Pegawai Index</a>
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
                        <a href="<?php echo site_url('pegawai/create');?>">Input Pegawai</a>
                    </li>
                    <li role="presentation" class="active">
                        <a href="<?php echo site_url('pegawai');?>">List Pegawai</a>
                    </li>
                </ul>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Data Table Pegawai</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="<?php echo site_url('pegawai?search=true');?>" method="GET">
                            <input type="hidden" class="form-control" name="search" value="true"/>
                            <div class="box-body pad">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <input type="text" class="form-control" name="id" placeholder="Pencarian Nama pegawai" autocomplete="off"/>
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
                                    <th>Jabatan</th>
                                    <th>Nama Pegawai</th>
                                    <th>NIK</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Alamat</th>
                                    <th>Gaji</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($pegawais) && is_array($pegawais)){ ?>
                                <?php foreach($pegawais as $pegawai){?>
                                <tr>
                                    <td><?php echo $pegawai->id;?></td>
                                    <td><?php echo $pegawai->nama_jabatan;?></td>
                                    <td><?php echo $pegawai->nama;?></td>
                                    <td><?php echo $pegawai->nik;?></td>
                                    <td><?php echo $pegawai->jk;?></td>
                                    <td><?php echo $pegawai->alamat;?></td>
                                    <td><?php echo "Rp. ". number_format($pegawai->gaji)." ,-";?></td>
                                    <td><?php echo $pegawai->date_created;?></td>
                                    <td>
                                        <a
                                            href="<?php echo site_url('pegawai/edit').'/'.$pegawai->id;?>"
                                            class="btn btn-xs btn-primary">Edit</a>
                                        <a
                                            onclick="return confirm('Are you sure you want to delete this pegawai?');"
                                            href="<?php echo site_url('pegawai/delete').'/'.$pegawai->id;?>"
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