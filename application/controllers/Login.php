<?php
class Login extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('Admin_data');
		$this->load->model('Login_data');
		$this->load->library('session');

	}

	public function index()
	{
		$this->load->view('login');
	}

	public function login(){
		$username = $this->input->post('username'); 
		$password = md5($this->input->post('password')); 


		$user = $this->Login_data->get($username); 

		if(empty($user)){ 
			$this->session->set_flashdata('message', 'Username tidak ditemukan'); 

			redirect(base_url('Login/?info=admin'));

		}if($password == $user->password){ 

			$session = array(
				'status'=>"login_admin", 
				'kode_user'=>$user->kode_user,  
				'username' =>$username,
			);
			
			$this->session->set_userdata($session); 

			redirect(base_url('admin/index')); 
		}else{
			$this->session->set_flashdata('message', 'Password salah');

			redirect(base_url('Login/?info=admin')); 
		}
	}



	function logout(){
		$this->session->unset_userdata("status");
		$this->session->unset_userdata("kode_user");
		$this->session->unset_userdata("username");
		redirect(base_url('Login/?info=admin'));
	}

	public function login_pegawai(){
		$nip = $this->input->post('nip'); 
		$password = md5($this->input->post('password')); 


		$user = $this->Login_data->get_pegawai($nip); 

		if(empty($user)){ 
			$this->session->set_flashdata('message', 'Username tidak ditemukan'); 

			redirect(base_url('Login/?info=pegawai'));

		}else if($password == $user->password){ 
			
			$session = array(
				'status1'=>"Pegawai_Login", 
				'nip'=>$user->nip, 
			);
			$this->session->set_userdata($session); 

			redirect(base_url('pegawai/index')); 
		}else{
			$this->session->set_flashdata('message', 'Password salah');

			redirect(base_url('Login/?info=pegawai')); 
		}
	}

	function logout_pegawai(){
		$this->session->unset_userdata("status1");
		$this->session->unset_userdata("nip");
		redirect(base_url('Login/?info=pegawai'));
	}

}

?>