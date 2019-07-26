<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daybook extends CI_Controller {
	public function index()
	{
		$data['title']="Rayado Diario";
		$this->load->view('head',$data);
		$this->load->view('daybook');
	}
}
