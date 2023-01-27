<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kary extends MY_Controller {
	function __construct(){
        parent::__construct();
		$this->load->model('kary_model');
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
                $filter['nik ='] = $_GET['id'];
			}

			$total_row = $this->kary_model->count_total_filter($filter);
			$data['karys'] = $this->kary_model->get_filter($filter,url_param());
		}else{
			$total_row = $this->kary_model->count_total();
			$data['karys'] = $this->kary_model->get_all(url_param());
		}
		$data['paggination'] = get_paggination($total_row,get_search());

		$this->load->view('kary/index',$data);
	}
	
	public function create(){
		$data['judul_app'] = $this->setting_model->get_by_id(1);
		$this->load->view('kary/form',$data);
	}

	public function edit($id = ''){
		$data['judul_app'] = $this->setting_model->get_by_id(1);
		$check_id = $this->kary_model->get_by_id($id);
		if($check_id){
            $data['kary'] = $check_id[0];
			$this->load->view('kary/form',$data);
		}else{
			redirect(site_url('kary'));
		}
	}

	public function save($id = ''){
		$data['nik'] = escape($this->input->post('nik'));
        $nik = $data['nik'];
		if (empty($id)){
            $check_nik = $this->kary_model->check_nik($nik);
		    if($check_nik){
            $this->session->set_flashdata('form_false', 'NIK sudah terdaftar!');
            redirect(site_url('kary/create'));
            }else{
		    $this->form_validation->set_rules('nik', 'ID', 'required');
            }
		}else{
		$this->form_validation->set_rules('nik', 'ID', 'required');
		}
		$data['nama_kary'] = escape($this->input->post('nama_kary'));
		$data['alamat'] = escape($this->input->post('alamat'));
		$data['tgl_lhr'] = escape($this->input->post('tgl_lhr'));

		if ($this->form_validation->run() != FALSE && !empty($id)) {
			// EDIT
			$check_id = $this->kary_model->get_by_id($id);
			if($check_id){
				unset($data['id']);
                echo "atas";
				$this->kary_model->update($id,$data);
			}
		}elseif($this->form_validation->run() != FALSE && empty($id)){
			// INSERT NEW
			$this->kary_model->insert($data);
		}else{
			$this->session->set_flashdata('form_false', 'Harap periksa form anda.');
			redirect(site_url('kary/create'));
		}
		redirect(site_url('kary'));
	}
	public function delete($id){
		$check_id = $this->kary_model->get_by_id($id);
		if($check_id){
			$this->kary_model->delete($id);
		}
		redirect(site_url('kary'));
	}
	public function export_csv(){
		$filter = false;
		if(isset($_GET['search'])) {
			$filter = array();
			if (!empty($_GET['value']) && $_GET['value'] != '') {
				$filter[$_GET['search_by'] . ' LIKE'] = "%" . $_GET['value'] . "%";
			}
		}
		$data = $this->kary_model->get_all_array($filter);
		$this->csv_library->export('resto.csv',$data);
	}
}
