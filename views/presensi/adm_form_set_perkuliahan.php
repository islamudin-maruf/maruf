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
                <form action="<?php echo base_url();?>adminpanel/act_set_perkuliahan" method="POST">
                <input type="hidden" name="id_kelas" value="<?php echo $id_kelas; ?>">
                    <div class="card">
                  <div class="card-header">
                    <h4>Form Setting Perkuliahan</h4>
                  </div>
                  <div class="card-body">
                    <div class="form-group row">
                      <label for="inputEmail3" class="col-sm-3 col-form-label">Tanggal Awal Perkuliahan</label>
                      <div class="col-sm-9">
                        <input type="date" name="tanggal" class="form-control" id="inputEmail3">
                      </div>
                    </div>
                  </div>
                  <div class="card-footer">       
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
                </div>
                </form>
              </div>
            </div>
<?php $this->load->view('presensi/_partials/footer'); ?>
