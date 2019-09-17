<div class="container col-md-6">
  <?php $band_debe = true;?>
<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Registro Normal</a>
    <!--a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Registro Parcial</a-->
  </div>
</nav>

<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
    <div class="container">
      <h3 class="text-center">Editar Registro</h3>
      <hr class="line_sep">

      <form name="form_register" method="post" action="<?php echo base_url();?>daybook/edit_register/<?php echo $id_empresa;?>/<?php echo $id_asiento;?>/<?php echo $register->id_registro ?>">

        <div class="form-group">
          Cuenta
          <select class="form-control" name="cuenta">
            <?php foreach ($accounts as $account) {?>
              <option value="<?php echo $account->id_catalogo_usuario;?>" <?php if ($register->cuenta == $account->nombre): ?>
                <?php echo 'selected' ?>
              <?php endif ?>>
                <?php echo $account->nombre;?>
              </option>
            <?php } ?>
          </select>

          <?php echo form_error('cuenta') ?>
        </div>

        <div class="form-group">
          Cantidad:
          <input type="text" name="cantidad" class="form-control" 
          value="<?php if ($register->debe > 0): echo $register->debe; $band_debe = true; else: echo $register->haber; $band_debe = false; endif ?>">
          <?php echo form_error('cantidad') ?>
        </div>

        <div class="form-group">
          <div class="custom-control custom-radio custom-control-inline col-5">
            <input type="radio" id="cargo" name="movimiento" class="custom-control-input" value="cargo" <?php if ($band_debe): ?>
              <?php echo 'checked' ?>
            <?php endif ?>>
            <label class="custom-control-label" for="cargo">Cargo</label>
          </div>
          <div class="custom-control custom-radio custom-control-inline col-5">
            <input type="radio" id="abono" name="movimiento" class="custom-control-input" value="abono" <?php if (!$band_debe): ?>
              <?php echo 'checked' ?>
            <?php endif ?>>
            <label class="custom-control-label" for="abono">Abono</label>
          </div>
        </div>

        <input type="submit" name="add_resgistry" value="Actualizar" class="btn btn-outline-success my-2 my-sm-0">
        <a href="<?php echo base_url()?>daybook/register/<?php echo $id_empresa;?>/<?php echo $id_asiento;?>"> <button type="button" class="btn btn-outline-primary my-2 my-sm-0" name="cancelar">Cancelar</button></a>

      </form>
    </div>
  </div>

  <!--div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
    <div class="container">
      <h3 class="text-center">Editar Registro Parcial</h3>
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
        <div class="panel-footer text-center">
          <a href="<?php echo base_url()?>/daybook/register/<?php echo $id_empresa;?>/<?php echo $id_asiento;?>"> <button type="button" class="btn btn-outline-primary my-2 my-sm-0" name="cancelar">Cancelar</button></a>
          <input type="submit" name="add_resgistry" value="Continuar" class="btn btn-outline-success my-2 my-sm-0 margin_left_btn">
        
        </div>
      </form>
    </div>
  </div -->
</div>
</div>