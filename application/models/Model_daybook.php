<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_daybook extends CI_Model
{
  //Insertar asiento contable
  public function insert_entry($data)
  {
    return $this->db->insert('asiento', $data);
  }
  //Ver los asientos contables registrados
  public function get_entries($data)
  {
    $sql = $this->db->get_where('asiento', $data);
    return $sql->result();
  }
  //Ver asiento contable registrado
  public function get_entry($data)
  {
    $sql = $this->db->get_where('asiento', $data);
    return $sql->row();
  }
  //Actualizar asiento contable
  public function update_entry($data)
  {
    $this->db->where('id', $data['id']);
    return $this->db->update('asiento', $data);
  }
  //Eliminar asiento contable
  public function delete_entry($data)
  {
    return $this->db->delete( 'asiento' , $data );
  }
}