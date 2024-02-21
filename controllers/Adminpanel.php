<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminpanel extends CI_Controller {

    public function index() {
		$data = array(
			'title' => "Login Admin"
		);
		$this->load->view('presensi/adm_login', $data);
	}

    public function act_login(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $cek = $this->db->query("select * from user where username='$username' and password='$password'")->num_rows();
        if($cek==1){
            $data_session = array(
                'username' => $username,
                'status' => "login"
                );

            $this->session->set_userdata($data_session);
     
            redirect('adminpanel/dashboard');
        } else {
            redirect('adminpanel');
        }
    }

    public function dashboard (){
        $data = array(
			'title' => "Rekap Presensi Mahasiswa"
		);
        $this->load->view('presensi/adm_dashboard', $data);
    }

    public function perkuliahan(){
        $data = array(
			'title' => "Setting Perkuliahan"
		);
		$data['dosen']=$this->db->query("SELECT * FROM dosen")->result();
		$this->load->view('presensi/adm_setting_perkuliahan', $data);
    }

    public function pilih_kelas($id_dosen){
        $data = array(
			'title' => "Setting Perkuliahan"
		);
        $data['kelas'] = $this->db->query("SELECT k.id_kelas, d.id_dosen, m.nama_mk, k.ruang FROM kelas k, matkul m, dosen d where k.id_matkul=m.kode_mk and k.id_dosen='$id_dosen' and d.id_dosen='$id_dosen'")->result();
        $this->load->view('presensi/adm_pilih_kelas', $data);
    }

    public function set_perkuliahan($id_kelas){
        $data = array(
			'title' => "Setting Perkuliahan"
		);
        $data['id_kelas'] = $id_kelas;
        $this->load->view('presensi/adm_form_set_perkuliahan', $data);

    }

    public function act_set_perkuliahan(){
        $id_kelas = $this->input->post('id_kelas');
        $tanggal_awal =  $this->input->post('tanggal');
       // $tgl2    = date('Y-m-d', strtotime('+7 days', strtotime($tanggal_awal)));
        $input_date=array();

        for($i=1; $i<=14; $i++){
            $this->db->query("insert into presensi (id_kelas, tanggal) values ('$id_kelas', '$tanggal_awal')");
            $tanggal_awal = date('Y-m-d', strtotime('+7 days', strtotime($tanggal_awal)));
        }
        
        redirect('adminpanel/set_mhs/'.$id_kelas);
    }

    public function set_mhs($id_kelas){
        $kel=$this->db->query("select * from krs where id_kelas='$id_kelas'")->result();
        $pre=$this->db->query("select * from presensi where id_kelas='$id_kelas'")->result();
        foreach($pre as $val){
            foreach($kel as $vale){
                $a=$val->id_presensi;
                $b=$vale->nim;
                $this->db->query("insert into detail_presensi (id_presensi, nim, status) values ('$a', '$b','0')");
            }
        }
        redirect('adminpanel/tanggal_perkuliahan/'.$id_kelas);
    }


    public function tanggal_perkuliahan ($id_kelas){
        $data = array(
			'title' => "Setting Perkuliahan"
		);
        $data['presensi'] = $this->db->query("SELECT * FROM presensi where id_kelas='$id_kelas'")->result();
        $this->load->view('presensi/adm_tanggal_perkuliahan', $data);
    }


    public function rekap_presensi(){
        $data = array(
			'title' => "Setting Perkuliahan"
		);
        $data['kelas'] = $this->db->query("SELECT k.id_kelas,  m.nama_mk, k.ruang FROM kelas k, matkul m where k.id_matkul=m.kode_mk")->result();
        $this->load->view('presensi/adm_pilih_kelas_rekap', $data);

    }

    public function detail_rekap($id_kelas){
        $data = array(
			'title' => "Setting Perkuliahan"
		);
        $data['id_kelas'] = $id_kelas;
        $data['mahasiswa'] = $this->db->query("SELECT * FROM mahasiswa m, krs k where k.id_kelas=$id_kelas and m.nim=k.nim")->result();
        $this->load->view('presensi/adm_detail_rekap', $data);
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect(base_url('adminpanel'));
    }

}