<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="<?php echo base_url(); ?>dist/index">PRESENSI</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?php echo base_url(); ?>dist/index">Stp</a>
          </div>
          <ul class="sidebar-menu">

            <li class="<?php echo $this->uri->segment(2) == 'blank' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>adminpanel/dashboard"><i class="fas fa-home"></i> <span>Beranda</span></a></li>
            <li class="<?php echo $this->uri->segment(2) == 'credits' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>adminpanel/perkuliahan"><i class="fas fa-clock"></i> <span>Setting Perkuliahan</span></a></li>
            <li class="<?php echo $this->uri->segment(2) == 'blank' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>adminpanel/rekap_presensi"><i class="fas fa-history"></i> <span>Rekap Presensi</span></a></li>
            <li class="<?php echo $this->uri->segment(2) == 'blank' ? 'active' : ''; ?>"><a class="nav-link" href="<?php echo base_url(); ?>adminpanel/logout"><i class="fas fa-power-off"></i> <span>Logout</span></a></li>
          </ul>
        </aside>
      </div>
