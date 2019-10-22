<div class="container col-lg-4 col-md-4">
  <div class="text-center"> 
    <h3>Lista de Grupos</h3>
  </div>
  <hr class="line_sep">
    <?php
      if($this->session->flashdata('msg'))
        echo $this->session->flashdata('msg');
    ?>
  <div>

    <a href="<?php echo base_url('professor/add_group'); ?>" class="btn btn-outline-success my-2 my-sm-0" aria-label="Left Align" title="Agregar Grupo"><i class="icon-users-2"></i></a>

    <button class="btn btn-outline-danger my-2 my-sm-0" data-toggle="modal" data-target="#grupos" title="Eliminar Grupos"><strong><em><i class="icon-trash-empty"></i></em></strong></button>

    </br>
    </br>
    <table class="table" id="user-table">
      <thead>
        <tr>
          <th>Grupo</th>
          <th colspan="2" class="text-center">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($groups as $group) {?>
        <tr >
          <td><?php echo $group->grupo ?></td>
          <td colspan="2" class="row">
            <!--EDITAR-->
            <a class="btn btn-outline-success my-2 my-sm-0 offset-2" href="<?php echo base_url() ?>professor/edit_group/<?php echo $group->grupo_id;?>" title="Editar Grupo"><strong><em><i class="icon-pencil"></i></em></strong></a>
            <!--ELIMINAR-->
             <a class="btn btn-outline-danger offset-1 " href="" data-toggle="modal" data-target="#mi_modal" onclick="eliminar(<?php echo $group->grupo_id;?>)" title="Eliminar Grupo"><strong><em><i class="icon-trash-empty"></i></em></strong></a>
            <!--VER-->
            <a class="btn btn-outline-info my-2 my-sm-0 offset-1" href="<?php echo base_url() ?>professor/show_students/<?php echo $group->grupo_id;?>" title="Ver Alumnos del Grupo"><strong><em><i class="icon-eye"></i></em></strong></a>
          </td>
        </tr>
        <?php } ?>

      </tbody>
      </table>
      <?php if (!$groups): ?>
          <p class="text-center text-danger">No se han registrado grupos</p>
        <?php endif ?>
      <br>
  </div>
</div>

<!-- Modal de confirmación para eliminar grupos-->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mi_modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-tittle" id="modalTittle">Eliminar Grupo</h5>
            </div>
            <div class="modal-body">
                ¿Está seguro que desea eliminar el grupo?
            </div>
            <div class="modal-footer">
               <form method="POST" action="<?php echo base_url() ?>professor/del_group">
                   <input type="hidden" id="eliminar" name="id_grupo"></input>
                   <input type="reset" class="btn btn-outline-success my-2 my-sm-0" data-dismiss="modal" value="No">
                   <input type="submit" class="btn btn-outline-primary my-2 my-sm-0 margin_left_modal" value="Si">                   
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

<?php //modal eliminar grupos ?>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="grupos">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-tittle" id="modalTittle">Eliminar Grupos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                 ¿Está seguro que desea eliminar los grupos?
            </div>
            <div class="modal-footer">
               <form method="POST" action="<?php echo base_url()?>professor/del_groups">
                  <input type="reset" class="btn btn-outline-success my-2 my-sm-0" data-dismiss="modal" value="No">
                  <input type="submit" name="del_groups" class="btn btn-outline-danger my-2 my-sm-0 margin_left_modal" value="Si">    
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
