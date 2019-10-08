<div class="container">
	<div class="text-center"><h3>Estado de Resultados</h3></div>
	<hr class="line_sep">
	<table class="table">
		<thead>
			<tr>
				<th colspan="100%" class="text-center text-uppercase"><?php echo $exercise->nombre; ?></th>
			</tr>
			<tr>
				<td colspan="100%" class="text-center">Estado de resultados del 1 de enero al 31 de diciembre del</td>
			</tr>	
		</thead>
		<tbody>
			<?php foreach ($catalog as $account): ?>
				<?php if ($account->tipo_id>3): ?>
					<?php foreach ($registers as $register): ?>
						<?php if ($register->catalogo_usuario_id==$account->id_catalogo_usuario): ?>
							<tr>
								<?php if (($register->folio>4000 && $register->folio<4200) || ($register->folio>5000 && $register->folio<5200)): ?>
									<td><?php echo $register->cuenta;?></td>
									<?php $aux=0; if ($register->folio<5000):
										$aux=$register->debe-$register->haber;
									else:
										$aux=$register->haber-$register->debe;
									endif ?>
									<td></td>
									<td></td>
									<td class="text-right <?php if ($aux<0){echo 'text-danger';} ?>">$ <?php echo number_format($aux,2,'.',',');?></td>
									<td></td>
								<?php endif ?>								
							</tr>
						<?php endif?>
					<?php endforeach ?>
				<?php endif ?>
			<?php endforeach ?>

		</tbody>
	</table>
</div>