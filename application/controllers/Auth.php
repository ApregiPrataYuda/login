<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('LoginModels');
    }
	
	public function login()
	{
		$this->load->view('login_view');
	}

    public function Process()
    {
        //ambil semua inputan dari user 
       $username = $this->input->post('username');
       $password = $this->input->post('password');

       //cek username dari db models apakah ada / tidak
       $checkusrname = $this->LoginModels->checkusername($username);
     
       //jika username ada
       if ($checkusrname->num_rows() > 0) {
       
         //cek username dan pass dari db models apakah ada / tidak
       $checkusernamedanpass = $this->LoginModels->checkusernamedanpass($username,  $password);

       //jika username dan pw ada 
         if ($checkusernamedanpass->num_rows() > 0) {
          
          // ambil semua data username dan pass yang ada 
            $getallfield = $checkusernamedanpass->row_array();

            //ambil field user_status
            //jika user statusnya aktif maka boleh masuk
              if ($getallfield['user_status'] == 1) {
                
                //buat session untuk mencegah masuk lewat url
                $this->session->set_userdata('locked', TRUE);

                //deklarasi
                $this->session->set_userdata('user', $username);

                //deklarasi id
                $id = $getallfield['user_id'];

                //jika
                if ($getallfield['user_akses'] == 1) {
                  
                   $name =  $getallfield['name'];
                   $usernames =  $getallfield['username'];
                   $this->session->set_userdata('access', 'Admin');
                   $this->session->set_userdata('id', $id);
                   $this->session->set_userdata('nama', $name);
                   $this->session->set_userdata('username', $usernames);
                    redirect('Dashboard');

                }elseif ($getallfield['user_akses'] == 2) {

                  $name =  $getallfield['name'];
                  $usernames =  $getallfield['username'];
                  $this->session->set_userdata('access', 'admin dua');
                  $this->session->set_userdata('id', $id);
                  $this->session->set_userdata('nama', $name);
                  $this->session->set_userdata('username', $usernames);
                     redirect('Dashboard');

                }elseif ($getallfield['user_akses'] == 3) {

                  $name =  $getallfield['name'];
                  $usernames =  $getallfield['username'];
                  $this->session->set_userdata('access', 'admin tiga');
                  $this->session->set_userdata('id', $id);
                  $this->session->set_userdata('nama', $name);
                  $this->session->set_userdata('username', $usernames);
                     redirect('Dashboard');

                }elseif ($getallfield['user_akses'] == 4) {

               $name =  $getallfield['name'];
               $usernames =  $getallfield['username'];
               $this->session->set_userdata('access', 'admin empat');
               $this->session->set_userdata('id', $id);
               $this->session->set_userdata('nama', $name);
               $this->session->set_userdata('username', $usernames);
                  redirect('Dashboard');
                }
                //jika user_status 0 maka 
              }else {
               $this->session->set_flashdata('error','Akun Belum Aktif');
               redirect('Auth/login');
              }
         //jika pass salah/tidak ada
         }else{
          $this->session->set_flashdata('error','Password Tidak Valid');
          redirect('Auth/login');
         }
         //jika username tidak ada
       }else {
        $this->session->set_flashdata('error','Username tidak terdaftar');
        redirect('Auth/login');
       }
    }


    function logout()
    {
        $this->session->sess_destroy();
        redirect('Auth/Login');
    }
}
