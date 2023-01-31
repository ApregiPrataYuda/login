<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class emailAttach extends CI_Controller {

	public function __construct()
 {
   parent::__construct(); 
   require APPPATH.'libraries/phpmailer/src/Exception.php';
   require APPPATH.'libraries/phpmailer/src/PHPMailer.php';
   require APPPATH.'libraries/phpmailer/src/SMTP.php';
 }

	public function index()

	{
		$this->template->load('template','emailAttach');
	}


	public function send()
	{
	  // PHPMailer object
	  $response = false;
	  $mail = new PHPMailer();
   
	  // SMTP configuration
	  $mail->isSMTP();
	  $mail->Host     = 'smtp.gmail.com';
	  $mail->SMTPAuth = true;
	  $mail->Username = 'tess96956@gmail.com'; // user email anda
	  $mail->Password = 'yijptjqfajlghyqf'; // diisi dengan App Password yang sudah di generate
	  $mail->SMTPSecure = 'ssl';
	  $mail->Port     = 465;
   
	  $mail->setFrom('tess96956@gmail.com', 'Tes'); // user email anda
	  $mail->addReplyTo('tess96956@gmail.com', ''); //user email anda
   
	  // Email subject
	  $mail->Subject = 'SMTP CodeIgniter | TES'; //subject email
   
	  // Add a recipient
	  $mail->addAddress($this->input->post('email')); //email tujuan pengiriman email
   
	  // Set email format to HTML
	  $mail->isHTML(true);
   
	  // Email body content
	  $mailContent = "<p>Hallo <b>".$this->input->post('nama')."</b> berikut ini adalah komentar Anda:</p>
	  <table>
		<tr>
		  <td>Nama</td>
		  <td>:</td>
		  <td>".$this->input->post('nama')."</td>
		</tr>
		<tr>
		  <td>Website</td>
		  <td>:</td>
		  <td>".$this->input->post('website')."</td>
		</tr>
		<tr>
		  <td>Komentar</td>
		  <td>:</td>
		  <td>".$this->input->post('komentar')."</td>
		</tr>
	  </table>
	  <p>Terimakasih <b>".$this->input->post('nama')."</b> telah memberi komentar.</p>"; // isi email
	  $mail->Body = $mailContent;
   
	  // Send email
	  if(!$mail->send()){
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	  }else{
		echo 'Message has been sent';
	  }
	}

	
}
