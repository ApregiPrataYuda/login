<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginModels extends CI_Model {

	public function checkusername($username)
	{
		$query =  $this->db->query("SELECT * FROM users_login WHERE username = '$username' LIMIT 1");
        return $query;
	}


    public function checkusernamedanpass($username,$password)
	{
		$query =  $this->db->query("SELECT * FROM users_login WHERE username = '$username' AND password = sha1('$password') LIMIT 1");
        return $query;
	}
}
