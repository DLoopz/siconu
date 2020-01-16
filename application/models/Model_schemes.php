<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_schemes extends CI_Model
{
  

  public function get_asientos($data)
  {
    $sql = $this->db->get_where('asiento',$data);
    return $sql->result();
  }

  public function get_cuentas($data)
  {
    $sql = $this->db->query("
      SELECT registro_asiento.cuenta
      FROM empresa
      JOIN asiento
      ON asiento.empresa_id = empresa.id_empresa
      JOIN registro_asiento
      ON registro_asiento.asiento_id = asiento.id_asiento
      WHERE empresa.id_empresa = {$data['empresa_id']}
      GROUP BY registro_asiento.cuenta
    ");
    return $sql->result();
  }



  public function get_all($data)
  {
    
    $sql = $this->db->query("
      SELECT
      asiento.id_asiento, empresa.id_empresa, asiento.fecha, empresa.nombre, registro_asiento.id_registro, registro_asiento.asiento_id, registro_asiento.cuenta, registro_asiento.debe, registro_asiento.haber, registro_parcial.registro_id, registro_parcial.concepto, registro_parcial.cantidad
      FROM asiento
      JOIN empresa
      on asiento.empresa_id = empresa.id_empresa
      JOIN registro_asiento
      on registro_asiento.asiento_id = asiento.id_asiento
      LEFT JOIN registro_parcial
      on registro_parcial.registro_id = registro_asiento.id_registro
      WHERE empresa.id_empresa = {$data['empresa_id']}
      ORDER by registro_asiento.cuenta ASC
    ");
    
    return $sql->result();
    
  }

  public function get_partials($data)
  {
    $sql = $this->db->query("
      SELECT asiento.id_asiento, empresa.id_empresa, registro_asiento.id_registro, registro_asiento.asiento_id, registro_asiento.cuenta, registro_asiento.debe, registro_asiento.haber, registro_parcial.registro_id FROM asiento JOIN empresa on asiento.empresa_id = empresa.id_empresa JOIN registro_asiento on registro_asiento.asiento_id = asiento.id_asiento RIGHT JOIN registro_parcial on registro_parcial.registro_id = registro_asiento.id_registro
      WHERE empresa.id_empresa = {$data['empresa_id']}
      GROUP by registro_asiento.id_registro 
      ORDER BY registro_parcial.registro_id ASC
    ");
    
    return $sql->result();
  }

}