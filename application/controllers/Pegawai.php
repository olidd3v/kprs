<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends MY_Controller {
	function __construct(){
        parent::__construct();
		$this->load->model('pegawai_model');
		$this->load->model('jabatan_model');
		$this->load->model('setting_model');
		$this->load->model('user_model');
        $this->load->library('form_validation');
		
		// Check Session Login
		if(!isset($_SESSION['logged_in'])){
			redirect(site_url('auth/login'));
		}
	}
	
	public function index(){
		$data['judul_app'] = $this->setting_model->get_by_id(1);
		if(isset($_GET['search'])){
			$filter = array();
            if(!empty($_GET['id']) && $_GET['id'] != ''){
				$filter['nama LIKE'] = "%".$_GET['id']."%";
			}

			$total_row = $this->pegawai_model->count_total_filter($filter);
			$data['pegawais'] = $this->pegawai_model->get_filter($filter,url_param());
		}else{
			$total_row = $this->pegawai_model->count_total();
			$data['pegawais'] = $this->pegawai_model->get_all(url_param());
		}
		$data['paggination'] = get_paggination($total_row,get_search());

		$this->load->view('pegawai/index',$data);
	}
	
	public function create(){
        $data['jabatan'] = $this->jabatan_model->get_all();
		$data['judul_app'] = $this->setting_model->get_by_id(1);
		$this->load->view('pegawai/form',$data);
	}

	public function edit($id = ''){
        $data['jabatan'] = $this->jabatan_model->get_all();
		$data['judul_app'] = $this->setting_model->get_by_id(1);
		$check_id = $this->pegawai_model->get_by_id($id);
		if($check_id){
            $data['pegawai'] = $check_id[0];
			$this->load->view('pegawai/form',$data);
		}else{
			redirect(site_url('pegawai'));
		}
	}

	public function save($id = ''){
		if (empty($id)){
		$this->form_validation->set_rules('nik', 'NIK', 'trim|required|is_unique[pegawai.nik]');
		}else{
		$this->form_validation->set_rules('nik', 'NIK', 'required');
		}
		$data['id_jabatan'] = escape($this->input->post('id_jabatan'));
		$data['nama'] = escape($this->input->post('nama'));
		$data['nik'] = escape($this->input->post('nik'));
		$data['jk'] = escape($this->input->post('jk'));
		$data['alamat'] = escape($this->input->post('alamat'));
		$data['gaji'] = escape($this->input->post('gaji'));

		if ($this->form_validation->run() != FALSE && !empty($id)) {
			// EDIT
			$check_id = $this->pegawai_model->get_by_id($id);
			if($check_id){
				unset($data['id']);
				$this->pegawai_model->update($id,$data);
			}
		}elseif($this->form_validation->run() != FALSE && empty($id)){
			// INSERT NEW
			$this->pegawai_model->insert($data);
		}else{
			$this->session->set_flashdata('form_false', 'Harap periksa form anda.');
			redirect(site_url('pegawai/create'));
		}
		redirect(site_url('pegawai'));
	}
	public function delete($id){
		$check_id = $this->pegawai_model->get_by_id($id);
		if($check_id){
			$this->pegawai_model->delete($id);
		}
		redirect(site_url('pegawai'));
	}
	public function export_csv(){
		$filter = false;
		if(isset($_GET['search'])) {
			$filter = array();
			if (!empty($_GET['value']) && $_GET['value'] != '') {
				$filter[$_GET['search_by'] . ' LIKE'] = "%" . $_GET['value'] . "%";
			}
		}
		$data = $this->pegawai_model->get_all_array($filter);
		$this->csv_library->export('resto.csv',$data);
	}
}
