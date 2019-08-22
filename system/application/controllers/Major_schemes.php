<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Major_schemes extends CI_Controller {
	public function schemes($id_empresa)
	{
    $data['title']="Esquemas de ma mayor";
    $fields = array('empresa_id' => $id_empresa);
    //$data['entries']=$this->model_daybook->get_entries($fields);
    $data['registers']=$this->model_schemes->get_registers($fields);
    $data['partials']=$this->model_daybook->get_partials($fields);
    $data['id_empresa']=$id_empresa;
    $fields = array('usuario_id' => $this->session->userdata('grupo'), );
    $data['accounts']=$this->model_account->get_catalog($fields);
    $this->load->view('head',$data);
    $this->load->view('navbar');
    $this->load->view('student/view_major_schemes');
    $this->load->view('foot');
	}
}