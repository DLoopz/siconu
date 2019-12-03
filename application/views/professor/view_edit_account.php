<div class="container col-md-4" >
  <div class = "panel panel-primary col-md-offset-4">
    <div class = "panel-heading" >
      <h3 class = "panel-title text-center">Editar Cuenta</h3>
    </div>
    <hr class="line_sep"><br>
    <div class = "panel-body">
      <?php if (isset($account)) {?>
      <form method="post"  action="<?php echo base_url();?>professor/edit_account/<?php echo $account->id_catalogo_usuario?>">
        <div class="form-group">
          Nombre de la Cuenta
          <input type="text" name="nombre" class="form-control" placeholder="Nombre de la Cuenta" value="<?php echo $account->nombre ?>" autofocus >
          <?php echo form_error('nombre'); ?>
        </div>
        <br>
        <div class="panel-footer text-center">
          <input type="submit" name="edit_cuenta" value="Guardar" class="btn btn-outline-success my-2 my-sm-0 ">
          <a href="<?php echo base_url()?>professor/account_catalog"> <button type="button" class="btn btn-outline-primary my-2 my-sm-0 margin_left_btn tam_btn">Volver</button></a>
        </div>
      </form>
    <?php } ?>
    </div>
  </div>
  <hr>
</div>  