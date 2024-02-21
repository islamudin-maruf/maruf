<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

	public function response($data){
		$this->output
			 ->set_content_type('application/json')
			 ->set_status_header(200)
			 ->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			 ->_display();

			 exit;
	}

	public function index(){
		$data = array(
			'title' => "Jadwal Perkuliahan"
		);
		$nim = $this->session->userdata('nim');
		$data['jadwal']=$this->db->query("SELECT * 
											FROM kelas k, dosen d, matkul m, krs s 
											where s.nim=$nim
											and s.id_kelas = k.id_kelas
											and k.id_dosen=d.id_dosen 
											and k.id_matkul=m.kode_mk")->result();
		$this->load->view('presensi/jadwal', $data);
	}

	public function save_kode(){
		$jwt = new JWT();
		$nim = $this->input->post('nim');
		$kode_input = $this->input->post('qr');
		
	
		//$id_presensi = $this->session->userdata('idpresensi');

		//echo $kode_input;
		$q = $this->db->query("select * from presensi where kode_qr='$kode_input'")->result_array();
		$id_presensi = $q[0]['id_presensi'];
		if($kode_input==$q[0]['kode_qr']){
			$res = $this->db->query("update detail_presensi set status=1 where nim='$nim' and id_presensi='$id_presensi'");
			if($res){
				//
				$data = array(
					'nim'=>$nim,
					'kode_qr'=>$kode_input,
					'id_presensi'=>$id_presensi
					
				);
				$token['success']='true';
				$token['id_token']=$jwt->encode($data, 'Rahasia', 'HS256');
		
				echo json_encode($token); 
				//
				//echo "presensi berhasil";
			} else {
				$resi['success']='false';
				$resi['message']='gagal update';
				echo json_encode($resi);
			}
		} else {
			$resi['success']='false';
			$resi['message']='kode salah';
			echo json_encode($resi);
		}

	}
	public function save_kode2(){
		$jwt = new JWT();
		$nim = $this->session->userdata('nim');
		$kode_input = $this->input->post('qr');
		
	
		//$id_presensi = $this->session->userdata('idpresensi');

		//echo $kode_input;
		$q = $this->db->query("select * from presensi where kode_qr='$kode_input'")->result_array();
		$id_presensi = $q[0]['id_presensi'];
		if($kode_input==$q[0]['kode_qr']){
			$res = $this->db->query("update detail_presensi set status=1 where nim='$nim' and id_presensi='$id_presensi'");
			if($res){
				//
				$data = array(
					'nim'=>$nim,
					'kode_qr'=>$kode_input,
					'id_presensi'=>$id_presensi
					
				);
				$token['success']='true';
				$token['id_token']=$jwt->encode($data, 'Rahasia', 'HS256');
		
				return json_encode($token); 
				//
				//echo "presensi berhasil";
			} else {
				$resi['success']='false';
				$resi['message']='gagal update';
				return json_encode($resi);
			}
		} else {
			$resi['success']='false';
			$resi['message']='kode salah';
			return json_encode($resi);
		}

	}

	public function simpan_kode(){
		$this->save_kode2();
		redirect('mahasiswa/rekap_presensi');
	}

    public function input_kode() {
		$data = array(
			'title' => "Dashboard Mahasiswa"
		);
		$this->load->view('presensi/input_qr', $data);
	}

	public function jadwal(){
		$data = array(
			'title' => "Jadwal Perkuliahan"
		);
		$nim = $this->session->userdata('nim');
		$data['jadwal']=$this->db->query("SELECT * 
											FROM kelas k, dosen d, matkul m, krs s 
											where s.nim=$nim
											and s.id_kelas = k.id_kelas
											and k.id_dosen=d.id_dosen 
											and k.id_matkul=m.kode_mk")->result();
		$this->load->view('presensi/jadwal', $data);
	}

	public function rekap_presensi(){
		$data = array(
			'title' => "Rekap Presensi Mahasiswa"
		);
		$nim = $this->session->userdata('nim');
		$data['rekap']=$this->db->query("SELECT m.kode_mk, k.id_kelas, d.nama_dosen, m.nama_mk, k.ruang 
											FROM kelas k, dosen d, matkul m, krs s
											where s.nim=$nim 
											and s.id_kelas = k.id_kelas
											and k.id_dosen=d.id_dosen 
											and k.id_matkul=m.kode_mk")->result();
		$this->load->view('presensi/rekap', $data);
	}

	public function detail_presensi($id_kelas){
		$data = array(
			'title' => "Rekap Presensi Mahasiswa"
		);
		$nim = $this->session->userdata('nim');
		$data['detail']=$this->db->query("SELECT d.id_det_pre, p.tanggal, d.status 
						FROM detail_presensi d, presensi p, kelas k 
						WHERE d.id_presensi=p.id_presensi 
						and p.id_kelas='$id_kelas' 
						and k.id_kelas = '$id_kelas'
						and d.nim=$nim")->result();
		$this->load->view('presensi/detail_presensi', $data);
	}
}