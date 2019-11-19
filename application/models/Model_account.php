<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_account extends CI_Model
{
  //Insertar cuentas
  public function insert_account($data)
  {
    //se inserta una nueva cuenta
    $sql=$this->db->insert('catalogo_usuario', array('nombre' => $data['nombre'],'tipo_id' => $data['tipo_id'],'clasificacion_id' => $data['clasificacion_id'],'usuario_id' => $data['usuario_id']));
    return $sql;   
  }
  //Eliminar cuenta
  public function delete_account($data)
  {
    //id_catalogog usario de la cuenta y el user_id
    $sql = $this->db->query("
      SELECT cu.id_catalogo_usuario, cu.nombre, ra.catalogo_usuario_id, ra.cuenta, cu.usuario_id, u.id_usuario, u.matricula from catalogo_usuario cu
      JOIN registro_asiento ra
      on cu.id_catalogo_usuario = ra.catalogo_usuario_id and ra.catalogo_usuario_id = {$data['id_catalogo_usuario']}
      join usuario u
      on u.id_usuario = cu.usuario_id and cu.usuario_id = {$data['usuario_id']}
    ");
    if ($sql->num_rows()>0) {
      return false;
    }
    else
    {
      return $this->db->delete( 'catalogo_usuario' , $data );
    }
  }

  public function delete_catalog($data)
  {
    
    $sql = $this->db->query("
      SELECT * FROM catalogo_usuario ca
      JOIN registro_asiento ra
      ON ca.id_catalogo_usuario = ra.catalogo_usuario_id and ca.usuario_id = {$data['usuario_id']}
    ");
    if ($sql->num_rows()>0) {
      return false;
    }
    else
    {
      return $this->db->delete( 'catalogo_usuario' , $data );
    }
  }


  //Actualizar cuentas
  public function update_account($data)
  {
    $this->db->where('id_catalogo_usuario', $data['id_catalogo_usuario']);
    return $this->db->update('catalogo_usuario', $data);
  }
  //Elim
  //Ver las cuentas estandar
  public function get_std_accounts()
  {
    $sql = $this->db->get_where('catalogo_estandar');
    return $sql->result();
  }
  //Ver catalogo registrado
  public function get_catalog($data)
  {
    $this->db->order_by('tipo_id');
    $this->db->order_by('clasificacion_id');
    $this->db->order_by('id_catalogo_usuario');
    $sql = $this->db->get_where('catalogo_usuario',$data);
    return $sql->result();
  }

  public function get_account($data)
  {
    $sql = $this->db->get_where('catalogo_usuario', $data);
    return $sql->row();
  }

  public function get_tipo_cuenta()
  {
    $sql = $this->db->get_where('tipo_cuenta');
    return $sql->result();
  }
  public function get_tipo_cuenta_basica()
  {
    $this->db->where('id_tipo != 4');
    $this->db->where('id_tipo != 5');
    $sql = $this->db->get_where('tipo_cuenta');
    return $sql->result();
  }
  public function get_clasificacion_cuenta()
  {
    $sql = $this->db->get_where('clasificacion_cuenta');
    return $sql->result();
  }
  public function get_catalog_student_inventarios($data)
  {
    $this->db->order_by('tipo_id');
    $this->db->order_by('clasificacion_id');
    $this->db->order_by('id_catalogo_usuario');
    $this->db->where('fecha >= "'.$data['fecha_inicio'].'"');
    $sql = $this->db->get_where('catalogo_grupo',$data);
    return $sql->result();
  }
  public function get_catalog_student($data)
  {
    $this->db->order_by('tipo_id');
    $this->db->order_by('clasificacion_id');
    $this->db->order_by('id_catalogo_usuario');
    $sql = $this->db->get_where('catalogo_grupo',$data);
    return $sql->result();
  }
  public function get_catalog_student_mercancias($data)
  {
    $this->db->order_by('tipo_id');
    $this->db->order_by('clasificacion_id');
    $this->db->order_by('id_catalogo_usuario');
    $this->db->where('tipo_id != 4');
    $this->db->where('tipo_id != 5');
    $sql = $this->db->get_where('catalogo_grupo',$data);
    return $sql->result();
  }
  //Actualizar cuentas
  /*public function update_group($data)
  {
    $this->db->where('id_grupo', $data['id_grupo']);
    return $this->db->update('grupo', $data);
  }
  //Eliminar cuentas
  public function delete_group($data)
  {
    return $this->db->delete( 'grupo' , $data );
  }*/
}
