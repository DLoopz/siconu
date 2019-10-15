<div class="container col-md-6">
	<h3 class="text-center">Agregar Registros al Asiento</h3>
	<hr class="line_sep">
	<div>
		<br>
		<a href="<?php echo base_url();?>daybook/add_register/<?php echo $id_empresa;?>/<?php echo $id_asiento;?>" class="btn btn-outline-success my-2 my-sm-0" aria-label="Left Align" title="Agregar Registros al Asiento"><i class="icon-plus-2"></i></a>
		<br><br>
		<table class="table table-hover" id="user-table">
	    <thead>
	      <tr>
	        <th>Cuenta</th>
	        <th>Parcial</th>
	        <th>Debe</th>
	        <th>Haber</th>
	        <th>Opciones</th>
	      </tr>
	    </thead>
	    <tbody>
	      <?php $d=0;$h=0;
	      foreach ($registers as $register){?>
	        <tr>
	          <td><div class="<?php if($register->haber>0){echo 'offset-2';}?>"><?php echo $register->cuenta;?></div></td>
	          <td class="text-right">$ <?php echo number_format($register->parcial, 2, '.', ',');?></td>
	          <td class="text-right">$ <?php echo number_format($register->debe, 2, '.', ','); $d=$register->debe+$d;?></td>
	          <td class="text-right">$ <?php echo number_format($register->haber, 2, '.', ','); $h=$register->haber+$h;?></td>
	          <td>
	          	<!--editar asiento-->

	          	<a class="btn btn-outline-secondary" href="<?php echo base_url() ?>daybook/edit_register/<?php echo $id_empresa;?>/<?php echo $id_asiento;?>/<?php echo $register->id_registro;?>" title="Editar Registro Parcial"><strong><em><i class="icon-edit"></i></em></strong></a>

            	<!-- eliminar asiento -->
              <a class="btn btn-outline-danger" href="" data-toggle="modal" data-target="#modal_del_register" onclick="eliminar(<?php echo $register->id_registro;?>)" title="Eliminar Registro Parcial"><strong><em><i class="icon-trash-empty"></i></em></strong></a>
            </td>
	        </tr>
	      <?php foreach ($partials as $partial){
	      		if ($register->id_registro==$partial->registro_id){?>
	      			<tr class="table-secondary">
      				  <td><?php echo $partial->concepto;?></td>
    				    <td class="text-right">$ <?php echo number_format($partial->cantidad,2,'.',',');?></td>
  				      <td></td>
				        <td></td>
				        <td></td>
	      			</tr>
    		<?php }
	      	} ?>
	      <?php } ?>
	      <tr class="<?php if($d==$h and $d!=0) echo "table-success"; else echo "table-danger";?>">
	        <th>Total</th>
	        <th></th>
	        <th class="text-right">$ <?php echo number_format($d,2,'.',','); ?></th>
	        <th class="text-right">$ <?php echo number_format($h,2,'.',','); ?></th>
	        <th></th>
	      </tr>
	    </tbody>
	  </table>

		<?php if ($d!=$h) {?>
			<div class="alert alert-danger text-center">Las sumas no son iguales ( Diferencia:<?php echo abs($d-$h);?>)</div>
		<?php } ?>
		<div class="panel-footer text-center">
			<a href="<?php echo base_url()?>daybook/book/<?php echo $id_empresa;?>"> <button type="button" class="btn btn-outline-success my-2 my-sm-0" <?php if ($d!=$h or $d==0) {echo "disabled";}?>>Cerrar Asiento</button></a>
			<?php if (!$edit){?>
				<a href="<?php echo base_url()?>daybook/delete_entry/<?php echo $id_empresa;?>/<?php echo $id_asiento;?>"> <button type="button" class="btn btn-outline-primary my-2 my-sm-0 margin_left_btn">Cancelar</button></a>
			<?php } ?>
		</div>
	</div>
</div>

<!-- Modal de confirmación -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modal_del_register">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-tittle" id="modalTittle">Eliminar Asiento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Está seguro de eliminar el registro?
            </div>
            <div class="modal-footer">
               <form method="post" action="<?php echo base_url() ?>daybook/delete_register/<?php echo $id_empresa; ?>/<?php echo $id_asiento; ?>">
                   <input type="hidden" id="eliminar" name="id_register"></input>
                   <input type="reset" class="btn btn-outline-success my-2 my-sm-0" data-dismiss="modal" value="No">
                   <input type="submit" class="btn btn-outline-danger my-2 my-sm-0 margin_left_modal" value="Si">                   
               </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function eliminar(id)
    {
        $('#eliminar').val(id);
    }
</script>