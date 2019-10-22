<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_result extends CI_Model
{
  //Insertar cuentas
  public function get_accounts_rslt($data)
  {
  	$this->db->select('cuenta');
  	$this->db->select('folio');
  	$this->db->select('catalogo_usuario_id');
  	$this->db->select_sum('parcial');
  	$this->db->select_sum('debe');
  	$this->db->select_sum('haber');
  	$this->db->group_by('catalogo_usuario_id');
  	$this->db->group_by('cuenta');
  	$this->db->group_by('folio');
    $this->db->where('fecha >= "'.$data['fecha_inicio'].'"');
    $this->db->where('fecha <= "'.$data['fecha_fin'].'"');
    $this->db->where('empresa_id',$data['empresa_id']);
  	$sql = $this->db->get_where('rayado_diario');
    echo $data['fecha_inicio'];
    echo $data['fecha_fin'];
    return $sql->result();   
  }
}