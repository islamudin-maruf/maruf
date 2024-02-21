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
                          <th scope="col">Minggu ke</th>
                          <th scope="col">Tanggal Perkuliahan</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $minggu = 1;
                        foreach($presensi as $val){ ?>
                        <tr>
                          <td><?php echo $minggu; ?></td>
                          <td><?php echo $val->tanggal; ?></td>
                          <td>
                        </td>
                        </tr>
                         <?php $minggu++; }?>
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