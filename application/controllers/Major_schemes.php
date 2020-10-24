<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Major_schemes extends CI_Controller
{
  
  function __construct()
  {
    parent:: __construct();
    if ($this->session->userdata('activo') != TRUE)
    {
      redirect('');
    }
    if ($this->session->userdata('rol') == 1)
    {
      redirect('');
    }
  }
  
  public function schemes($id_empresa)
	{
    $fields = array('empresa_id' => $id_empresa );
    $data['entries']=$this->model_daybook->get_entries($fields);
    $data['title']="Esquemas de mayor";
    $fields = array('empresa_id' => $id_empresa);
    $data['asientos'] = $this->model_schemes->get_asientos($fields);
    $data['registros'] = $this->model_schemes->get_all($fields);
    $data['cuentas'] = $this->model_schemes->get_cuentas($fields);
    $data['parciales'] = $this->model_schemes->get_partials($fields);
    $data['id_empresa'] = $id_empresa;
    
    $data['catalog']=$this->model_account->get_std_accounts();

    
    $this->load->view('head',$data);
    $this->load->view('navbar');
    $this->load->view('student/nabvar_options');
    $this->load->view('student/view_major_schemes');
    $this->load->view('pdf');
    $this->load->view('foot');
    
	}
}
