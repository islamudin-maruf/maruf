<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('presensi/_partials/header');
?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Presensi</h1>     
          </div>
          <div class="section-body">
            <div class="row">
              <div class="col-12 col-md-10 col-lg-10">
                <div class="card">
             
                  <div class="card-body">
                  <img src="<?php echo base_url();?><?php echo $qr.'.png'; ?>"/>
                 <h1> <?php echo $qr; ?></h1>
                  </div>
                </div> 
              </div>
            </div>
          </div>
        </section>
      </div>
      <script type="text/javascript">  
   setTimeout(function(){  
       location.reload();  
   },60000);  
</script> 
<?php $this->load->view('presensi/_partials/footer'); ?>