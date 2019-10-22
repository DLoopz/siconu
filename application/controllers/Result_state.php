<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Result_state extends CI_Controller {
	public function index()
	{
		/*$data['title']="Rayado Diario";
		$this->load->view('head',$data);
		$this->load->view('student/view_daybook');
		$this->load->view('foot');*/
	}

	public function state($id_empresa=null)
	{
    $fields = array('id_empresa' => $id_empresa );
    $data['exercise']=$this->model_exercise->get_exercise($fields);
		$data['id_empresa']=$id_empresa;
		$fields = array('empresa_id' => $id_empresa );
    $data['registers']=$this->model_result->get_accounts_rslt($fields);
		$fields = array('grupo_id' => $this->session->userdata('grupo'));
    $data['catalog']=$this->model_account->get_catalog_student($fields);
		$data['title']="Estado de resultados";
		$this->load->view('head',$data);
		$this->load->view('navbar');
    $this->load->view('student/nabvar_options');
		$this->load->view('student/view_result_state');
		$this->load->view('foot');
	}
}