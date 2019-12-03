<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{
  function __construct()
  {
    parent:: __construct();
    if ($this->session->userdata('activo') != TRUE)
    {
      redirect('');
    }
    if ($this->session->userdata('rol') != 1)
    {
      redirect('');
    }
  }
  
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
    $this->form_validation->set_rules('password','Nueva Contraseña','trim|required|min_length[8]');
    $this->form_validation->set_rules('password_c','Confirmar Nueva Contraseña ','trim|required|matches[password]');
    //personalizacion de reglas
    $this->form_validation->set_message('required', '%s es un campo obligatorio');
    $this->form_validation->set_message('matches', 'Las contraseñas no coinciden');
    $this->form_validation->set_message('min_length', '%s debe tener como mínimo 8 caracteres');
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
        $fields = array('id_usuario' => $id );
        $correo = $this->model_user->get_user($fields);
        $correo = $correo->matricula;

        $password = $this->input->post('password');/*md5($this->input->post('password'));*/
        $fields = array(
          'id_usuario' => $id,
          'contrasenia' => md5($password)
        );
        $mod= $this->model_user->update_user($fields);

        $this->load->library('email');
        $this->email->from('siconu@novauniversitas.edu.mx', 'SICONU:Credenciales');  //de paerte de
        $this->email->to($correo);                   //para quien
        //$this->email->cc('another@another-example.com');
        //$this->email->bcc('them@their-example.com');
        $this->email->subject('Usuario del sistema SICONU');
        $this->email->message("Su usuario de ingreso es: <b>{$correo}</b> y su contraseña es <b>{$password}</b>");
        
        $this->email->send();

        
        if($mod==true)
        {
          $msg_correo='<div class="alert alert-success text-center">Correo enviado</div>';
        }
        else
        {
          $msg_correo='<div class="alert alert-danger text-center">Correo no enviado</div>';
        }

        if($mod){
          $this->session->set_flashdata('msg', $msg_correo.'<div class="text-center alert alert-success">Contraseña editada exitosamente</div');
        }
        else
        {
          $this->session->set_flashdata('msg', $msg_correo.'<div class="text-center alert alert-danger">Error contraseña no editada</div');
        }
        redirect('admin');

        /*correo*/
      }
      else
      {
        redirect('admin');
      }    
    }   
  }


  public function add_professor()
  {
    $this->form_validation->set_rules('correo', 'Correo electrónico','valid_email|required|min_length[8]|max_length[50]|is_unique[usuario.matricula]');
    //Personalizamos las reglas
    $this->form_validation->set_message('required', '%s es un campo obligatorio');
    $this->form_validation->set_message('valid_email', '%s no es válido');
    $this->form_validation->set_message('min_length', '%s debe tener al menos 8 caracteres');
    $this->form_validation->set_message('max_length', '%s no debe tener mas de 50 caracteres');
    $this->form_validation->set_message('is_unique', '%s ya esta registrado');
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
        $add = $this->model_user->insert_user($fields);
        $this->load->library('email');
        $this->email->from('siconu@novauniversitas.edu.mx', 'SICONU:Credenciales');  //de paerte de
        $this->email->to($correo);                   //para quien
        //$this->email->cc('another@another-example.com');
        //$this->email->bcc('them@their-example.com');
        $this->email->subject('Usuario del sistema SICONU');
        $this->email->message("Su usuario de ingreso es: <b>{$correo}</b> y su contraseña es <b>profesor{$num}</b>");
        
        $this->email->send();
        if($add==true)
        {
          $msg_correo='<div class="alert alert-success text-center">Correo enviado</div>';
        }
        else
        {
          $msg_correo='<div class="alert alert-danger text-center">Correo no enviado</div>';
        }

        if($add)
        {
          $this->session->set_flashdata('msg', $msg_correo.'<div class="text-center alert alert-success text-center">Profesor añadido exitosamente</div>');
        }
        else
        {
          $this->session->set_flashdata('msg', $msg_correo.'<div class="text-center alert alert-danger text-center">Error profesor no añadido</div>');
        }
        redirect('admin');

        /*correo*/
      }
      else
      {
        redirect('admin');
      }
    }//fin de form validation
  }

  public function eliminar_professor(){
    $fields = array('id_usuario' => $this->input->post("id_profesor"));
    $del=$this->model_user->delete_user($fields);
    if($del)
      {
        $this->session->set_flashdata('msg', '<div class="text-center alert alert-success text-center">Profesor eliminado exitosamente</div>');
      }
      else
      {
        $this->session->set_flashdata('msg', '<div class="text-center alert alert-danger text-center">Error profesor no eliminado</div>');
      }
    redirect('admin', 'refresh');
  }

  public function clean_data()
  {
    $del=$this->model_system->empty_db();
    if($del)
    {
      $this->session->set_flashdata('msg', '<div class="text-center alert alert-success text-center">Limpieza ejecutada</div>');
    }
    else
    {
      $this->session->set_flashdata('msg', '<div class="text-center alert alert-danger text-center">Error La base no se limpio</div>');
    }
    redirect('admin', 'refresh');
  }

  public function recover_password($id=null)
  {
    //reglas de validacion
    $this->form_validation->set_rules('password','contraseña','trim|required|valid_email');
    //personalizacion de reglas
    $this->form_validation->set_message('required', '%s es un campo obligatorio');
    $this->form_validation->set_message('valid_email', '%s no es un formato de correo válido');
    //personalizacion de delimitadores
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger text-center">', '</div>');
    //$this->form_validation->set_message('required', 'El campo %s requerido');
    if($this->form_validation->run()==FAlSE)
    {
      $data['title']='Recuperar contraseña de profesor';
      $data['id_user']=$id;
      $this->load->view('head',$data);
      $this->load->view('navbar');
      $this->load->view('professor/view_recover_pass');
      $this->load->view('foot');
    }else{
      if($this->input->post("submit")){
        $fields = array(
          'id_usuario' => $id,
          'contrasenia' =>md5($this->input->post('password'))
        );
        $mod= $this->model_user->update_user($fields);
        //redirect('profesor');
        if($mod){
          $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Contraseña editada correctamente</div>');
        }else{
          $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center"> Error contraseña no editada</div>');
        }
        redirect('professor');
      }else{
        redirect('professor');
      }
    }
  }
}
