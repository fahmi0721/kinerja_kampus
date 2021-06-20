<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct(){
			parent::__construct();
			$this->load->helper('url'); 
			$this->load->model('m_auth');
	}
	public function index()
	{
		$this->load->view('login');
	}

	public function proses(){
		$Username = $this->input->post('Username');
		$Password = md5("pp".$this->input->post('Password'));
		if($this->m_auth->login_user($Username,$Password)){
			redirect("/");
			
		}else{
			$this->session->set_flashdata('error','Username / Password salah');
			redirect("/auth");
		}
	}

	public function logout(){
		$this->session->unset_userdata('Username');
		$this->session->unset_userdata('Nama');
		$this->session->unset_userdata('Level');
		$this->session->unset_userdata('KodeLevel');
		$this->session->unset_userdata('is_login');
		redirect('auth');
	}
	
}
