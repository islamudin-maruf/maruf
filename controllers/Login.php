<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function index(){

	echo "Auth Controller";

    }

    public function token(){
        $jwt = new JWT();

        $JwtSecretKey="Rahasia";

        $data = array(
            'userId'=>12,
            'email'=>'admin@admin.com',
            'userType'=>'admin'
        );

        $token=$jwt->encode($data, $JwtSecretKey, 'HS256');
        echo $token;
    }

    public function decode_token(){
        $token="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VySWQiOjEyLCJlbWFpbCI6ImFkbWluQGFkbWluLmNvbSIsInVzZXJUeXBlIjoiYWRtaW4ifQ.2sZ2cyTl-Q-I4TtYmv8mWuMhXvk6Ud0dI0tm39CxEa8";

        $jwt = new JWT();

        $JwtSecretKey="Rahasia";
        $decode_token = $jwt->decode($token, $JwtSecretKey, 'HS256');
        echo "<pre>";
        print_r($decode_token);

        $token1=$jwt->jsonEncode($decode_token);
        echo $token1;

    }

}