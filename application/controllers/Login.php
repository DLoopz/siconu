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
        $data['title']="Siconu";
        $this->load->view('head',$data);
        $this->load->view('login');
        $this->load->view('foot');
    }
 
    public function login()
    {
        if ($this->input->post('login')) {
            //se establecen reglas de validacion
            $this->form_validation->set_rules('usuario', 'usuario', 'required');
            $this->form_validation->set_rules('password', 'contraseña', 'required');
            //personalizacion de reglas de validacion
            $this->form_validation->set_message('required', 'El campo %s es oblligatorio');
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
                    'matricula' => $this->input->post('usuario'),
                    'contrasenia' => $this->input->post('password')/*md5($this->input->post('password'))*/);
                $user=$this->model_user->get_user($fields);
                if (!$user){
                    $this->session->set_flashdata('msg', '<br><div class="alert alert-danger text-center">Usuario o contraseña invalidos</div');
                    redirect();
                }
                $newdata = array(    
                    'usuario' => $user->matricula,
                    'id_user' => $user->id,
                    'rol' => $user->rol
                );
                $this->session->set_userdata($newdata);
                if($newdata['rol'] == 0 )
                    redirect('admin');
                else if($newdata['rol'] == 1 )
                    redirect('professor'); 
                else if($newdata['rol'] == 2 )
                    redirect('student'); 
                else             
                    redirect();
            }
        }
        else
            redirect('');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/','refresh');
    }
}