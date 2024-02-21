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
                    <th scope="col">Nama Mahasiswa</th>
                      <?php
                        $kelas=$this->db->query("select * from presensi where id_kelas='$id_kelas'")->result();
                        $minggu = 1;
                        foreach($kelas as $val){
                          echo "<th>$minggu - $val->tanggal</th>";
                          $minggu++;
                        }
                      ?> 
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($mahasiswa as $val){ ?>
                    <tr>
                      <td scope="row"><?php echo $val->nim; ?></td>                          
                      <td><?php echo $val->nama_mhs; ?></td>
                        <?php
                          $pre=$this->db->query("select * from presensi where id_kelas='$id_kelas'")->result();
                            foreach($pre as $vale){
                              $cek =  $this->db->query("select * from detail_presensi where nim='$val->nim' and id_presensi='$vale->id_presensi'")->num_rows();
                              $res =  $this->db->query("select * from detail_presensi where nim='$val->nim' and id_presensi='$vale->id_presensi'")->row_object();
                              if($cek>0){
                                if($res->status=='0'){
                                  echo "<td><div class='badge badge-danger'>Alpha</div></td>";
                                } elseif ($res->status=='1'){
                                  echo "<td><div class='badge badge-success'>Hadir</div></td>";
                                } elseif($res->status=='2'){
                                  echo "<td><div class='badge badge-primary'>Ijin</div></td>";
                                } elseif($res->status=='3'){
                                  echo "<td><div class='badge badge-warning'>Sakit</div></td>";
                                }
                              } else {
                                echo "<td><div class='badge badge-default'>-</div></td>";
                              }
                            }
                            // alpha danger
                            // hadir hijau 
                            // ijin biru
                            // sakit warning
                          ?>
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