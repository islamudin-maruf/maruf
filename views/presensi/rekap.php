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
                          <th scope="col">No</th>
                          <th scope="col">Nama Matakuliah</th>
                          <th scope="col">Dosen</th>
                          <th scope="col">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($rekap as $val){ ?>
                        <tr>
                          <th scope="row"><?php echo $val->id_kelas; ?></th>
                          <td><?php echo $val->nama_mk; ?></td>
                          <td><?php echo $val->nama_dosen; ?></td>
                          <td><a href="<?php echo base_url();?>mahasiswa/detail_presensi/<?php echo $val->id_kelas; ?>" class="btn btn-primary">Detail</a></td>
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