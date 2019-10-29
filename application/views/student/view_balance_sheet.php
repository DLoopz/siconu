<div class="container">
	<?php
	setlocale(LC_ALL, 'es_MX');?>
	<h3 class="text-center">Balance General</h3>
	<hr class="line_sep">

  <div class="row">
    <div class="col-12 text-right">
        <a href="<?php echo base_url();?>student/close_exercise/<?php echo $id_empresa;?>" class="btn btn-outline-danger my-2 my-sm-0" aria-label="Left Align" title="Cerrar Empresa"><i class="icon-cancel-circled"></i></a>
        <a href="<?php echo base_url();?>student" class="btn btn-outline-info my-2 my-sm-0" aria-label="Left Align" title="Regresar a Empresas"><i class="icon-home-1"></i></a>
    </div>
  </div>
  <br>

	<nav class="nav-fill">
	  <div class="nav nav-tabs" id="nav-tab" role="tablist">
	    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Formato de Reporte</a>
	    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Formato de Cuenta</a>
	  </div>
	</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
    <table class="table">
      <thead>
        <tr>
          <th colspan="2" class="text-center text-uppercase"><?php echo $exercise->nombre; ?></th>
        </tr>
        <tr>
          <td colspan="2" class="text-center">Balance general al <?php echo date('j/m/Y'); ?></td>
        </tr>
      </thead>
      <tbody>
        <?php 
          $total_tipo[1]=0;
          $total_tipo[2]=0;
        ?>
        <?php foreach ($types as $type):?>
          <?php if ($type->id_tipo <3): ?>
            <tr>
              <td colspan="2" class="font-weight-bold"><?php echo $type->nombre; ?></td>
            </tr>
            <?php foreach ($clasifications as $clasification): $total_clas=0;?>
              <tr>
                <td colspan="2" class="font-italic"><?php echo $clasification->nombre; ?></td>
              </tr>
              <?php foreach ($accounts as $account): 
                $cuenta="";
                $debe=0;
                $haber=0;?>
                <?php foreach ($registers as $register): ?>
                  <?php if ($account->nombre==$register->cuenta and $account->tipo_id==$type->id_tipo and $account->clasificacion_id==$clasification->id_clasificacion): 
                    $cuenta=$register->cuenta;
                    $debe=$debe+$register->debe;
                    $haber=$haber+$register->haber;
                  endif ?>
                <?php endforeach ?>
                <?php if ($cuenta): ?>
                  <tr>
                    <td><?php echo $account->nombre; ?></td>
                    <td>$<?php if ($type->id_tipo == 1): ?>
                      <?php echo number_format(($debe-$haber),2,'.',','); $total_clas=$total_clas+($debe-$haber);?>
                      <?php else: ?>
                        <?php echo number_format(($haber-$debe),2,'.',','); $total_clas=$total_clas+($haber-$debe);?>
                    <?php endif ?></td>
                  </tr>
                <?php endif ?>
              <?php endforeach ?>
              <tr>
                <td class="font-weight-light font-italic">Total de <?php echo $type->nombre ?>s <?php echo $clasification->nombre?>s</td>
                <td class="font-weight-bold font-italic">$ <?php echo number_format($total_clas,2,'.',','); $total_tipo[$type->id_tipo]=$total_tipo[$type->id_tipo]+$total_clas;?></td>
              </tr>
            <?php endforeach ?>
             <tr>
                <td class="font-weight-bold font-italic">Total de <?php echo $type->nombre ?>s</td>
                <td class="font-weight-bold font-italic">$ <?php echo number_format($total_tipo[$type->id_tipo],2,'.',','); ?></td>
              </tr>
          <?php endif ?>
        <?php endforeach ?>
        <tr>
          <td class="font-weight-bold">Capital contable</td>
          <td class="font-weight-bold font-italic"><?php echo ($total_tipo[1]-$total_tipo[2]); ?></td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
    <div>
      <div class="text-center text-uppercase font-weight-bold td"><?php echo $exercise->nombre;?></div>
      <div class="text-center td">Balance general al <?php echo date('j/m/Y'); ?></div>
      <div class="row">
        <!-- ACTIVOS -->
        <div class="col-6">
          <?php foreach ($types as $type): $total_tipo[1]=0;?>
            <?php if ($type->id_tipo == 1): ?>
              <div class="row"><div class="font-weight-bold td-b col-12"><?php echo $type->nombre; ?></div></div>
              <?php foreach ($clasifications as $clasification): $total_clas=0; ?>
                <div class="row"><div class="font-italic td-b col-12"> <?php echo $clasification->nombre; ?></div></div>
                <?php foreach ($accounts as $account): 
                  $cuenta="";
                  $debe=0;
                  $haber=0;?>
                  <?php foreach ($registers as $register): ?>
                    <?php if ($account->nombre==$register->cuenta and $account->tipo_id==$type->id_tipo and $account->clasificacion_id==$clasification->id_clasificacion):
                    $cuenta=$register->cuenta;
                    $debe=$debe+$register->debe;
                    $haber=$haber+$register->haber;                      
                    endif ?>
                  <?php endforeach ?>
                  <?php if ($cuenta): ?>
                    <div class="row td-b">
                      <div class="col-6"><?php echo $cuenta; ?></div>
                      <div class="col-6">$ <?php echo number_format(($debe-$haber),2,'.',','); $total_clas=$total_clas+($debe-$haber)?></div>
                    </div>
                  <?php endif ?>
                <?php endforeach ?>
                <div class="row td-b font-italic font-weight-light">
                  <div class="col-6">Total de <?php echo $type->nombre; ?>s <?php echo $clasification->nombre; ?>s</div>
                  <div class="col-6">$ <?php echo number_format($total_clas,2,'.',','); $total_tipo[1]=$total_tipo[1]+$total_clas;?></div>
                </div>
              <?php endforeach ?>
              <div class="row td-b font-weight-bold">
                <div class="col-6">Total <?php echo $type->nombre; ?>s</div>
                <div class="col-6"><?php echo number_format($total_tipo[1],2,'.',','); ?></div>
              </div>
            <?php endif ?>
          <?php endforeach ?>
        </div>
        <!-- PASIVOS -->
        <div class="col-6">
          <?php $totla_pasivo=0;$total_capital=0;?>
          <?php foreach ($types as $type): $total_tipo[2]=0;?>
            <?php if ($type->id_tipo == 2): ?>
             <div class="row td"><div class="font-weight-bold col-12"><?php echo $type->nombre; ?></div></div>
              <?php foreach ($clasifications as $clasification): $total__clas=0; $total_tipo[2]=0?>
                <div class="row td"><div class="font-italic"> <?php echo $clasification->nombre; ?></div></div>
                <?php foreach ($accounts as $account): 
                  $cuenta="";
                  $debe=0;
                  $haber=0;?>
                  <?php foreach ($registers as $register): ?>
                    <?php if ($account->nombre==$register->cuenta and $account->tipo_id==$type->id_tipo and $account->clasificacion_id==$clasification->id_clasificacion):
                    $cuenta=$register->cuenta;
                    $debe=$debe+$register->debe;
                    $haber=$haber+$register->haber;                      
                    endif ?>
                  <?php endforeach ?>
                  <?php if ($cuenta): ?>
                    <div class="row td">
                      <div class="col-6"><?php echo $cuenta; ?></div>
                      <div class="col-6">$ <?php echo number_format(($haber-$debe),2,'.',','); $total_clas=$total_clas+($haber-$debe);?></div>
                    </div>
                  <?php endif ?>
                <?php endforeach ?>
                <div class="row td-b font-italic font-weight-light">
                  <div class="col-6">Total de <?php echo $type->nombre; ?>s <?php echo $clasification->nombre; ?>s</div>
                  <div class="col-6">$ <?php echo number_format($total_clas,2,'.',','); $total_tipo[2]=$total_tipo[2]+$total_clas;?></div>
                </div>
              <?php endforeach ?>
              <div class="row td-b font-weight-bold">
                <div class="col-6">Total <?php echo $type->nombre; ?>s</div>
                <div class="col-6">$ <?php echo number_format($total_tipo[2],2,'.',','); $total_capital=$total_tipo[2]?></div>
              </div>
            <?php endif ?>
            <?php if ($type->id_tipo == 3): $total_tipo[3]=0;?>
             <div class="row td"> <div class="font-weight-bold"><?php echo $type->nombre; ?></div></div>
              <?php foreach ($accounts as $account): 
                  $cuenta="";
                  $debe=0;
                  $haber=0;?>
                  <?php foreach ($registers as $register): ?>
                    <?php if ($account->nombre==$register->cuenta and $account->tipo_id==$type->id_tipo):
                    $cuenta=$register->cuenta;
                    $debe=$debe+$register->debe;
                    $haber=$haber+$register->haber;                      
                    endif ?>
                  <?php endforeach ?>
                  <?php if ($cuenta): ?>
                    <div class="row td">
                      <div class="col-6"><?php echo $cuenta; ?></div>
                      <div class="col-6">$ <?php echo number_format(($haber-$debe),2,'.',','); $total_tipo[3]=$total_tipo[3]+($haber-$debe)?></div>
                    </div>
                  <?php endif ?>
                <?php endforeach ?>
                 <div class="row td-b font-weight-bold">
                <div class="col-6">Total <?php echo $type->nombre; ?></div>
                <div class="col-6">$ <?php echo number_format($total_tipo[3],2,'.',','); ?></div>
              </div>
            <?php endif ?>
          <?php endforeach ?>
          <div class="row td">
            <div class="col-6">Total Activo + Capital</div>
            <div class="col-6">$ <?php echo number_format(($totla_pasivo+$total_capital),2,'.',',');?></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br>
</div>
</div>
