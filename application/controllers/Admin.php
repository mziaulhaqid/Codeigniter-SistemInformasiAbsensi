<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
		$this->load->model('Admin_data');
		$this->load->library('session');
		$this->load->library('upload');

		if($this->session->userdata('status') != "login_admin"){

			$this->session->set_flashdata('login','Anda Harus Login Terlebih Dahulu.');

			redirect(base_url("Login/?info=admin"));
		}
	} 

	public function index()
	{

		$data = array(
			'content' => 'admin/content/home', 
			'title' => 'Dashboard',
			'pegawai' => $this->Admin_data->select('nama_pegawai','pegawai','ASC')->result(),
			'jumlah_pegawai' => $this->Admin_data->select('nama_pegawai','pegawai','ASC')->num_rows(),
			'jumlah_devisi' => $this->Admin_data->select('kode_devisi','devisi','ASC')->num_rows(),

		);
		$this->load->view('admin/index',$data);
	}

	public function list_pegawai(){
		$data = array(
			'content' => 'admin/content/list_pegawai', 
			'title' => 'List Pegawai',
			'show' => $this->Admin_data->select('nama_pegawai','v_pegawai','ASC')->result(), 
			'pegawai' => $this->Admin_data->select('nama_pegawai','pegawai','ASC')->result(),
		);
		$this->load->view('admin/index',$data);
	}

	public function tambah_pegawai(){
		$data = array(
			'content' => 'admin/content/tambah_pegawai', 
			'title' => 'Tambah Pegawai',
			'devisi' => $this->Admin_data->select('nama_devisi','devisi','ASC')->result(), 
			'pegawai' => $this->Admin_data->select('nama_pegawai','pegawai','ASC')->result(),
		);
		$this->load->view('admin/index',$data);
	}

	public function list_devisi(){
		$data = array(
			'content' => 'admin/content/list_devisi', 
			'title' => 'List Devisi',
			'show' => $this->Admin_data->select('nama_devisi','devisi','ASC')->result(), 
			'pegawai' => $this->Admin_data->select('nama_pegawai','pegawai','ASC')->result(),
		);
		$this->load->view('admin/index',$data);
	}

	public function tambah_devisi(){
		$data = array(
			'content' => 'admin/content/tambah_devisi', 
			'title' => 'Tambah Devisi',
			'kode_devisi' => $this->Admin_data->code_otomatis('kode_devisi','devisi','D'),
			'pegawai' => $this->Admin_data->select('nama_pegawai','pegawai','ASC')->result(),
		);
		$this->load->view('admin/index',$data);
	}

	public function list_kehadiran(){
		$data = array(
			'content' => 'admin/content/list_kehadiran', 
			'title' => 'List Kehadiran',
			'show' => $this->Admin_data->select('kode_kehadiran','v_kehadiran','DESC')->result(), 
			'pegawai' => $this->Admin_data->select('nama_pegawai','pegawai','ASC')->result(), 
			'pegawai' => $this->Admin_data->select('nama_pegawai','pegawai','ASC')->result(),
		);
		$this->load->view('admin/index',$data);
	}

	public function tambah_kehadiran(){
		$data = array(
			'content' => 'admin/content/tambah_kehadiran', 
			'title' => 'Tambah Kehadiran',
			'pegawai' => $this->Admin_data->select('nama_pegawai','pegawai','ASC')->result(),
		);
		$this->load->view('admin/index',$data);
	}

	public function aksi_tambah_pegawai(){
		$nip = $this->input->post('nip');

		$where = array(
			'nip' => $this->input->post('nip'), 
		);

		if (count($this->Admin_data->edit($where,'pegawai')->result()) > 0){
			$this->session->set_flashdata('warning', 'Maaf NIP sudah terdaftar.!');
			redirect(site_url('admin/tambah_pegawai'));
		}

		if (!empty($_FILES['profile']['name'])) {
			$upload = $this->_do_upload_file($nip,'profile');
			$profile = $upload;
		}else{
			$profile = 'default-150x150.png';
		}

		$data = array(
			'nip' => $nip,
			'nama_pegawai' => $this->input->post('nama_pegawai'),
			'email' => $this->input->post('email'), 
			'password' => md5($this->input->post('password')),
			'kode_devisi' => $this->input->post('devisi'),
			'profile' => $profile,
		);

		$this->Admin_data->input($data,'pegawai');

		$this->session->set_flashdata('success', 'Selamat Input Pegawai Berhasil');
		
		redirect(base_url('admin/tambah_pegawai'));
	}

	public function hapus_pegawai(){
		$id = $this->input->post('id');
		array_map('unlink', glob(FCPATH."assets/profile/".$id.".*"));
		$data = array(
			'nip' => $id,
		);
		$this->Admin_data->hapus($data,'pegawai');

		$this->session->set_flashdata('success', 'Selamat Hapus Pegawai Berhasil');
		
		redirect(base_url('admin/list_pegawai'));
	}

	public function edit_pegawai($id)
	{
		if(empty($id)){
			redirect(base_url('admin/list_pegawai'));
		}
		$where = array(
			'nip' => $id, );

		$data = array(
			'content' => 'admin/content/edit_pegawai',
			'title' => 'Edit Pegawai',
			'show' => $this->Admin_data->edit($where,'pegawai')->result(),  
			'devisi' => $this->Admin_data->select('nama_devisi','devisi','ASC')->result(), 
		);

		$this->load->view('admin/index', $data);
	}
	public function edit_devisi($id)
	{
		if(empty($id)){
			redirect(base_url('admin/list_devisi'));
		}
		$where = array(
			'kode_devisi' => $id, );

		$data = array(
			'content' => 'admin/content/edit_devisi',
			'title' => 'Edit Devisi',
			'show' => $this->Admin_data->edit($where,'devisi')->result(),  
		);

		$this->load->view('admin/index', $data);
	}

	public function view_pegawai($id)
	{
		if(empty($id)){
			redirect(base_url('admin/list_pegawai'));
		}
		$where = array(
			'nip' => $id, );

		$data = array(
			'content' => 'admin/content/view_pegawai',
			'title' => 'View Pegawai',
			'show' => $this->Admin_data->edit($where,'v_pegawai')->result(),  
		);

		$this->load->view('admin/index', $data);
	}



	function aksi_update_pegawai(){

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
				'kode_devisi' => $this->input->post('devisi'),
				'profile' => $profile,
			);
		}else{
			$data = array(
				'nama_pegawai' => $this->input->post('nama_pegawai'),
				'email' => $this->input->post('email'),
				'kode_devisi' => $this->input->post('devisi'),
				'profile' => $profile,
			);
		}
		$this->Admin_data->update($where,$data,'pegawai');

		$this->session->set_flashdata('success', 'Selamat Update Pegawai Berhasil');

		redirect(base_url('admin/edit_pegawai/').$id);
	}

	function aksi_update_devisi(){

		$id = $this->input->post('kode_devisi');

		
		$where = array(
			'kode_devisi' => $id,
		);


		$data = array(
			'nama_devisi' => $this->input->post('nama_devisi'),
		);

		$this->Admin_data->update($where,$data,'devisi');

		$this->session->set_flashdata('success', 'Selamat Update Devisi Berhasil');

		redirect(base_url('admin/edit_devisi/').$id);
	}

	function aksi_update_kehadiran(){

		$id = $this->input->post('kode_kehadiran');

		
		$where = array(
			'kode_kehadiran' => $id,
		);


		$data = array(
			'jam_masuk' => $this->input->post('jam_masuk'),
			'jam_keluar' => $this->input->post('jam_keluar'),
			'status' => $this->input->post('kehadiran'),
		);

		$this->Admin_data->update($where,$data,'kehadiran');

		$this->session->set_flashdata('success', 'Selamat Update Kehadiran Berhasil');

		redirect(base_url('admin/list_kehadiran'));
	}

	public function aksi_tambah_devisi(){
		$kode_devisi = $this->input->post('kode_devisi');
		$nama_devisi = $this->input->post('nama_devisi');
		

		$data = array(
			'kode_devisi' => $kode_devisi ,
			'nama_devisi' => $nama_devisi,
		);

		$this->Admin_data->input($data,'devisi');

		$this->session->set_flashdata('success', 'Selamat input data devisi berhasil.');
		
		redirect(base_url('admin/tambah_devisi'));
	}

	public function hapus_devisi(){
		$id = $this->input->post('id');

		$where = array(
			'kode_devisi' => $id, 
		);

		$pegawai = $this->Admin_data->edit($where,'pegawai')->result();

		foreach ($pegawai as $i) {
			array_map('unlink', glob(FCPATH."assets/profile/".$i->nip.".*"));
		}
		
		$data = array(
			'kode_devisi' => $id,
		);
		$this->Admin_data->hapus($data,'devisi');

		$this->session->set_flashdata('success', 'Selamat Hapus Devisi Berhasil');
		
		redirect(base_url('admin/list_devisi'));
	}

	public function input_absen(){
		$tanggal = $this->input->post('tanggal');
		$bulan = $this->input->post('bulan');

		$date = ''.$tanggal.''.$bulan.'';
		$where = array(
			'tanggal_kehadiran' => date("Y-m-d",strtotime($date)), 
		);

		$cek = $this->Admin_data->edit($where,'kehadiran')->result();

		if (count($cek) > 0) {

			$this->session->set_flashdata('warning', 'Maaf tanggal yang di pilih telah tersedia');

			redirect(base_url('admin/list_kehadiran'));

		}

		$nip = $this->input->post('nip');
		$keterangan = $this->input->post('keterangan');
		$jam_masuk = $this->input->post('jam_masuk');
		$jam_keluar = $this->input->post('jam_keluar');
		$no = 0;
		foreach ($nip as $i) {

			$data = array(
				'kode_kehadiran' => $this->Admin_data->kode_kehadiran('kode_kehadiran','kehadiran','KH') ,
				'nip' => $nip[$no],
				'tanggal_kehadiran' => date("Y-m-d",strtotime($date)),
				'jam_masuk' => $jam_masuk[$no],
				'jam_keluar' => $jam_keluar[$no],
				'status' => $keterangan[$no],
			);
			$no++;

			$this->Admin_data->input($data,'kehadiran');
		}

		$this->session->set_flashdata('success', 'Selamat Input Kehadiran Berhasil');

		redirect(base_url('admin/list_kehadiran'));
	}

	function get_data_kehadiran(){

		$table = 'v_kehadiran';
		$column_order = array(null, 'nama_pegawai','tanggal_kehadiran','keterangan','jam_masuk','jam_keluar','status','null'); 
		$column_search = array('nama_pegawai','tanggal_kehadiran'); 
		$order = array('kode_kehadiran' => 'DESC'); 


		$list = $this->Admin_data->get_datatables($table,$column_order,$column_search,$order);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $field) {
			$no++;
			$row = array();
			$row[] = $no;
			$where = array(
				'nip' => $field->nip, 
			);

			$variable = $this->Admin_data->edit($where,'pegawai')->result();
			foreach ($variable as $i) {
				$row[] = $i->nama_pegawai; 
			}
			$row[] = date("d/m/Y",strtotime($field->tanggal_kehadiran));
			$row[] = $field->jam_masuk;
			$row[] = $field->jam_keluar;
			$row[] = $field->status;
			$row[] = $field->kode_kehadiran;
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->Admin_data->count_all($table),
			"recordsFiltered" => $this->Admin_data->count_filtered($table,$column_order,$column_search,$order),
			"data" => $data,
		);
        //output dalam format JSON
		echo json_encode($output);
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

	public function edit_kehadiran($kode_kehadiran){
		$where = array(
			'kode_kehadiran' => $kode_kehadiran, 
		);

		$e = $this->Admin_data->edit($where,'kehadiran')->row();


		$kirim['kode_kehadiran'] = $e->kode_kehadiran;
		
		$where1 = array(
			'nip' => $e->nip, 
		);

		$w = $this->Admin_data->edit($where1,'pegawai')->row();

		$kirim['nama_pegawai'] = $w->nama_pegawai;
		$kirim['tanggal_kehadiran'] = date("d/m/Y",strtotime($e->tanggal_kehadiran));
		$kirim['jam_masuk'] = $e->jam_masuk;
		$kirim['jam_keluar'] = $e->jam_keluar;
		$kirim['keterangan'] = $e->status;

		$this->output
		->set_content_type('application/json')
		->set_output(json_encode($kirim));

	}

	public function laporan_kehadiran(){
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$nip = $this->input->post('nip');
		$date = ''.$bulan.'-'.$tahun.'';
		if (empty($nip)){
			$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);

			$data = array(
				'bulan' => $date,
				'show' => $this->Admin_data->laporan_kehadiran($bulan, $tahun,'nip')->result(),
				'tanggal' => $this->Admin_data->laporan_kehadiran($bulan, $tahun,'tanggal_kehadiran')->result(),
			);

			$html = $this->load->view('admin/content/laporan_perbulan',$data, true);
			$mpdf->AddPage('L');
			$mpdf->WriteHTML($html);
			$mpdf->Output();	
		}else{
			$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);

			$data = array(
				'bulan' => $date,
				'show' => $this->Admin_data->laporan_kehadiran_($bulan, $tahun,'nip',$nip)->result(),
				'tanggal' => $this->Admin_data->laporan_kehadiran_($bulan, $tahun,'tanggal_kehadiran',$nip)->result(),
				'nip' => $nip,
			);

			$html = $this->load->view('admin/content/laporan_perorang',$data, true);
			$mpdf->WriteHTML($html);
			$mpdf->Output();	
		}
	}

	public function view_user($id){
		$where = array(
			'kode_user' => $id, 
		);

		$data = array(
			'content' =>'admin/content/view_user',
			'title' => 'View User',
			'show' => $this->Admin_data->edit($where,'user')->result(),
		);
		$this->load->view('admin/index',$data);
	}

	public function edit_user($id)
	{
		if(empty($id)){
			redirect(site_url('admin/index'));
		}
		$where = array(
			'kode_user' => $id, );

		$data = array(
			'content' => 'admin/content/edit_user',
			'title' => 'Edit User',
			'show' => $this->Admin_data->edit($where,'user')->result(),  
		);

		$this->load->view('admin/index', $data);
	}

	function Aksi_Update_User(){

		$id = $this->input->post('kode_user');

		$iden = "update";

		$where = array(
			'kode_user' => $id,
		);

		if (!empty($_FILES['profile']['name'])) {
			array_map('unlink', glob(FCPATH."assets/profile/".$id.".*"));
			$upload = $this->_do_upload_file($id,'profile',$iden);
			$profile = $upload;
		}else{
			$profile = $this->input->post('pro');
		}

		if (!empty($this->input->post('password'))){
			$data = array(
				'nama' => $this->input->post('nama'),
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password')), 
				'profile' => $profile,
			);
		}else{
			$data = array(
				'nama' => $this->input->post('nama'),
				'username' => $this->input->post('username'),
				'profile' => $profile,
			);
		}
		$this->Admin_data->update($where,$data,'user');

		$this->session->set_flashdata('success', 'Selamat Update User Berhasil');

		redirect(base_url('admin/Edit_User/').$id);
	}

	public function laporan_pegawai(){
		$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4-L']);

		$data = array(
			'show' => $this->Admin_data->select('nama_pegawai', 'v_pegawai','ASC')->result(),
		);

		$html = $this->load->view('admin/content/laporan_pegawai',$data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();	
	}



}
