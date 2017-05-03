<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

	public function index()
	{
		$this->load->view('tambah_user_view');		
	}

	public function createuser(){
		$this->load->helper('url','form');	
		$this->load->library('form_validation'); 
		$this->form_validation->set_rules('username','Username','trim|required|callback_cekDB');
		$this->form_validation->set_rules('password','Password','trim|required');
		$this->load->model('user');
		
		if($this->form_validation->run()==FALSE){
			$this->load->view('tambah_user_view');
		}else{
				$this->user->insertUser();
				$this->load->view('tambah_user_sukses');
		}
	}
	public function cekDB(){
		$this->load->model('user');
		
		$username = $this->input->post('username');
		$result = $this->user->register($username);
		if($result){
			$this->form_validation->set_message('cekDB',"Register Gagal! Username Sudah Digunakan!");
			return false;
		}
		else{
			return true;
		}
	}	

}

/* End of file Register.php */
/* Location: ./application/controllers/Register.php */
?>