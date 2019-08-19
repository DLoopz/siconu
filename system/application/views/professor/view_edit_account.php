<div class="container col-md-4" >
  <div class = "panel panel-primary col-md-offset-4">
    <div class = "panel-heading" >
      <h3 class = "panel-title">Editar Cuenta</h3>
    </div>
    <hr class="line_sep">
    <div class = "panel-body">
      <?php if (isset($account)) {?>
      <form method="post"  action="<?php echo base_url();?>professor/edit_account/<?php echo $account->id_catalogo_usuario?>">
        <div class="form-group">
          Nombre de la cuenta:
          <input type="text" name="nombre" class="form-control" placeholder="Nombre de la cuenta" value="<?php echo $account->nombre ?>" autofocus >
          <?php echo form_error('nombre'); ?>
        </div>
        <input type="submit" name="edit_cuenta" value="Guardar" class="btn btn-outline-success my-2 my-sm-0">
        <a href="<?php echo base_url()?>professor/account_catalog"> <button type="button" class="btn btn-outline-primary my-2 my-sm-0">Volver</button></a>
      </form>
    <?php } ?>
    </div>
  </div>
  <hr>
</div>  