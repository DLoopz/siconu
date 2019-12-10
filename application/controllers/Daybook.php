<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$usuario_local = get_current_user();
require_once("/home/{$usuario_local}/dompdf/autoload.inc.php");
use Dompdf\Dompdf;

$usuario_local = get_current_user();
require_once("/home/{$usuario_local}/fpdf/fpdf.php");
$usuario_local = get_current_user();
require_once("/home/{$usuario_local}/html2pdf/src/Html2Pdf.php");

require_once("/home/{$usuario_local}/html2pdf/tcpdf.php");
require_once("/home/{$usuario_local}/html2pdf/tcpdf_parser.php");
require_once("/home/{$usuario_local}/html2pdf/tcpdf_import.php");
require_once("/home/{$usuario_local}/html2pdf/tcpdf_barcodes_1d.php");
require_once("/home/{$usuario_local}/html2pdf/tcpdf_barcodes_2d.php");
require_once("/home/{$usuario_local}/html2pdf/include/tcpdf_colors.php");
require_once("/home/{$usuario_local}/html2pdf/include/tcpdf_filters.php");
require_once("/home/{$usuario_local}/html2pdf/include/tcpdf_font_data.php");
require_once("/home/{$usuario_local}/html2pdf/include/tcpdf_fonts.php");
require_once("/home/{$usuario_local}/html2pdf/include/tcpdf_images.php");
require_once("/home/{$usuario_local}/html2pdf/include/tcpdf_static.php");
require_once("/home/{$usuario_local}/html2pdf/include/barcodes/datamatrix.php");
require_once("/home/{$usuario_local}/html2pdf/include/barcodes/pdf417.php");
require_once("/home/{$usuario_local}/html2pdf/include/barcodes/qrcode.php");
require_once("/home/{$usuario_local}/html2pdf/src/Locale.php");
require_once("/home/{$usuario_local}/html2pdf/src/MyPdf.php");
require_once("/home/{$usuario_local}/html2pdf/src/CssConverter.php");
require_once("/home/{$usuario_local}/html2pdf/src/SvgDrawer.php");
require_once("/home/{$usuario_local}/html2pdf/src/Exception/Html2PdfException.php");
require_once("/home/{$usuario_local}/html2pdf/src/Exception/ImageException.php");
require_once("/home/{$usuario_local}/html2pdf/src/Exception/LongSentenceException.php");
require_once("/home/{$usuario_local}/html2pdf/src/Exception/HtmlParsingException.php");
require_once("/home/{$usuario_local}/html2pdf/src/Exception/TableException.php");
require_once("/home/{$usuario_local}/html2pdf/src/Extension/ExtensionInterface.php");
require_once("/home/{$usuario_local}/html2pdf/src/Extension/AbstractExtension.php");
require_once("/home/{$usuario_local}/html2pdf/src/Extension/Core/HtmlExtension.php");
require_once("/home/{$usuario_local}/html2pdf/src/Extension/Core/SvgExtension.php");
require_once("/home/{$usuario_local}/html2pdf/src/Parsing/Css.php");
require_once("/home/{$usuario_local}/html2pdf/src/Parsing/Html.php");
require_once("/home/{$usuario_local}/html2pdf/src/Parsing/HtmlLexer.php");
require_once("/home/{$usuario_local}/html2pdf/src/Parsing/Token.php");
require_once("/home/{$usuario_local}/html2pdf/src/Parsing/Node.php");
require_once("/home/{$usuario_local}/html2pdf/src/Parsing/TagParser.php");
require_once("/home/{$usuario_local}/html2pdf/src/Parsing/TextParser.php");
require_once("/home/{$usuario_local}/html2pdf/src/Tag/TagInterface.php");
require_once("/home/{$usuario_local}/html2pdf/src/Tag/AbstractTag.php");
require_once("/home/{$usuario_local}/html2pdf/src/Tag/AbstractHtmlTag.php");
require_once("/home/{$usuario_local}/html2pdf/src/Tag/Html/I.php");
require_once("/home/{$usuario_local}/html2pdf/src/Tag/Html/B.php");
require_once("/home/{$usuario_local}/html2pdf/src/Tag/Html/Big.php");
require_once("/home/{$usuario_local}/html2pdf/src/Tag/Html/Bookmark.php");
require_once("/home/{$usuario_local}/html2pdf/src/Tag/Html/Cite.php");
require_once("/home/{$usuario_local}/html2pdf/src/Tag/Html/Em.php");
require_once("/home/{$usuario_local}/html2pdf/src/Tag/Html/Span.php");
require_once("/home/{$usuario_local}/html2pdf/src/Tag/Html/Font.php");
require_once("/home/{$usuario_local}/html2pdf/src/Tag/Html/Label.php");
require_once("/home/{$usuario_local}/html2pdf/src/Tag/Html/Samp.php");
require_once("/home/{$usuario_local}/html2pdf/src/Tag/Html/Small.php");
require_once("/home/{$usuario_local}/html2pdf/src/Tag/Html/Strong.php");
require_once("/home/{$usuario_local}/html2pdf/src/Tag/Html/Sup.php");
require_once("/home/{$usuario_local}/html2pdf/src/Tag/Html/Sub.php");
require_once("/home/{$usuario_local}/html2pdf/src/Tag/Html/U.php");
require_once("/home/{$usuario_local}/html2pdf/src/Tag/Html/Ins.php");
require_once("/home/{$usuario_local}/html2pdf/src/Tag/Html/S.php");
require_once("/home/{$usuario_local}/html2pdf/src/Tag/Html/Del.php");
require_once("/home/{$usuario_local}/html2pdf/src/Tag/Html/Address.php");
require_once("/home/{$usuario_local}/html2pdf/src/Tag/AbstractSvgTag.php");
require_once("/home/{$usuario_local}/html2pdf/src/Tag/Svg/Circle.php");
require_once("/home/{$usuario_local}/html2pdf/src/Tag/Svg/Ellipse.php");
require_once("/home/{$usuario_local}/html2pdf/src/Tag/Svg/G.php");
require_once("/home/{$usuario_local}/html2pdf/src/Tag/Svg/Line.php");
require_once("/home/{$usuario_local}/html2pdf/src/Tag/Svg/Path.php");
require_once("/home/{$usuario_local}/html2pdf/src/Tag/Svg/Polygon.php");
require_once("/home/{$usuario_local}/html2pdf/src/Tag/Svg/Polyline.php");
require_once("/home/{$usuario_local}/html2pdf/src/Tag/Svg/Rect.php");
require_once("/home/{$usuario_local}/html2pdf/src/Debug/DebugInterface.php");
require_once("/home/{$usuario_local}/html2pdf/src/Debug/Debug.php");



