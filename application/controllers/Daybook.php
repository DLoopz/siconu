<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$usuario_local = get_current_user();
require_once("/home/{$usuario_local}/dompdf/autoload.inc.php");
use Dompdf\Dompdf;

class Daybook extends CI_Controller {
  
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
    $data['partials']=$this->model_daybook->get_partials($fields);
    $fields = array('id_empresa' => $id );
    $data['exercise']=$this->model_exercise->get_exercise($fields);
		$data['id_empresa']=$id;
    $data['disabled']=false;
    $fields = array('id_empresa' => $id );
    $status = $this->model_daybook->get_status($fields);
    $newdata = array(
      'empresa' => $status->estado
    );
    $this->session->set_userdata($newdata);

		$this->load->view('head',$data);
		$this->load->view('navbar');
    $this->load->view('student/nabvar_options');
		$this->load->view('student/view_daybook');
    $this->load->view('pdf');
		$this->load->view('foot');

	}

	public function add_entry($id_empresa=null)
	{
    if ($this->session->userdata('empresa') == 1) {
      $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">No se puede editar el ejercicio</div>');
      redirect('daybook/book/'.$id_empresa);
    }
    //se establecen reglas de validacion
    $this->form_validation->set_rules('concepto','Nombre del Asiento','required|min_length[3]|max_length[50]');
    $this->form_validation->set_rules('fecha_asiento','Fecha del Asiento','required');
    //personalizacion de reglas de validacion
    $this->form_validation->set_message('required', '%s es un campo obligatorio');
    $this->form_validation->set_message('max_length', '%s no debe contener más de 50 caracteres');
    $this->form_validation->set_message('min_length', '%s no debe contener menos de 3 caracteres');
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
      if ($this->input->post('ajuste')) {
        $ajuste=1;
      }else{
        $ajuste=0;
      }
      $fields = array(
        'empresa_id' => $id_empresa,
        'descripcion' => $this->input->post('concepto'),
        'fecha' => $this->input->post('fecha_asiento'), 
        'ajuste' => $ajuste
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
      redirect('daybook/register/'.$id_empresa.'/'.$add->id_asiento, 'refresh');
    }
  }

  public function edit_entry($id_empresa=null,$id_asiento=null)
  {
    if ($this->session->userdata('empresa') == 1) {
      $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">No se puede editar el ejercicio</div>');
      redirect('daybook/book/'.$id_empresa);
    }
    //se establecen reglas de validacion
    $this->form_validation->set_rules('concepto','Nombre del Asiento','required|min_length[3]|max_length[50]');
    $this->form_validation->set_rules('fecha_asiento','Fecha del Asiento','required');
    //personalizacion de reglas de validacion
    $this->form_validation->set_message('required', '%s es un campo obligatorio');
    $this->form_validation->set_message('max_length', '%s no debe contener más de 50 caracteres');
    $this->form_validation->set_message('min_length', '%s no debe contener menos de 3 caracteres');
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
      $this->load->view('student/view_edit_entry');
      $this->load->view('foot');
    }
    else
    {
      $fields = array(
        'id_asiento' => $id_asiento,
        'empresa_id' => $id_empresa,
        'descripcion' => $this->input->post('concepto'),
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
      redirect('daybook/book/'.$id_empresa,'refresh');
    }
  }

  


