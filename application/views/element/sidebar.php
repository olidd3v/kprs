  <aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu">
          <li class="treeview <?php echo is_menu('kary');?>">
          <a href="#"><i class="fa fa-institution"></i> <span>Master Kary</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu"> 
			    <li class="<?php echo is_menu('kary');?>"><a href="<?php echo site_url('kary');?>"><i class="fa fa-institution" aria-hidden="true"></i> <span>List Kary</span></a></li>
			    <li class="<?php echo is_menu('kary','create');?>"><a href="<?php echo site_url('kary/create');?>"><i class="fa fa-plus-square-o" aria-hidden="true"></i> <span>Add Kary</span></a></li>
          </ul>
          </li>
        </li>
        <li class="<?php echo is_menu('setting','edit/1');?>"><a href="<?php echo site_url('setting/edit/1');?>"><i class="fa fa-gear" aria-hidden="true"></i> <span>Setting</span></a></li>
      </ul>
      <br />
      <br />
    </section>
  </aside>
