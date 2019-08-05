<div class="container col-lg-6 col-md-8">
  <div style="float: left;"><a href="<?php echo base_url('professor/account_catalog'); ?>" class="btn btn-outline-success my-2 my-sm-0" aria-label="Left Align" title="Agregar catalogo de cuentas"><i class="icon-plus-2"></i></a></div>
  <div class="text-center"> 
    <h3>Lista de Grupos</h3>
  </div>
  <div>
    <a href="<?php echo base_url('professor/add_group'); ?>" class="btn btn-outline-success my-2 my-sm-0" aria-label="Left Align" title="Agregar grupo"><i class="icon-plus-2"></i></a>
   
    <table class="table " id="user-table">
      <thead>
        <tr>
          <th>Grupo</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($groups as $group) {?>
        <tr class="fila">
          <td><?php echo $group->grupo ?></td>
          <td>
          <!--EDITAR-->
          <a class="btn btn-outline-success my-2 my-sm-0" href="<?php echo base_url() ?>professor/edit_group/<?php echo $group->grupo_id;?>" title="Editar grupo"><strong><em><i class="icon-pencil-1"></i></em></strong></a>
          <!--ELIMINAR-->
          <a class="btn btn-outline-primary my-2 my-sm-0" data-toggle="modal" data-target="#mi_modal" onclick="eliminar(<?php echo $group->grupo_id;?>)" title="Eliminar"><strong><em><i class="icon-trash-empty"></i></em></strong></a>
          <!--VER-->
          <a class="btn btn-outline-info my-2 my-sm-0 " href="<?php echo base_url() ?>professor/show_students/<?php echo $group->grupo_id;?>" title="Ver alumnos"><strong><em><i class="icon-eye"></i></em></strong></a>
          </td>
        </tr>
        <?php } ?>
      </tbody>
      </table>
  </div>
</div>

<!-- Modal de confirmación para eliminar grupos-->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mi_modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-tittle" id="modalTittle">Eliminar Grupo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Esta seguro?
            </div>
            <div class="modal-footer">
               <form method="POST" action="<?php echo base_url() ?>professor/del_group">
                   <input type="hidden" id="eliminar" name="id_grupo"></input>
                   <input type="reset" class="btn btn-outline-success my-2 my-sm-0" value="No">
                   <input type="submit" class="btn btn-outline-primary my-2 my-sm-0" value="Si">                   
               </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                ...
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
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