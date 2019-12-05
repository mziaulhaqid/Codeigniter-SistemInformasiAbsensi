<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {

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
		$this->load->model('Pegawai_data');
		$this->load->library('session');
		$this->load->library('upload');

		if($this->session->userdata('status1') != "Pegawai_Login"){

			$this->session->set_flashdata('login','Anda Harus Login Terlebih Dahulu.');

			redirect(base_url("Login/?info=pegawai"));
		}
	} 

	public function index()
	{

		$where = array(
			'nip' => $this->session->userdata('nip'),
			'status' => 'Hadir',
		);

		$where1 = array(
			'nip' => $this->session->userdata('nip'),
			'status' => 'Sakit',
		);

		$where2 = array(
			'nip' => $this->session->userdata('nip'),
			'status' => 'Izin',
		);

		$where3 = array(
			'nip' => $this->session->userdata('nip'),
			'status' => 'Alpa',
		);


		$data = array(
			'content' => 'pegawai/content/home', 
			'title' => 'Dashboard',
			'hadir' => $this->Pegawai_data->edit($where,'kehadiran')->num_rows(),
			'sakit' => $this->Pegawai_data->edit($where1,'kehadiran')->num_rows(),
			'izin' => $this->Pegawai_data->edit($where2,'kehadiran')->num_rows(),
			'alpa' => $this->Pegawai_data->edit($where3,'kehadiran')->num_rows(),
			'jumlah_devisi' => $this->Pegawai_data->select('kode_devisi','devisi','ASC')->num_rows(),
		);
		$this->load->view('pegawai/index',$data);
	}

	public function data_pribadi(){

		$where = array(
			'nip' => $this->session->userdata('nip'), 
		);

		$data = array(
			'content' => 'pegawai/content/data_pribadi',
			'title' => 'Data Pribadi',
			'show' =>  $this->Pegawai_data->edit($where,'v_pegawai')->result(),  
		);
		$this->load->view('pegawai/index',$data);
	}

	public function list_kehadiran(){

		$where = array(
			'nip' => $this->session->userdata('nip'), 
		);


		$data = array(
			'content' => 'pegawai/content/list_kehadiran',
			'title' => 'List Kehadiran',
			'show' => $this->Pegawai_data->kehadiran_pegawai($where,'v_kehadiran','kode_kehadiran','DESC')->result(), 
		);
		$this->load->view('pegawai/index',$data);
	}

	function get_data_kehadiran(){

		$table = 'kehadiran';
		$column_order = array(null, 'tanggal_kehadiran','keterangan','jam_masuk','jam_keluar','status','null'); 
		$column_search = array('tanggal_kehadiran'); 
		$order = array('kode_kehadiran' => 'DESC'); 


		$list = $this->Pegawai_data->get_datatables($table,$column_order,$column_search,$order);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = date("d/m/Y",strtotime($field->tanggal_kehadiran));
			$row[] = $field->jam_masuk;
			$row[] = $field->jam_keluar;
			$row[] = $field->status;
			$row[] = $field->kode_kehadiran;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Pegawai_data->count_all($table),
			"recordsFiltered" => $this->Pegawai_data->count_filtered($table,$column_order,$column_search,$order),
			"data" => $data,
		);
        //output dalam format JSON
		echo json_encode($output);
	}

	public function edit_pegawai($id)
	{
		if(empty($id)){
			redirect(base_url('pegawai/index'));
		}
		$where = array(
			'nip' => $id, );

		$data = array(
			'content' => 'pegawai/content/edit_pegawai',
			'title' => 'Edit Data Pribadi',
			'show' => $this->Pegawai_data->edit($where,'v_pegawai')->result(),  
		);

		$this->load->view('pegawai/index', $data);
	}

	function Aksi_Update_Pegawai(){

		$id = $this->input->post('nip');

		$iden = "update";

		$where = array(
			'nip' => $id,
		);

		if (!empty($_FILES['profile']['name'])) {
			array_map('unlink', glob(FCPATH."assets/profile/".$id.".*"));
			$upload = $this->_do_upload_file($id,'profile',$iden);
			$profile = $upload;
		}else{
			$profile = $this->input->post('profile');
		}

		if (!empty($this->input->post('password'))){
			$data = array(
				'nama_pegawai' => $this->input->post('nama_pegawai'),
				'email' => $this->input->post('email'),
				'password' => md5($this->input->post('password')), 
				'profile' => $profile,
			);
		}else{
			$data = array(
				'nama_pegawai' => $this->input->post('nama_pegawai'),
				'email' => $this->input->post('email'),
				'profile' => $profile,
			);
		}
		$this->Pegawai_data->update($where,$data,'pegawai');

		$this->session->set_flashdata('success', 'Selamat Update Pegawai Berhasil');

		redirect(base_url('pegawai/edit_pegawai/').$id);
	}

	private function _do_upload_file($name,$id,$iden){
		$config['upload_path'] 		= 'assets/profile/';
		$config['allowed_types'] 	= 'pdf|docx|doc|png|jpg';
		$config['max_size'] 		= 200000;
		$config['file_name'] 		= $name;

		$this->upload->initialize($config);

		if (!$this->upload->do_upload($id)) {

			if($iden == 'update'){

				$this->session->set_flashdata('warning', 'Ukuran atau format file tidak sesuai');
				$name1 = substr($name, -10);
				redirect(base_url('admin/edit_pegawai/'.$name1.''));	
			}

			$this->session->set_flashdata('warning', 'Ukuran atau format file tidak sesuai');

			redirect(base_url('Admin/tambah_pegawai'));
		}
		return $this->upload->data('file_name');
	}


	
}
