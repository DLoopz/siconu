<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function index()
	{
		$data['title']="Admin";
		$fields = array('rol' => 2);
		$data['profesor']=$this->model_user->get_users($fields);
		$this->load->view('head',$data);
		$this->load->view('navbar');
		$this->load->view('admin/view_professor');
		$this->load->view('foot');
	}

	public function edit_password($id=null)
	{
		//reglas de validacion
    $this->form_validation->set_rules('password','contraseña','trim|required');
    $this->form_validation->set_rules('password_c','contraseña','trim|required|matches[password]');
    //personalizacion de reglas
    $this->form_validation->set_message('required', 'El campo %s requerido');
    $this->form_validation->set_message('matches', 'Las contaseñas no coinciden');
    //personalizacion de delimitadores
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger text-center">', '</div>');
    if($this->form_validation->run()==FAlSE)
    {
      $fields = array('id_usuario' =>$id);        
      if($id)
      {
        $data['profesor']= $this->model_user->get_user($fields);
      }
      $data['title']='cambiar contraseña profesor';
      $this->load->view('head', $data);
      $this->load->view('navbar');
      $this->load->view('admin/view_edit_password');
      $this->load->view('foot');
    }
    else
    {
      if($this->input->post("submit"))
      {
        $password = $this->input->post('password');/*md5($this->input->post('password'));*/
        $fields = array(
        	'id_usuario' => $id,
        	'contrasenia' => md5($password)
        );
        $mod= $this->model_user->update_user($fields);
        $this->email->from('e32wsaq1@gmail.com', 'SICONU: Credenciales');
        $this->email->to($correo);
        $this->email->subject('Usuario del sistema FEP');
        $this->email->message("Su nueva contraseña es: ".$password);
        $this->email->send();
        if(!$mod){
          $this->session->set_flashdata('msg', '<div class="alert alert-success">Contraseña editado exitosamente</div');
        }
        else
        {
          $this->session->set_flashdata('msg', '<div class="alert alert-danger">Error contraseña no editado</div');
        }
        redirect('admin');
      }
      else
      {
        redirect('admin');
      }    
    }   
  }
    
  public function add_professor()
  {
    $this->form_validation->set_rules('correo', 'correo','valid_email|required|min_length[8]|max_length[50]|is_unique[usuario.matricula]');
    //Personalizamos las reglas
    $this->form_validation->set_message('required', 'El %s es un campo obligatorio');
    $this->form_validation->set_message('valid_email', 'El %s no es valido');
    $this->form_validation->set_message('min_length', 'El %s debe tener al menos 8 caracteres');
    $this->form_validation->set_message('max_length', 'El %s no debe tener mas de 50 caracteres');
    $this->form_validation->set_message('is_unique', 'El %s ya esta registrado');
    //personalizacion de delimitadores
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger text-center">', '</div>');
	  if($this->form_validation->run() == FAlSE)
	  {
	  	$data['title']="Alta profesores";
	  	$this->load->view('head',$data);
	    $this->load->view('navbar');
	    $this->load->view("admin/view_add_professor");
	    $this->load->view("foot");
	  }
	  else
	  {
	    if($this->input->post("submit"))
	    {
        $correo = $this->input->post("correo");
        $num = rand(100,999);
	    	$fields = array(
	    		'rol' => 2,
	    		'nombre' =>  'profesor', 
          'apellido_paterno' =>  'profesor',
          'apellido_materno' =>  'profesor',
          'matricula' => $correo,
          'contrasenia' =>  md5('profesor'.$num)
	      );
        $add=$this->model_user->insert_user($fields);
        $this->email->from('e32wsaq1@gmail.com', 'SICONU: Credenciales');
        $this->email->to($correo);
        $this->email->subject('Usuario del sistema FEP');
        $this->email->message('Su usuario de ingreso es: '.$correo.', Su contraseña es: profesor'.$num);
        $this->email->send();
        if($add==true)
        {
          $this->session->set_flashdata('msg', '<div class="alert alert-success">Profesor añadido exitosamente</div>');
        }
        else
        {
          $this->session->set_flashdata('msg', '<div class="alert alert-danger">Error profesor no añadido</div>');
        }
	      redirect('admin');
	    }
	    else
	    {
	    	redirect('admin');
	    }
	  }//fin de form validation
  }

  public function eliminar_professor(){
    $fields = array('id_usuario' => $this->input->post("id_profesor"));
    $this->model_user->delete_user($fields);
    redirect('admin', 'refresh');
  }

  public function vaciarBD()
  {
    $this->RootModel->vaciarBD();
    redirect('admin', 'refresh');
  }
}