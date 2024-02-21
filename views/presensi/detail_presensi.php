<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('presensi/_partials/header');
?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Rekap Presensi Perkuliahan</h1>
       
          </div>

          <div class="section-body">

            <div class="row">
              <div class="col-12 col-md-10 col-lg-10">
                <div class="card">
             
                  <div class="card-body">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Pertemuan ke</th>
                          <th scope="col">Tanggal</th>
                          <th scope="col">Status</th>
                         
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        $pert=1;
                        foreach($detail as $val){ ?>
                        <tr>
                          <th scope="row"> <?php echo $pert; ?></th>
                          <td><?php echo $val->tanggal; ?></td>
                          <td><?php if($val->status==0){
                            echo "<div class='badge badge-warning'>Tidak Hadir</div>"; } else {
                                echo "<div class='badge badge-success'>Hadir</div>";
                            } ?>
                            </td>
                        </tr>
                         <?php $pert++; } ?>
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