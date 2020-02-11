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
    $this->load->view('pdf');
		$this->load->view('foot');
	}

    public function list_sc($id_empresa = null)
    {
		$data['title']="Tarjeta de Almacén";

        $fields = array('empresa_id' => $id_empresa);
        $id_exercise = $fields['empresa_id'];
        $data['stock_card'] = $this->model_stock_card->get_sc($id_exercise);
        $fields = array('id_empresa' => $id_empresa);
        $data['exercise'] = $this->model_exercise->get_exercise($fields);
		$data['id_empresa'] = $id_empresa;

		$data['articulo'] = null;
		$data['unidad'] = null;

        $fields = array('empresa_id' => $id_empresa);
        $ultimo_id = $this->model_stock_card->get_last_id($fields);
        $fields = array('id_tarjeta' => intval($ultimo_id->id));
        $registro_antes = $this->model_stock_card->get_registro($fields);
        if($registro_antes)
        {
            $data['id_empresa']=$id_empresa;
            $fields = array('id_empresa' => $id_empresa);
            $data['empresa'] = $this->model_exercise->get_exercise($fields);
            $data['ultimo'] = $registro_antes->id_tarjeta;

            if($registro_antes->entradas != 0 || $registro_antes->salidas != 0)
            {   if($registro_antes->terminar == 1)
                    $data['btn_end'] = 0;
                $data['terminar'] = $registro_antes->terminar;
                $data['btn_end'] = 1;

                $fields = array('empresa_id' => $id_empresa);
                $primer_id = $this->model_stock_card->get_first_id($fields);
                $fields = array('id_tarjeta' => intval($primer_id->id));
                $ii = $this->model_stock_card->get_registro($fields);
                $compra = $this->model_stock_card->get_sum_debe($id_empresa);
                $mercancias = $ii->saldo + $compra;
                $if = $registro_antes->saldo;
                $vendido = $this->model_stock_card->get_sum_haber($id_empresa);
                //echo 'Inventario_inicial: ', $ii->id_tarjeta;

                $data['ii'] = $ii->saldo;
                $data['compra'] = $compra;
                $data['mercancias'] = $mercancias;
                $data['if'] = $if;
                $data['vendido'] = $vendido;

                $data['articulo'] = $ii->nombre_articulo;
                $data['unidad'] = $ii->tipo_unidad;
            }else
            {
                $fields = array('empresa_id' => $id_empresa);
                $primer_id = $this->model_stock_card->get_first_id($fields);
                $fields = array('id_tarjeta' => intval($primer_id->id));
                $ii = $this->model_stock_card->get_registro($fields);

                $data['articulo'] = $ii->nombre_articulo;
                $data['unidad'] = $ii->tipo_unidad;

                $data['btn_end'] = 0;
                $data['terminar'] = $registro_antes->terminar;

                $data['compra'] = 0;
                $data['vendido'] = 0;
            }
        }
        else
        {
            $data['ultimo'] = null;
            $data['terminar'] = 0;
            $data['btn_end'] = 0;
        }

		$this->load->view('head',$data);
		$this->load->view('navbar');
        $this->load->view('student/nabvar_options');
		$this->load->view('student/view_stock_card');
		$this->load->view('foot');
	}

    public function add_register_card($id_empresa = null)
    {
        $fields = array('empresa_id' => $id_empresa);
        $ultimo_id = $this->model_stock_card->get_last_id($fields);
        $fields = array('id_tarjeta' => intval($ultimo_id->id));
        $existencia_antes = $this->model_stock_card->get_existencia($fields);

        // REGLAS
        //$this->form_validation->set_rules('fecha_sc', 'fecha', 'required');
        $this->form_validation->set_rules('fecha_sc', 'Fecha', 'callback_date_check', 'required');

        $ref = $this->input->post("referencia");
        $unic = $this->model_stock_card->get_unic($id_empresa, $ref);
        if($unic)
            $this->form_validation->set_rules('referencia', 'Referencia', 'required|is_unique[tarjeta_almacen.referencia]');
        else
            $this->form_validation->set_rules('referencia', 'Referencia', 'required');


        if($existencia_antes == NULL)
        {
            $this->form_validation->set_rules('cantidad_existencia', 'Cantidad en existencia', 'numeric|min_length[1]|max_length[11]|required');
            $this->form_validation->set_rules('cantidad_unidades', 'Cantidad en unidades', 'numeric|min_length[1]|max_length[11]');
            $this->form_validation->set_rules('articulo', 'Nombre del artículo', 'min_length[0]|max_length[50]|required');
            $this->form_validation->set_rules('unidad', 'Tipo de unidad', 'min_length[1]|max_length[11]|required|alpha');
        }else
        {
            $this->form_validation->set_rules('cantidad_existencia', 'Cantidad en existencia', 'numeric|min_length[1]|max_length[11]');

            switch($this->input->post('otras_operaciones'))
            {
                case "gastosCompra":
                    $this->form_validation->set_rules('afectacion', 'Cantidad en afectación', 'callback_venta_check|numeric|min_length[1]|max_length[11]|required');
                    break;
                case "descuentosCompra":
                    $this->form_validation->set_rules('afectacion', 'Cantidad en afectación', 'callback_venta_check|numeric|min_length[1]|max_length[11]|required');
                    break;
                case "rebajasCompra":
                    $this->form_validation->set_rules('afectacion', 'Cantidad en afectación', 'callback_venta_check|numeric|min_length[1]|max_length[11]|required');
                    break;
                case "devolucionesCompra":
                    $this->form_validation->set_rules('cantidad_unidades', 'Cantidad en unidades', 'callback_venta_check|numeric|min_length[1]|max_length[11]');
                    $this->form_validation->set_rules('cantidad_costos', 'Cantidad en costo unitario', 'callback_cost_check|required|numeric|min_length[1]|max_length[11]');
                    break;
                case "devolucionesVenta":
                    $this->form_validation->set_rules('cantidad_unidades', 'Cantidad en unidades', 'callback_venta_check|numeric|min_length[1]|max_length[11]');
                    $this->form_validation->set_rules('cantidad_costos', 'Cantidad en costo unitario', 'callback_cost_check|required|numeric|min_length[1]|max_length[11]');
                    break;
            }
            if($this->input->post('otras_operaciones') != null)
            {
                $this->form_validation->set_rules('unidades', 'Tipo de movimiento');
            }else
            {
                if($this->input->post('unidades') == "salida" && $existencia_antes->existencia == 0)
                {
                    $this->form_validation->set_rules('cantidad_unidades', 'Cantidad en unidades', 'callback_venta_check|numeric|min_length[1]|max_length[11]|required');
                    $this->form_validation->set_rules('unidades', 'Tipo de movimiento', 'callback_operation_check|required');
                }else
                {
                    $this->form_validation->set_rules('cantidad_unidades', 'Cantidad en unidades', 'numeric|min_length[1]|max_length[11]|required');
                    $this->form_validation->set_rules('unidades', 'Tipo de movimiento', 'required');
                }
            }
            /*if($this->form_validation->set_rules('cantidad_unidades', 'cantidad en unidades', 'numeric|min_length[1]|max_length[11]|required'))
                $this->form_validation->set_rules('radio_unidades', 'entrada o salida', 'required', array('required' => 'Seleccione cualquiera de estos dos movimientos-1'));*/
        }
        if($this->input->post('unidades') != "salida")
        {
            //$this->form_validation->set_rules('cantidad_costos', 'Cantidad en costo unitario', 'required|numeric|min_length[1]|max_length[11]');
            if($this->input->post('cantidad_existencia') == 0)
            {
                $this->form_validation->set_rules('cantidad_costos', 'Cantidad en costo unitario', 'required|numeric|min_length[1]|max_length[11]');
            }else
            {
                $this->form_validation->set_rules('cantidad_costos', 'Cantidad en costo unitario', 'callback_cost_check|required|numeric|min_length[1]|max_length[11]');
            }
        }

        // MENSAJE
        $this->form_validation->set_message('required', '%s es un campo obligatorio');
        $this->form_validation->set_message('numeric', '%s debe ser numérico');
        $this->form_validation->set_message('min_length', '%s no debe contener menos de 1 caracter');
        $this->form_validation->set_message('max_length', '%s no debe contener más de 11 caracteres');
        $this->form_validation->set_message('alpha', '%s no debe contener caracteres alfanuméricos');
        $this->form_validation->set_message('is_unique', '%s debe tener otro nombre porque ya existe uno');

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger text-center">', '</div>');

        if(!$this->form_validation->run())
        {
            $data['title']="Alumno: Nuevo Registro de Tarjerta de Almacén";
            $data['id_empresa']=$id_empresa;
            $fields = array('id_empresa' => $id_empresa);
            $data['info'] = $this->model_exercise->get_exercise($fields);

            $fields = array('empresa_id' => $id_empresa);
            $ultimo_id = $this->model_stock_card->get_last_id($fields);
            $fields = array('id_tarjeta' => intval($ultimo_id->id));
            $existencia_antes = $this->model_stock_card->get_existencia($fields);

            if($existencia_antes == NULL)
            {
                $data['exis'] = '';
                $data['fecha_anterior'] = '';
                $data['costo_unitario'] = '';
            }
            else
            {
                $data['exis'] = $existencia_antes->existencia;
                $data['fecha_anterior'] = $existencia_antes->fecha;
                $data['costo_unitario'] = $existencia_antes->promedio;
            }

			$this->load->view('head',$data);
			$this->load->view('navbar');
			$this->load->view('student/view_add_register_sc');
			$this->load->view('foot');
        }else
        {
            // CONDICIÓN PARA INGRESAR EXISTENCIA (INVENTARIO INICIAL)
            if($this->input->post('cantidad_existencia') != null)
            {
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
                    'debe' => 0,
                    'haber' => 0,
                    'saldo' => $this->input->post('cantidad_existencia') * $this->input->post('cantidad_costos'),
                    'nombre_articulo' => $this->input->post('articulo'),
                    'tipo_unidad' => $this->input->post('unidad')
                );
            }else
            {
                $fields = array('empresa_id' => $id_empresa);
                $ultimo_id = $this->model_stock_card->get_last_id($fields);
                $fields = array('id_tarjeta' => intval($ultimo_id->id));
                $existencia_antes = $this->model_stock_card->get_existencia($fields);

                $saldo_antes = $this->model_stock_card->get_saldo($fields);

                if($this->input->post('unidades') == "entrada" && $this->input->post('otras_operaciones') == null)
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

                if($this->input->post('unidades') == "salida" && $this->input->post('otras_operaciones') == null)
                {
                    if((floatval($existencia_antes->saldo) - ($this->input->post('cantidad_unidades') * floatval($existencia_antes->promedio))) == 0 && ( floatval($existencia_antes->existencia) - floatval($this->input->post('cantidad_unidades'))) == 0)
                    {
                        $promedio = 0;
                    }else
                    {
                        $promedio = (floatval($existencia_antes->saldo) - ($this->input->post('cantidad_unidades') * floatval($existencia_antes->promedio))) / ( floatval($existencia_antes->existencia) - floatval($this->input->post('cantidad_unidades')));
                    }
                    $fields = array
                    (
                        'empresa_id' => $id_empresa,
                        'fecha' => $this->input->post('fecha_sc'),
                        'referencia' => $this->input->post('referencia'),
                        'entradas' => 0,
                        'salidas' => $this->input->post('cantidad_unidades'),
                        'existencia' => floatval($existencia_antes->existencia) - floatval($this->input->post('cantidad_unidades')),
                        //'unitario' => $this->input->post('cantidad_costos'),
                        'unitario' => $existencia_antes->promedio,
                        'promedio' => $promedio,
                        //'promedio' => (floatval($existencia_antes->saldo) - ($this->input->post('cantidad_unidades') * floatval($existencia_antes->promedio))) / ( floatval($existencia_antes->existencia) - floatval($this->input->post('cantidad_unidades'))),
                        'debe' => 0,
                        'haber' => $this->input->post('cantidad_unidades') * floatval($existencia_antes->promedio),
                        'saldo' => floatval($existencia_antes->saldo) - ($this->input->post('cantidad_unidades') * floatval($existencia_antes->promedio))
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
                            'promedio' => (floatval($existencia_antes->saldo) + ($this->input->post('afectacion'))) / floatval($existencia_antes->existencia),
                            'debe' => $this->input->post('afectacion'),
                            'haber' => 0, //$this->input->post('cantidad_unidades') * $this->input->post('cantidad_costos'),
                            'saldo' => floatval($existencia_antes->saldo) + $this->input->post('afectacion')
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
                            'unitario' => 0, //$this->input->post('cantidad_costos'),
                            'promedio' => (floatval($existencia_antes->saldo) - ($this->input->post('afectacion'))) / floatval($existencia_antes->existencia),
                            'debe' => 0,
                            'haber' => $this->input->post('afectacion'),
                            'saldo' => floatval($existencia_antes->saldo) - $this->input->post('afectacion')
                        );
                        break;
                    case "rebajasCompra": //Afecta Haber
                        $fields = array
                        (
                            'empresa_id' => $id_empresa,
                            'fecha' => $this->input->post('fecha_sc'),
                            'referencia' => $this->input->post('referencia'),
                            'entradas' => 0,
                            'salidas' => 0,
                            'existencia' => floatval($existencia_antes->existencia) - floatval($this->input->post('cantidad_unidades')),
                            'unitario' => 0, //$this->input->post('cantidad_costos'),
                            'promedio' => (floatval($existencia_antes->saldo) + ($this->input->post('afectacion'))) / floatval($existencia_antes->existencia),
                            'debe' => 0,
                            'haber' => $this->input->post('afectacion'),
                            'saldo' => floatval($existencia_antes->saldo) - $this->input->post('afectacion')
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
                            'promedio' => (floatval($existencia_antes->saldo) - ($this->input->post('cantidad_unidades') * $this->input->post('cantidad_costos'))) / (floatval($existencia_antes->existencia) - (floatval($this->input->post('cantidad_unidades')))),
                            'debe' => 0,
                            'haber' => $this->input->post('cantidad_unidades') * $this->input->post('cantidad_costos'),
                            'saldo' => floatval($existencia_antes->saldo) - ($this->input->post('cantidad_unidades') * $this->input->post('cantidad_costos'))
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
                            'existencia' => floatval($existencia_antes->existencia) + floatval($this->input->post('cantidad_unidades')),
                            'unitario' => $this->input->post('cantidad_costos'),
                            'promedio' => (floatval($existencia_antes->saldo) - ($this->input->post('cantidad_unidades') * $this->input->post('cantidad_costos'))) / (floatval($existencia_antes->existencia) - (floatval($this->input->post('cantidad_unidades')))),
                            'debe' => $this->input->post('cantidad_unidades') * $this->input->post('cantidad_costos'),
                            'haber' => 0,
                            'saldo' => floatval($existencia_antes->saldo) + ($this->input->post('cantidad_unidades') * $this->input->post('cantidad_costos'))
                        );
                    break;

                }
            }

            $info = $this->model_stock_card->insert_ta($fields);
            if($info)
            {
                $this->session->set_flashdata('msg', '<div id="men_val" class="alert alert-success"> Registro nuevo agregado correctamente</div>' );
            }else
            {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger"> Error al agregar registro</div>');
            }
            redirect('stock_card/list_sc/'.$id_empresa, 'refresh');
        }
    }

    public function edit_register($id_empresa = null, $id_register = null)
    {
        $fields = array('empresa_id' => $id_empresa);
        $ultimo_id = $this->model_stock_card->get_last_id($fields);
        $fields = array('id_tarjeta' => intval($ultimo_id->id));
        $existencia_antes = $this->model_stock_card->get_existencia($fields);
        $exis_ref = $this->model_stock_card->get_unic($id_empresa, $this->input->post('referencia'));
        $total = $this->model_stock_card->get_total($id_empresa);
        $data['total'] = $total->total;
        //echo("TOTAL DE ELEMENTOS EN TA: ".$total->total);

        //var_dump($total);

        // REGLAS
        //$this->form_validation->set_rules('fecha_sc', 'fecha', 'required');
        $this->form_validation->set_rules('fecha_sc', 'Fecha', 'callback_date_check', 'required');
        if($this->input->post('referencia') == $existencia_antes->referencia)
        {
            $this->form_validation->set_rules('referencia', 'Referencia', 'required');
        }else
        {
            if($exis_ref)
            {
                $this->form_validation->set_rules('referencia', 'Referencia', 'required|is_unique[tarjeta_almacen.referencia]');
            }else
            {
                $this->form_validation->set_rules('referencia', 'Referencia', 'required');
            }
        }

        if($existencia_antes == NULL)
        {
            $this->form_validation->set_rules('cantidad_existencia', 'Cantidad en existencia', 'numeric|min_length[1]|max_length[11]|required');
            $this->form_validation->set_rules('cantidad_unidades', 'Cantidad en unidades', 'numeric|min_length[1]|max_length[11]');
            $this->form_validation->set_rules('articulo', 'Nombre del artículo', 'min_length[0]|max_length[50]|required');
            $this->form_validation->set_rules('unidad', 'Tipo de unidad', 'min_length[1]|max_length[11]|required|alpha');
        }else
        {
            $this->form_validation->set_rules('cantidad_existencia', 'Cantidad en existencia', 'numeric|min_length[1]|max_length[11]');

            switch($this->input->post('otras_operaciones'))
            {
                case "gastosCompra":
                    $this->form_validation->set_rules('afectacion', 'Cantidad en afectación', 'callback_venta_check|numeric|min_length[1]|max_length[11]|required');
                    break;
                case "descuentosCompra":
                    $this->form_validation->set_rules('afectacion', 'Cantidad en afectación', 'callback_venta_check|numeric|min_length[1]|max_length[11]|required');
                    break;
                case "rebajasCompra":
                    $this->form_validation->set_rules('afectacion', 'Cantidad en afectación', 'callback_venta_check|numeric|min_length[1]|max_length[11]|required');
                    break;
                case "devolucionesCompra":
                    $this->form_validation->set_rules('cantidad_unidades', 'Cantidad en unidades', 'callback_venta_check|numeric|min_length[1]|max_length[11]');
                    $this->form_validation->set_rules('cantidad_costos', 'Cantidad en costo unitario', 'callback_cost_check|required|numeric|min_length[1]|max_length[11]');
                    break;
                case "devolucionesVenta":
                    $this->form_validation->set_rules('cantidad_unidades', 'Cantidad en unidades', 'callback_venta_check|numeric|min_length[1]|max_length[11]');
                    $this->form_validation->set_rules('cantidad_costos', 'Cantidad en costo unitario', 'callback_cost_check|required|numeric|min_length[1]|max_length[11]');
                    break;
            }
            if($this->input->post('otras_operaciones') != null)
            {
                $this->form_validation->set_rules('unidades', 'Tipo de movimiento');
            }else
            {
                if($this->input->post('unidades') == "salida" && $existencia_antes->existencia == 0)
                {
                    $this->form_validation->set_rules('cantidad_unidades', 'Cantidad en unidades', 'callback_venta_check|numeric|min_length[1]|max_length[11]|required');
                    $this->form_validation->set_rules('unidades', 'Tipo de movimiento', 'callback_operation_check|required');
                }else
                {
                    $this->form_validation->set_rules('cantidad_unidades', 'Cantidad en unidades', 'numeric|min_length[1]|max_length[11]|required');
                    $this->form_validation->set_rules('unidades', 'Tipo de movimiento', 'required');
                }
            }
        }
        if($this->input->post('unidades') != "salida")
        {
            //$this->form_validation->set_rules('cantidad_costos', 'Cantidad en costo unitario', 'required|numeric|min_length[1]|max_length[11]');
            if($this->input->post('cantidad_existencia') == 0)
            {
                $this->form_validation->set_rules('cantidad_costos', 'Cantidad en costo unitario', 'required|numeric|min_length[1]|max_length[11]');
            }else
            {
                $this->form_validation->set_rules('cantidad_costos', 'Cantidad en costo unitario', 'callback_cost_check|required|numeric|min_length[1]|max_length[11]');
            }
        }

        // MENSAJE
        $this->form_validation->set_message('required', '%s es un campo obligatorio');
        $this->form_validation->set_message('numeric', '%s debe ser numérico');
        $this->form_validation->set_message('min_length', '%s no debe de contener menos de 1 caracter');
        $this->form_validation->set_message('max_length', '%s no debe de contener más de 11 caracteres');
        $this->form_validation->set_message('alpha', '%s no debe de contener caracteres alfanuméricos');
        $this->form_validation->set_message('is_unique', '%s debe tener otro nombre porque ya existe uno');

        $this->form_validation->set_error_delimiters('<div class="alert alert-danger text-center">', '</div>');

        if(!$this->form_validation->run())
        {
            $data['title']="Alumno: Editar Registro de Tarjerta de Almacén";
            $data['id_empresa']=$id_empresa;
            $fields = array('id_empresa' => $id_empresa);
            $data['info'] = $this->model_exercise->get_exercise($fields);

            $fields = array('empresa_id' => $id_empresa);
            $ultimo_id = $this->model_stock_card->get_last_id($fields);

            $penultim_id = $this->model_stock_card->get_penultimate_id($id_empresa);
            $fields = array('id_tarjeta' => intval($penultim_id->id_tarjeta));
            $penultim = $this->model_stock_card->get_existencia($fields);
            //$penultim = $penultim_id->id_tarjeta;
            //echo("PENULTIMO ID: ".$penultim);
            //var_dump($penultim);


            $fields = array('id_tarjeta' => intval($ultimo_id->id));
            $data['info_edit'] = $this->model_stock_card->get_info($fields);
            $existencia_antes = $this->model_stock_card->get_existencia($fields);

            if($existencia_antes == NULL)
            {
                $data['exis'] = '';
                $data['fecha_anterior'] = '';
                $data['costo_unitario'] = '';
            }
            else
            {
                $data['exis'] = $existencia_antes->existencia;
                $data['fecha_anterior'] = $existencia_antes->fecha;
                $data['costo_unitario'] = $existencia_antes->promedio;
            }

			$this->load->view('head',$data);
			$this->load->view('navbar');
			$this->load->view('student/view_edit_register_sc');
			$this->load->view('foot');
        }else
        {
            // CONDICIÓN PARA INGRESAR EXISTENCIA (INVENTARIO INICIAL)
            if($this->input->post('cantidad_existencia') != null)
            {
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
                    'saldo' => $this->input->post('cantidad_existencia') * $this->input->post('cantidad_costos'),
                    'nombre_articulo' => $this->input->post('articulo'),
                    'tipo_unidad' => $this->input->post('unidad')
                );
            }else
            {
                $fields = array('empresa_id' => $id_empresa);
                $ultimo_id = $this->model_stock_card->get_last_id($fields);

                $penultim_id = $this->model_stock_card->get_penultimate_id($id_empresa);
                $fields = array('id_tarjeta' => intval($penultim_id->id_tarjeta));
                $penultim = $this->model_stock_card->get_existencia($fields);

                $fields = array('id_tarjeta' => intval($ultimo_id->id));
                $existencia_antes = $this->model_stock_card->get_existencia($fields);
                $id_ = $existencia_antes->id_tarjeta;

                $saldo_antes = $this->model_stock_card->get_saldo($fields);

                if($this->input->post('unidades') == "entrada" && $this->input->post('otras_operaciones') == null)
                {
                    $fields = array
                    (
                        'empresa_id' => $id_empresa,
                        'fecha' => $this->input->post('fecha_sc'),
                        'referencia' => $this->input->post('referencia'),
                        'entradas' => $this->input->post('cantidad_unidades'),
                        'salidas' => 0,
                        'existencia' => floatval($this->input->post('cantidad_unidades')) + floatval($penultim->existencia),
                        'unitario' => $this->input->post('cantidad_costos'),
                        'promedio' => (floatval($penultim->saldo) + ($this->input->post('cantidad_unidades') * $this->input->post('cantidad_costos'))) / (floatval($this->input->post('cantidad_unidades')) + floatval($penultim->existencia)),
                        'debe' => $this->input->post('cantidad_unidades') * $this->input->post('cantidad_costos'),
                        'haber' => 0,
                        'saldo' => floatval($penultim->saldo) + ($this->input->post('cantidad_unidades') * $this->input->post('cantidad_costos'))
                    );
                }

                if($this->input->post('unidades') == "salida" && $this->input->post('otras_operaciones') == null)
                {
                    if((floatval($penultim->saldo) - ($this->input->post('cantidad_unidades') * floatval($penultim->promedio))) == 0 && ( floatval($penultim->existencia) - floatval($this->input->post('cantidad_unidades'))) == 0)
                    {
                        $promedio = 0;
                    }else
                    {
                        $promedio = (floatval($penultim->saldo) - ($this->input->post('cantidad_unidades') * floatval($penultim->promedio))) / ( floatval($penultim->existencia) - floatval($this->input->post('cantidad_unidades')));
                    }
                    $fields = array
                    (
                        'empresa_id' => $id_empresa,
                        'fecha' => $this->input->post('fecha_sc'),
                        'referencia' => $this->input->post('referencia'),
                        'entradas' => 0,
                        'salidas' => $this->input->post('cantidad_unidades'),
                        'existencia' => floatval($penultim->existencia) - floatval($this->input->post('cantidad_unidades')),
                        //'unitario' => $this->input->post('cantidad_costos'),
                        'unitario' => $penultim->promedio,
                        'promedio' => $promedio,
                        //'promedio' => (floatval($existencia_antes->saldo) - ($this->input->post('cantidad_unidades') * floatval($existencia_antes->promedio))) / ( floatval($existencia_antes->existencia) - floatval($this->input->post('cantidad_unidades'))),
                        'debe' => 0,
                        'haber' => $this->input->post('cantidad_unidades') * floatval($penultim->promedio),
                        'saldo' => floatval($penultim->saldo) - ($this->input->post('cantidad_unidades') * floatval($penultim->promedio))
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
                            'existencia' => floatval($penultim->existencia) - floatval($this->input->post('cantidad_unidades')),
                            'unitario' => 0, //$this->input->post('cantidad_costos'),
                            'promedio' => (floatval($penultim->saldo) + ($this->input->post('afectacion'))) / floatval($penultim->existencia),
                            'debe' => $this->input->post('afectacion'),
                            'haber' => 0, //$this->input->post('cantidad_unidades') * $this->input->post('cantidad_costos'),
                            'saldo' => floatval($penultim->saldo) + $this->input->post('afectacion')
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
                            'existencia' => floatval($penultim->existencia) - floatval($this->input->post('cantidad_unidades')),
                            'unitario' => 0, //$this->input->post('cantidad_costos'),
                            'promedio' => (floatval($penultim->saldo) - ($this->input->post('afectacion'))) / floatval($penultim->existencia),
                            'debe' => 0,
                            'haber' => $this->input->post('afectacion'),
                            'saldo' => floatval($penultim->saldo) - $this->input->post('afectacion')
                        );
                        break;
                    case "rebajasCompra": //Afecta Haber
                        $fields = array
                        (
                            'empresa_id' => $id_empresa,
                            'fecha' => $this->input->post('fecha_sc'),
                            'referencia' => $this->input->post('referencia'),
                            'entradas' => 0,
                            'salidas' => 0,
                            'existencia' => floatval($penultim->existencia) - floatval($this->input->post('cantidad_unidades')),
                            'unitario' => 0, //$this->input->post('cantidad_costos'),
                            'promedio' => (floatval($penultim->saldo) + ($this->input->post('afectacion'))) / floatval($penultim->existencia),
                            'debe' => 0,
                            'haber' => $this->input->post('afectacion'),
                            'saldo' => floatval($penultim->saldo) - $this->input->post('afectacion')
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
                            'existencia' => floatval($penultim->existencia) - floatval($this->input->post('cantidad_unidades')),
                            'unitario' => $this->input->post('cantidad_costos'),
                            'promedio' => (floatval($penultim->saldo) - ($this->input->post('cantidad_unidades') * $this->input->post('cantidad_costos'))) / (floatval($penultim->existencia) - (floatval($this->input->post('cantidad_unidades')))),
                            'debe' => 0,
                            'haber' => $this->input->post('cantidad_unidades') * $this->input->post('cantidad_costos'),
                            'saldo' => floatval($penultim->saldo) - ($this->input->post('cantidad_unidades') * $this->input->post('cantidad_costos'))
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
                            'existencia' => floatval($penultim->existencia) + floatval($this->input->post('cantidad_unidades')),
                            'unitario' => $this->input->post('cantidad_costos'),
                            'promedio' => (floatval($penultim->saldo) - ($this->input->post('cantidad_unidades') * $this->input->post('cantidad_costos'))) / (floatval($penultim->existencia) - (floatval($this->input->post('cantidad_unidades')))),
                            'debe' => $this->input->post('cantidad_unidades') * $this->input->post('cantidad_costos'),
                            'haber' => 0,
                            'saldo' => floatval($penultim->saldo) + ($this->input->post('cantidad_unidades') * $this->input->post('cantidad_costos'))
                        );
                    break;

                }
            }

            //$info = $this->model_stock_card->insert_ta($fields);
            $update = $this->model_stock_card->update_ta($fields, $id_);
            if($update)
            {
                $this->session->set_flashdata('msg', '<div id="men_val" class="alert alert-success"> Registro editado correctamente</div>' );
            }else
            {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger"> Error al editar registro</div>');
            }
            redirect('stock_card/list_sc/'.$id_empresa, 'refresh');
        }
    }

    public function delete_register($id_empresa=null)
    {
        $fields = array('id_tarjeta' => $this->input->post('id_register'));
        $delete_register = $this->model_stock_card->delete_register($fields);
        if($delete_register)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-success"> Registro borrado correctamente</div>');
        }
        else
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger"> Error al borrar el registro</div>');
        }
        redirect('stock_card/list_sc/'.$id_empresa, 'refresh');
    }

    public function terminar($id_empresa=null)
    {
        $fields = $this->input->post('id_terminar');
        $delete_register = $this->model_stock_card->terminar($fields);
        if($delete_register)
        {
            $this->session->set_flashdata('msg','<div class="alert alert-success"> A continuación se muestra el resultado</div>');
        }
        else
        {
            $this->session->set_flashdata('msg','<div class="alert alert-danger"> Error al mostrar el resultado</div>');
        }
        redirect('stock_card/list_sc/'.$id_empresa, 'refresh');
    }

    public function cost_check($str)
    {
        if($str == NULL)
        {
            $this->form_validation->set_message('cost_check', '%s es un campo obligatorio');
            return FALSE;
        }else
        {
            if($str == 0)
            {
                $this->form_validation->set_message('cost_check', '%s debe ser distinto a 0');
                return FALSE;
            }else
                return TRUE;
        }
    }

    public function venta_check($str)
    {
        if($str == NULL)
        {
            $this->form_validation->set_message('venta_check', '%s es un campo obligatorio');
            return FALSE;
        }else
        {
            if($str == 0)
            {
                $this->form_validation->set_message('venta_check', '%s debe ser distinto a 0');
                return FALSE;
            }else
                return TRUE;
        }
    }

    public function operation_check($str)
    {
        if($str == NULL)
        {
            $this->form_validation->set_message('operation_check', '%s es un campo obligatorio');
            return FALSE;
        }else
        {
            if($str == "salida")
            {
                $this->form_validation->set_message('operation_check', '%s no debe ser salida cuando aun no hay nada en existencia');
                return FALSE;
            }else
                return TRUE;
        }
    }

    public function date_check($str)
    {
        if($str == '' || $str == '0000-00-00')
        {
            $this->form_validation->set_message('date_check', '%s es un campo obligatorio');
            return FALSE;
        }
        else
        {
            if($this->input->post('fecha_anterior'))
            {
                if($this->input->post('fecha_anterior') > ($str))
                {
                    //$this->form_validation->set_message('date_check', 'No puede ser una fecha anterior, verifique de nuevo.');
                    $this->form_validation->set_message('date_check', 'La fecha debe ser posterior al del último movimiento realizado, verifique de nuevo.');
                    return FALSE;
                }
                else
                {
                    return TRUE;
                }
            }else
            {
                if($str == '' || $str == '0000-00-00')
                {
                    $this->form_validation->set_message('date_check', '%s es un campo obligatorio');
                    return FALSE;
                }else
                    return TRUE;
            }
        }

    }

}
