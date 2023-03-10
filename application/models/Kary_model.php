<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kary_model extends CI_Model {
	function __construct(){
        parent::__construct();
	}
	
	public function get_all($limit_offset = array()){
		if(!empty($limit_offset)){
			$query = $this->db->get("tbl_kary",$limit_offset['limit'],$limit_offset['offset']);
		}else{
			$query = $this->db->get("tbl_kary");
		}
		return $query->result();
	}
	public function get_all_pdf($limit_offset = array()){
		$this->db->join("tbl_kary", "tbl_kary.nik = transaksi.nik", "left");
		if(!empty($limit_offset)){
			$query = $this->db->get("transaksi",$limit_offset['limit'],$limit_offset['offset']);
		}else{
			$query = $this->db->get("transaksi");
		}
		return $query->result();
	}
	public function count_total(){
		$query = $this->db->get("tbl_kary");
		return $query->num_rows();
	}
	public function get_all_array($filter = ''){
		if(!empty($filter)) {
			$query = $this->db->get_where("tbl_kary",$filter);
		}else{
			$query = $this->db->get_where("tbl_kary");
		}
		return $query->result_array();
	}
	public function get_last_id(){
		$this->db->order_by('id_kary', 'DESC');

		$query = $this->db->get("tbl_kary",1,0);
		return $query->result();
	}
	public function insert($data){
		$this->db->insert('tbl_kary', $data);
	}
	public function insert_transaction($data_transaction){
		$this->db->insert('transaksi', $data_transaction);
	}
	public function update_transaction($nik,$data_transaction){
		$this->db->where('nik', $nik);
		$this->db->update('transaksi', $data_transaction);
	}
	public function update_transaction_w($d,$data_transaction){
		$this->db->where('nik', $d);
		$this->db->update('transaksi', $data_transaction);
	}
	public function update($id,$data){
		$this->db->where('id_kary', $id);
		$this->db->update('tbl_kary', $data);
	}
	public function get_by_id($id){
		$response = false;
		$query = $this->db->get_where('tbl_kary',array('id_kary' => $id));
		if($query && $query->num_rows()){
			$response = $query->result_array();
		}
		return $response;
	}
	public function get_by_id_transaction($nik){
		$response = false;
		$query = $this->db->get_where('transaksi',array('nik' => $nik));
		if($query && $query->num_rows()){
			$response = $query->result_array();
		}
		return $response;
	}
    public function check_nik($nik){
		$response = false;
		$query = $this->db->get_where('tbl_kary',array('nik' => $nik));
		if($query && $query->num_rows()){
			$response = $query->result_array();
		}
		return $response;
	}
	public function delete($id){
		$this->db->delete('tbl_kary', array('id_kary' => $id));
	}
	public function delete_transaction($nik){
		$this->db->delete('transaksi', array('nik' => $nik));
	}
	public function get_filter($filter = '',$limit_offset = array()){
		if(!empty($filter)){
			$query = $this->db->get_where("tbl_kary",$filter,$limit_offset['limit'],$limit_offset['offset']);
		}else{
			$query = $this->db->get("tbl_kary",$limit_offset['limit'],$limit_offset['offset']);
		}
		return $query->result();
	}
	public function count_total_filter($filter = array()){
		if(!empty($filter)){
			$query = $this->db->get_where("tbl_kary",$filter);
		}else{
			$query = $this->db->get("tbl_kary");
		}
		return $query->num_rows();
	}
	public function get_by_id_upload($nik){
		$response = false;
		$this->db->join("tbl_kary", "tbl_kary.nik = transaksi.nik", "left");
		$query = $this->db->get_where('transaksi',array('transaksi.nik' => $nik));
		if($query && $query->num_rows()){
			$response = $query->result_array();
		}
		return $response;
	}
	public function get_filter_history($filter = '',$limit_offset = array()){
		$this->db->join("tbl_kary", "tbl_kary.nik = transaksi.nik", "left");
		if(!empty($filter)){
			$query = $this->db->get_where("transaksi",$filter,$limit_offset['limit'],$limit_offset['offset']);
		}else{
			$query = $this->db->get("transaksi",$limit_offset['limit'],$limit_offset['offset']);
		}
		return $query->result();
	}
	public function count_total_filter_history($filter = array()){
		if(!empty($filter)){
			$query = $this->db->get_where("transaksi",$filter);
		}else{
			$query = $this->db->get("transaksi");
		}
		return $query->num_rows();
	}
}