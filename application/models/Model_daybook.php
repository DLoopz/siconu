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
    $this->db->order_by('haber');
    $sql = $this->db->get_where('rayado_diario', $data);
    return $sql->result();
  }
  //Ver los registros en un asiento
  public function get_registers($data)
  {
    $this->db->order_by('haber');
    $sql = $this->db->get_where('registro_asiento', $data);
    return $sql->result();
  }
  //Ver registro registrado
  public function get_register($data)
  {
    $sql = $this->db->get_where('registro_asiento', $data);
    return $sql->row();
  }
  public function last_register($data)
  {
    $this->db->select_max('id_registro');
    $this->db->where('asiento_id',$data['asiento_id']);
    $sql=$this->db->get('registro_asiento');
    return $sql->row();
  }
  public function insert_register($data)
  {
    return $this->db->insert('registro_asiento', $data);
  }
  public function delete_register($data)
  {
    return $this->db->delete( 'registro_asiento' , $data );
  }
  //borrar parciales
  public function delete_parciales($data)
  {
    return $this->db->delete( 'registro_parcial' , $data );
  }
  //Actualizar registro de asiento
  public function update_register($data)
  {
    $this->db->where('id_registro', $data['id_registro']);
    return $this->db->update('registro_asiento', $data);
  }
  //--------Registros parciales
  //ver las partes de un registro parcial
  public function get_registers_partial($data)
  {
    $sql = $this->db->get_where('registro_parcial', $data);
    return $sql->result();
  }
  //obtener los registros parciales
  public function get_partials($data)
  {
    $sql = $this->db->get_where('parcial', $data);
    return $sql->result();
  }




  public function insert_register_partial($data)
  {
    //aqui 
    $add = $this->db->insert('registro_parcial', $data);
    return $add;
  }
  public function update_register_partial($data)
  {
    //aqui
    //actualizar a 1 los parciales
    $this->db->where('agregar', 0);
    $this->db->update('registro_parcial',  array('agregar' => 1 ));
    //actualizar registro asiento, el debe o el haber con la cantidad total
    $this->db->where('id_registro', $data['id_registro']);
    return $this->db->update('registro_asiento', $data);

  }
  public function cancel_partials()
  {
    //aqui
    $this->db->where('parcial = 1 and debe = 0 and haber = 0');
    $this->db->delete('registro_asiento');

    $this->db->where('agregar <> 1');
    $this->db->delete('registro_parcial');

    //revisar que cada cuenta en registr_asiento con parcial = 1
    // tenga registros parciales en registro_parcial

    $con_parcial = $this->db->where('parcial = 1');
    $sql = $this->db->get('registro_asiento');

    //echo '<pre>'.print_r($sql->result(),1).'</pre>';

    foreach ($sql->result() as $r) {
      $f = array('registro_id' => $r->id_registro );
      
      $sql = $this->db->get_where('registro_parcial', $f);

      if (!$sql->num_rows()) {
        $f = array('id_registro' =>  $r->id_registro);
        $this->db->delete('registro_asiento', $f);
      }
    }

    
    
  }




  //estado de la empresa
  public function get_status($data)
  {
    $sql = $this->db->get_where('empresa', $data);
    return $sql->row();
  }
  
  //activar parcial
  public function partial($data)
  {
    $this->db->where('id_registro', $data['registro_id']);
    return $this->db->update('registro_asiento', $data);
  }

  //obtener datos de un parcial
  public function get_partial($data)
  {
    $sql = $this->db->get_where('registro_asiento', $data);
    return $sql->row();
  }

  //obtener parcial de registro parcial
  public function get_partial_rp($data)
  {
    $sql = $this->db->get_where('registro_parcial', $data);
    return $sql->row();
  }

  //obtene parciales de registro parcial
  public function get_partials_rp($data)
  {
    $sql = $this->db->get_where('registro_parcial', $data);
    return $sql->result();
  }

  //actulaizar parcial en rp
  public function update_parcial($data)
  {
    
    $this->db->where('id_parcial', $data['id_parcial']);
    return $this->db->update('registro_parcial', $data);
  }
  //eliminar un pariclaito parcial en rp
  public function delete_parcial($data)
  {
    return $this->db->delete('registro_parcial', $data );
  }  

}
