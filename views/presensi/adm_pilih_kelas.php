<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('presensi/_partials/header');
?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Setting Tanggal Perkuliahan</h1>
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
                          <th scope="col">Ruang</th>
                          <th scope="col">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($kelas as $val){ ?>
                        <tr>
                          <th scope="row"><?php echo $val->id_kelas; ?></th>
                          <td><?php echo $val->nama_mk; ?></td>
                          <td><?php echo $val->ruang; ?></td>
                          <td>
                          <?php 
                          $cek = $this->db->query("SELECT * from kelas k, presensi p where p.id_kelas='$val->id_kelas'")->num_rows();
                          if($cek>0) { ?>
 <a href="<?php echo base_url();?>adminpanel/tanggal_perkuliahan/<?php echo $val->id_kelas; ?>" class="btn btn-warning">Tanggal Perkuliahan</a>
                       <?php   } else { ?>
<a href="<?php echo base_url();?>adminpanel/set_perkuliahan/<?php echo $val->id_kelas; ?>" class="btn btn-primary">Setting Perkuliahan</a>
                        </td>
                        </tr>
                         <?php }} ?>
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