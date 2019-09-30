<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_stock_card extends CI_Model
{
    /* Muestra la consulta de la Tarjeta de Almacén */
    // insertar ingreso TA
    public function insert_ta($data)
    {
        return $this->db->insert('tarjeta_almacen', $data);
    }
    public function get_last_id($data)
    {
        $this->db->select_max('id_tarjeta','id');
        $this->db->from('tarjeta_almacen');
        $this->db->where('empresa_id',$data['empresa_id']);
        $sql=$this->db->get();
        return $sql->row();
    }
    public function get_existencia($data)
    {
        $aux=$this->db->get_where('tarjeta_almacen',$data);
        return $aux->row();
    }
    
    public function get_saldo($data)
    {
        $sql = $this->db->get_where('tarjeta_almacen', $data);
        return $sql->result();
    }
    
    public function get_sc(){
        $query = $this->db->get_where('tarjeta_almacen');        
        return $query->result();
    }
}