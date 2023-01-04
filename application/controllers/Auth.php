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
       $username = $this->input->post();
       $password = $this->input->post();

       
    }
}
