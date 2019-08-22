<div class="container col-md-4" >
  <div class = "panel panel-primary col-md-offset-4">
    <div class = "panel-heading" >
      <h3 class = "panel-title">Editar grupo </h3>
    </div>
    <hr class="line_sep">
    <div class = "panel-body">
      <?php if (isset($group)) {?>
      <form method="post"  action="<?php echo base_url();?>professor/edit_group/<?php echo $group->id_grupo?>">
        <div class="form-group">
          Nombre del grupo:
          <input type="text" name="nombre" class="form-control" placeholder="Nombre del grupo" value="<?php echo $group->nombre ?>" autofocus >
          <?php echo form_error('nombre'); ?>
        </div>
        <input type="submit" name="edit_grupo" value="Guardar" class="btn btn-outline-success my-2 my-sm-0">
        <a href="<?php echo base_url()?>professor"> <button type="button" class="btn btn-outline-primary my-2 my-sm-0">Volver</button></a>
      </form>
    <?php } ?>
    </div>
  </div>
  <hr>
</div>  