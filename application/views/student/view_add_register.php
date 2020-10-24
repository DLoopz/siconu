<div class="container col-md-6">
<nav class="nav-fill">
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true" onclick="reset_forms()">Registro Normal</a>
    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false" onclick="reset_forms()">Registro Parcial</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
    <div class="container">
      <h3 class="text-center">Registro del Asiento</h3>
      <hr class="line_sep">
      <form name="form_register" id="normal" method="post" action="<?php echo base_url();?>daybook/add_register/<?php echo $id_empresa;?>/<?php echo $id_asiento;?>/<?php echo $edit;?>">
        <?php if ($accounts==null) { ?>
          <div class="form-check alert-warning text-center">
            <br>
            El Catalogo de cuentas no ha sido dado de alta, avisa a tu Profesor(a). <br>
            <br>
          </div>
          <hr>
        <?php } ?>
         <div class="form-group">
          Tipo de cuenta *
          <select class="form-control" name="tipo_cuenta" id="tipo_cuenta" onchange="activeClasification()" <?php if($accounts==null){echo "disabled";} ?>>
            <option value="0" selected disabled>Seleccione tipo de cuenta</option>
            <?php foreach ($types as $type) {?>
              <option value="<?php echo $type->id_tipo;?>"><?php echo $type->nombre;?></option>
            <?php } ?>
          </select>
        </div>
         <div class="form-group">
          Clasificación de cuenta *
          <select class="form-control" name="clasificacion_cuenta" id="clasificacion_cuenta" onchange="activeCuenta()" disabled>
            <option value="0" selected disabled>Seleccione clasificación de cuenta</option>
            <?php foreach ($clasifications as $clasification) {?>
              <option value="<?php echo $clasification->id_clasificacion;?>"><?php echo $clasification->nombre;?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          Cuenta *
          <select class="form-control" name="cuenta" disabled id="cuenta">
            <option value="0" selected disabled>Seleccione cuenta</option>
          </select>
          <?php echo form_error('cuenta') ?>
        </div>
        <div class="form-group">
          Cantidad *
          <div class="input-group mb-2">
            <div class="input-group-prepend">
              <div class="input-group-text">$</div>
            </div>
            <input type="text" name="cantidad" class="form-control" placeholder="0.00">
          </div>
          <?php echo form_error('cantidad');?>
        </div>
        <div class="form-group">
          <div class="custom-control custom-radio custom-control-inline col-5">
            <input type="radio" id="cargo" name="movimiento" class="custom-control-input" value="cargo" <?php echo  set_radio('movimiento', 'cargo', 'checked');?> >
            <label class="custom-control-label" for="cargo">Cargo</label>
          </div>
          <div class="custom-control custom-radio custom-control-inline col-5">
            <input type="radio" id="abono" name="movimiento" class="custom-control-input" value="abono" <?php echo  set_radio('movimiento', 'abono', 'checked');?> >
            <label class="custom-control-label" for="abono">Abono</label>
          </div>
          <?php echo form_error('movimiento'); ?>
        </div>
        <div class="text-danger">
          <?php echo form_label('* Campos Obligatorios')?><br>
        </div>
        <hr>
        <br>
        <div class="text-center">
          <input type="submit" name="add_resgistry" value="Agregar" class="btn btn-outline-success my-2 my-sm-0 margin_left_btn">
          <a href="<?php echo base_url()?>daybook/register/<?php echo $id_empresa;?>/<?php echo $id_asiento;?>"> <button type="button" class="btn btn-outline-primary my-2 my-sm-0 margin_left_btn tam_btn" name="cancelar">Volver</button></a>
        </div>
      </form>
    </div>
  </div>
  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
    <div class="container">
      <h3 class="text-center"> Agregar Registros Parciales al Asiento</h3>
      <hr class="line_sep">
      <form id="parcial" name="form_register" method="post" action="<?php echo base_url();?>daybook/register_partial/<?php echo $id_empresa;?>/<?php echo $id_asiento;?>">
        <?php if ($accounts==null) { ?>
          <div class="form-check alert-warning text-center">
            <br>
            El Catalogo de cuentas no ha sido dado de alta, avisa a tu Profesor(a). <br>
            <br>
          </div>
          <hr>
        <?php } ?>
         <div class="form-group">
          Tipo de cuenta *
          <select class="form-control" name="tipo_cuenta" id="tipo_cuenta_p" onchange="activeClasificationP()" <?php if($accounts==null){echo "disabled";} ?>>
            <option value="0" selected disabled>Seleccione tipo de cuenta</option>
            <?php foreach ($types as $type) {?>
              <option value="<?php echo $type->id_tipo;?>"><?php echo $type->nombre;?></option>
            <?php } ?>
          </select>
        </div>
         <div class="form-group">
          Clasificacion de cuenta *
          <select class="form-control" name="clasificacion_cuenta" id="clasificacion_cuenta_p" onchange="activeCuentaP()" disabled>
            <option value="0" selected disabled>Seleccione clasificación de cuenta</option>
            <?php foreach ($clasifications as $clasification) {?>
              <option value="<?php echo $clasification->id_clasificacion;?>"><?php echo $clasification->nombre;?></option>
            <?php } ?>
          </select>
        </div>
        <div class="form-group">
          Cuenta *
          <select class="form-control" name="cuenta" disabled id="cuenta_p">
            <option value="0" selected disabled>Seleccione cuenta </option>
          </select>
          <?php echo form_error('cuenta') ?>
        </div>

         <div class="text-danger">
          <?php echo form_label('* Campos Obligatorios')?><br>
        </div>
        <hr>
        <br>
        <div class="panel-footer text-center">
           <input type="submit" name="add_resgistry" value="Agregar" class="btn btn-outline-success my-2 my-sm-0">
          <a href="<?php echo base_url()?>daybook/register/<?php echo $id_empresa;?>/<?php echo $id_asiento;?>"> <button type="button" class="btn btn-outline-primary my-2 my-sm-0 margin_left_btn" name="cancelar">Volver</button></a>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
<br>
<script type="text/javascript">
    function reset_forms() {
      //reseteo cuenta normal
      document.getElementById('parcial').reset();
      document.getElementById('clasificacion_cuenta').disabled=true;
      document.getElementById('cuenta').disabled=true;


      // reseteo cuenta parciales
      document.getElementById('normal').reset();
      document.getElementById('clasificacion_cuenta_p').disabled=true;
      document.getElementById('cuenta_p').disabled=true;
    }

  function activeClasification(){
    if (document.getElementById('tipo_cuenta').value>2) {
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
    for (var i = 0; i < nCuentas.length; i++) { 
      imprimir=true;
      if (idTipo[i]==tipo && idClas[i]==clas){
        for (var j = 0; j < registers.length; j++) {
          if(nCuentas[i]==registers[j])
          {
            imprimir=false;
          }
        }
        if (imprimir){
          var option = document.createElement("option");
          option.text = nCuentas[i];
          option.value = idCuentas[i];
          x.add(option); 
          console.log(nCuentas[i]+", "+idCuentas[i]);
        }
      }
      else  if (idTipo[i]==tipo && idTipo[i]>2){
        imprimir=true;
        for (var j = 0; j < registers.length; j++){
          if(nCuentas[i]==registers[j])
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

<script type="text/javascript">

  $(window).ready(function(){
    //$("#tipo_cuenta_p").find('option[value=4]').remove();
    //$("#tipo_cuenta_p").find('option[value=5]').remove();
  });

  function activeClasificationP(){
    if (document.getElementById('tipo_cuenta_p').value > 2 ) {
      document.getElementById('clasificacion_cuenta_p').disabled=true;
      document.getElementById('clasificacion_cuenta_p').options[0].selected=true;
      document.getElementById('cuenta_p').disabled=false;
      setCuentaP();
    }
    else
    {
      document.getElementById('clasificacion_cuenta_p').disabled=false;
      document.getElementById('clasificacion_cuenta_p').options[0].selected=true;
      document.getElementById('cuenta_p').disabled=true;
    }
  }

  function activeCuentaP(){
    document.getElementById('cuenta_p').disabled=false;
    setCuentaP();
  }
  function resetCuentaP(){
    var x=document.getElementById('cuenta_p');
    x.length=1;
    x.options[0].value=0;
    x.options[0].text="Seleccione cuenta";
  }
  function setCuentaP()
  {
    var tipo=document.getElementById('tipo_cuenta_p').value;
    var clas=document.getElementById('clasificacion_cuenta_p').value;
    var idCuentas = [<?php foreach ($accounts as $account){echo '"'.$account->id_catalogo_usuario.'",';} ?>];
    var nCuentas = [<?php foreach ($accounts as $account){echo '"'.$account->nombre.'",';} ?>];
    var idTipo = [<?php foreach ($accounts as $account){echo '"'.$account->tipo_id.'",';} ?>];
    var idClas = [<?php foreach ($accounts as $account){echo '"'.$account->clasificacion_id.'",';} ?>];
    var registers = [<?php foreach ($registers as $register){echo '"'.$register->cuenta.'",';} ?>];
    resetCuentaP();
    var x = document.getElementById("cuenta_p");
    for (var i = 0; i < nCuentas.length; i++) { 
      imprimir=true;
      if (idTipo[i]==tipo && idClas[i]==clas){
        for (var j = 0; j < registers.length; j++) {
          if(nCuentas[i]==registers[j])
          {
            imprimir=false;
          }
        }
        if (imprimir){
          var option = document.createElement("option");
          option.text = nCuentas[i];
          option.value = idCuentas[i];
          x.add(option); 
          console.log(nCuentas[i]+", "+idCuentas[i]);
        }
      }
      else  if (idTipo[i]==tipo && idTipo[i]==3){
        imprimir=true;
        for (var j = 0; j < registers.length; j++){
          if(nCuentas[i]==registers[j])
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
