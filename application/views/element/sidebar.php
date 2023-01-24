  <aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
          <li class="treeview <?php echo is_menu('jabatan');?>">
          <a href="#"><i class="fa fa-institution"></i> <span>Master Jabatan</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu"> 
			    <li class="<?php echo is_menu('jabatan');?>"><a href="<?php echo site_url('jabatan');?>"><i class="fa fa-institution" aria-hidden="true"></i> <span>List Jabatan</span></a></li>
			    <li class="<?php echo is_menu('jabatan','create');?>"><a href="<?php echo site_url('jabatan/create');?>"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <span>Add Jabatan</span></a></li>
          </ul>
          </li>
          <li class="treeview <?php echo is_menu('pegawai');?>">
          <a href="#"><i class="fa fa-group"></i> <span>Master Pegawai</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu"> 
			    <li class="<?php echo is_menu('pegawai');?>"><a href="<?php echo site_url('pegawai');?>"><i class="fa fa-group" aria-hidden="true"></i> <span>List Pegawai</span></a></li>
			    <li class="<?php echo is_menu('pegawai','create');?>"><a href="<?php echo site_url('pegawai/create');?>"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <span>Add Pegawai</span></a></li>
          </ul>
          </li>
        </li>
        <li class="<?php echo is_menu('setting','edit/1');?>"><a href="<?php echo site_url('setting/edit/1');?>"><i class="fa fa-gear" aria-hidden="true"></i> <span>Setting</span></a></li>
      </ul>
      <br />
      <br />
    </section>
  </aside>
