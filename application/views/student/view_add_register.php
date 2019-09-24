<div class="container col-md-6">
<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Registro Normal</a>
    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Registro Parcial</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
    <div class="container">
      <h3 class="text-center">Agregar Registros al Asiento</h3>
      <hr class="line_sep">
      <form name="form_register" method="post" action="<?php echo base_url();?>daybook/add_register/<?php echo $id_empresa;?>/<?php echo $id_asiento;?>">
         <div class="form-group">
          Tipo de cuenta
          <select class="form-control" name="tipo_cuenta" id="tipo_cuenta" onchange="activeClasification()">
            <option value="0" selected disabled>Seleccione tipo de cuenta</option>
            <?php foreach ($types as $type) {?>
              <option value="<?php echo $type->id_tipo;?>"><?php echo $type->nombre;?></option>
            <?php } ?>
          </select>
        </div>
         <div class="form-group">
          Clasificación de cuenta
          <select class="form-control" name="clasificacion_cuenta" id="clasificacion_cuenta" onchange="activeCuenta()" disabled>
            <option value="0" selected disabled>Seleccione clasificación de cuenta</option>
            <?php foreach ($clasifications as $clasification) {?>
              <option value="<?php echo $clasification->id_clasificacion;?>"><?php echo $clasification->nombre;?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          Cuenta
          <select class="form-control" name="cuenta" disabled id="cuenta">
            <option value="0" selected disabled>Seleccione cuenta</option>
          </select>
          <?php echo form_error('cuenta') ?>
        </div>
        <div class="form-group">
          Cantidad
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
        <br>
        <div class="text-center">
          <a href="<?php echo base_url()?>/daybook/register/<?php echo $id_empresa;?>/<?php echo $id_asiento;?>"> <button type="button" class="btn btn-outline-primary my-2 my-sm-0" name="cancelar">Cancelar</button></a>
          <input type="submit" name="add_resgistry" value="Registrar" class="btn btn-outline-success my-2 my-sm-0 margin_left_btn">
        </div>
      </form>
    </div>
  </div>
  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
    <div class="container">
      <h3 class="text-center"> Agregar Registros Parciales al Asiento</h3>
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
        <br>
        <div class="panel-footer text-center">
          <a href="<?php echo base_url()?>/daybook/register/<?php echo $id_empresa;?>/<?php echo $id_asiento;?>"> <button type="button" class="btn btn-outline-primary my-2 my-sm-0" name="cancelar">Cancelar</button></a>
          <input type="submit" name="add_resgistry" value="Continuar" class="btn btn-outline-success my-2 my-sm-0 margin_left_btn">
        
        </div>
      </form>
    </div>
  </div>
</div>
<br>
</div>

<script type="text/javascript">
  function activeClasification(){
    if (document.getElementById('tipo_cuenta').value==3) {
      document.getElementById('clasificacion_cuenta').disabled=true;
      document.getElementById('clasificacion_cuenta').options[0].selected=true;
      document.getElementById('cuenta').disabled=false;
      setCuenta();
    }
    else
    {
      document.getElementById('clasificacion_cuenta').disabled=false;
      document.getElementById('clasificacion_cuenta').options[0].selected=true;
      document.getElementById('cuenta').disabled=true;
    }
  }

  function activeCuenta(){
    document.getElementById('cuenta').disabled=false;
    setCuenta();
  }
  function resetCuenta(){
    var x=document.getElementById('cuenta');
    x.length=1;
    x.options[0].value=0;
    x.options[0].text="Seleccione cuenta";
  }
  function setCuenta()
  {
    var tipo=document.getElementById('tipo_cuenta').value;
    var clas=document.getElementById('clasificacion_cuenta').value;
    var idCuentas = [<?php foreach ($accounts as $account){echo '"'.$account->id_catalogo_usuario.'",';} ?>];
    var nCuentas = [<?php foreach ($accounts as $account){echo '"'.$account->nombre.'",';} ?>];
    var idTipo = [<?php foreach ($accounts as $account){echo '"'.$account->tipo_id.'",';} ?>];
    var idClas = [<?php foreach ($accounts as $account){echo '"'.$account->clasificacion_id.'",';} ?>];
    var registers = [<?php foreach ($registers as $register){echo '"'.$register->cuenta.'",';} ?>];
    resetCuenta();
    var x = document.getElementById("cuenta");
    for (var i = 0; i < nCuentas.length; i++) { imprimir=true;
      if (idTipo[i]==tipo && idClas[i]==clas){
        for (var j = 0; j < registers.length; j++) {
          if(idCuentas[i]==registers[j])
          {
            imprimir=false;
          }
        }
        if (imprimir) {
         var option = document.createElement("option");
          option.text = nCuentas[i];
          option.value = idCuentas[i];
          x.add(option); 
          console.log(nCuentas[i]+", "+idCuentas[i]);
        }
      }
      else  if (idTipo[i]==tipo && idTipo[i]==3){
        for (var j = 0; j < registers.length; j++) {
          if(idCuentas[i]==registers[j])
          {
            imprimir=false;
          }
        }
        if (imprimir) {
         var option = document.createElement("option");
          option.text = nCuentas[i];
          option.value = idCuentas[i];
          x.add(option); 
          console.log(nCuentas[i]+", "+idCuentas[i]);
        }
      }
    }
}
</script>