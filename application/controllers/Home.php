<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {
	function __construct(){
        parent::__construct();
		// Check Session Login
		if(!isset($_SESSION['logged_in'])){
			redirect(site_url('auth/login'));
		}
	}
}
