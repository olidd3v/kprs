<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resto extends MY_Controller {
	function __construct(){
        parent::__construct();
				$this->load->model('resto_model');
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
                $filter['resto.code_resto ='] = $_GET['id'];
			}

			$total_row = $this->resto_model->count_total_filter($filter);
			$data['restos'] = $this->resto_model->get_filter($filter,url_param());
		}else{
			$total_row = $this->resto_model->count_total();
			$data['restos'] = $this->resto_model->get_all(url_param());
		}
		$data['paggination'] = get_paggination($total_row,get_search());

		$this->load->view('resto/index',$data);
	}
	
	public function create(){
		$data['judul_app'] = $this->setting_model->get_by_id(1);
		$code_resto = $this->resto_model->get_last_id();
		$user = $this->user_model->get_all();
		if($code_resto){
			$id = $code_resto[0]->code_resto;
			$data['user'] = $user;
			$data['code_resto'] = generate_code('',$id);
		}else{
			$data['code_resto'] = '001';
			$data['user'] = $user;
		}
		
		$this->load->view('resto/form',$data);
	}

	public function edit($id = ''){
		$data['judul_app'] = $this->setting_model->get_by_id(1);
		$check_id = $this->resto_model->get_by_id($id);
		$user = $this->user_model->get_all();
		if($check_id){
			$data['resto'] = $check_id[0];
			$data['user'] = $user;
			$this->load->view('resto/form',$data);
		}else{
			redirect(site_url('resto'));
		}
	}

	public function save($id = ''){
		if (empty($id)){
		$this->form_validation->set_rules('resto_id', 'ID', 'trim|required|is_unique[resto.code_resto]');
		}else{
		$this->form_validation->set_rules('resto_id', 'ID', 'required');
		}

		$this->form_validation->set_rules('name_resto', 'Nama', 'required');
		$this->form_validation->set_rules('address_resto', 'Adress', 'required');
		$this->form_validation->set_rules('city_resto', 'City', 'required');
		$this->form_validation->set_rules('phone_resto', 'City', 'required');

		$data['code_resto'] = escape($this->input->post('resto_id'));
		$data['name_resto'] = escape($this->input->post('name_resto'));
		$data['address_resto'] = escape($this->input->post('address_resto'));
		$data['city_resto'] = escape($this->input->post('city_resto'));
		$data['phone_resto'] = escape($this->input->post('phone_resto'));
		$data['id_user'] = escape($this->input->post('user'));

		if ($this->form_validation->run() != FALSE && !empty($id)) {
			// EDIT
			$check_id = $this->resto_model->get_by_id($id);
			if($check_id){
				unset($data['id']);
				$this->resto_model->update($id,$data);
			}
		}elseif($this->form_validation->run() != FALSE && empty($id)){
			// INSERT NEW
			$this->resto_model->insert($data);
		}else{
			$this->session->set_flashdata('form_false', 'Harap periksa form anda.');
			redirect(site_url('resto/create'));
		}
		redirect(site_url('resto'));
	}
	public function delete($id){
		$check_id = $this->resto_model->get_by_id($id);
		if($check_id){
			$this->resto_model->delete($id);
		}
		redirect(site_url('resto'));
	}
	public function export_csv(){
		$filter = false;
		if(isset($_GET['search'])) {
			$filter = array();
			if (!empty($_GET['value']) && $_GET['value'] != '') {
				$filter[$_GET['search_by'] . ' LIKE'] = "%" . $_GET['value'] . "%";
			}
		}
		$data = $this->resto_model->get_all_array($filter);
		$this->csv_library->export('resto.csv',$data);
	}
}
