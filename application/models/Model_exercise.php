<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_exercise extends CI_Model
{
  //Insertar ejercicio
  public function insert_exercise($data)
  {
    return $this->db->insert('empresa', $data);
  }
  //Ver los ejercicios registrados
  public function get_exercises()
  {
    $sql = $this->db->get_where('empresa');
    return $sql->result();
  }
  //Ver ejercicio registrado
  public function get_exercise($data)
  {
    $sql = $this->db->get_where('empresa', $data);
    return $sql->row();
  }
  //Actualizar ejercicio
  public function update_exercise($data)
  {
    $this->db->where('id_empresa', $data['id_empresa']);
    return $this->db->update('empresa', $data);
  }
  //Eliminar ejercicio
  public function delete_exercise($data)
  {
    return $this->db->delete('empresa' , $data );
  }
}