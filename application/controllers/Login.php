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
			$data["logo"]=true;
			$this->load->view('head',$data);
			$this->load->view('login');
			$this->load->view('foot');
				echo "ESTO ES OTRA PRUEBA";
		}
	}
 
	public function login()
	{

		if ($this->input->post('login')) {
			//se establecen reglas de validacion
			$this->form_validation->set_rules('usuario', 'Usuario', 'required');
			$this->form_validation->set_rules('password', 'Contraseña', 'required');
			//personalizacion de reglas de validacion
			$this->form_validation->set_message('required', '%s es un campo obligatorio');
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
					'matricula' => addslashes($this->input->post('usuario')),
					'contrasenia' => md5(addslashes($this->input->post('password')))
				);

				$user = $this->model_user->get_user($fields);

				if (!$user){
					$this->session->set_flashdata('msg', '<br><div class="alert alert-danger text-center">Usuario o contraseña inválidos</div');
					redirect();
				}

				$fields = array(
					'usuario_id' => $user->id_usuario
				);
				$info=$this->model_user->get_info_user($fields);

				$newdata = array(    
					'usuario' => $user->matricula,
					'id_user' => $user->id_usuario,
					'grupo' => $info->grupo_id,
					'rol' => $user->rol,
					'nombre'=> $user->nombre,
					'activo' =>true,
					'id_org' => $user->id_usuario
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