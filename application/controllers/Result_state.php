<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Result_state extends CI_Controller {
	public function index()
	{
		/*$data['title']="Rayado Diario";
		$this->load->view('head',$data);
		$this->load->view('student/view_daybook');
		$this->load->view('foot');*/
	}

	public function state($id_empresa=null)
	{
		if ($this->input->post("submit_generar")) {
			//reglas de validacion
			$this->form_validation->set_rules('fecha_inicio','Fecha de inicio','required|callback_down_date|callback_up_date');
			$this->form_validation->set_rules('fecha_fin','Fecha de fin','required|callback_down_date');
			//personalizacion de reglas
			$this->form_validation->set_message('required', '%s es un campo obligatorio');
			$this->form_validation->set_message('up_date', '%s no es valida, debe ser como maximo un año separado de la fecha actual');
			$this->form_validation->set_message('down_date', '%s no es valida, debe ser una fecha menor o igual a la actual');
			//personalizacion de delimitadores
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger text-center">', '</div>');
			if($this->form_validation->run()==FAlSE)
			{
				//strtotime(date("Y-m-d",time()));
		    //$fields = array('id_empresa' => $id_empresa );
		    //$data['exercise']=$this->model_exercise->get_exercise($fields);
				$data['id_empresa']=$id_empresa;
				//$fields = array('empresa_id' => $id_empresa );
		    //$data['registers']=$this->model_result->get_accounts_rslt($fields);
				//$fields = array('grupo_id' => $this->session->userdata('grupo'));
		    //$data['catalog']=$this->model_account->get_catalog_student($fields);
				$data['title']="Estado de resultados";
				$this->load->view('head',$data);
				$this->load->view('navbar');
		    $this->load->view('student/nabvar_options');
				$this->load->view('student/view_result_state');
				$this->load->view('foot');
	    }else{
	    	$inicio=$this->input->post("fecha_inicio");
	    	$fin=$this->input->post("fecha_fin");
	    	$fields = array('empresa_id' => $id_empresa,'fecha' => $inicio );
	    	$inventario_inical=$this->model_result->get_accounts_rslt($fields);
				$fields = array('id_empresa' => $id_empresa );
				$data['exercise']=$this->model_exercise->get_exercise($fields);
				$data['id_empresa']=$id_empresa;
				$fields = array(
					'empresa_id' => $id_empresa,
					'fecha_inicio' => $inicio,
					'fecha_fin' => $fin
				);
				$data['registers']=$this->model_result->get_accounts_rslt($fields);
				$fields = array('grupo_id' => $this->session->userdata('grupo'));
				$data['catalog']=$this->model_account->get_catalog_student($fields);
				$data['title']="Estado de resultados";
				$data['fecha_inicio']=$inicio;
				$data['fecha_fin']=$fin;
				$this->load->view('head',$data);
				$this->load->view('navbar');
				$this->load->view('student/nabvar_options');
				$this->load->view('student/view_result_state');
				$this->load->view('foot');

   		}
   	}else{
			//strtotime(date("Y-m-d",time()));
	    //$fields = array('id_empresa' => $id_empresa );
	    //$data['exercise']=$this->model_exercise->get_exercise($fields);
			$data['id_empresa']=$id_empresa;
			//$fields = array('empresa_id' => $id_empresa );
	    //$data['registers']=$this->model_result->get_accounts_rslt($fields);
			//$fields = array('grupo_id' => $this->session->userdata('grupo'));
	    //$data['catalog']=$this->model_account->get_catalog_student($fields);
			$data['title']="Estado de resultados";
			$this->load->view('head',$data);
			$this->load->view('navbar');
	    $this->load->view('student/nabvar_options');
			$this->load->view('student/view_result_state');
			$this->load->view('foot');
		}
	}

	public function down_date($dt){
		$now=date("Y-m-d");
		if (strtotime($dt)<=strtotime($now)) { 
			return true;
		}
		return false;
	}

	public function up_date($dt){
		$now=date("Y-m-d");
		$last_year= date("d-m-Y",strtotime($now."- 1 year"));
		if (strtotime($dt)>=strtotime($last_year)) {
			return true;
		}
		return false;
	}
}