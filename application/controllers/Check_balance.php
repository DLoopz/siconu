<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Check_balance extends CI_Controller
{
	public function check($id_empresa=null)
	{
    $fields = array('usuario_id' => $this->session->userdata('grupo'), );
    $data['accounts']=$this->model_account->get_std_accounts();
		$fields = array('empresa_id' => $id_empresa );
    $data['registers']=$this->model_daybook->get_all_registers($fields);
    $fields = array('id_empresa' => $id_empresa );
    $data['exercise']=$this->model_exercise->get_exercise($fields);
		$data['title']="Balanza de comprobación";
		$data['id_empresa']=$id_empresa;
		$this->load->view('head',$data);
		$this->load->view('navbar');
    $this->load->view('student/nabvar_options');
		$this->load->view('student/view_check_balance');
		$this->load->view('foot');
	}
}