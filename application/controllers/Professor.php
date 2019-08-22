<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Professor extends CI_Controller {
	function __construct(){
    parent:: __construct();
  }
  //vista principal
	public function index()
	{
		$data['title']="Profesor";
		$fields = array('usuario_id' => $this->session->userdata('id_user'));
		$data['groups']=$this->model_group->get_groups($fields);
		$this->load->view('head',$data);
		$this->load->view('navbar');
		$this->load->view('professor/view_groups');
		$this->load->view('foot');
	}

	//funciones de los grupos
  public function add_group()
  {
    //se establecen reglas de validacion
    $this->form_validation->set_rules('nombre','grupo','required|min_length[3]|alpha_numeric|max_length[7]|trim|is_unique[grupo.nombre]');
    //personalizacion de reglas de validacion
    $this->form_validation->set_message('required', 'El campo %s es obligatorio');
    $this->form_validation->set_message('is_unique', 'El %s ya existe');
    $this->form_validation->set_message('alpha_numeric', 'El campo %s solo debe contener números y letras');
    $this->form_validation->set_message('required', 'El campo %s es obligatorio');
    $this->form_validation->set_message('max_length', 'El campo %s no debe de contener más de 7 caracteres');
    $this->form_validation->set_message('min_length', 'El campo %s no debe de contener menos de 3 caracteres');
    //personalizacion de delimitadores
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger text-center">', '</div>');
    if (!$this->form_validation->run())
    {
    	$data['title']="Registrar grupo";
      $this->load->view('head',$data);
      $this->load->view('navbar');      
      $this->load->view('professor/view_add_group');
      $this->load->view('foot');
    }
    else
    {
      $fields = array(
        'nombre' => $this->input->post('nombre'),
        'usuario_id' => $this->session->userdata('id_user')
      );
      $add=$this->model_group->insert_group($fields);
      if($add){
          $this->session->set_flashdata('msg','<div class="alert alert-success"> Grupo agregado correctamente</div>');
      }else{
          $this->session->set_flashdata('msg','<div class="alert alert-danger"> Error grupo no agregado</div>');
      }
      redirect('professor', 'refresh');
    }
  }

  public function edit_group($id=null)
  {
    //se establecen reglas de validacion
    $this->form_validation->set_rules('nombre','grupo','required|min_length[3]|alpha_numeric|max_length[7]|trim');
    //personalizacion de reglas de validacion
    $this->form_validation->set_message('required', 'El campo %s es obligatorio');
    $this->form_validation->set_message('is_unique', 'El %s ya existe');
    $this->form_validation->set_message('alpha_numeric', 'El campo %s solo debe contener números y letras');
    $this->form_validation->set_message('required', 'El campo %s es obligatorio');
    $this->form_validation->set_message('max_length', 'El campo %s no debe de contener más de 7 caracteres');
    $this->form_validation->set_message('min_length', 'El campo %s no debe de contener menos de 3 caracteres');
    //personalizacion de delimitadores
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger text-center">', '</div>');
    if($this->form_validation->run()==FAlSE){
      $data = array();        
      if($id){
        $fields = array('id_grupo' => $id);
        $data['group']= $this->model_group->get_group($fields);
      }
      $data['title']='Modificar grupo';
      $this->load->view('head',$data);
      $this->load->view('navbar');
      $this->load->view('professor/view_edit_group');
      $this->load->view('foot');
    }else{
      if($this->input->post("edit_grupo")){
        $fields = array(
          'id_grupo' => $id,
          'nombre' =>  $this->input->post('nombre')
        );
        $mod= $this->model_group->update_group($fields);
        //redirect('profesor');
        if($mod){
          $this->session->set_flashdata('correcto', '<div class="alert alert-success"> grupo editado correctamente</div>');
        }else{
          $this->session->set_flashdata('incorrecto', '<div class="alert alert-danger"> Error grupo no editado </div>');
        }
        redirect('professor');
      }else{
        redirect('professor');
      }    
    }   
  }

  public function del_group()
  {
    $id = $this->input->post("id_grupo");
    $fields = array('id_grupo' => $id );
    $this->model_group->delete_group($fields);
    redirect('professor', 'refresh');
  }

  //funciones de los alumnos
  public function show_students($id_grupo=null)
  {
    if($id_grupo)
    {
      $fields = array(
        'grupo_id' => $id_grupo,
        'rol' => 3 );  
      $data['students'] = $this->model_student->get_students_group($fields);            
      $data['title'] = 'Lista de alumnos en el grupo';
      $data['id_group'] = $id_grupo;
      $this->load->view('head',$data);
      $this->load->view('navbar');
      $this->load->view('professor/view_students');
      $this->load->view('foot');
    }
    else
    {
      redirect('professor', 'refresh');
    }
  }

  public function add_student($id_grupo=null)
  {
    //se establecen reglas de validacion
    $this->form_validation->set_rules('nombre', 'nombre', 'trim|required|alpha|min_length[3]');
    $this->form_validation->set_rules('ap_paterno', 'apellido paterno', 'trim|required|alpha|min_length[3]',
      array('max_length'=>'El campo %s debe contener mas de 3 caracteres'));
    $this->form_validation->set_rules('ap_materno', 'apellido materno', 'trim|required|alpha|min_length[3]');
    $this->form_validation->set_rules('matricula', 'matricula','trim|required|alpha_numeric|min_length[5]|is_unique[usuario.matricula]',
      array('min_length'=>'El campo %s debe contener mas de 5 caracteres'));
    $this->form_validation->set_rules('password', 'contraseña','trim|required|min_length[8]|alpha_numeric',
      array('min_length'=>'El campo %s debe contener mas de 8 caracteres'));
    //personalizacion de reglas de validacion
    $this->form_validation->set_rules('conf_password', 'confirmar contraseña','required|matches[password]');
    $this->form_validation->set_message('required', 'El campo %s requerido');
    $this->form_validation->set_message('alpha_numeric', 'El campo %s solo debe contener números y letras');
    $this->form_validation->set_message('alpha', 'El campo %s solo debe contener letras'); 
    $this->form_validation->set_message('is_unique', 'El campo %s ya existe');
    $this->form_validation->set_message('matches', 'El campo %s no coincide con el campo contraseña');
    $this->form_validation->set_message('min_length', 'El campo %s debe contener más de 3 caracteres');
    //personalizacion de delimitadores
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger text-center">', '</div>');
    if($this->form_validation->run()==FAlSE)
    {
      $data['title']='Registrar Alumno';
      $data['id_grupo'] = $id_grupo;
      $this->load->view('head',$data);
      $this->load->view('navbar');
      $this->load->view('professor/view_add_student');
      $this->load->view('foot');
    }
    else
    {
      if($this->input->post("submit"))
      {  
        $fields = array
        (
          'nombre' =>  $this->input->post("nombre"), 
          'apellido_paterno' =>  $this->input->post("ap_paterno"),
          'apellido_materno' =>  $this->input->post("ap_materno"),
          'matricula' =>  $this->input->post("matricula"),
          'contrasenia' =>  md5($this->input->post("password"))
        );               
        $this->model_user->insert_user($fields);
        $std=$this->model_user->last_user();
        $fields = array
        (
          'usuario_id' => $std->id_usuario,
          'grupo_id' => $id_grupo
        );
        $add=$this->model_user->insert_std($fields);
        if($add==true){
            $this->session->set_flashdata('msg', '<div class="alert alert-success">Alumno agregado correctamente</div>');
        }else{
            $this->session->set_flashdata('msg', '<div class="alert alert-danger"> Error alumno no agregado</div>');
        }
        redirect('professor/show_students/'.$id_grupo);
      }//fin del input submit
      else{
        redirect('professor/show_students/'.$id_grupo);
      }
    }//fin de form validation
  }

  public function students_file($id_grupo=null)
  {
    if($this->input->post('archivo'))
    {
      $filename=$_FILES["file"]["name"];
      $info = new SplFileInfo($filename);
      $extension = pathinfo($info->getFilename(), PATHINFO_EXTENSION);

      if($extension == 'csv')
      {
        $filename = $_FILES['file']['tmp_name'];
        $handle = fopen($filename, "r");

        while( ($data = fgetcsv($handle, 1000, '"') ) !== FALSE )
        {
          //$consulta = $this->db->query("LOAD DATA LOCAL INFILE '$ruta' INTO TABLE isr FIELDS TERMINATED BY ',' LINES TERMINATED BY '".'\r\n'."' (isr.lim_inferior, isr.cuota_fija, isr.porcentaje);");
          $fields = array(
            'matricula' => $data[0],
            'apellido_paterno' => $data[1],
            'apellido_materno' => $data[2],
            'nombre' => $data[3],
            'contrasenia' =>  md5($data[0])
          );

          $this->model_user->insert_user($fields);
          $std=$this->model_user->last_user();
          $fields = array
          (
            'usuario_id' => $std->id_usuario,
            'grupo_id' => $id_grupo
          );
          $add=$this->model_user->insert_std($fields);
        }
        fclose($handle);

        $this->session->set_flashdata('msg', '<div class="alert alert-success">Alumno agregado correctamente</div>');
        
        redirect('professor/show_students/'.$id_grupo);
      }
      else
      {
        $this->session->set_flashdata('msg', '<div class="alert alert-danger"> Error alumno no agregado</div>');
        redirect('professor/show_students/'.$id_grupo);
      }
    }

  }
  
  public function edit_student($id=null,$id_group=null)
  {
    //se establecen reglas de validacion
    $this->form_validation->set_rules('nombre', 'nombre', 'trim|required|alpha|min_length[3]');
    $this->form_validation->set_rules('ap_paterno', 'apellido paterno', 'trim|required|alpha|min_length[3]',
      array('max_length'=>'El campo %s debe contener mas de 3 caracteres'));
    $this->form_validation->set_rules('ap_materno', 'apellido materno', 'trim|required|alpha|min_length[3]');
    $this->form_validation->set_rules('matricula', 'matricula','trim|required|alpha_numeric|min_length[5]',
      array('min_length'=>'El campo %s debe contener mas de 5 caracteres'));
    //personalizacion de reglas de validacion
    $this->form_validation->set_message('required', 'El campo %s requerido');
    $this->form_validation->set_message('alpha_numeric', 'El campo %s solo debe contener solo números y letras');
    $this->form_validation->set_message('is_unique', 'El campo %s ya existe');
    $this->form_validation->set_message('matches', 'El campo %s no coincide con el campo contraseña');
    $this->form_validation->set_message('min_length', 'El campo %s debe contener más de 3 caracteres');
    //personalizacion de delimitadores
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger text-center">', '</div>');    
    if($this->form_validation->run()==FAlSE)
    {
      $fields = array('id_usuario' => $id);
      $data['student']=$this->model_user->get_user($fields);
      $data['id_group'] = $id_group;
      $data['title']='Editar alumno';
      $this->load->view('head',$data);
      $this->load->view('navbar');
      $this->load->view('professor/view_edit_student');
      $this->load->view('foot');
    }else{
      if($this->input->post("submit")){
        $fields = array(
          'id_usuario' => $id,
          'nombre' => $this->input->post('nombre'),
          'apellido_paterno' => $this->input->post('ap_paterno'),
          'apellido_materno' => $this->input->post('ap_materno'),
          'matricula' => $this->input->post('matricula')
        );
        $mod= $this->model_user->update_user($fields);
        if($mod){
          $this->session->set_flashdata('msg', '<div class="alert alert-success">Alumno editado correctamente</div>');
        }else{
          $this->session->set_flashdata('msg', '<div class="alert alert-danger"> Error alumno no editado</div>');
        }
        redirect('professor/show_students/'.$id_group);
      }
      else
      {
        redirect('professor/show_students/'.$id_group);
      }    
    }   
  }

  public function edit_password($id=null,$id_group=null){
    //reglas de validacion
    $this->form_validation->set_rules('password','contraseña','trim|required|min_length[8]');
    $this->form_validation->set_rules('password_c','comfirmacion de contraseña','trim|required|matches[password]|min_length[8]');
    //personalizacion de reglas
    $this->form_validation->set_message('required', 'El campo %s requerido');
    $this->form_validation->set_message('matches', 'Las contaseñas no coinciden');
    $this->form_validation->set_message('min_length', 'El campo %s debe contener más de 8 caracteres');
    //personalizacion de delimitadores
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger text-center">', '</div>');
    //$this->form_validation->set_message('required', 'El campo %s requerido');
    if($this->form_validation->run()==FAlSE)
    {
      $data['title']='Editar contraseña de alumno';
      $data['id_student']=$id;
      $data['id_group']=$id_group;
      $this->load->view('head',$data);
      $this->load->view('navbar');
      $this->load->view('professor/view_edit_pass_student');
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
          $this->session->set_flashdata('correcto', '<div class="alert alert-success">Contraseña editado correctamente</div>');
        }else{
          $this->session->set_flashdata('incorrecto', '<div class="alert alert-danger"> Error contraseña no editado</div>');
        }
        redirect('professor/show_students/'.$id_group);
      }else{
        redirect('professor/show_students/'.$id_group);
      }    
    }   
  }

  public function del_student($id_group)
  {
    $fields = array(
      'id_usuario' => $this->input->post("id_alumno")
    );
    $this->model_user->delete_user($fields);
    redirect('professor/show_students/'.$id_group, 'refresh');
  }

  //funciones del catalogo de cuentas
  public function account_catalog()
  {
    $fields = array('usuario_id' => $this->session->userdata('id_user'));
    $catalog=$this->model_account->get_catalog($fields);
    $data['types']=$this->model_account->get_tipo_cuenta();
    $data['clasifications']=$this->model_account->get_clasificacion_cuenta();
    if ($catalog)//entra si el usuario ya tiene por lo menos una cuenta
    {
      $data['title'] = 'Catalogo de cuentas';
      $data['accounts'] = $catalog;
      $this->load->view('head',$data);
      $this->load->view('navbar');
      $this->load->view('professor/view_catalog_user');
      $this->load->view('foot');
    }
    else
    {
      redirect('professor/create_account_catalog');
    }
  }

  public function create_account_catalog()
  {
    $accounts= $this->model_account->get_std_accounts();
    if($this->input->post('crear_catalogo'))
    {
      foreach ($accounts as $account) 
      {
        if($this->input->post('cuenta'.$account->id_catalogo_estandar)){
          $fields = array(
            'tipo_id' => $account->tipo_id,
            'clasificacion_id' => $account->clasificacion_id,
            'nombre' => $account->nombre,
            'usuario_id' => $this->session->userdata('id_user')
          );
          $acc=$this->model_account->insert_account($fields);

          $retVal = ($acc) ? $this->session->set_flashdata('msg', '<div class="alert alert-danger">No ha seleccionado ninguna cuenta</div>'):$this->session->set_flashdata('msg', '<div class="alert alert-success">Cuentas seleccionadas</div>');
        }else{
          //redirect('professor/add_account');
        }
      }
      redirect('professor/account_catalog');

    }
    else
    {
      $data['accounts'] = $accounts;
      $data['title'] = 'Catálogo de cuentas';
      $data['accounts'] = $this->model_account->get_std_accounts();
      $data['types']=$this->model_account->get_tipo_cuenta();
      $data['clasifications']=$this->model_account->get_clasificacion_cuenta();
      $this->load->view('head',$data);
      $this->load->view('navbar');
      $this->load->view('professor/view_catalog');
      $this->load->view('foot');

    }
  }


   public function add_account()
  {
    //se establecen reglas de validacion
    $this->form_validation->set_rules('nombre','nombre','required|min_length[3]|alpha_numeric_spaces|max_length[50]|trim|is_unique[catalogo_usuario.nombre]',array('required' => 'El campo %s es obligatorio' ));
    $this->form_validation->set_rules('tipo','tipo de cuenta','required');
     $this->form_validation->set_rules('clasificacion','clasificacion de cuenta','required');
    //personalizacion de reglas de validacion
    $this->form_validation->set_message('required', 'Este campo debe tener un valor diferente al predeterminado');
    $this->form_validation->set_message('is_unique', 'El %s ya existe');
    $this->form_validation->set_message('alpha_numeric_spaces', 'El campo %s no acepta caracteres especiales');
    $this->form_validation->set_message('max_length', 'El campo %s no debe de contener más de 50 caracteres');
    $this->form_validation->set_message('min_length', 'El campo %s no debe de contener menos de 3 caracteres');
   

    //personalizacion de delimitadores
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger text-center">', '</div>');
    if (!$this->form_validation->run())
    {
      $data['title']="Agregar cuenta";
      $fields = array('usuario_id' => $this->session->userdata('id_user'));
      $data['view_tipo']=$this->model_account->get_tipo_cuenta($fields);
      $data['view_clasificacion']=$this->model_account->get_clasificacion_cuenta($fields);
      $this->load->view('head', $data);
      $this->load->view('navbar');      
      $this->load->view('professor/view_add_account');
      $this->load->view('foot');
    }
    else
    {
      $fields = array(
        'tipo_id' => $this->input->post('tipo'),
        'clasificacion_id' => $this->input->post('clasificacion'),
        'nombre' => $this->input->post('nombre'),
        'usuario_id' => $this->session->userdata('id_user')
      );
      $add=$this->model_account->insert_account($fields);
      if($add==true){
          $this->session->set_flashdata('correcto','<div class="alert alert-success">Cuenta agregado correctamente</div>');
      }else{
          $this->session->set_flashdata('incorrecto','<div class="alert alert-danger"> Error cuenta no agregado</div>');
      }
      redirect('professor/account_catalog', 'refresh');
    }
  }

  public function del_account()
  {
    $id = $this->input->post("id_catalogo_usuario");
    $fields = array('id_catalogo_usuario' => $id );
    $this->model_account->delete_account($fields);
    redirect('professor/account_catalog', 'refresh');
  }

   public function edit_account($id=null)
  {
    //reglas de validacion
    $this->form_validation->set_rules('nombre','nombre','required|min_length[3]|alpha|max_length[50]|trim|is_unique[catalogo_usuario.nombre]');
    //personalizacion de reglas de validacion
    $this->form_validation->set_message('required', 'El campo %s es obligatorio');
    $this->form_validation->set_message('is_unique', 'El %s ya existe');
    $this->form_validation->set_message('alpha_numeric', 'El campo %s solo debe contener letras');
    $this->form_validation->set_message('required', 'El campo %s es obligatorio');
    $this->form_validation->set_message('max_length', 'El campo %s no debe de contener más de 50 caracteres');
    $this->form_validation->set_message('min_length', 'El campo %s no debe de contener menos de 3 caracteres');
    //personalizacion de delimitadores
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger text-center">', '</div>');   
    if($this->form_validation->run()==FAlSE)
    {      
      if($id)
      {
        $fields = array('id_catalogo_usuario' => $id);
        $data['account']= $this->model_account->get_account($fields);            
      }
      $data['title']='Editar cuenta';
      $this->load->view('head', $data);
      $this->load->view('navbar');
      $this->load->view('professor/view_edit_account');
      $this->load->view('foot');
    }
    else
    {
      if($this->input->post("edit_cuenta"))
      {
        $fields = array(
          'id_catalogo_usuario' => $id,
          'nombre' => $this->input->post('nombre'),
        );
        $mod  = $this->model_account->update_account($fields);
        if($mod)
        {
          $this->session->set_flashdata('msg', '<div class="alert alert-success">Cuenta editado correctamente</div>');
        }else{
          $this->session->set_flashdata('msg', '<div class="alert alert-danger"> Error Cuenta no editada</div>');
        }
        redirect('professor/account_catalog');
      }
      else
      {
        redirect('professor/account_catalog');
      }    
    }   
  }

  public function edit_professor($id=null)
  {
    //reglas de validacion
    $this->form_validation->set_rules('nombre', 'nombre', 'required|alpha|min_length[3]');
    $this->form_validation->set_rules('ap_paterno', 'apellido paterno', 'required|alpha|min_length[3]');
    $this->form_validation->set_rules('ap_materno', 'apellido materno', 'required|alpha|min_length[3]');
    $this->form_validation->set_rules('usuario', 'matricula','required|min_length[3]');
    //personalizacion de reglas
    $this->form_validation->set_message('required', 'El campo %s requerido');
    $this->form_validation->set_message('min_length','El campo %s no debe contener menos de tres caracteres');
    $this->form_validation->set_message('alpha_numeric_spaces', 'el campo %s no debe tener caracteres especiales');
    $this->form_validation->set_message('numeric', 'El campo %s debe contener solo números');
    $this->form_validation->set_message('alpha', 'El campo %s debe contener solo letras');
    //personalizacion de delimitadores
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger text-center">', '</div>');    
    if($this->form_validation->run()==FAlSE)
    {      
      if($id)
      {
        $fields = array('id_usuario' => $id);
        $data['profesor']= $this->model_user->get_user($fields);            
      }
      $data['title']='Editar profesor';
      $this->load->view('head', $data);
      $this->load->view('navbar');
      $this->load->view('professor/view_edit_professor');
      $this->load->view('foot');
    }
    else
    {
      if($this->input->post("submit"))
      {
        $fields = array(
          'id_usuario' => $id,
          'nombre' => $this->input->post('nombre'),
          'apellido_paterno' => $this->input->post('ap_paterno'),
          'apellido_materno' => $this->input->post('ap_materno'),
          'matricula' => $this->input->post('usuario')
        );
        $mod  = $this->model_user->update_user($fields);
        if($mod)
        {
          $datos_usuario = array( 'nombre' => $this->input->post('nombre'));
          $this->session->set_userdata($datos_usuario);
          $this->session->set_flashdata('msg', '<div class="alert alert-success">Profesor editado correctamente</div>');
        }else{
          $this->session->set_flashdata('msg', '<div class="alert alert-danger"> Error profesor no editado</div>');
        }
        redirect('professor');
      }
      else
      {
        redirect('professor');
      }    
    }   
  }
}