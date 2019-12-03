<div class="container col-md-4" >
  <div class = "panel panel-primary col-md-offset-4">
    <div class = "panel-heading" >
      <h3 class = "panel-title text-center">Editar Grupo </h3>
    </div>
    <hr class="line_sep">
    <br>
    <div class = "panel-body">
      <?php if (isset($group)) {?>
      <form method="post"  action="<?php echo base_url();?>professor/edit_group/<?php echo $group->id_grupo?>">
        <div class="form-group">
          <label>Nombre del Grupo *</label>
          <input type="text" name="nombre" class="form-control" placeholder="Nombre del Grupo" value="<?php echo $group->nombre ?>" autofocus >
          <?php echo form_error('nombre'); ?>
        </div>
        <div class="text-danger">
          <?php echo form_label('* Campos Obligatorios')?><br>
        </div>
         <hr>
        <div class="panel-footer text-center">
          <input type="submit" name="edit_grupo" value="Guardar" class="btn btn-outline-success my-2 my-sm-0 ">
          <a href="<?php echo base_url()?>professor"> <button type="button" class="btn btn-outline-primary my-2 my-sm-0 margin_left_btn tam_btn">Volver</button></a>
        </div>
      </form>
    <?php } ?>
    </div>
  </div>
</div>