use Spipu\Html2Pdf\Debug\Debug;
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;
require_once("/home/{$usuario_local}/html2pdf/src/Html2Pdf.php");

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
        //$this->load->view('student/view_add_register_partial');
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
            'cuenta' => $accounts[$a]->nombre
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

  public function add_register_partial($id_empresa=null,$id_asiento=null,$id_registro=null)
  {
    //se establecen reglas de validacion
    $this->form_validation->set_rules('concepto','Concepto','required|min_length[3]|max_length[50]');
    $this->form_validation->set_rules('cantidad','Cantidad','required|numeric');
    //personalizacion de reglas de validacion
    $this->form_validation->set_message('required', '%s es un campo obligatorio');
    $this->form_validation->set_message('numeric', '%s debe ser numérico');
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
      $data['modal'] = 'parciales';


      $this->load->view('head',$data);
      $this->load->view('navbar');
      $this->load->view('student/view_register_partial');
      //$this->load->view('student/view_add_register_partial');
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

      $fields = array(
        'id_registro' => $id_registro,
        'parcial' => 1
      );
      $act_parc = $this->model_daybook->partial($fields);


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
            'debe' => $cantidad
          );
        }
        else{
          $fields = array(
            'id_registro' => $id_registro,
            'haber' => $cantidad
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

  public function pdf_no_html()
  {


    if ($this->input->post('sendcont'))
    {
      
      $cont = $this->input->post('contpdf');

      $pdf = new FPDF();
      $pdf->AddPage();
      $pdf->SetFont('Arial','B',16);
      $pdf->Cell(40,10, $cont);
      $pdf->Output();
      
    }
    else
    {
      redirect('');
    }
  }


  public function pdf()
        {
          if ($this->input->post('sendcont'))
          {
            
            //$head = $this->input->post('contpdf');
            $id_empresa = $this->input->post('id_empresa');


            $title="Esquemas de mayor";
            $fields = array('empresa_id' => $id_empresa);
            $asientos = $this->model_schemes->get_asientos($fields);
            $registros = $this->model_schemes->get_all($fields);
            $cuentas = $this->model_schemes->get_cuentas($fields);
            $parciales = $this->model_schemes->get_partials($fields);
            $id_empresa = $id_empresa;
            
            $catalog = $this->model_account->get_std_accounts();


            $head = "
            <!DOCTYPE html>
            ".setlocale(LC_MONETARY, 'es_MX.UTF-8')."
            <html lang='es'>
              <head>
                <title>".$title."</title>
                <meta charset='utf-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <link rel='stylesheet' type='text/css' href='".base_url()."source/css/bootstrap.min.css'>
                <script type='text/javascript' src='".base_url()."source/js/jquery-3.3.1.min.js'></script>
                <script type='text/javascript' src='".base_url()."source/js/bootstrap.min.js'></script>
                <link rel='stylesheet' type='text/css' href='".base_url()."source/fontello/css/fontello.css'>
                <link rel='stylesheet' type='text/css' href='".base_url()."source/css/styles.css'>
                <link rel='stylesheet' type='text/css' href='".base_url()."source/fontello/css/fontello.css'>
              </head>
            <body>
            <style>
            
            </style>
            ";


            $cont = $head;

                foreach ($catalog as $cu){
                  
                  foreach ($cuentas as $accs){
                    if ($accs->cuenta == $cu->nombre){
                  
                  $cont .= "<table class='table table-hover table-responsive-md col-md-5 scheme'>
                      <thead class='text-center'>
                        <tr>
                          <th colspan='2'>".$cu->nombre."</th>
                        </tr>
                        <tr>
                          <th>Debe</th>
                          <th>Haber</th>
                        </tr>
                      </thead>
                      <tbody>";

                        $total_debe = 0;
                        $total_haber = 0;
                        
                      
                        foreach ($registros as $regs){

                          if ($regs->cuenta == $cu->nombre and $regs->registro_id==NULL){
                            $cont .= "<tr>
                              <td class='border-right text-right'>$ ".number_format($regs->debe,2,'.',',')."</td>
                              <td class='text-right'>$ ".number_format($regs->haber,2,'.',',')."</td>
                            </tr>";

                            $total_debe += $regs->debe;
                            $total_haber += $regs->haber;

                          }

                        } //registros

                        foreach ($parciales as $parc){

                          if ($parc->cuenta == $cu->nombre and $parc->registro_id!=NULL){
                            
                            $cont.="<tr>
                              <td class='border-right text-right'>$ ".number_format($parc->debe,2,'.',',')."</td>
                              <td class='text-right'>$ ".number_format($parc->haber,2,'.',',')."</td>
                            </tr>";

                            $total_debe += $parc->debe;
                            $total_haber += $parc->haber;

                          }

                        } //parciales

                        $cont .= "<tr>
                          <th class='border-right text-right'>$".number_format($total_debe,2,'.',',')."</th>
                          <th class='text-right'>$ ".number_format($total_haber,2,'.',',')."</th>
                          </tr>
                          
                          <tr>";
                          if ($total_debe>=$total_haber){
                            $cont.="<th class='border-right table-success text-right'>$ ".number_format(abs($total_debe-$total_haber),2,'.',',')."</th>".
                            "<th class='table-secondary'></th>";
                          }
                          else
                          {
                            $cont.="<th class='border-right table-secondary text-right'></th>".
                            "<th class='table-danger text-right'>$ ".number_format(abs($total_debe-$total_haber),2,'.',',')."</th>";
                          }
                        $cont .= "</tr>
                        
                      </tbody>
                    </table>";
                    
                    }
                  }
                  
                }

              $cont .= "</div>
            </div>";



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

            
            //echo $cont.$foot;
            //echo $head;
            ///*
            $dompdf = new Dompdf();
            //$dompdf->loadHtml($cont);
            $contenido = $cont.$foot;
            //$dompdf->loadHtml($contenido);
            //$contenido = $head.'<div class="cola">dfghjk</div>';
            $dompdf->loadHtml($contenido);
            $dompdf->setPaper('A4', 'landscape');
            //ini_set("memory_limit","50M");//aumentar memoria
            $dompdf->render();
            $dompdf->stream('archivo.pdf', array('Attachment' => true));
            //$dompdf->stream('archivo.pdf');
            //*/
          }
          else
          {
            redirect('');
          }
        }

  public function pdf_balance()
  {
    if ($this->input->post('sendcont'))
    {
      //$head = $this->input->post('contpdf');
      $cont = $this->input->post('contpdf');
      $id_empresa = $this->input->post('id_empresa');

      $head = "
      <!DOCTYPE html>
      <html lang='es'>
        <head>
          <title>".''."</title>
          <meta charset='utf-8'>
          <meta name='viewport' content='width=device-width, initial-scale=1.0'>
          <link rel='stylesheet' type='text/css' href='".base_url()."source/css/bootstrap.min.css'>
          <script type='text/javascript' src='".base_url()."source/js/jquery-3.3.1.min.js'></script>
          <script type='text/javascript' src='".base_url()."source/js/bootstrap.min.js'></script>
          <link rel='stylesheet' type='text/css' href='".base_url()."source/fontello/css/fontello.css'>
          <link rel='stylesheet' type='text/css' href='".base_url()."source/css/styles.css'>
          <link rel='stylesheet' type='text/css' href='".base_url()."source/fontello/css/fontello.css'>
        </head>
      <style>
      
      </style>
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
        <body>
      ";

      

      $contenido = $head.$cont.$foot;
      //echo $cont;
      //echo $contenido;
      
      ///*
      $dompdf = new Dompdf();
      
      $dompdf->loadHtml($contenido);
      $dompdf->setPaper('A4', 'landscape');
      //ini_set("memory_limit","50M");//aumentar memoria
      $dompdf->render();
      $dompdf->stream('archivo.pdf', array('Attachment' => true));
      //$dompdf->stream('archivo.pdf');
      //*/
    }
    else
    {
      redirect('');
    }
}


  public function html2pdf()
  {

    if ($this->input->post('sendcont'))
    {
      $cont = $this->input->post('contpdf');
        
          ob_start();        

          $content = ob_get_clean();

          if (! empty ( $_GET ['html'] )) {
              echo $content;
              return;
            }
          
          try
          {
            $html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8', 3);
            $html2pdf->pdf->SetDisplayMode('fullpage');
            //$html2pdf->writeHTML($content, isset($_GET['vuehtml']));
            $html2pdf->writeHTML($cont);
            $html2pdf->Output('Archivo.pdf');
          }
          catch(HTML2PDF_exception $e) {
              echo $e;
              $formatter = new ExceptionFormatter ( $e );
                echo $formatter->getHtmlMessage ();
              exit;
          }
    }
    else
    {
      redirect('');
    }
    
  }

}//fin clase
