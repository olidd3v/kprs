<?php $this->load->view('element/head');?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Resto Form
        <small>List resto</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Resto Form</a></li>
        <li class="active">Here</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
	
      <div class="row">
        <div class="col-xs-12">
          <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="<?php echo site_url('resto/create');?>">Input Resto</a></li>
            <li role="presentation"><a href="<?php echo site_url('resto');?>">List Resto</a></li>
          </ul>
		  <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">resto</h3>
              <?php if($this->session->flashdata('form_false')){?>
                <div class="alert alert-danger text-center">
                  <strong><?php echo $this->session->flashdata('form_false');?></strong>
                </div>
              <?php } ?>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php if(!empty($resto)){?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('resto/save').'/'.$resto['id'];?>">
            <?php }else{?>
            <form class="form-horizontal" method="POST" action="<?php echo site_url('resto/save');?>">
            <?php } ?>
              <div class="box-body">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="kode">Code</label>
                    <div class="col-sm-8">
                      <input type="text" value="<?php echo !empty($resto) ? $resto['code_resto'] : '';?>" id="resto_id" name="resto_id" class="form-control" placeholder="Code"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="name">Name</label>
                    <div class="col-sm-8">
                      <input type="text" value="<?php echo !empty($resto) ? $resto['name_resto'] : '';?>" name="name_resto" placeholder="Resto Name" id="name" class="form-control" required/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="address">Address</label>
                    <div class="col-sm-8">
                      <textarea name="address_resto" placeholder="Address" id="address" class="form-control"/><?php echo !empty($resto) ? $resto['address_resto'] : '';?></textarea>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="city">City</label>
                    <div class="col-sm-8">
                      <input type="text" value="<?php echo !empty($resto) ? $resto['city_resto'] : '';?>" name="city_resto" placeholder="City" id="city" class="form-control"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="phone">No Telp</label>
                    <div class="col-sm-8">
                      <input type="number" value="<?php echo !empty($resto) ? $resto['phone_resto'] : '';?>" name="phone_resto" placeholder="Phone" id="phone" class="form-control"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-4 control-label" for="user">User</label>
                    <div class="col-sm-8">
                      <select name="user" id="user" class="form-control">
                      <option value="">== PILIH USER ==</option>
                        <?php if(isset($user) && is_array($user)){?>
                          <?php foreach($user as $item){?>
                            <option value="<?php echo $item->id;?>" <?php if(!empty($resto) && $item->id == $resto['id_user']) echo 'selected="selected"';?>>
                              <?php echo $item->name;?>
                            </option>
                          <?php }?>
                          <?php }?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="col-md-3 col-md-offset-4">
                  <a class="btn btn-default" href="<?php echo site_url('resto');?>">Cancel</a>
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