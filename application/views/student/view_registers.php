<div class="container col-md-6">
	<h3>Agregar registros al asiento</h3>
	<hr class="line_sep">
	<div>
		<a href="<?php echo base_url();?>daybook/add_register/<?php echo $id_empresa;?>/<?php echo $id_asiento;?>" class="btn btn-outline-success my-2 my-sm-0" aria-label="Left Align" title="Agregar catálogo de cuentas"><i class="icon-plus-2"></i></a>
		<table class="table table-hover" id="user-table">
	    <thead>
	      <tr>
	        <th>concepto</th>
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
	          <td><?php echo $register->cuenta;?></td>
	          <td><?php echo $register->parcial;?></td>
	          <td><?php echo $register->debe; $d=(int)$register->debe+$d;?></td>
	          <td><?php echo $register->haber; $h=(int)$register->haber+$h;?></td>
	          <td>
	          	<!--editar asiento-->
	          	<a class="btn btn-outline-secondary" href="<?php echo base_url() ?>daybook/edit_register/<?php echo $register->id_registro;?>" title="Editar registro"><strong><em><i class="icon-edit-1"></i></em></strong></a>
            	<!-- eliminar asiento -->
              <a class="btn btn-outline-danger" href="" data-toggle="modal" data-target="#modal_del_register" onclick="eliminar(<?php echo $register->id_registro;?>)" title="Eliminar registro"><strong><em><i class="icon-trash-empty"></i></em></strong></a>
            </td>
	        </tr>
	      <?php } ?>
	      <tr class="<?php if($d==$h and $d!=0) echo "table-success"; else echo "table-danger";?>">
	        <th>Total</th>
	        <th></th>
	        <th><?php echo $d; ?></th>
	        <th><?php echo $h; ?></th>
	        <th></th>
	      </tr>
	    </tbody>
	  </table>

		<?php if ($d!=$h) {?>
			<div class="alert alert-danger text-center">Las sumas no son iguales ( Diferencia:<?php echo abs($d-$h);?>)</div>
		<?php } ?>
		<a href="<?php echo base_url()?>daybook/book/<?php echo $id_empresa;?>"> <button type="button" class="btn btn-outline-success my-2 my-sm-0" <?php if ($d!=$h or $d==0) {echo "disabled";}?>>Terminar</button></a>
		<a href="<?php echo base_url()?>daybook/delete_entry/<?php echo $id_empresa;?>/<?php echo $id_asiento;?>"> <button type="button" class="btn btn-outline-primary my-2 my-sm-0">Cancelar</button></a>
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
                ¿Esta seguro?
            </div>
            <div class="modal-footer">
               <form method="post" action="<?php echo base_url() ?>daybook/delete_register/<?php echo $id_empresa; ?>/<?php echo $id_asiento; ?>">
                   <input type="hidden" id="eliminar" name="id_register"></input>
                   <input type="reset" class="btn btn-outline-success my-2 my-sm-0" value="No">
                   <input type="submit" class="btn btn-outline-danger my-2 my-sm-0" value="Si">                   
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