<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Major_schemes extends CI_Controller
{
  function __construct()
  {
    parent:: __construct();
  }

  /*

SELECT * FROM asiento
JOIN empresa
on asiento.empresa_id = empresa.id_empresa
JOIN registro_asiento
on registro_asiento.asiento_id = asiento.id_asiento
LEFT JOIN registro_parcial
on registro_parcial.registro_id = registro_asiento.id_registro

//todos los datos 

SELECT 
asiento.id_asiento, empresa.id_empresa, asiento.fecha, empresa.nombre, registro_asiento.id_registro, registro_asiento.asiento_id, registro_asiento.cuenta, registro_asiento.debe, registro_asiento.haber, registro_parcial.registro_id, registro_parcial.concepto, registro_parcial.cantidad
FROM asiento
JOIN empresa
on asiento.empresa_id = empresa.id_empresa
JOIN registro_asiento
on registro_asiento.asiento_id = asiento.id_asiento
LEFT JOIN registro_parcial
on registro_parcial.registro_id = registro_asiento.id_registro
WHERE empresa.id_empresa = 15
ORDER by registro_asiento.cuenta ASC

//cuentas utilizadas


SELECT registro_asiento.cuenta
FROM empresa
JOIN asiento
ON asiento.empresa_id = empresa.id_empresa
JOIN registro_asiento
ON registro_asiento.asiento_id = asiento.id_asiento
WHERE empresa.id_empresa = 15
GROUP BY registro_asiento.cuenta

//solo los parciales
SELECT asiento.id_asiento, empresa.id_empresa, asiento.fecha, empresa.nombre, registro_asiento.id_registro, registro_asiento.asiento_id, registro_asiento.cuenta, registro_asiento.debe, registro_asiento.haber, registro_parcial.registro_id, registro_parcial.concepto, registro_parcial.cantidad FROM asiento JOIN empresa on asiento.empresa_id = empresa.id_empresa JOIN registro_asiento on registro_asiento.asiento_id = asiento.id_asiento RIGHT JOIN registro_parcial on registro_parcial.registro_id = registro_asiento.id_registro WHERE empresa.id_empresa = 15 ORDER BY `registro_parcial`.`registro_id` ASC

  */
  
  public function schemes($id_empresa)
	{
    $data['title']="Esquemas de mayor";
    $fields = array('empresa_id' => $id_empresa);


    $data['asientos'] = $this->model_schemes->get_asientos($fields);
    $data['registros'] = $this->model_schemes->get_all($fields);
    $data['cuentas'] = $this->model_schemes->get_cuentas($fields);
    $data['parciales'] = $this->model_schemes->get_partials($fields);
    
    //echo "<pre>".print_r($data['asientos'], 1)."</pre>";
    //echo "<hr>";
    //echo "<pre>".print_r($data['cuentas'], 1)."</pre>";
    //echo "<hr>";
    //echo "<pre>".print_r($data['registros'], 1)."</pre>";
    //echo "<pre>".print_r($data['parciales'], 1)."</pre>";
    

    //echo "<pre>".print_r($data['asientos'][3], 1)."</pre>";


    echo "<hr>";
    
    $this->load->view('head',$data);
    $this->load->view('navbar');
    $this->load->view('student/view_major_schemes');
    $this->load->view('foot');
    
	}
}