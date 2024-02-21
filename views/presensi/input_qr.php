<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('presensi/_partials/header');
?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>&nbsp</h1>
     
          </div>

          <div class="section-body">
      

            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Form Presensi</h4>
                  </div>
                  <form action="<?php echo base_url();?>mahasiswa/simpan_kode" method="POST">
                  <div class="card-body">
                    <div class="form-group row mb-10">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kode QR</label>
                      <div class="col-sm-12 col-md-7">
                        <input type="text" name="qr" class="form-control">
                      </div>
                    </div>

          
                    <div class="form-group row mb-10">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                      <div class="col-sm-12 col-md-7">
                        <button class="btn btn-primary">Simpan</button>
                      </div>
                    </div>
                  </div>
                </form>
                </div>
              </div>
            </div>



<?php $this->load->view('presensi/_partials/footer'); ?>