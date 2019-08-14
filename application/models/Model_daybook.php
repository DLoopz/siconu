<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_daybook extends CI_Model
{
  //Insertar asiento contable
  public function insert_entry($data)
  {
    $sql= $this->db->insert('asiento', $data);
    $this->db->select_max('id_asiento');
    $sql=$this->db->get('asiento');
    return $sql->row();
  }
  //ultimo registro
  public function last_entry($data)
  {
    $this->db->select_max('id_asiento');
    $this->db->where('empresa_id',$data['empresa_id']);
    $sql=$this->db->get('asiento');
    return $sql->row();
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
    $this->db->where('id_asiento', $data['id_asiento']);
    return $this->db->update('asiento', $data);
  }
  //Eliminar asiento contable
  public function delete_entry($data)
  {
    return $this->db->delete( 'asiento' , $data );
  }

  //registros en los asientos contables
   //Ver todos los registros de los asientos de la empresa
  public function get_all_registers($data)
  {
    $sql = $this->db->get_where('rayado_diario', $data);
    return $sql->result();
  }
  //Ver los registros registrados en un asiento
  public function get_registers($data)
  {
    $sql = $this->db->get_where('registro_asiento', $data);
    return $sql->result();
  }
  public function insert_register($data)
  {
    return $this->db->insert('registro_asiento', $data);
  }
    //Eliminar asiento contable
  public function delete_register($data)
  {
    return $this->db->delete( 'registro_asiento' , $data );
  }

}