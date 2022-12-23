<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$viewData = new stdClass();
		$viewData->url="home";
		$this->load->view('index',$viewData);
	}

}
