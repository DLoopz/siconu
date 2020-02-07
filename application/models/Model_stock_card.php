<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_stock_card extends CI_Model
{
    /* Muestra la consulta de la Tarjeta de Almacén */
    // Insertar ingreso TA
    public function insert_ta($data)
    {
        return $this->db->insert('tarjeta_almacen', $data);
    }

    public function update_ta($data, $id)
    {
        /*$this->db->where('id_tarjeta', $data['id_tarjera']);
        return $this->db->update('tarjeta_almacen', $data);*/
        $this->db->where(['id_tarjeta' => $id]);
        $update_data = $this->db->update('tarjeta_almacen', $data);
        return $update_data;
    }

    public function get_last_id($data)
    {
        $this->db->select_max('id_tarjeta','id');
        $this->db->from('tarjeta_almacen');
        $this->db->where('empresa_id',$data['empresa_id']);
        $sql=$this->db->get();
        return $sql->row();
    }

    public function get_penultimate_id()
    {
        $sql = $this->db->query("SELECT id_tarjeta FROM tarjeta_almacen ORDER BY id_tarjeta DESC LIMIT 1, 1");
        return $sql->row();
    }

    public function get_first_id($data)
    {
        $this->db->select_min('id_tarjeta','id');
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
    
    public function get_registro($data)
    {
        $aux=$this->db->get_where('tarjeta_almacen',$data);
        return $aux->row();
    }

    public function get_saldo($data)
    {
        $sql = $this->db->get_where('tarjeta_almacen', $data);
        return $sql->result();
    }

    public function get_sc($id_empresa){
        $sql = $this->db->query("SELECT * FROM tarjeta_almacen WHERE tarjeta_almacen.empresa_id  = $id_empresa");
        return $sql->result();
    }

    public function get_sum_debe()
    {
        $sql = "SELECT sum(debe) as debe FROM tarjeta_almacen";
        $result = $this->db->query($sql);
        return $result->row()->debe;
    }

    public function get_sum_haber()
    {
        $sql = "SELECT sum(haber) as haber FROM tarjeta_almacen";
        $result = $this->db->query($sql);
        return $result->row()->haber;
    }

    public function get_sum_saldo()
    {
        $sql = "SELECT sum(saldo) as saldo FROM tarjeta_almacen";
        $result = $this->db->query($sql);
        return $result->row()->saldo;
    }

    public function consultar_exis(/*$rut_usu*/)
    {
        $query = $this->db->query("SELECT existencia FROM tarjeta_almacen WHERE existencia!=NULL");
        $usuario = $query->row();

        if(empty($usuario)) {echo false;} //Si existe devolvemos false
        else {echo true; }//Si no existe, true.
    }

    public function delete_register($data)
    {
        return $this->db->delete('tarjeta_almacen', $data);
    }

    public function terminar($id_tarjeta)
    {
        $sql = $this->db->query("UPDATE tarjeta_almacen SET terminar = 1 WHERE tarjeta_almacen.id_tarjeta = $id_tarjeta");
        return $sql;
    }

    public function id_ex($id_exercise)
    {
        $sql = $this->db->query("SELECT empresa_id FROM tarjeta_almacen WHERE tarjeta_almacen.empresa_id = $id_exercise");
        return $sql;
    }

    public function get_ii()
    {
        $sql = $this->db->query("SELECT min(id_tarjeta) as id_tarjeta FROM tarjeta_almacen");
        $result = $this->db->query($sql);
        return $result->row()->id_tarjeta;
    }
    public function get_saldo_id($id_tarjeta)
    {
        $sql = $this->db->query("SELECT saldo FROM tarjeta_almacen WHERE id_tarjeta = $id_tarjeta");
        $result = $this->db->query($sql);
        return $result->row()->saldo;
    }

    public function get_info($data)
    {
        $sql = $this->db->get_where('tarjeta_almacen', $data);
        return $sql->row();
    }
}
