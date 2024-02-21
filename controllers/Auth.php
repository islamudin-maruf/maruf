<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {


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
			'title' => "Login"
		);
    //echo ($this->uri->segment(1));
		$this->load->view('presensi/login', $data);
    }

    public function valid(){
      $username = $this->input->post('username');
      $password = $this->input->post('password');
    

      $res = $this->db->query("select * from user where username='$username' and password='$password'")->result_array();
      $cek = count($res);
      if($cek==1){    

        $jwt = new JWT();

        $JwtSecretKey="Rahasia";
        $idLogin = $res[0]['id_login'];
        // jika mahasiswa 2
        if($res[0]['level']==2){
          $dataMhs= $this->db->query("select * from mahasiswa where id_login='$idLogin'")->result_array();
          $data = array(
            'userId'=>$res[0]['id_login'],
            'username'=>$res[0]['username'],
            'nim'=>$dataMhs[0]['nim'],
            'level'=>$res[0]['level']
            
        );
        $token['success']='true';
        $token['id_token']=$jwt->encode($data, $JwtSecretKey, 'HS256');

        return json_encode($token);  
        } elseif($res[0]['level']==1){
          $dataDosen= $this->db->query("select * from dosen where id_login='$idLogin'")->result_array();

          $data = array(
            'userId'=>$res[0]['id_login'],
            'username'=>$res[0]['username'],
            'id_dosen'=>$dataDosen[0]['id_dosen'],
            'level'=>$res[0]['level']
        );
        $token['success']='true';
        $token['id_token']=$jwt->encode($data, $JwtSecretKey, 'HS256');

        return json_encode($token);
        }

      } else {

        $res['success']='false';
        $res['message']='Username atau password salah';
   
        return json_encode($res); 
      }
    }

    public function act_login(){
      $jwt = new JWT();
      $res = $this->valid();
      $log = json_decode($res, true);

      if($log['success']=='true'){
        $JwtSecretKey="Rahasia";
        $decode_token = $jwt->decode($log['id_token'], $JwtSecretKey, 'HS256');
        if($decode_token->level=='1'){
         // echo "<pre>";
          //print_r($decode_token);
          $data_session = array(
            'id_dosen' => $decode_token->id_dosen,
            'status' => "login"
            );
        $this->session->set_userdata($data_session);
          redirect('dosen');
        } else {
          $data_session = array(
            'nim' => $decode_token->nim,
            'status' => "login"
            );
        $this->session->set_userdata($data_session);
          redirect('mahasiswa');
        }
      } else {
        redirect('auth');
      }
      

    
    }
    public function logout(){
      session_start();
      session_destroy();
      redirect('auth');
    }

    public function login_valid(){
      $username = $this->input->post('username');
      $password = $this->input->post('password');
    

      $res = $this->db->query("select * from user where username='$username' and password='$password'")->result_array();
      $cek = count($res);
      if($cek==1){    

        $jwt = new JWT();

        $JwtSecretKey="Rahasia";
        $idLogin = $res[0]['id_login'];
        // jika mahasiswa 2
        if($res[0]['level']==2){
          $dataMhs= $this->db->query("select * from mahasiswa where id_login='$idLogin'")->result_array();
          $data = array(
            'userId'=>$res[0]['id_login'],
            'username'=>$res[0]['username'],
            'nim'=>$dataMhs[0]['nim'],
            'level'=>$res[0]['level']
            
        );
        $token['success']='true';
        $token['id_token']=$jwt->encode($data, $JwtSecretKey, 'HS256');

        echo json_encode($token);  
        } elseif($res[0]['level']==1){
          $dataDosen= $this->db->query("select * from dosen where id_login='$idLogin'")->result_array();

          $data = array(
            'userId'=>$res[0]['id_login'],
            'username'=>$res[0]['username'],
            'id_dosen'=>$dataDosen[0]['id_dosen'],
            'level'=>$res[0]['level']
        );
        $token['success']='true';
        $token['id_token']=$jwt->encode($data, $JwtSecretKey, 'HS256');

        echo json_encode($token);
        }

      } else {

        $res['success']='false';
        $res['message']='Username atau password salah';
   
        echo json_encode($res); 
      }
    }

}