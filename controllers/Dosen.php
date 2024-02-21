<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dosen extends CI_Controller {


    public function index(){
        $data = array(
			'title' => "Dashboard Dosen"
		);
        $id_dosen = $this->session->userdata('id_dosen');
        $data['kelas']=$this->db->query("SELECT * from kelas k, dosen d, matkul m WHERE k.id_matkul=m.kode_mk and k.id_dosen=d.id_dosen and k.id_dosen='$id_dosen'")->result();
		$this->load->view('presensi/dosen_presensi', $data);
	}

    public function presensi() {
		$data = array(
			'title' => "Dashboard Dosen"
		);
        $id_dosen = $this->session->userdata('id_dosen');
        $data['kelas']=$this->db->query("SELECT * from kelas k, dosen d, matkul m 
                                    WHERE k.id_matkul=m.kode_mk 
                                    and k.id_dosen=d.id_dosen 
                                    and k.id_dosen=$id_dosen")->result();
		$this->load->view('presensi/dosen_presensi', $data);
	}

    public function pertemuan ($id_kelas){
		$data = array(
			'title' => "Dashboard Dosen"
		);
        $data['minggu']=$this->db->query("SELECT * from presensi p WHERE p.id_kelas='$id_kelas'")->result();
        $this->load->view('presensi/dosen_pertemuan', $data);
    }

    public function genqr($id_presensi){
        $ran= $this->getName(4);
        $kode=$ran;
    
        
        $data = array(
			'title' => "Dashboard Dosen",
            'qr'=> $kode
		);
        //
        $this->load->library('ciqrcode');

		$params['data'] = $kode;
		$params['level'] = 'H';
		$params['size'] = 10;
		$params['savename'] = FCPATH.$kode.'.png';
		$this->ciqrcode->generate($params);
        //
        $data_session_kode = array(
            'kode_qr' => $kode,
            'idpresensi' => $id_presensi
            );

        $this->session->set_userdata($data_session_kode);
        //
		$this->db->query("update presensi set kode_qr='$kode' where id_presensi='$id_presensi'");
		//echo '<img src="'.base_url().'tes.png" />';
        //
    $this->load->view('presensi/dosen_qr', $data);
    }

    private function getName($n) {
        $characters = 'ABCDEFGHIJKLMNPQRSTUVWXYZ';
        $randomString = '';
    
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
        return $randomString;
    }
    public function rekap_presensi() {
        $data = array(
			'title' => "Dashboard Dosen"
		);
        $id_dosen = $this->session->userdata('id_dosen');
        $data['kelas']=$this->db->query("SELECT * from kelas k, dosen d, matkul m WHERE k.id_matkul=m.kode_mk and k.id_dosen=$id_dosen and d.id_dosen=$id_dosen")->result();
		$this->load->view('presensi/dosen_rekap', $data);
    }

    public function detail_rekap ($id_kelas){
        $data = array(
			'title' => "Setting Perkuliahan"
		);
        $data['id_kelas'] = $id_kelas;
        $data['mahasiswa'] = $this->db->query("SELECT * FROM mahasiswa m, krs k where k.id_kelas=$id_kelas and m.nim=k.nim")->result();
        $this->load->view('presensi/dosen_det_rekap', $data);
    }

}