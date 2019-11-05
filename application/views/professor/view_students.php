<div class="container col-md-8">
  <div >
    <h3 class="text-center">Lista de Alumnos</h3>
  </div>
  <hr class="line_sep">
  <?php
    if($this->session->flashdata('msg'))
      echo $this->session->flashdata('msg');
  ?>
  <a href="<?php echo base_url() ?>professor " class="btn btn-outline-info my-2 my-sm-0" aria-label="Left Align" title="Volver a la Lista de Grupos"><i class="icon-left-big"></i></a>
  
  <a href="<?php echo base_url() ?>professor/add_student/<?php echo $id_group;?>" class="btn btn-outline-success my-2 my-sm-0" aria-label="Left Align" title="Agregar Alumno"><i class="icon-user-add"></i></a>

  <button class="btn btn-outline-danger my-2 my-sm-0 " data-toggle="modal" data-target="#alumnos" title="Eliminar Alumnos"><strong><em><i class="icon-trash-empty"></i></em></strong></button>
  <br></br>
  <table class="table" id="user-table">
    <thead>
      <tr>
        <th>Nombre del alumno</th>
        <th>Apellido Paterno</th>
        <th>Apellido Materno</th>
        <th>Matrícula</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($students as $student){?>
      <tr>
        <td><?php echo $student->nombre ?></td>
        <td><?php echo $student->apellido_paterno ?></td>
        <td><?php echo $student->apellido_materno ?></td>
        <td><?php echo $student->matricula ?></td>
        <td>
          <!--EDITAR-->
            <a class="btn btn-outline-info my-2 my-sm-0" href="<?php echo base_url() ?>professor/edit_student/<?php echo $student->usuario_id;?>/<?php echo $id_group;?>" title="Editar Alumno"><strong><em><i class="icon-pencil"></i></em></strong></a>
          <!--EDITAR password-->
          <a class="btn btn-outline-secondary my-2 my-sm-0" href="<?php echo base_url() ?>professor/edit_password/<?php echo $student->usuario_id;?>/<?php echo $id_group;?>" title="Editar Contraseña Alumno"><strong><em><i class="icon-edit"></i></em></strong></a>
          <!-- eliminar confirmación -->
          <a class="btn btn-outline-danger my-2 my-sm-0" data-toggle="modal" href="" data-target="#mi_modal" onclick="eliminar(<?php echo $student->usuario_id;?>)" title="Eliminar Alumno"><strong><em><i class="icon-user-delete"></i></em></strong></a>
          <!-- Ver Ejercicios -->
          <?php 
            $newdata = array(
              'id_user' => $student->usuario_id,
              'grupo' => $id_group,
              'id_org' =>$this->session->userdata('id_user')
            );
            $this->session->set_userdata($newdata);
          ?>
          <a class="btn btn-outline-success my-2 my-sm-0" href="<?php echo base_url() ?>student" title="Ver Ejercicios"><strong><em><i class="icon-eye"></i></em></strong></a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>     
</div>
<?php if (!isset($student)){?>
    <div class="text-center">
      <p class="text-danger">No se han registrado alumnos</p>
    </div>
  <?php } ?>

<!-- Modal de confirmación -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mi_modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-tittle" id="modalTittle">Eliminar Alumno</h5>
            </div>
            <div class="modal-body">
                ¿Está seguro de eliminar el alumno?
            </div>
            <div class="modal-footer">
               <form method="POST" action="<?php echo base_url() ?>professor/del_student/<?php echo $id_group ?>">
                   <input type="hidden" id="eliminar" name="id_alumno"></input>
                   <input type="submit" class="btn btn-outline-primary my-2 my-sm-0 " value="Si">    
                   <input type="reset" class="btn btn-outline-success my-2 my-sm-0 margin_left_modal" data-dismiss="modal" value="No">
               </form>
            </div>
        </div>
    </div>
</div>

<?php //modal eliminar grupos ?>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="alumnos">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-tittle" id="modalTittle">Eliminar Alumnos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                 ¿Está seguro que desea eliminar los alumnos del grupo?
            </div>
            <div class="modal-footer">
               <form method="POST" action="<?php echo base_url()?>professor/del_students/<?php echo $id_group; ?>">
                  <input type="reset" class="btn btn-outline-success my-2 my-sm-0" data-dismiss="modal" value="No">
                  <input type="submit" name="del_students" class="btn btn-outline-danger my-2 my-sm-0 margin_left_modal" value="Si">    
                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function eliminar(id)
    {
        $('#eliminar').val(id);
    }
</script>
