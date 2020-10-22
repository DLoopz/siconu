<div class="container col-md-6">
  <div class="container">
      <h3 class="text-center"> Agregar Registros Parciales al Asiento</h3>
      <hr class="line_sep">
      <form name="form_register" method="post" action="<?php echo base_url();?>daybook/register_partial/<?php echo $id_empresa;?>/<?php echo $id_asiento;?>">
         <div class="form-group">
          Tipo de cuenta *
          <select class="form-control" name="tipo_cuenta" id="tipo_cuenta_p" onchange="activeClasificationP()">
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
<br>
<script type="text/javascript">
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
  function activeClasificationP(){
    if (document.getElementById('tipo_cuenta_p').value>2) {
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
