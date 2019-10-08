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
  	$sql = $this->db->get_where('rayado_diario',$data);
    return $sql->result();
  }
}