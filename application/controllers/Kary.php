<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kary extends MY_Controller {
	function __construct(){
        parent::__construct();
		$this->load->model('kary_model');
		$this->load->model('setting_model');
		$this->load->model('user_model');
        $this->load->library('form_validation');
		$this->load->helper(array('form', 'url'));		
		$this->load->library('Pdf');
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

	public function history(){
		$data['judul_app'] = $this->setting_model->get_by_id(1);
		if(isset($_GET['search'])){
			$filter = array();
            if(!empty($_GET['id']) && $_GET['id'] != ''){
                $filter['transaksi.nik ='] = $_GET['id'];
			}
			$data['result_kary'] = $this->kary_model->get_filter_history($filter,url_param());
		}
		$this->load->view('kary/history',$data);
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
			$nik = $check_id[0]['nik'];
			$data['uploads'] = $this->kary_model->get_by_id_upload($nik);
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
				$this->kary_model->update($id,$data);
				$config['upload_path']          = './upload/';
				$config['allowed_types']        = 'jpg';
				$config['max_size']             = 5000;
				// $config['max_width']            = 1024;
				// $config['max_height']           = 768;
				$config['encrypt_name'] = TRUE;
			
				$this->load->library('upload', $config);

				$nik = $check_id[0]['nik'];
				$upload = $this->kary_model->get_by_id_upload($nik);
				if (!$this->upload->do_upload('gambar1')){
						$error = array($this->upload->display_errors());
						$this->session->set_flashdata('form_false', $error);
					}else{
						$data = array('upload_data' => $this->upload->data('file_name'));
						$filename = $data['upload_data'];
						$nik = $this->input->post('nik');
						$data_transaction = array(
							'nik' => $nik,
							'gambar' => $filename 
						);
						$unlink = '././upload/'.$upload[0]['gambar'];
						unlink($unlink);
						$this->kary_model->update_transaction($nik,$data_transaction);
					}
				

				if (!$this->upload->do_upload('gambar2')){
						$error = array($this->upload->display_errors());
						$this->session->set_flashdata('form_false', $error);
					}else{
						$data = array('upload_data' => $this->upload->data('file_name'));
						$filename = $data['upload_data'];
						$nik = $this->input->post('nik');
						$data_transaction = array(
							'nik' => $nik,
							'gambar1' => $filename 
						);
						$unlink = '././upload/'.$upload[0]['gambar1'];
						unlink($unlink);
						$this->kary_model->update_transaction($nik,$data_transaction);
					}
			}
		}elseif($this->form_validation->run() != FALSE && empty($id)){
			// INSERT NEW
			$data_transaction = array(
				'no_tr' => date("Yshh"),
				'nik' => $nik
			);
			$this->kary_model->insert_transaction($data_transaction);
			$this->kary_model->insert($data);
		}else{
			$this->session->set_flashdata('form_false', 'Harap periksa form anda.');
			redirect(site_url('kary/create'));
		}
		redirect(site_url('kary'));
	}
	public function save_transaction(){
		$config['upload_path']          = './upload/';
		$config['allowed_types']        = 'jpg';
		$config['max_size']             = 5000;
		// $config['max_width']            = 1024;
		// $config['max_height']           = 768;
		$config['encrypt_name'] = TRUE;
	 
		$this->load->library('upload', $config);
	 
		if ( ! $this->upload->do_upload('files')){
			$error = array($this->upload->display_errors());
			// echo json_encode($error);
            $this->session->set_flashdata('form_false', $error);
			redirect(site_url('kary'));
		}else{
			$data = array('upload_data' => $this->upload->data('file_name'));
			$filename = $data['upload_data'];
			$nik = $this->input->post('nik');
			$data_transaction = array(
				'no_tr' => date("Yshh"),
				// 'no_tr' => date("Y-shh")."-".md5(date("s")),
				'nik' => $nik,
				'gambar' => $filename 
			);
			$this->kary_model->insert_transaction($data_transaction);
			// $this->load->view('kary', $data);
			redirect(site_url('kary'));
		}
	}
	public function delete($id){
		$check_id = $this->kary_model->get_by_id($id);
		if($check_id){
			$nik = $check_id[0]['nik'];
			$check_nik = $this->kary_model->get_by_id_transaction($nik);
			if ($check_nik){
				$g = '././upload/'.$check_nik[0]['gambar'];
				$f = '././upload/'.$check_nik[0]['gambar1'];
				unlink($g);
				unlink($f);
				$this->kary_model->delete_transaction($nik);
			}
			$this->kary_model->delete($id);
		}
		redirect(site_url('kary'));
	}
	public function report_pdf(){
		error_reporting(0);
        $pdf = new FPDF('L', 'mm','Letter');
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(0,7,'REPORT',0,1,'C');
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(10,10,'No',1,0,'C');
        $pdf->Cell(85,10,'NIK',1,0,'C');
        $pdf->Cell(85,10,'NAMA',1,0,'C');
        $pdf->Cell(40,10,'GAMBAR 1',1,0,'C');
        $pdf->Cell(40,10,'GAMBAR 2',1,1,'C');
        $pdf->SetFont('Arial','',10);		
		// $pdf->setTopMargin(10,10);
		$data = $this->kary_model->get_all_pdf(url_param());
        $no=0;
        foreach ($data as $data){
            $no++;
            $pdf->Cell(10,10,$no,1,0, 'C');
            $pdf->Cell(85,10,$data->nik,1,0);
            $pdf->Cell(85,10,$data->nama_kary,1,0);
			$gambar = 'upload/'.$data->gambar;
			$gambar1 = 'upload/'.$data->gambar1;
				// $pdf->Cell(40,10,$data->gambar,1,1);
			if (!empty($data->gambar)){
				$pdf->Cell(40,10, $pdf->Image($gambar, $pdf->GetX(), $pdf->GetY(), 11.5,10) ,1,0,'C',0);
			}
			if (!empty($data->gambar1)){
				$pdf->Cell(40,10, $pdf->Image($gambar1, $pdf->GetX(), $pdf->GetY(), 11.5,10) ,1,1,'C',0);
			}else{
				$pdf->Cell(40,10, '', 1,1,'C',0);
			}
			
			// list($x1, $y1) = getimagesize($gambar);
			// $x2 = 10;
			// $y2 = 70;
			// if(($x1 / $x2) < ($y1 / $y2)) {
			// 	$y2 = 0;
			// } else {
			// 	$x2 = 0;
			// }
			// $pdf->Cell(40, 6, $pdf->Image($gambar, 'R' ,40,40));
			// $pdf->Cell(40, 6, "", 0, 1, 'C',$pdf->Image($gambar,$x2,$y2,0,40));
        }
        $pdf->Output();
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
