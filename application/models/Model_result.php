<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_result extends CI_Model
{
  //Insertar cuentas
  public function get_accounts_rslt($data)
  {
  	$sql = $this->db->get_where('registro_asiento',$data);
    return $sql->result();
  }
}