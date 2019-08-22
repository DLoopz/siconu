<div class="container">
	<?php
	setlocale(LC_ALL, 'es_MX');?>
	<h3 class="text-center">Balance General</h3>
	<hr class="line_sep">
	<nav>
	  <div class="nav nav-tabs" id="nav-tab" role="tablist">
	    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Formato de Reporte</a>
	    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Formato de Cuenta</a>
	  </div>
	</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
  	<br>
  	<div>
  		<table class="table">
  			<thead>
  				<tr>
  					<th></th>
  					<th><div class="text-center"><?php echo $exercise->nombre; ?></div></th>
  					<th></th>
  				</tr>
  				<tr>
  					<td colspan="3">Balance general al <?php echo date('j/m/Y'); ?></td>
  				</tr>
  			</thead>
  			<tbody>
  				<?php foreach ($types as $type): ?>
  					<tr>
  						<td colspan="2"><?php echo $type->nombre;?></td>
  						<td></td>
  					</tr>
  					<?php foreach ($clasifications as $calsification): $total=0;?>
  						<?php if ($type->id_tipo!=3): ?>
  							<tr>
		  						<td colspan="2"><?php echo $calsification->nombre;?></td>
		  						<td></td>
	  						</tr>
  						<?php endif ?>
  						<?php foreach ($accounts as $account):
  							$debe=0;$haber=0;$saldo_deudor=0;$saldo_acredor=0;$cuenta=0;?>
  							<?php foreach ($registers as $register): ?>
  								<?php if ($account->nombre==$register->cuenta and $account->tipo_id==$type->id_tipo and $account->clasificacion_id==$calsification->id_clasificacion):
										$cuenta=$register->cuenta;
										$debe=$debe+$register->debe;
										$haber=$haber+$register->haber;
									endif ?>
  							<?php endforeach ?>
  							<?php if ($cuenta): ?>
							 		<tr>
										<td></td>
										<td><?php echo $account->nombre; ?></td>
										<?php if ($debe>$haber){
											$saldo_deudor=$debe-$haber;?>
											<td class="text-right">$ <?php echo number_format($saldo_deudor,2,'.',','); ?></td>
										<?php $total=$total+$saldo_deudor;} else {
											$saldo_acredor=$haber-$debe;?>
											<td class="text-right">$ <?php echo number_format($saldo_acredor,2,'.',','); ?></td>
										<?php $total=$total+$saldo_acredor;} ?>
									</tr>
							 	<?php endif ?>
  						<?php endforeach ?>
  						<?php if ($type->id_tipo!=3): ?>
								<tr>
									<td></td>
									<th class="text-right">Total de <?php echo $type->nombre; ?>s <?php echo $calsification->nombre;?>s:</th>
									<th class="text-right">$ <?php echo number_format($total,2,'.',','); ?></th>
								</tr>
  						<?php endif ?>
  					<?php endforeach ?>
  				<?php endforeach ?>
  			</tbody>
  		</table>
  	</div>
  </div>
  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
  	<br>
  	<div>
  		<table class="table">
  			<thead>
  				<tr>
  					<th></th>
  					<th><div class="text-center"><?php echo $exercise->nombre; ?></div></th>
  					<th></th>
  				</tr>
  				<tr>
  					<td colspan="3">Balance general al <?php echo date('j/m/Y'); ?></td>
  				</tr>
  			</thead>
  			<tbody></tbody>
  		</table>
			<div class="row">
				<div class="col-6 table">
  				<?php foreach ($types as $type): ?>
  					<div class="tr">
  						<div colspan="td">
  							<?php if ($type->id_tipo!=3): ?>
  								<?php echo $type->nombre;?>
  							<?php endif ?></div>
  					</div>
  					<?php foreach ($clasifications as $calsification): $total=0;?>
  						<?php if ($type->id_tipo!=3): ?>
  							<div class="tr">
		  						<div class=""><?php echo $calsification->nombre;?></div>
	  						</div>
  						<?php endif ?>
  						<?php foreach ($accounts as $account):
  							$debe=0;$haber=0;$saldo_deudor=0;$saldo_acredor=0;$cuenta=0;?>
  							<?php foreach ($registers as $register): ?>
  								<?php if ($account->nombre==$register->cuenta and $account->tipo_id==$type->id_tipo and $account->clasificacion_id==$calsification->id_clasificacion):
										$cuenta=$register->cuenta;
										$debe=$debe+$register->debe;
										$haber=$haber+$register->haber;
									endif ?>
  							<?php endforeach ?>
  							<?php if ($cuenta): ?>
							 		<div class="row">
										<div class="col-1 tr"></div>
										<div class="td col-5"><?php echo $account->nombre; ?></div>
										<?php if ($debe>$haber){
											$saldo_deudor=$debe-$haber;?>
											<div class="text-right td col-6"><?php echo '$  '.number_format($saldo_deudor,2,'.',','); ?></div>
										<?php $total=$total+$saldo_deudor;} else {
											$saldo_acredor=$haber-$debe;?>
											<div class="text-right td col-6"><?php echo '$  '.number_format($saldo_acredor,2,'.',','); ?></div>
										<?php $total=$total+$saldo_acredor;} ?>
									</div>
							 	<?php endif ?>
  						<?php endforeach ?>
  						<?php if ($type->id_tipo!=3): ?>
								<div class="tr row">
									<div class=" text-right bold col-6">Total de <?php echo $type->nombre; ?>s <?php echo $calsification->nombre;?>s:</div>
									<div class=" text-right bold col-6">$ <?php echo number_format($total,2,'.',','); ?></div>
								</div>
  						<?php endif ?>
  					<?php endforeach ?>
  						<?php if ($type->id_tipo!=3): ?>
								</div><div class="col-6">
							<?php endif ?>
  				<?php endforeach ?>
				</div>
			</div>
  	</div>
  </div>
</div>
</div>