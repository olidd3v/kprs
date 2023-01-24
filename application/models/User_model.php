<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
	private $table;
	private $select_default;
	function __construct(){
        parent::__construct();
		$this->table = "user";
		$this->select_defaultx = 'user.id AS id, code_user, username, photo_profile, password, role, name, resto.code_resto as code_resto, name_resto';
		// $this->select_defaultx = 'user.id AS id, supplier_name, total_price, total_item,user.date AS date, purchase_data.subtotal as sub';
		$this->select_default = 'user.id AS id, code_user, username, photo_profile, password, role, name, resto.code_resto as code_resto, name_resto';

	}
	
	public function get_all($limit_offset = array()){
		$this->db->select($this->select_defaultx);
		$this->db->join('resto', 'resto.code_resto = user.code_resto', 'left');
		// $this->db->join('purchase_data', 'purchase_data.transaction_id = user.id', 'left');
		$this->db->order_by("user.id", "desc");
		if(!empty($limit_offset)){
			$query = $this->db->get($this->table,$limit_offset['limit'],$limit_offset['offset']);
		}else{
			$query = $this->db->get($this->table);
		}
		return $query->result();
	}
	public function count_total(){
		$query = $this->db->get($this->table);
		return $query->num_rows();
	}
	public function get_all_array(){
		$query = $this->db->order_by("date", "desc")->get($this->table);
		return $query->result_array();
	}
	public function get_last_id(){
		$this->db->order_by('id', 'DESC');

		$query = $this->db->get($this->table,1,0);
		return $query->result();
	}
	public function insert($data){
		$this->db->insert($this->table, $data);
	}
	public function update($id,$data){
		$this->db->where('id', $id);
		$this->db->update($this->table, $data);
	}
	public function get_by_id($id){
		$response = false;
		$query = $this->db->get_where($this->table,array('id' => $id));
		if($query && $query->num_rows()){
			$response = $query->result_array();
		}
		return $response;
	}
	public function delete($id){
		$this->db->delete($this->table, array('id' => $id));
	}
	public function get_detail($id,$array = false){
		$this->db->select('*, user.id as id');
		$this->db->from('user');
		$this->db->join('resto', 'resto.code_resto = user.code_resto', 'left');
		$this->db->where('user.user_code',$id);
		$query = $this->db->get();
		if($array){
			return $query->result_array();
		}else{
			return $query->result();
		}
	}
	public function get_filter($filter = '',$limit_offset = array(),$is_array = false){
		$this->db->select($this->select_default);
		$this->db->join('resto', 'resto.code_resto = user.code_resto', 'left');
		$this->db->order_by("id", "desc");
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
	public function get_filter_csv($filter = ''){
		$this->db->select('user.id AS id, supplier_name, total_price, total_item,user.date AS date,
					supplier_id,supplier_address,supplier_phone,transaction_id,category.category_name,product.id as product_id,quantity,price_item,subtotal,product_name,product_desc');
		$this->db->join('supplier', 'supplier.id = user.supplier_id');

		$this->db->join('purchase_data', 'purchase_data.transaction_id = user.id');
		$this->db->join('product', 'product.id = purchase_data.product_id');
		$this->db->join('category', 'category.id = purchase_data.category_id');

		$this->db->order_by("user.date", "desc");
		$filter['type'] = 1;
		if(!empty($filter)){
			$this->db->where($filter);
		}
		$query = $this->db->get($this->table);
		return $query->result_array();
	}
	public function count_total_filter($filter = array()){
		if(!empty($filter)){
			$query = $this->db->order_by("date", "desc")->get_where($this->table,$filter);
		}else{
			$query = $this->db->order_by("date", "desc")->get($this->table);
		}
		return $query->num_rows();
	}
	public function insert_purchase_data($data){
		$this->db->insert('purchase_data', $data);
	}
	public function delete_purchase_data_trx($transaction_id){
		$this->db->delete('purchase_data', array('transaction_id' => $transaction_id));
	}
}