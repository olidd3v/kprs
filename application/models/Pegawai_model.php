<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai_model extends CI_Model {
	function __construct(){
        parent::__construct();
		$this->table = "pegawai";
		$this->select_default = '*, pegawai.id as id';
	}
	
	public function get_all($limit_offset = array()){
		$this->db->select($this->select_default);
		$this->db->join('jabatan', 'jabatan.id = pegawai.id_jabatan', 'left');
		$this->db->order_by("pegawai.id", "desc");
		if(!empty($limit_offset)){
			$query = $this->db->get($this->table,$limit_offset['limit'],$limit_offset['offset']);
		}else{
			$query = $this->db->get($this->table);
		}
		return $query->result();
	}
	public function count_total(){
		$query = $this->db->get("pegawai");
		return $query->num_rows();
	}
	public function get_all_array($filter = ''){
		if(!empty($filter)) {
			$query = $this->db->get_where("pegawai",$filter);
		}else{
			$query = $this->db->get_where("pegawai");
		}
		return $query->result_array();
	}
	public function get_last_id(){
		$this->db->order_by('id', 'DESC');

		$query = $this->db->get("pegawai",1,0);
		return $query->result();
	}
	public function insert($data){
		$this->db->insert('pegawai', $data);
	}
	public function update($id,$data){
		$this->db->where('id', $id);
		$this->db->update('pegawai', $data);
	}
	public function get_by_id($id){
		$response = false;
		$query = $this->db->get_where('pegawai',array('id' => $id));
		if($query && $query->num_rows()){
			$response = $query->result_array();
		}
		return $response;
	}
	public function delete($id){
		$this->db->delete('pegawai', array('id' => $id));
	}
	public function get_filter($filter = '',$limit_offset = array(),$is_array = false){
        $this->db->select($this->select_default);
		$this->db->join('jabatan', 'jabatan.id = pegawai.id_jabatan', 'left');
		$this->db->order_by("pegawai.id", "desc");
		if(!empty($filter)){
			$this->db->where($filter);
			if($limit_offset){
				$this->db->limit($limit_offset['limit'],$limit_offset['offset']);
			}
			$query = $this->db->get($this->table);
		}else{
			$query = $this->db->get($this->table,$limit_offset['limit'],$limit_offset['offset']);
		}
		if($is_array){
			return $query->result_array();
		}else{
			return $query->result();
		}
	}
	public function count_total_filter($filter = array()){
		if(!empty($filter)){
			$query = $this->db->get_where("pegawai",$filter);
		}else{
			$query = $this->db->get("pegawai");
		}
		return $query->num_rows();
	}
}