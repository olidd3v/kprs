<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends MY_Controller {
	function __construct(){
        parent::__construct();
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
                $filter['nama_jabatan ='] = $_GET['id'];
			}

			$total_row = $this->jabatan_model->count_total_filter($filter);
			$data['jabatans'] = $this->jabatan_model->get_filter($filter,url_param());
		}else{
			$total_row = $this->jabatan_model->count_total();
			$data['jabatans'] = $this->jabatan_model->get_all(url_param());
		}
		$data['paggination'] = get_paggination($total_row,get_search());

		$this->load->view('jabatan/index',$data);
	}
	
	public function create(){
		$data['judul_app'] = $this->setting_model->get_by_id(1);
		$this->load->view('jabatan/form',$data);
	}

	public function edit($id = ''){
		$data['judul_app'] = $this->setting_model->get_by_id(1);
		$check_id = $this->jabatan_model->get_by_id($id);
		if($check_id){
            $data['jabatan'] = $check_id[0];
			$this->load->view('jabatan/form',$data);
		}else{
			redirect(site_url('jabatan'));
		}
	}

	public function save($id = ''){
		if (empty($id)){
		$this->form_validation->set_rules('nama_jabatan', 'ID', 'trim|required|is_unique[jabatan.nama_jabatan]');
		}else{
		$this->form_validation->set_rules('nama_jabatan', 'ID', 'required');
		}
		$data['nama_jabatan'] = escape($this->input->post('nama_jabatan'));

		if ($this->form_validation->run() != FALSE && !empty($id)) {
			// EDIT
			$check_id = $this->jabatan_model->get_by_id($id);
			if($check_id){
				unset($data['id']);
				$this->jabatan_model->update($id,$data);
			}
		}elseif($this->form_validation->run() != FALSE && empty($id)){
			// INSERT NEW
			$this->jabatan_model->insert($data);
		}else{
			$this->session->set_flashdata('form_false', 'Harap periksa form anda.');
			redirect(site_url('jabatan/create'));
		}
		redirect(site_url('jabatan'));
	}
	public function delete($id){
		$check_id = $this->jabatan_model->get_by_id($id);
		if($check_id){
			$this->jabatan_model->delete($id);
		}
		redirect(site_url('jabatan'));
	}
	public function export_csv(){
		$filter = false;
		if(isset($_GET['search'])) {
			$filter = array();
			if (!empty($_GET['value']) && $_GET['value'] != '') {
				$filter[$_GET['search_by'] . ' LIKE'] = "%" . $_GET['value'] . "%";
			}
		}
		$data = $this->jabatan_model->get_all_array($filter);
		$this->csv_library->export('resto.csv',$data);
	}
}
