<?php 
class Model_system extends CI_Model
{
  public function empty_db()
  {
    $this->db->query('set foreign_key_checks=0');
    $this->db->truncate("asiento");
    //$this->db->truncate("catalogo_estandar");
    $this->db->truncate("catalogo_usuario");
    //$this->db->truncate("clasificacion_cuenta");
    $this->db->truncate("empresa");
    $this->db->truncate("grupo");
    //$this->db->truncate("grupos_usuarios");
    //$this->db->truncate("parcial");
    //$this->db->truncate("rayado_diario");
    $this->db->truncate("registro_asiento");
    $this->db->truncate("registro_parcial");
    $this->db->truncate("tarjeta_almacen");
    //$this->db->truncate("tipo_cuenta");
    $this->db->truncate("usuario");
    $this->db->truncate("usuario_grupo");

    $root = array(
      'rol' => 1,
      'nombre' => 'Administrador de Siconu',
      'apellido_paterno' => 'Nova',
      'apellido_materno' => 'Universitas',
      'matricula' => 'root',
      'contrasenia' => md5('root'),
    );
    $sql = $this->db->insert('usuario', $root);
    $this->db->query('set foreign_key_checks=1');
    return $sql;
  }
}
?>
