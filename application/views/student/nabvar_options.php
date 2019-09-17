<?php
  //para determinar la url y marcar el nav_proyecto
  
  $mystring = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
  
  $var = array(
    1 => 'daybook',
    2 => 'mayor_schemas',
    3 => 'check_balance',
    4 => 'sheet_balance',
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

<div class="container container-nav">
  <h4 class="titulo_proyecto"><?php if(isset($proyecto->titulo)) {echo $proyecto->titulo;}?></h4> 
  <hr> 
  <nav class="navbar navbar-expand-lg navbar-light bg-light">    
      <a class="navbar-brand" href=""></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav_proyecto" aria-controls="nav_proyecto" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="nav_proyecto">
        <ul class="navbar-nav mr-auto">
          <?php if ($this->session->userdata('rol')==2) {?>
            <li class="nav-item">
              <a class="nav-link icon-reply" href="<?php echo base_url();?>professor/list_project/<?php echo $this->session->userdata('id_grupo');?>/" title="Rayado Diario"></a>
            </li>
          <?php } ?>

          <li class="nav-item">
            <a class="nav-link <?php if(isset($book)) echo "link_activo";?>" href="<?php echo base_url();?>daybook/book/<?php echo $id_empresa; ?>" title="Rayado Diario">Rayado Diario</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if(isset($mayor_schemas)) echo "link_activo";?>" title="Esquemas de Mayor"href="<?php echo base_url();?>mayor_schemas">Esquemas de Mayor</a>
          </li>

          <li class="nav-item">
            <a class="nav-link <?php if(isset($check_balance)) echo "link_activo";?>" href="<?php echo base_url();?>check_balance/check/<?php echo $id_empresa; ?>" title="Balanza de Comprobacion">Balanza de Comprobacion</a>
          </li>

          <li class="nav-item">
            <a class="nav-link <?php if(isset($sheet_balance)) echo "link_activo";?>" href="<?php echo base_url();?>/balance_sheet/sheet/<?php echo $id_empresa; ?>" title="Balance General">Balance General</a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php if(isset($result_state)) echo "link_activo"; ?>" href="<?php echo base_url();?>result_state" title="Esatdo de resultados"> Esatdo de resultados</a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link <?php if(isset($stock_card)) echo "link_activo";?>" href="<?php echo base_url();?>stock_card" title="Targeta de almacen">
                Targeta de almacen
            </a>
          </li>
        </ul>
      </div>
  </nav>
  <hr>
</div>