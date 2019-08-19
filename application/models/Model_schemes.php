<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_schemes extends CI_Model
{
  //Insertar ejercicio
  /*public function insert_exercise($data)
  {
    return $this->db->insert('registro_asiento', $data);
  }*/
  //Ver los ejercicios registrados
  public function get_registers($data)
  {
    $this->db->order_by('cuenta');
    //$this->db->order_by('id_asiento');
    $sql = $this->db->get_where('rayado_diario',$data);
    return $sql->result();
  }
  //Ver ejercicio registrado
  public function get_exercise($data)
  {
    $sql = $this->db->get_where('registro_asiento', $data);
    return $sql->row();
  }
  //Actualizar ejercicio
  /*public function update_exercise($data)
  {
    $this->db->where('id_registro_asiento', $data['id_registro_asiento']);
    return $this->db->update('registro_asiento', $data);
  }
  //Eliminar ejercicio
  public function delete_exercise($data)
  {
    return $this->db->delete('registro_asiento' , $data );
  }*/
}