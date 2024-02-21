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
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">No</th>
                          <th scope="col">Tanggal</th>                         
                          <th scope="col">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($minggu as $val){ ?>
                        <tr>
                          <th scope="row">1</th>
                          <td><?php echo $val->tanggal; ?></td>
                        
                          <td><a href="<?php echo base_url();?>dosen/genqr/<?php echo $val->id_presensi; ?>" class="btn btn-primary">Generate Presensi QRCode</a></td>
                        </tr>
                         <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>


        
     
              </div>
      
            </div>
          </div>
        </section>
      </div>
<?php $this->load->view('presensi/_partials/footer'); ?>