//-----------funciones para los registros en los asientos
  public function register($id_empresa=null, $id_asiento=null,$edit=null)
	{
    if ($this->session->userdata('empresa') == 1) {
      $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">No se puede editar el ejercicio</div>');
      redirect('daybook/book/'.$id_empresa);
    }
		$data['title']="Registros  de Asiento";
		$fields = array('asiento_id' => $id_asiento);
		$data['registers']=$this->model_daybook->get_registers($fields);
    $data['partials']=$this->model_daybook->get_partials($fields);
		$data['id_asiento']=$id_asiento;
    $data['id_empresa']=$id_empresa;
    if (is_null($edit))
      $data['edit']=null;
    else
      $data['edit']=1;
		$this->load->view('head',$data);
		$this->load->view('navbar');
		$this->load->view('student/view_registers');
		$this->load->view('foot');
	}

	public function add_register($id_empresa=null,$id_asiento=null)
	{
    //se establecen reglas de validacion
    $this->form_validation->set_rules('cuenta','Cuenta del Registro','required');
    $this->form_validation->set_rules('movimiento','Movimiento','required');
    $this->form_validation->set_rules('cantidad','Cantidad','numeric|required|min_length[1]|max_length[11]|callback_notCero');
    //personalizacion de reglas de validacion
    $this->form_validation->set_message('required', '%s es un campo obligatorio');
    $this->form_validation->set_message('max_length', '%s no debe contener más de 50 caracteres');
    $this->form_validation->set_message('min_length', '%s no debe contener menos de 3 caracteres');
    $this->form_validation->set_message('notCero', '%s debe ser mayor a 0');
    //personalizacion de delimitadores
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger text-center">', '</div>');

    $fields = array('id_empresa' => $id_empresa);
    $exercise=$this->model_exercise->get_exercise($fields);

    if ($exercise->procedimiento==1) {      
      $data['types']=$this->model_account->get_tipo_cuenta();
      $fields = array('grupo_id' => $this->session->userdata('grupo'));
      $accounts=$this->model_account->get_catalog_student_inventarios($fields);
    }
    if ($exercise->procedimiento==2) {      
      $data['types']=$this->model_account->get_tipo_cuenta();
      $fields = array('grupo_id' => $this->session->userdata('grupo'));
      $accounts=$this->model_account->get_catalog_student($fields);
    }
    if ($exercise->procedimiento==3) {

      $data['types']=$this->model_account->get_tipo_cuenta_basica();
      $fields = array('grupo_id' => $this->session->userdata('grupo'));
      $accounts=$this->model_account->get_catalog_student_mercancias($fields);
    }
   

    if (!$this->form_validation->run())
    {
    	$data['title']="Alumno: Agregar Asiento";
			$data['id_asiento']=$id_asiento;
      $data['id_empresa']=$id_empresa;
			$data['accounts']=$accounts;
      $data['clasifications']=$this->model_account->get_clasificacion_cuenta();
      $fields = array('asiento_id' => $id_asiento);
      $data['registers']=$this->model_daybook->get_registers($fields);
			$this->load->view('head',$data);
			$this->load->view('navbar');
			$this->load->view('student/view_add_register');
			$this->load->view('foot');
    }
    else
    {
      $id= $this->input->post('cuenta');
      $indice=1;$clasificacion=1;$aux=0;
      for ($i=0; $i < count($accounts); $i++) { 
        if ($accounts[$i]->clasificacion_id!=$clasificacion){
          $indice=1;
          $clasificacion=$accounts[$i]->clasificacion_id;
        }
        if ($accounts[$i]->id_catalogo_usuario==$id){
          $a=$i;
          $aux=$indice;
        }
        $indice++;
      }
    	$folio= ($accounts[$a]->tipo_id*1000)+($accounts[$a]->clasificacion_id*100)+$aux;
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


  //-----------funciones para los registros parciales
  //guardar la cuenta vacia
  public function register_partial($id_empresa=null,$id_asiento=null,$id_registro=null)
  {

    if (is_null($id_registro)) {
      //se establecen reglas de validacion
      $this->form_validation->set_rules('cuenta','Cuenta del Registro','required');
      //personalizacion de reglas de validacion
      $this->form_validation->set_message('required', '%s es un campo obligatorio');
      $this->form_validation->set_message('max_length', '%s no debe contener más de 50 caracteres');
      $this->form_validation->set_message('min_length', '%s no debe de contener menos de 3 caracteres');
      //personalizacion de delimitadores
      $this->form_validation->set_error_delimiters('<div class="alert alert-danger text-center">', '</div>');
      $fields = array('grupo_id' => $this->session->userdata('grupo'), );
      $accounts=$this->model_account->get_catalog_student($fields);
      if (!$this->form_validation->run())
      {
         $this->session->set_flashdata('msg','<script type="text/javascript"> $(\'#myTab li:first-child a\').tab(\'show\')</script>');
        $data['title']="Alumno: Agregar Asiento";
        $data['id_asiento']=$id_asiento;
        $data['id_empresa']=$id_empresa;
        $data['accounts']=$accounts;

        // para mostrar la cuenta
        $fields = array('id_registro' => $id_registro);
        $cuenta = $this->model_daybook->get_partial($fields);
        $data['cuenta']= $cuenta;


        $this->load->view('head',$data);
        $this->load->view('navbar');
        $this->load->view('student/view_register_partial');
        $this->load->view('foot');
      }
      else
      {
        $id = $this->input->post('cuenta');
        for ($i=0; $i < count($accounts); $i++) { 
          if ($accounts[$i]->id_catalogo_usuario==$id){
            $a=$i;
          }
        }
        $folio= ($accounts[$a]->tipo_id*1000)+($accounts[$a]->clasificacion_id*100)+$a+1;
        $fields = array(
            'asiento_id' => $id_asiento,
            'folio'      => $folio,
            'catalogo_usuario_id' =>$id,
            'cuenta' => $accounts[$a]->nombre,
            'parcial' => 1
          );
        $add=$this->model_daybook->insert_register($fields);
        if($add)
        {
          $this->session->set_flashdata('msg','<div class="alert alert-success"> Registro agregado correctamente</div>');
        }
        else
        {
          $this->session->set_flashdata('msg','<div class="alert alert-danger"> Error registro no agregado</div>');
        }
        $fields = array('asiento_id' =>$id_asiento);
        $add=$this->model_daybook->last_register($fields);
        redirect('daybook/register_partial/'.$id_empresa.'/'.$id_asiento.'/'.$add->id_registro, 'refresh');
      }
    }
    else
    {
      $data['title']="Alumno: Agregar Asiento Parcial";
      $data['id_asiento']=$id_asiento;
      $data['id_empresa']=$id_empresa;
      $data['id_registro']=$id_registro;
      $fields = array('registro_id' => $id_registro);
      $data['partials']=$this->model_daybook->get_registers_partial($fields);
      // para mostrar la cuenta
      $fields = array('id_registro' => $id_registro);
      $data['cuenta'] = $this->model_daybook->get_partial($fields);

      $fields = array('id_empresa' => $id_empresa);
      $data['exercise']= $this->model_exercise->get_exercise($fields);
      $this->load->view('head',$data);
      $this->load->view('navbar');
      $this->load->view('student/view_register_partial');
      $this->load->view('foot');
    }
    
  }


  //llenar los parciales actualizando la cuenta en registro parcial
  public function add_register_partial($id_empresa=null,$id_asiento=null,$id_registro=null,$cuenta=null)
  {
    //se establecen reglas de validacion
    $this->form_validation->set_rules('concepto','Concepto','required|min_length[3]|max_length[50]|alpha_numeric_spaces');
    $this->form_validation->set_rules('cantidad','Cantidad','required|numeric');
    //personalizacion de reglas de validacion
    $this->form_validation->set_message('required', '%s es un campo obligatorio');
    $this->form_validation->set_message('numeric', '%s debe ser numérico');
    $this->form_validation->set_message('alpha_numeric_spaces', '%s no debe contener caracteres especiales');
    $this->form_validation->set_message('max_length', '%s no debe contener más de 50 caracteres');
    $this->form_validation->set_message('min_length', '%s no debe contener menos de 3 caracteres');
    //personalizacion de delimitadores
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger text-center">', '</div>');
    if (!$this->form_validation->run())
    {
      $this->session->set_flashdata('msg','<script type="text/javascript"> $(\'#myTab li:first-child a\').tab(\'show\')</script>');
      $data['title']="Alumno: Agregar Asiento parcial";
      $data['id_asiento']=$id_asiento;
      $data['id_empresa']=$id_empresa;
      $data['id_registro']=$id_registro;
      $fields = array('registro_id' => $id_registro);
      $data['partials']=$this->model_daybook->get_registers_partial($fields);
      
      $fields = array('id_registro' => $id_registro);
      $cuenta = $this->model_daybook->get_partial($fields);
      $data['cuenta']= $cuenta;

      $data['modal'] = 'parciales';


      $this->load->view('head',$data);
      $this->load->view('navbar');
      $this->load->view('student/view_register_partial');
      $this->load->view('foot');
    }
    else
    {
      //para la tabla registro parcial
      $fields = array(
          'registro_id' => $id_registro,
          'concepto' => $this->input->post('concepto'),
          'cantidad' =>$this->input->post('cantidad')
        );
      $add=$this->model_daybook->insert_register_partial($fields);

      
      /*
      $fields = array(
        'id_registro' => $id_registro,
        'parcial' => 1
      );
      $act_parc = $this->model_daybook->partial($fields);
      */


      if($add)
      {
        $this->session->set_flashdata('msg','<div class="alert alert-success"> Registro agregado correctamente</div>');
      }
      else
      {
        $this->session->set_flashdata('msg','<div class="alert alert-danger"> Error registro no agregado</div>');
      }
      $fields = array('asiento_id' =>$id_asiento);
      $add=$this->model_daybook->last_register($fields);
      $id_registro = $add->id_registro;

      redirect('daybook/register_partial/'.$id_empresa.'/'.$id_asiento.'/'.$add->id_registro, 'refresh');
    }
  }


  public function edit_register_partial($id_empresa=null,$id_asiento=null,$id_registro=null,$cantidad=null)
  {
    if (!is_null($cantidad)){

      //se establecen reglas de validacion
      $this->form_validation->set_rules('operacion','Operación del Registro','required');
      //personalizacion de reglas de validacion
      $this->form_validation->set_message('required', '%s es un campo obligatorio');
      //personalizacion de delimitadores
      $this->form_validation->set_error_delimiters('<div class="alert alert-danger text-center">', '</div>');
      if (!$this->form_validation->run())
      {
        $data['title']="Alumno: Agregar Asiento parcial";
        $data['id_asiento']=$id_asiento;
        $data['id_empresa']=$id_empresa;
        $data['id_registro']=$id_registro;
        $fields = array('registro_id' => $id_registro);
        $data['partials']=$this->model_daybook->get_registers_partial($fields);

        $fields = array('id_registro' => $id_registro);
        $cuenta = $this->model_daybook->get_partial($fields);
        $data['cuenta']= $cuenta;


        $this->load->view('head',$data);
        $this->load->view('navbar');
        $this->load->view('student/view_register_partial');
        $this->load->view('foot');
      }
      else
      {
        if ($this->input->post('operacion')=='cargo') {
          $fields = array(
            'id_registro' => $id_registro,
            'debe' => $cantidad,
            'haber' => 0
          );
        }
        else{
          $fields = array(
            'id_registro' => $id_registro,
            'haber' => $cantidad,
            'debe' => 0
          );
        }
        $upd=$this->model_daybook->update_register($fields);
        if($upd)
        {
          $this->session->set_flashdata('msg','<div class="alert alert-success text-center"> Registro modificado correctamente</div>');
        }
        else
        {
          $this->session->set_flashdata('msg','<div class="alert alert-danger"> Error registro no modificado</div>');
        }
        redirect('daybook/register/'.$id_empresa.'/'.$id_asiento, 'refresh');

      }
    }
  }

  //para cancelar en el parcial
  public function delet_register($id_empresa=null,$id_asiento=null, $id_registro=null)
  {
    $fields = array('id_registro' => $id_registro);
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

  public function delete_register($id_empresa=null,$id_asiento=null)
  {
    //verificamos si es parcial, entonces borramos los aprciales
    $fields = array('id_registro' => $this->input->post('id_register'));
    $ver = $this->model_daybook->get_register($fields);
    if ($ver->parcial > 0) {
      //parcial y borrar con registro_id los parciales
      $fields = array('registro_id' => $this->input->post('id_register'));
      $del_par = $this->model_daybook->delete_parciales($fields);
    }

    //eliminamos del asiento
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

  public function delet_entry($id_empresa=null)
  {
    if ($this->session->userdata('empresa') == 1) {
      $this->session->set_flashdata('msg','<div class="alert alert-danger text-center">No se puede editar el ejercicio</div>');
      redirect('daybook/book/'.$id_empresa);
    }
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

  public function notCero($cantidad)
  {
    if ($cantidad > 0)
      return True;
    else
      return False;
  }



  public function edit_register($id_empresa=null,$id_asiento=null,$id_registro=null,$edit=null)
  {
    //se establecen reglas de validacion
    $this->form_validation->set_rules('cuenta','cuenta del registro','required');
    $this->form_validation->set_rules('cantidad','Cantidad','numeric|required|min_length[1]|max_length[11]|callback_notCero');
    //personalizacion de reglas de validacion
    $this->form_validation->set_message('required', 'El campo %s es obligatorio');
    $this->form_validation->set_message('max_length', 'El campo %s no debe de contener más de 7 caracteres');
    $this->form_validation->set_message('min_length', 'El campo %s no debe de contener menos de 3 caracteres');
    $this->form_validation->set_message('notCero', '%s debe ser mayor a 0');
    $this->form_validation->set_message('numeric', '%s debe ser un número');
    //personalizacion de delimitadores
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger text-center">', '</div>');

    $fields = array('grupo_id' => $this->session->userdata('grupo'), );
    $accounts=$this->model_account->get_catalog_student($fields);
    $fields = array('id_registro' => $id_registro);
    $register=$this->model_daybook->get_register($fields);

    if (!$this->form_validation->run())
    {
      $data['title']="Alumno: Agregar Asiento";
      $data['id_asiento']=$id_asiento;
      $data['id_empresa']=$id_empresa;
      $data['accounts']=$accounts;
      $data['register'] = $register;
      if (!$edit==null) {
        $data['edit'] = 1;
      }
      $this->load->view('head',$data);
      $this->load->view('navbar');
      $this->load->view('student/view_edit_register');
      $this->load->view('foot');
    }
    else
    {
      $id= $this->input->post('cuenta');
      $indice=1;$clasificacion=1;$aux=0;
      for ($i=0; $i < count($accounts); $i++) { 
        if ($accounts[$i]->clasificacion_id!=$clasificacion){
          $indice=1;
          $clasificacion=$accounts[$i]->clasificacion_id;
        }
        if ($accounts[$i]->id_catalogo_usuario==$id){
          $a=$i;
          $aux=$indice;
        }
        $indice++;
      }
      $folio= ($accounts[$a]->tipo_id*1000)+($accounts[$a]->clasificacion_id*100)+$aux;
      if ($this->input->post('movimiento')=='cargo') {
        $fields = array(
          'id_registro' => $id_registro,
          'asiento_id' => $id_asiento,
          'folio'      => $folio,
          'catalogo_usuario_id' =>$id,
          'cuenta' => $accounts[$a]->nombre,
          'debe' => $this->input->post('cantidad'),
          'haber' => 0
        );
      }
      else
      {
        $fields = array(
          'id_registro' => $id_registro,
          'asiento_id' => $id_asiento,
          'folio'      => $folio,
          'catalogo_usuario_id' =>$id,
          'cuenta' => $accounts[$a]->nombre,
          'haber' => $this->input->post('cantidad'),
          'debe' => 0,
        );
      }
      $add=$this->model_daybook->update_register($fields);
      if($add)
      {
        $this->session->set_flashdata('msg','<div class="alert alert-success"> Registro agregado correctamente</div>');
      }
      else
      {
        $this->session->set_flashdata('msg','<div class="alert alert-danger"> Error registro no agregado</div>');
      }
      $xdir='daybook/register/'.$id_empresa.'/'.$id_asiento;
      if ($edit==1){
        $xdir=$xdir.'/1';
      }
      redirect($xdir, 'refresh');
    }
  }

  

  public function pdf()
  {
    if ($this->input->post('sendcont'))
    {
      //$head = $this->input->post('contpdf');
      $titulo_pdf = $this->input->post('titulo_pdf');
      $cont = $this->input->post('contpdf');
      $id_empresa = $this->input->post('id_empresa');

      $head = "
        <!DOCTYPE html>
        <html lang='es'>
        <head>
          <title>".$titulo_pdf."</title>
          <meta charset='utf-8'>
          <meta name='viewport' content='width=device-width, initial-scale=1.0'>
          <link rel='stylesheet' type='text/css' href='".base_url()."source/css/bootstrap.min.css'>
          <script type='text/javascript' src='".base_url()."source/js/jquery-3.3.1.min.js'></script>
          <script type='text/javascript' src='".base_url()."source/js/bootstrap.min.js'></script>
          <link rel='stylesheet' type='text/css' href='".base_url()."source/css/styles.css'>
          <link rel='stylesheet' type='text/css' href='".base_url()."source/fontello/css/fontello.css'>
          <link rel='stylesheet' type='text/css' href='".base_url()."source/fontello/css/fontello.css'>
        </head>
        <body>
      ";

      $foot = "
            <footer class='espacio-footer'>
              <div class='text-center'>
                <br>
                Copyright © Derechos Reservados ".date('Y')."  SICONU
              </div>
            </footer>
          </body>
        </html>

        <script type='text/javascript'>
          $(window).ready(function(){
            $('table.table.table-hover.table-responsive-md.col-md-5:nth-child(2n)').addClass('offset-2'); 
        </script>
      ";
      
      $contenido = $head.$cont.$foot;
      //echo $cont;
      //echo $contenido;
      
      $dompdf = new Dompdf();
      
      $dompdf->loadHtml($contenido);
      $dompdf->setPaper('A4', 'landscape');
      //ini_set("memory_limit","50M");//aumentar memoria
      $dompdf->render();
      $dompdf->stream('archivo.pdf', array('Attachment' => true));
      //$dompdf->stream('archivo.pdf');
    }
    else
    {
      redirect('');
    }
}


  

}//fin clase
