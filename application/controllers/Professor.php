<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Professor extends CI_Controller {
	function __construct()
  {
    parent:: __construct();
    if ($this->session->userdata('activo') != TRUE)
    {
      redirect('');
    }
    if ($this->session->userdata('rol') != 2)
    {
      redirect('');
    }
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

  public function edit_password_p($id=null){
    //reglas de validacion
    $this->form_validation->set_rules('password','Nueva Contraseña','trim|required|min_length[8]');
    $this->form_validation->set_rules('password_c','Confirmar Contraseña','trim|required|matches[password]|min_length[8]');
    //personalizacion de reglas
    $this->form_validation->set_message('required', '%s es un campo obligatorio');
    $this->form_validation->set_message('matches', 'Las contraseñas no coinciden');
    $this->form_validation->set_message('min_length', '%s debe contener más de 8 caracteres');
    //personalizacion de delimitadores
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger text-center">', '</div>');

    if($this->form_validation->run()==FAlSE)
    {
      $data['title']='Editar contraseña de profesor';
      $data['id_user']=$id;
      $this->load->view('head',$data);
      $this->load->view('navbar');
      $this->load->view('professor/view_edit_pass');
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

	//funciones de los grupos
  public function add_group()
  {
    //se establecen reglas de validacion
    $this->form_validation->set_rules('nombre','Nombre del Grupo','required|min_length[3]|alpha_numeric|max_length[7]|trim|is_unique[grupo.nombre]');
    //personalizacion de reglas de validacion
    $this->form_validation->set_message('required', '%s es un campo obligatorio');
    $this->form_validation->set_message('is_unique', '%s ya existe');
    $this->form_validation->set_message('alpha_numeric', '%s solo debe contener números y letras');
    $this->form_validation->set_message('max_length', '%s no debe contener más de 7 caracteres');
    $this->form_validation->set_message('min_length', '%s debe contener al menos 3 caracteres');
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
          $this->session->set_flashdata('msg','<div class="alert alert-success text-center"> Grupo agregado correctamente</div>');
      }else{
          $this->session->set_flashdata('msg','<div class="alert alert-danger text-center"> Error grupo no agregado</div>');
      }
      redirect('professor', 'refresh');
    }
  }

  public function edit_group($id=null)
  {
    //se establecen reglas de validacion
    $this->form_validation->set_rules('nombre','Grupo','required|min_length[3]|alpha_numeric|max_length[7]|trim');
    //personalizacion de reglas de validacion
    $this->form_validation->set_message('required', '%s es un campo obligatorio');
    $this->form_validation->set_message('is_unique', '%s ya existe');
    $this->form_validation->set_message('alpha_numeric', '%s solo debe contener números y letras');
    $this->form_validation->set_message('max_length', '%s no debe contener más de 7 caracteres');
    $this->form_validation->set_message('min_length', '%s debe contener al menos 3 caracteres');
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
          $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"> Grupo editado correctamente</div>');
        }else{
          $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center"> Error grupo no editado </div>');
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
    $del=$this->model_group->delete_group($fields);
    if($del){
      $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"> Grupo eliminado correctamente</div>');
    }else{
      $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center"> Error grupo no eliminado </div>');
    }
    redirect('professor', 'refresh');
  }

  public function del_groups($group=NULL)
  {
    if ($this->input->post('del_groups')) {

      $del = $this->model_group->delete_groups();
      if($del){
        $this->session->set_flashdata('msg', '<div class="alert alert-success text-center"> Grupos eliminado correctamente</div>');
      }else{
        $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center"> Error grupo no eliminado </div>');
      }
      redirect('professor');
    }
    redirect('professor');
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
    $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|min_length[3]|callback_alpha_spaces');
    $this->form_validation->set_rules('ap_paterno', 'Apellido Paterno', 'trim|required|min_length[3]|callback_alpha_spaces',
      array('max_length'=>'%s debe contener al menos 3 caracteres'));
    $this->form_validation->set_rules('ap_materno', 'Apellido Materno', 'trim|required|min_length[3]|callback_alpha_spaces');
    $this->form_validation->set_rules('matricula', 'Matrícula','trim|required|numeric|min_length[5]|is_unique[usuario.matricula]',
      array('min_length'=>'%s debe contener al menos 5 caracteres'));
    //personalizacion de reglas de validacion
    $this->form_validation->set_message('alpha', '%s solo debe contener letras');
    $this->form_validation->set_message('required', '%s es un campo obligatorio');
    $this->form_validation->set_message('alpha_spaces', '%s debe contener solo letras y espacios');
    $this->form_validation->set_message('is_unique', '%s ya existe');
    $this->form_validation->set_message('alpha_numeric', '%s no debe contener caracteres especiales');
    $this->form_validation->set_message('min_length', '%s debe contener más de 3 caracteres');
    $this->form_validation->set_message('numeric', '%s debe contener solo números');
    //$this->form_validation->set_message('alpha_spaces', '%s no debe contener numeros');


    //personalizacion de delimitadores
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger text-center">', '</div>');
    if($this->form_validation->run()==FAlSE)
    {
      $data['title']='Registrar Alumno';
      $data['id_grupo'] = $id_grupo;
      $this->load->view('head', $data);
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
          'contrasenia' =>  md5($this->input->post("matricula"))
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
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Alumno agregado correctamente</div>');
        }else{
            $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center"> Error alumno no agregado</div>');
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

        $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Alumnos agregados correctamente<br>La contraseña del alumno es su matrícula</div>');
        
        redirect('professor/show_students/'.$id_grupo);
      }
      else
      {
        $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center"> Error alumno no agregado</div>');
        redirect('professor/show_students/'.$id_grupo);
      }
    }

  }
  
  public function edit_student($id=null,$id_group=null)
  {
    //se establecen reglas de validacion
    $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required|callback_alpha_spaces|min_length[3]|alpha');
    $this->form_validation->set_rules('ap_paterno', 'Apellido Paterno', 'trim|required|callback_alpha_spaces|min_length[3]|alpha',
      array('max_length'=>'%s debe contener mas de 3 caracteres'));
    $this->form_validation->set_rules('ap_materno', 'Apellido Materno', 'trim|required|callback_alpha_spaces|min_length[3]|alpha');
    $this->form_validation->set_rules('matricula', 'Matrícula','trim|required|numeric|min_length[5]',
      array('min_length'=>'%s debe contener mas de 5 caracteres'));
    //personalizacion de reglas de validacion
    $this->form_validation->set_message('required', '%s es un campo obligatorio');
    $this->form_validation->set_message('alpha', '%s no debe contener caracteres especiales');
    $this->form_validation->set_message('numeric', '%s debe contener solo números');
    $this->form_validation->set_message('alpha_spaces', '%s debe contener solo letras y espacios');
    $this->form_validation->set_message('is_unique', '%s ya existe');
    $this->form_validation->set_message('matches', '%s no coincide con el campo contraseña');
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
          $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Alumno editado correctamente</div>');
        }else{
          $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center"> Error alumno no editado</div>');
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
    $this->form_validation->set_rules('password','Nueva Contraseña','trim|required|min_length[8]');
    $this->form_validation->set_rules('password_c','Confirmar Nueva Contraseña','trim|required|matches[password]|min_length[8]');
    //personalizacion de reglas
    $this->form_validation->set_message('required', '%s es un campo obligatorio');
    $this->form_validation->set_message('matches', 'Las contraseñas no coinciden');
    $this->form_validation->set_message('min_length', '%s debe contener más de 8 caracteres');
    //personalizacion de delimitadores
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger text-center">', '</div>');
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
          $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Contraseña editada correctamente</div>');
        }else{
          $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center"> Error contraseña no editada</div>');
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
    $del=$this->model_user->delete_user($fields);
    if($del){
      $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Alumno eliminado correctamente</div>');
    }else{
      $this->session->set_flashdata('msg','<div class="alert alert-danger text-center"> Error alumno no eliminado</div>');
    }
    redirect('professor/show_students/'.$id_group, 'refresh');
  }

  public function del_students($id_group=NULL)
  {
    $fields = array(
      'grupo_id' => $id_group,
      'rol' => 3
    );

    $list_group = $this->model_user->delete_users($fields);

    //echo '<pre>'.print_r($list_group,1).'</pre>';

    foreach ($list_group as $lg) {
      $fields = array('id_usuario' => $lg->usuario_id );
      $del = $this->model_user->delete_user($fields);
    }

    if(isset($del)){
      $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Alumnos eliminados</div>');
    }else{
      $this->session->set_flashdata('msg','<div class="alert alert-danger text-center"> Error alumno no eliminado</div>');
    }
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
      $data['title'] = 'Catálogo de cuentas';
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
    $fields = array('usuario_id' => $this->session->userdata('id_user'));
    $catalog=$this->model_account->get_catalog($fields);
    if ($catalog) {
      redirect('professor/account_catalog');
    }

    $accounts= $this->model_account->get_std_accounts();
    if($this->input->post('crear_catalogo'))
    {
      $retVal=0;
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
          $retVal++;
        }
      }

      ($retVal > 0 )? $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Catálogo creado</div>'):$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">No ha seleccionado ninguna cuenta</div>');

      ($retVal)? redirect('professor/account_catalog') : redirect('professor/create_account_catalog') ;
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
    $aux=$this->input->post('tipo');
    //se establecen reglas de validacion
    $this->form_validation->set_rules('nombre','Nombre','required|min_length[3]|alpha_numeric_spaces|max_length[50]|trim|is_unique[catalogo_usuario.nombre]',array('required' => '%s es un campo obligatorio' ));
    $this->form_validation->set_rules('tipo','Tipo de Cuenta','required');
    if ($aux==3) {
      $aux=1;
    }
    else
    {
     $this->form_validation->set_rules('clasificacion','Clasificación de Cuenta','required');
     $aux=$this->input->post('clasificacion');
    }
    //personalizacion de reglas de validacion
    $this->form_validation->set_message('required', '%s debe tener un valor diferente al predeterminado');
    $this->form_validation->set_message('is_unique', '%s ya existe');
    $this->form_validation->set_message('alpha_numeric_spaces', '%s no debe contener caracteres especiales');
    $this->form_validation->set_message('max_length', '%s no debe de contener más de 50 caracteres');
    $this->form_validation->set_message('min_length', '%s no debe de contener menos de 3 caracteres');
   

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
        'clasificacion_id' => $aux,
        'nombre' => $this->input->post('nombre'),
        'usuario_id' => $this->session->userdata('id_user')
      );
      $add=$this->model_account->insert_account($fields);
      if($add){
          $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Cuenta agregada correctamente</div>');
      }else{
          $this->session->set_flashdata('msg','<div class="alert alert-danger text-center"> Error cuenta no agregada</div>');
      }
      redirect('professor/account_catalog', 'refresh');
    }
  }

  public function del_account()
  {
    $id_user = $this->session->userdata('id_user');
    $id = $this->input->post("id_catalogo_usuario");
    $fields = array('id_catalogo_usuario' => $id, 'usuario_id' => $id_user);

    $del=$this->model_account->delete_account($fields);

    if($del){
      $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Cuenta eliminada correctamente</div>');
    }else{
      $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Error, la cuenta esta siendo usada</div>');
    }
    redirect('professor/account_catalog', 'refresh');
  }

  public function del_accounts()
  {
    if ($this->input->post('del_cat'))
    {
      $fields = array('usuario_id' => $this->session->userdata('id_user'));
      $del = $this->model_account->delete_account($fields);
      if($del){
        $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Catálogo eliminado correctamente</div>');
        redirect('professor/create_account_catalog');
      }else{
        $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">Error catálogo no eliminado</div>');
        redirect('professor/account_catalog');
      }
    }
    else
    {
      redirect('');
    }
  }

   public function edit_account($id=null)
  {
    //reglas de validacion
    $this->form_validation->set_rules('nombre','Nombre','required|min_length[3]|alpha_numeric_spaces|max_length[50]|trim|is_unique[catalogo_usuario.nombre]');
    //personalizacion de reglas de validacion
    $this->form_validation->set_message('required', '%s es un campo obligatorio');
    $this->form_validation->set_message('is_unique', '%s ya existe');
    $this->form_validation->set_message('alpha_numeric_spaces', '%s solo debe contener letras');
    $this->form_validation->set_message('max_length', '%s no debe contener más de 50 caracteres');
    $this->form_validation->set_message('min_length', '%s no debe contener menos de 3 caracteres');
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
          $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Cuenta editado correctamente</div>');
        }else{
          $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center"> Error Cuenta no editada</div>');
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
    $this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]|callback_alpha_spaces');
    $this->form_validation->set_rules('ap_paterno', 'Apellido Paterno', 'required|min_length[3]|callback_alpha_spaces');
    $this->form_validation->set_rules('ap_materno', 'Apellido Materno', 'required|min_length[3]|callback_alpha_spaces');
    $this->form_validation->set_rules('usuario', 'Corrreo electrónico','required|valid_email');
    //personalizacion de reglas
    $this->form_validation->set_message('required', '%s es un campo obligatorio');
    $this->form_validation->set_message('min_length','%s no debe contener menos de tres caracteres');
    $this->form_validation->set_message('alpha_spaces', '%s no debe tener caracteres especiales');
    $this->form_validation->set_message('valid_email', '%s no es un formato de correo válido');
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
          $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Profesor editado correctamente</div>');
        }else{
          $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center"> Error profesor no editado</div>');
        }
        redirect('professor');
      }
      else
      {
        redirect('professor');
      }    
    }   
  }
  public function alpha_spaces($str)
  {
    $resultado = intval(preg_replace("/[^0-9]+/", '', $str, 10));
    if ($resultado)
    {
      return FALSE;
    }
    else
    {
      return TRUE;
    }
  }
}
