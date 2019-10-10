<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_card extends CI_Controller {
	public function index($id=null)
	{
		$data['title']="Tarjeta de Almacén";
		$this->load->view('head', $data);
		$this->load->view('navbar');
		$this->load->view('student/nabvar_options');
		$this->load->view('student/view_stock_card');
		$this->load->view('foot');
	}
    
    public function list_sc($id_empresa = null)
    {
		$data['title']="Tarjeta de Almacén";
        $data['stock_card'] = $this->model_stock_card->get_sc();
        $fields = array('id_empresa' => $id_empresa);
        $data['exercise'] = $this->model_exercise->get_exercise($fields);
		$data['id_empresa'] = $id_empresa;
		$this->load->view('head',$data);
		$this->load->view('navbar');
        $this->load->view('student/nabvar_options');
		$this->load->view('student/view_stock_card');
		$this->load->view('foot');
	}
    
    public function add_register_card($id_empresa = null)
    {
        // REGLAS
        $this->form_validation->set_rules('fecha_sc', 'fecha', 'required');
        $this->form_validation->set_rules('referencia', 'referencia', 'required');
        $this->form_validation->set_rules('cantidad_existencia', 'cantidad en existencia', 'numeric|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('cantidad_unidades', 'cantidad en unidades', 'numeric|min_length[1]|max_length[11]');
        $this->form_validation->set_rules('cantidad_costos', 'cantidad en costos', 'numeric|min_length[1]|max_length[11]');

        // MENSAJE
        $this->form_validation->set_message('required', 'El campo %s es obligatorio');
        $this->form_validation->set_message('numeric', 'El campo %s debe ser numérico');
        $this->form_validation->set_message('min_length', 'El campo %s no debe de contener menos de 1 caracteres');
        $this->form_validation->set_message('max_length', 'El campo %s no debe de contener mas de 11 caracteres');
        
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger text-center">', '</div>');
        
        if(!$this->form_validation->run())
        {
            $data['title']="Alumno: Nuevo Registro de Tarjerta de Almacén";
            $data['id_empresa']=$id_empresa;
            $fields = array('id_empresa' => $id_empresa);
            $data['info'] = $this->model_exercise->get_exercise($fields);
			$this->load->view('head',$data);
			$this->load->view('navbar');
			$this->load->view('student/view_add_register_sc');
			$this->load->view('foot');
        }else
        {
            // CONDICIÓN PARA INGRESAR EXISTENCIA (INVENTARIO INICIAL)
            if($this->input->post('cantidad_existencia') != null)
            {
                $bandera = false;


                $fields = array
                (
                    'empresa_id' => $id_empresa,
                    'fecha' => $this->input->post('fecha_sc'),
                    'referencia' => $this->input->post('referencia'),
                    'entradas' => 0,
                    'salidas' => 0,
                    'existencia' => $this->input->post('cantidad_existencia'),
                    'unitario' => $this->input->post('cantidad_costos'),
                    'promedio' => $this->input->post('cantidad_costos'),
                    'haber' => 0,
                    'saldo' => $this->input->post('cantidad_existencia') * $this->input->post('cantidad_costos')
                );
            }else
            {
                // Se envía una bandera para que se deshabilite el campo de EXISTENCIA
                $bandera = true;

                $fields = array('empresa_id' => $id_empresa);
                $ultimo_id = $this->model_stock_card->get_last_id($fields);
                $fields = array('id_tarjeta' => intval($ultimo_id->id));
                $existencia_antes = $this->model_stock_card->get_existencia($fields);

                $saldo_antes = $this->model_stock_card->get_saldo($fields);

                if($this->input->post('unidades') == "entrada")
                {
                    $fields = array
                    (
                        'empresa_id' => $id_empresa,
                        'fecha' => $this->input->post('fecha_sc'),
                        'referencia' => $this->input->post('referencia'),
                        'entradas' => $this->input->post('cantidad_unidades'),
                        'salidas' => 0,
                        'existencia' => floatval($this->input->post('cantidad_unidades')) + floatval($existencia_antes->existencia),
                        'unitario' => $this->input->post('cantidad_costos'),
                        'promedio' => (floatval($existencia_antes->saldo) + ($this->input->post('cantidad_unidades') * $this->input->post('cantidad_costos'))) / (floatval($this->input->post('cantidad_unidades')) + floatval($existencia_antes->existencia)),
                        'debe' => $this->input->post('cantidad_unidades') * $this->input->post('cantidad_costos'),
                        'haber' => 0,
                        'saldo' => floatval($existencia_antes->saldo) + ($this->input->post('cantidad_unidades') * $this->input->post('cantidad_costos'))
                    );
                }
                if($this->input->post('unidades') == "salida")
                {
                    $fields = array
                    (
                        'empresa_id' => $id_empresa,
                        'fecha' => $this->input->post('fecha_sc'),
                        'referencia' => $this->input->post('referencia'),
                        'entradas' => 0,
                        'salidas' => $this->input->post('cantidad_unidades'),
                        'existencia' => floatval($existencia_antes->existencia) - floatval($this->input->post('cantidad_unidades')),
                        'unitario' => $this->input->post('cantidad_costos'),
                        'promedio' => (floatval($existencia_antes->saldo) + ($this->input->post('cantidad_unidades') * $this->input->post('cantidad_costos'))) / (floatval($this->input->post('cantidad_unidades')) + floatval($existencia_antes->existencia)),
                        'debe' => 0,
                        'haber' => $this->input->post('cantidad_unidades') * $this->input->post('cantidad_costos'),
                        'saldo' => $this->model_stock_card->get_sum_saldo() - ($this->input->post('cantidad_unidades') * $this->input->post('cantidad_costos'))
                    );
                }
                switch($this->input->post('otras_operaciones'))
                {
                    case "gastosCompra":
                        $fields = array
                        (
                            'empresa_id' => $id_empresa,
                            'fecha' => $this->input->post('fecha_sc'),
                            'referencia' => $this->input->post('referencia'),
                            'entradas' => 0,
                            'salidas' => 0,
                            'existencia' => floatval($existencia_antes->existencia) - floatval($this->input->post('cantidad_unidades')),
                            'unitario' => 0, //$this->input->post('cantidad_costos'),
                            'promedio' => (floatval($existencia_antes->saldo) + ($this->input->post('cantidad_unidades') * $this->input->post('cantidad_costos'))) / (floatval($this->input->post('cantidad_unidades')) + floatval($existencia_antes->existencia)),
                            'debe' => $this->input->post('afectacion'),
                            'haber' => 0, //$this->input->post('cantidad_unidades') * $this->input->post('cantidad_costos'),
                            'saldo' => $this->model_stock_card->get_sum_saldo() - ($this->input->post('cantidad_unidades') * $this->input->post('cantidad_costos'))
                        );
                        break;
                    case "descuentosCompra":
                        $fields = array
                        (
                            'empresa_id' => $id_empresa,
                            'fecha' => $this->input->post('fecha_sc'),
                            'referencia' => $this->input->post('referencia'),
                            'entradas' => 0,
                            'salidas' => 0,
                            'existencia' => floatval($existencia_antes->existencia) - floatval($this->input->post('cantidad_unidades')),
                            'unitario' => $this->input->post('cantidad_costos'),
                            'promedio' => 0,//(floatval($existencia_antes->saldo) + ($this->input->post('cantidad_unidades') * $this->input->post('cantidad_costos'))) / (floatval($this->input->post('cantidad_unidades')) + floatval($existencia_antes->existencia)),
                            'debe' => 0, //$this->input->post('otras_operaciones'),
                            'haber' => $this->input->post('otras_operaciones'),
                            'saldo' => $this->model_stock_card->get_sum_saldo() - ($this->input->post('cantidad_unidades') * $this->input->post('cantidad_costos'))
                        );
                        break;
                    case "rebajasCompra":
                        $fields = array
                        (
                            'empresa_id' => $id_empresa,
                            'fecha' => $this->input->post('fecha_sc'),
                            'referencia' => $this->input->post('referencia'),
                            'entradas' => 0,
                            'salidas' => 0,
                            'existencia' => floatval($existencia_antes->existencia) - floatval($this->input->post('cantidad_unidades')),
                            'unitario' => 0, //$this->input->post('cantidad_costos'),
                            'promedio' => (floatval($existencia_antes->saldo) + ($this->input->post('cantidad_unidades') * $this->input->post('cantidad_costos'))) / (floatval($this->input->post('cantidad_unidades')) + floatval($existencia_antes->existencia)),
                            'debe' => $this->input->post('otras_operaciones'),
                            'haber' => 0, //$this->input->post('cantidad_unidades') * $this->input->post('cantidad_costos'),
                            'saldo' => $this->model_stock_card->get_sum_saldo() - ($this->input->post('cantidad_unidades') * $this->input->post('cantidad_costos'))
                        );
                        break;
                    case "devolucionesCompra":
                        $fields = array
                        (
                            'empresa_id' => $id_empresa,
                            'fecha' => $this->input->post('fecha_sc'),
                            'referencia' => $this->input->post('referencia'),
                            'entradas' => 0,
                            'salidas' => $this->input->post('cantidad_unidades'),
                            'existencia' => floatval($existencia_antes->existencia) - floatval($this->input->post('cantidad_unidades')),
                            'unitario' => $this->input->post('cantidad_costos'),
                            'promedio' => (floatval($existencia_antes->saldo) + ($this->input->post('cantidad_unidades') * $this->input->post('cantidad_costos'))) / (floatval($this->input->post('cantidad_unidades')) + floatval($existencia_antes->existencia)),
                            'debe' => 0,
                            'haber' => $this->input->post('otras_operaciones'),//$this->input->post('cantidad_unidades') * $this->input->post('cantidad_costos'),
                            'saldo' => $this->model_stock_card->get_sum_saldo() - ($this->input->post('cantidad_unidades') * $this->input->post('cantidad_costos'))
                        );
                        break;
                    case "devolucionesVenta":
                        $fields = array
                        (
                            'empresa_id' => $id_empresa,
                            'fecha' => $this->input->post('fecha_sc'),
                            'referencia' => $this->input->post('referencia'),
                            'entradas' => $this->input->post('cantidad_unidades'),
                            'salidas' => 0,
                            'existencia' => floatval($existencia_antes->existencia) - floatval($this->input->post('cantidad_unidades')),
                            'unitario' => $this->input->post('cantidad_costos'),
                            'promedio' => (floatval($existencia_antes->saldo) + ($this->input->post('cantidad_unidades') * $this->input->post('cantidad_costos'))) / (floatval($this->input->post('cantidad_unidades')) + floatval($existencia_antes->existencia)),
                            'debe' => $this->input->post('otras_operaciones'),
                            'haber' => 0,//$this->input->post('cantidad_unidades') * $this->input->post('cantidad_costos'),
                            'saldo' => $this->model_stock_card->get_sum_saldo() - ($this->input->post('cantidad_unidades') * $this->input->post('cantidad_costos'))
                        );
                        break;

                }
            }
            
            $info = $this->model_stock_card->insert_ta($fields);
            if($info)
            {
                $this->session->set_flashdata('msg', '<div class="alert alert-success"> Registro nuevo agregado correctamente</div>' );
            }else
            {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger"> Error al agregar registro</div>');
            }
            redirect('stock_card/list_sc/'.$id_empresa, 'refresh');
        }
    }
}
