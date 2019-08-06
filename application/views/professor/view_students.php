<div class="container">
  <div>
    <h3>Lista de Alumnos</h3>
  </div>
  <hr class="line_sep">
  <a href="<?php echo base_url() ?>professor/add_student/<?php echo $id_group;?>" class="btn btn-outline-success my-2 my-sm-0" aria-label="Left Align" title="Agregar alumno"><i class="icon-user-add"></i></a>
  <table class="table " id="user-table">
    <thead>
      <tr>
        <th>Nombre del alumno</th>
        <th>Apellido Paterno</th>
        <th>Apellido Materno</th>
        <th>Matricula/Nombre de usuario</th>
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
            <a class="btn btn-outline-success my-2 my-sm-0" href="<?php echo base_url() ?>professor/edit_student/<?php echo $student->usuario_id;?>/<?php echo $id_group;?>" title="Editar alumno"><strong><em><i class="icon-pencil-1"></i></em></strong></a>
          <!--EDITAR password-->
          <a class="btn btn-outline-secondary my-2 my-sm-0" href="<?php echo base_url() ?>professor/edit_password/<?php echo $student->usuario_id;?>/<?php echo $id_group;?>" title="Editar Contraseña Alumno"><strong><em><i class="icon-edit-1"></i></em></strong></a>
          <!-- eliminar confirmación -->
          <a class="btn btn-outline-primary my-2 my-sm-0" data-toggle="modal" data-target="#mi_modal" onclick="eliminar(<?php echo $student->usuario_id;?>)" title="Eliminar"><strong><em><i class="icon-user-delete"></i></em></strong></a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>     
</div>

<!-- Modal de confirmación -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mi_modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-tittle" id="modalTittle">Eliminar Alumno</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Esta seguro de eliminar el alumno?
            </div>
            <div class="modal-footer">
               <form method="POST" action="<?php echo base_url() ?>professor/del_student/<?php echo $id_group ?>">
                   <input type="hidden" id="eliminar" name="id_alumno"></input>
                   <input type="reset" class="btn btn-outline-success my-2 my-sm-0" value="No">
                   <input type="submit" class="btn btn-outline-primary my-2 my-sm-0" value="Si">                   
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