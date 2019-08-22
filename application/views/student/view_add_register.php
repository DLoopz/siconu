<div class="container col-md-6">
<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Registro normal</a>
    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Registro parcial</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
    <div class="container">
      <h3 class="text-center">Ingresar registro</h3>
      <hr class="line_sep">
      <form name="form_register" method="post" action="<?php echo base_url();?>daybook/add_register/<?php echo $id_empresa;?>/<?php echo $id_asiento;?>">
        <div class="form-group">
          Cuenta
          <select class="form-control" name="cuenta">
            <?php foreach ($accounts as $account) {?>
              <option value="<?php echo $account->id_catalogo_usuario;?>"><?php echo $account->nombre;?></option>
            <?php } ?>
          </select>
          <?php echo form_error('cuenta') ?>
        </div>
        <div class="form-group">
          Cantidad:
          <input type="text" name="cantidad" class="form-control">
          <?php echo form_error('cantidad') ?>
        </div>
        <div class="form-group">
          <div class="custom-control custom-radio custom-control-inline col-5">
            <input type="radio" id="cargo" name="movimiento" class="custom-control-input" value="cargo" checked>
            <label class="custom-control-label" for="cargo">Cargo</label>
          </div>
          <div class="custom-control custom-radio custom-control-inline col-5">
            <input type="radio" id="abono" name="movimiento" class="custom-control-input" value="abono">
            <label class="custom-control-label" for="abono">Abono</label>
          </div>
        </div>
        <input type="submit" name="add_resgistry" value="Registrar" class="btn btn-outline-success my-2 my-sm-0">
        <a href="<?php echo base_url()?>/daybook/register/<?php echo $id_empresa;?>/<?php echo $id_asiento;?>"> <button type="button" class="btn btn-outline-primary my-2 my-sm-0" name="cancelar">Cancelar</button></a>
      </form>
    </div>
  </div>
  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
    <div class="container">
      <h3 class="text-center">Ingresar registro parcial</h3>
      <hr class="line_sep">
      <form name="form_register" method="post" action="<?php echo base_url();?>daybook/register_partial/<?php echo $id_empresa;?>/<?php echo $id_asiento;?>">
        <div class="form-group">
          Cuenta
          <select class="form-control" name="cuenta">
            <?php foreach ($accounts as $account) {?>
              <option value="<?php echo $account->id_catalogo_usuario;?>"><?php echo $account->nombre;?></option>
            <?php } ?>
          </select>
          <?php echo form_error('cuenta') ?>
        </div>

        
        <input type="submit" name="add_resgistry" value="Continuar" class="btn btn-outline-success my-2 my-sm-0">
        <a href="<?php echo base_url()?>/daybook/register/<?php echo $id_empresa;?>/<?php echo $id_asiento;?>"> <button type="button" class="btn btn-outline-primary my-2 my-sm-0" name="cancelar">Cancelar</button></a>

      </form>
    </div>
  </div>
</div>
</div>




    


