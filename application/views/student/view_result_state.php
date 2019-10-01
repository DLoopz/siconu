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
			<?php foreach ($registers as $register): ?>
				<?php if ($register->folio>4000): ?>
					<?php if ($register->folio>4100 && $register->folio < 4200): ?>
							<tr>
								<td><?php echo $register->folio; ?></td>
								<td><?php echo $register->cuenta?></td>
								<td><?php ?>1</td>
								<td>1</td>
								<td>1</td>
							</tr>
						<?php endif ?>
				<?php endif ?>
			<?php endforeach ?>
		</tbody>
	</table>
</div>