<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$viewData = new stdClass();//arayüze veri göndermeye yarar
		$viewData->url="home";//sayfada $url diye çekilebilir
		$this->load->view('index',$viewData);//ilk açılacak sayfa // welcome_message viewi açılsın
	}

}
