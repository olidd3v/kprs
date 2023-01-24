<?php $this->load->view('element/head');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Resto Index
        <small>List resto</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Resto Index</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
            <ul class="nav nav-tabs">
                <li role="presentation"><a href="<?php echo site_url('resto/create');?>">Input Resto</a></li>
                <li role="presentation" class="active"><a href="<?php echo site_url('resto');?>">List Resto</a></li>
            </ul>
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Table Resto</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <form action="<?php echo site_url('resto?search=true');?>" method="GET">
                <input type="hidden" class="form-control" name="search" value="true"/>
                <div class="box-body pad">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="id">Code Resto</label>
                      <input type="text" class="form-control" name="id" value="<?php echo !empty($_GET['id']) ? $_GET['id'] : '';?>"/>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="submit">&nbsp</label>
                      <input type="submit" value="Cari" class="form-control btn btn-primary">
                    </div>
                  </div>
                </div>
              </form>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Code ID</th>
                  <th>Resto Name</th>
                  <th>Phone</th>
                  <th>City</th>
                  <th>Address</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
				<?php if(isset($restos) && is_array($restos)){ ?>
				  <?php foreach($restos as $resto){?>
            <tr>
            <td><?php echo $resto->code_resto;?></td>
					  <td><?php echo $resto->name_resto;?></td>
					  <td><?php echo $resto->phone_resto;?></td>
					  <td><?php echo $resto->city_resto;?></td>
					  <td><?php echo $resto->address_resto;?></td>
					  <td>
						<a href="<?php echo site_url('resto/edit').'/'.$resto->id;?>" class="btn btn-xs btn-primary">Edit</a>
						<a onclick="return confirm('Are you sure you want to delete this resto?');" href="<?php echo site_url('resto/delete').'/'.$resto->id;?>" class="btn btn-xs btn-danger">Delete</a>
					  </td>
					</tr>
				  <?php } ?>
				<?php } ?>
                </tbody>
                <tfoot>
                </tfoot>
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