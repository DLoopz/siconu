<div class="container">
	<div class="">
	<?php 
		foreach ($accounts as $account){
			$cuenta=$account->nombre;
			foreach ($registers as $regsiter){
				if ($cuenta==$regsiter->cuenta){
					$cuenta=$accounts[key($accounts)+1]->nombre;
	?>
					<div class="text-center"><?php echo $regsiter->cuenta; ?></div>
					<hr>
			<?php } ?>
			
		<?php }
		?>
		
	<?php } ?>
	</div>
</div>