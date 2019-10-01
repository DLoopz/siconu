<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {
	//vista principal
	public function index()
	{
		$data['title']="Alumno: Ejercicios";
		$fields = array('usuario_id' => $this->session->userdata('id_user'));
		$data['exercises']=$this->model_exercise->get_exercises($fields);
		$this->load->view('head',$data);
		$this->load->view('navbar');
		$this->load->view('student/view_exercise');
		$this->load->view('foot');
	}

    public function edit_password(){
    //reglas de validacion
    $this->form_validation->set_rules('password_act','contraseña actual','trim|required|min_length[8]|callback_thisPassword');
    $this->form_validation->set_rules('password','contraseña','trim|required|min_length[8]');
    $this->form_validation->set_rules('password_c','comfirmacion de contraseña','trim|required|matches[password]|min_length[8]');
    //personalizacion de reglas
    $this->form_validation->set_message('required', '%s es un campo requerido');
    $this->form_validation->set_message('matches', 'Las contraseñas no coinciden');
    $this->form_validation->set_message('min_length', '%s debe contener más de 8 caracteres');
    $this->form_validation->set_message('thisPassword', '%s es incorrecta');
    //personalizacion de delimitadores
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger text-center">', '</div>');
    //$this->form_validation->set_message('required', 'El campo %s requerido');
    if($this->form_validation->run()==FAlSE)
    {
      $data['title']='Editar contraseña de alumno';
      $this->load->view('head',$data);
      $this->load->view('navbar');
      $this->load->view('student/view_edit_pass');
      $this->load->view('foot');
    }else{
      if($this->input->post("submit")){
        $fields = array(
          'id_usuario' => $this->session->userdata('id_user'),
          'contrasenia' =>md5($this->input->post('password'))
        );
        $mod= $this->model_user->update_user($fields);
        //redirect('profesor');
        if($mod){
          $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Contraseña editada correctamente</div>');
        }else{
          $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center"> Error contraseña no editada</div>');
        }
        redirect('student');
      }else{
        redirect('student');
      }    
    }   
  }

	public function add_exercise()
	{
    $id=$this->session->userdata('id_user');
    //se establecen reglas de validacion
    $this->form_validation->set_rules('nombre','Nombre del Ejercicio','required|min_length[3]|max_length[50]');
    //personalizacion de reglas de validacion
    $this->form_validation->set_message('required', '%s es un campo obligatorio');
    $this->form_validation->set_message('max_length', '%s no debe contener más de 50 caracteres');
    $this->form_validation->set_message('min_length', '%s no debe contener menos de 3 caracteres');

    //personalizacion de delimitadores
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger text-center">', '</div>');
    if (!$this->form_validation->run())
    {
    	$data['title']="Alumno: Agregar ejercicios";
			$data['id_user']=$id;
			$this->load->view('head',$data);
			$this->load->view('navbar');
			$this->load->view('student/view_add_exercise');
			$this->load->view('foot');
    }
    else
    {
      $fields = array(
        'usuario_id' => $id,
        'nombre' => $this->input->post('nombre')
      );
      $add=$this->model_exercise->insert_exercise($fields);
      if($add){
          $this->session->set_flashdata('msg','<div class="alert alert-success"> Ejercicio agregado correctamente</div>');
      }else{
          $this->session->set_flashdata('msg','<div class="alert alert-danger"> Error ejercicio no agregado</div>');
      }
      redirect('student', 'refresh');
    }
  }

  public function edit_exercise($id=null)
  {
    //se establecen reglas de validacion
    $this->form_validation->set_rules('nombre','Nombre del Ejercicio','required|min_length[3]|max_length[50]');
    //personalizacion de reglas de validacion
    $this->form_validation->set_message('required', '%s es un campo obligatorio');
    $this->form_validation->set_message('max_length', '%s no debe contener más de 50 caracteres');
    $this->form_validation->set_message('min_length', '%s no debe contener menos de 3 caracteres');
    //personalizacion de delimitadores
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger text-center">', '</div>');
    if($this->form_validation->run()==FAlSE){       
      if($id){
        $fields = array('id_empresa' => $id);
        $data['exercise']= $this->model_exercise->get_exercise($fields);
      }
      $data['title']='Modificar exercicio';
      $this->load->view('head',$data);
      $this->load->view('navbar');
      $this->load->view('student/view_edit_exercise');
      $this->load->view('foot');
    }else{
      if($this->input->post("edit_exercise")){
        $fields = array(
          'id_empresa' => $id,
          'nombre' =>  $this->input->post('nombre')
        );
        $mod= $this->model_exercise->update_exercise($fields);
        if($mod){
          $this->session->set_flashdata('msg', '<div class="alert alert-success"> Ejercicio editado correctamente</div>');
        }else{
          $this->session->set_flashdata('msg', '<div class="alert alert-danger"> Error ejercicio no editado </div>');
        }
        redirect('student');
      }else{
        redirect('student');
      }    
    }   
  }

  public function del_exercise()
  {
    $id = $this->input->post("id_empresa");
    $fields = array('id_empresa' => $id );
    $this->model_exercise->delete_exercise($fields);
    redirect('student', 'refresh');
  }

  public function close_exercise($id=null)
  {
    $fields = array(
      'id_empresa' => $id,
      'estado' =>  1
    );
    $mod= $this->model_exercise->update_exercise($fields);
    if($mod){
      $this->session->set_flashdata('msg', '<div class="alert alert-success"> Ejercicio editado correctamente</div>');
    }else{
      $this->session->set_flashdata('msg', '<div class="alert alert-danger"> Error ejercicio no editado </div>');
    }
    redirect('student');
  }

  public function thisPassword($str)
  {
    $fields = array('id_usuario' => $this->session->userdata('id_user'));
    $us = $this->model_user->get_user($fields);
    if ($us->contrasenia==md5($str)) {
      return true;
    }
    return false;
  }
}
