<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
	function __construct()
	{
		parent:: __construct();
	}

	public function index()
	{
		if ($this->session->userdata('activo'))
		{
			if($this->session->userdata('rol') == 1 )
				redirect('admin');
			else if($this->session->userdata('rol') == 2 )
				redirect('professor'); 
			else if($this->session->userdata('rol') == 3 )
				redirect('student'); 
			else             
					redirect();
		}
		else
		{
			$data['title']="Siconu";
			$this->load->view('head',$data);
			$this->load->view('login');
			$this->load->view('foot');
		}
	}
 
	public function login()
	{
		if ($this->input->post('login')) {
			//se establecen reglas de validacion
			$this->form_validation->set_rules('usuario', 'Usuario', 'required');
			$this->form_validation->set_rules('password', 'Contraseña', 'required');
			//personalizacion de reglas de validacion
			$this->form_validation->set_message('required', '%s es un campo oblligatorio');
			//personalizacion de delimitadores
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger text-center">', '</div>');
			if ($this->form_validation->run() == FALSE)
			{
				$data['title']="Siconu";
				$this->load->view('head',$data);
				$this->load->view('login');
				$this->load->view('foot');
			}
			else
			{
				$fields = array(
					'matricula' => $this->input->post('usuario')
				);
				$fields1 = array(
					'contrasenia' => md5($this->input->post('password'))
				);

				$user=$this->model_user->get_user($fields);
				$pass=$this->model_user->get_user($fields1);
				if (!$user && !$pass){
					$this->session->set_flashdata('msg', '<br><div class="alert alert-danger text-center">Usuario y contraseña inválidos</div');
					redirect();
				}elseif (!$user) {
					$this->session->set_flashdata('msg', '<br><div class="alert alert-danger text-center">Usuario inválido</div');
					redirect();
				}elseif (!$pass) {
					$this->session->set_flashdata('msg', '<br><div class="alert alert-danger text-center">Contraseña inválida</div');
					redirect();
				}
				$newdata = array(    
					'usuario' => $user->matricula,
					'id_user' => $user->id_usuario,
					'grupo' => $user->grupo_id,
					'rol' => $user->rol,
					'nombre'=> $user->nombre,
					'activo' =>true
				);
				$this->session->set_userdata($newdata);
				if($newdata['rol'] == 1 )
					redirect('admin');
				else if($newdata['rol'] == 2 )
					redirect('professor'); 
				else if($newdata['rol'] == 3 )
					redirect('student'); 
				else             
					redirect();
			}
		}
		else
			redirect();
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('','refresh');
	}
}