<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daybook extends CI_Controller {
	public function index()
	{
		/*$data['title']="Rayado Diario";
		$this->load->view('head',$data);
		$this->load->view('student/view_daybook');
		$this->load->view('foot');*/
	}

	public function book($id=null)
	{
		$data['title']="Rayado Diario";
		$fields = array('empresa_id' => $id );
		$data['entries']=$this->model_daybook->get_entries($fields);
    $data['registers']=$this->model_daybook->get_all_registers($fields);
		$data['id_empresa']=$id;
		$this->load->view('head',$data);
		$this->load->view('navbar');
		$this->load->view('student/view_daybook');
		$this->load->view('foot');
	}

	public function add_entry($id_empresa=null)
	{
    //se establecen reglas de validacion
    $this->form_validation->set_rules('concepto','nombre del asiento','required|min_length[3]|max_length[50]');
    $this->form_validation->set_rules('fecha_asiento','fecha del asiento','required');
    //personalizacion de reglas de validacion
    $this->form_validation->set_message('required', 'El campo %s es obligatorio');
    $this->form_validation->set_message('max_length', 'El campo %s no debe de contener más de 7 caracteres');
    $this->form_validation->set_message('min_length', 'El campo %s no debe de contener menos de 3 caracteres');
    //personalizacion de delimitadores
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger text-center">', '</div>');
    if (!$this->form_validation->run())
    {
    	$data['title']="Alumno: Agregar Asiento";
			$data['id_empresa']=$id_empresa;
			$this->load->view('head',$data);
			$this->load->view('navbar');
			$this->load->view('student/view_add_entry');
			$this->load->view('foot');
    }
    else
    {
      $fields = array(
        'empresa_id' => $id_empresa,
        'concepto' => $this->input->post('concepto'),
        'fecha' => $this->input->post('fecha_asiento') 
      );
      $add=$this->model_daybook->insert_entry($fields);
      if($add)
      {
        $this->session->set_flashdata('msg','<div class="alert alert-success"> Asiento agregado correctamente</div>');
      }
      else
      {
        $this->session->set_flashdata('msg','<div class="alert alert-danger"> Error asiento no agregado</div>');
      }
      //$this->session->set_flashdata('id_emp',$id_empresa);
      redirect('daybook/register/'.$id_empresa.'/'.$add->id_asiento, 'refresh');
    }
  }

  public function register($id_empresa=null, $id_asiento=null)
	{
		$data['title']="Regsitros  de Asiento";
		$fields = array('asiento_id' => $id_asiento);
		$data['registers']=$this->model_daybook->get_registers($fields);
		$data['id_asiento']=$id_asiento;
    $data['id_empresa']=$id_empresa;
		$this->load->view('head',$data);
		$this->load->view('navbar');
		$this->load->view('student/view_registers');
		$this->load->view('foot');
	}

	public function add_register($id_empresa=null,$id_asiento=null)
	{
    //se establecen reglas de validacion
    $this->form_validation->set_rules('cuenta','cuenta del registro','required');
    $this->form_validation->set_rules('cantidad','cantidad','numeric|required|min_length[1]|max_length[11]');
    //personalizacion de reglas de validacion
    $this->form_validation->set_message('required', 'El campo %s es obligatorio');
    $this->form_validation->set_message('max_length', 'El campo %s no debe de contener más de 7 caracteres');
    $this->form_validation->set_message('min_length', 'El campo %s no debe de contener menos de 3 caracteres');
    //personalizacion de delimitadores
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger text-center">', '</div>');
    $fields = array('usuario_id' => $this->session->userdata('grupo'), );
    $accounts=$this->model_account->get_catalog($fields);
    if (!$this->form_validation->run())
    {
    	$data['title']="Alumno: Agregar Asiento";
			$data['id_asiento']=$id_asiento;
      $data['id_empresa']=$id_empresa;
			$data['accounts']=$accounts;
			$this->load->view('head',$data);
			$this->load->view('navbar');
			$this->load->view('student/view_add_register');
			$this->load->view('foot');
    }
    else
    {
      $id= $this->input->post('cuenta');
      for ($i=0; $i < count($accounts); $i++) { 
        if ($accounts[$i]->id_catalogo_usuario==$id){
          $a=$i;
        }
      }
    	$folio= ($accounts[$a]->tipo_id*1000)+($accounts[$a]->clasificacion_id*100)+$a+1;
      if ($this->input->post('movimiento')=='cargo') {
        $fields = array(
          'asiento_id' => $id_asiento,
          'folio'      => $folio,
          'catalogo_usuario_id' =>$id,
          'cuenta' => $accounts[$a]->nombre,
          'debe' => $this->input->post('cantidad')
        );
      }
      else
      {
        $fields = array(
          'asiento_id' => $id_asiento,
          'folio'      => $folio,
          'catalogo_usuario_id' =>$id,
          'cuenta' => $accounts[$a]->nombre,
          'haber' => $this->input->post('cantidad')
        );
      }
      $add=$this->model_daybook->insert_register($fields);
      if($add)
      {
        $this->session->set_flashdata('msg','<div class="alert alert-success"> Registro agregado correctamente</div>');
      }
      else
      {
        $this->session->set_flashdata('msg','<div class="alert alert-danger"> Error registro no agregado</div>');
      }
      redirect('daybook/register/'.$id_empresa.'/'.$id_asiento, 'refresh');
    }
  }

  public function delete_entry($id_empresa=null,$id_asiento=null)
  {
    $fields = array('empresa_id' =>$id_empresa);
    $del=$this->model_daybook->last_entry($fields);
    $fields = array('id_asiento' => $del->id_asiento);
    $del=$this->model_daybook->delete_entry($fields);
    if($del)
      {
        $this->session->set_flashdata('msg','<div class="alert alert-success"> Asiento borrado correctamente</div>');
      }
      else
      {
        $this->session->set_flashdata('msg','<div class="alert alert-danger"> Error asiento no borado</div>');
      }
      redirect('daybook/book/'.$id_empresa, 'refresh');
  }

  public function delet_entry($id_empresa=null)
  {
    $fields = array('id_asiento' => $this->input->post('id_entry'));
    $del=$this->model_daybook->delete_entry($fields);
    if($del)
      {
        $this->session->set_flashdata('msg','<div class="alert alert-success"> Asiento borrado correctamente</div>');
      }
      else
      {
        $this->session->set_flashdata('msg','<div class="alert alert-danger"> Error asiento no borado</div>');
      }
      redirect('daybook/book/'.$id_empresa, 'refresh');
  }

  public function delete_register($id_empresa=null,$id_asiento=null)
  {
    $fields = array('id_registro' => $this->input->post('id_register'));
    $del=$this->model_daybook->delete_register($fields);
    if($del)
      {
        $this->session->set_flashdata('msg','<div class="alert alert-success"> Asiento borrado correctamente</div>');
      }
      else
      {
        $this->session->set_flashdata('msg','<div class="alert alert-danger"> Error asiento no borado</div>');
      }
      redirect('daybook/register/'.$id_empresa.'/'.$id_asiento, 'refresh');
  }

  public function edit_entry($id_empresa=null,$id_asiento=null)
  {
    //se establecen reglas de validacion
    $this->form_validation->set_rules('concepto','nombre del asiento','required|min_length[3]|max_length[50]');
    $this->form_validation->set_rules('fecha_asiento','fecha del asiento','required');
    //personalizacion de reglas de validacion
    $this->form_validation->set_message('required', 'El campo %s es obligatorio');
    $this->form_validation->set_message('max_length', 'El campo %s no debe de contener más de 7 caracteres');
    $this->form_validation->set_message('min_length', 'El campo %s no debe de contener menos de 3 caracteres');
    //personalizacion de delimitadores
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger text-center">', '</div>');
    if (!$this->form_validation->run())
    {
      $data['title']="Alumno: Agregar Asiento";
      $data['id_empresa']=$id_empresa;
      $fields = array('id_asiento' => $id_asiento);
      $data['entry']=$this->model_daybook->get_entry($fields);
      $this->load->view('head',$data);
      $this->load->view('navbar');
      $this->load->view('student/view_upd_entry');
      $this->load->view('foot');
    }
    else
    {
      $fields = array(
        'id_asiento' => $id_asiento,
        'empresa_id' => $id_empresa,
        'concepto' => $this->input->post('concepto'),
        'fecha' => $this->input->post('fecha_asiento') 
      );
      $upd=$this->model_daybook->update_entry($fields);
      if($upd)
      {
        $this->session->set_flashdata('msg','<div class="alert alert-success"> Asiento modificado correctamente</div>');
      }
      else
      {
        $this->session->set_flashdata('msg','<div class="alert alert-danger"> Error asiento no modificado</div>');
      }
      //$this->session->set_flashdata('id_emp',$id_empresa);
      redirect('daybook/register/'.$id_empresa.'/'.$id_asiento, 'refresh');
    }
  }
}