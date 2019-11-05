<?php  
  $mystring = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
  $var = array(
    1 => 'daybook',
    2 => 'major_schemes',
    3 => 'check_balance',
    4 => 'balance_sheet',
    5 => 'result_state',
    6 => 'stock_card'
  );

  if (strpos($mystring, $var[1]))
  {
    $book = strpos($mystring, $var[1]);
  }
  if (strpos($mystring, $var[2]))
  {
    $mayor_schemas = strpos($mystring, $var[2]);
  }
  if (strpos($mystring, $var[3]))
  {
    $check_balance = strpos($mystring, $var[3]);  
  }
  if (strpos($mystring, $var[4]))
  {
    $sheet_balance = strpos($mystring, $var[4]);
  }
  if (strpos($mystring, $var[5]))
  {
    $result_state = strpos($mystring, $var[5]);
  }
  if (strpos($mystring, $var[6]))
  {
    $stock_card = strpos($mystring, $var[6]);
  }
    
?>
<div class="container">
  <nav class="nav-fill">
    <div class="nav nav-tabs" id="nav-tab" role="tablist">
      <?php if ($this->session->userdata('rol')==2) {?>
        <a class="nav-item nav-link icon-reply" href="<?php echo base_url();?>professor/list_project/<?php echo $this->session->userdata('id_grupo');?>/" title="Rayado Diario"></a>
      <?php } ?>
      <a class="nav-item nav-link <?php if(isset($book)) echo "active";?>" href="<?php echo base_url();?>daybook/book/<?php echo $id_empresa; ?>" title="Rayado Diario">Rayado Diario</a>
      <a class="nav-item nav-link <?php if(isset($mayor_schemas)) echo "active";?>  <?php //if(!isset($disabled)){echo "disabled";} ?>" title="Esquemas de Mayor"href="<?php echo base_url();?>major_schemes/schemes/<?php echo $id_empresa;?>">Esquemas de Mayor</a>
      <a class="nav-item nav-link <?php if(isset($check_balance)) echo "active";?>" href="<?php echo base_url();?>check_balance/check/<?php echo $id_empresa; ?>" title="Balanza de Comprobacion">Balanza de Comprobación</a>
      <a class="nav-item nav-link <?php if(isset($sheet_balance)) echo "active";?>" href="<?php echo base_url();?>/balance_sheet/sheet/<?php echo $id_empresa; ?>" title="Balance General">Balance General</a>
      <a class="nav-item nav-link <?php if(isset($result_state)) echo "active"; ?>" href="<?php echo base_url();?>result_state/state/<?php echo $id_empresa ?>" title="Esatdo de resultados">Estado de resultados</a>
      <a class="nav-item nav-link <?php if(isset($stock_card)) echo "active";?>" href="<?php echo base_url();?>stock_card/list_sc/<?php echo $id_empresa ?>" title="Targeta de almacen">Tarjeta de almacén</a>
      <a class="nav-item nav-link" href="<?php echo base_url();?>student" class="btn btn-outline-info my-2 my-sm-0" aria-label="Left Align" title="Volver a Empresas"><i class="icon-home-1"></i></a>
    </div>
  </nav>
</div>
<br>