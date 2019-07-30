<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {
	public function index()
	{
		$data['title']="Student";
		$this->load->view('head',$data);
		$this->load->view('navbar');
		$this->load->view('daybook');
		$this->load->view('foot');
	}
}
