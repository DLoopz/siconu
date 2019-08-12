<div class="container col-md-6">
	<h3>Agregar regsitros a Asiento</h3>
	<hr class="line_sep">
	<div>
		<a href="<?php echo base_url();?>daybook/add_register/<?php echo $id_asiento ?>" class="btn btn-outline-success my-2 my-sm-0" aria-label="Left Align" title="Agregar catálogo de cuentas"><i class="icon-plus-2"></i></a>
		<table class="table table-hover" id="user-table">
	    <thead>
	      <tr>
	        <th>concepto</th>
	        <th>Parcial</th>
	        <th>Debe</th>
	        <th>Haber</th>
	      </tr>
	    </thead>
	    <tbody>
	      <?php foreach ($registers as $register){?>
	        <tr>
	          <td><?php echo $register->cuenta ?></td>
	          <!--<td>
              <a class="btn btn-outline-success my-2 my-sm-0" href="<?php echo base_url() ?>student/edit_exercise/<?php echo $exercise->id_empresa;?>" title="Editar Ejercicio"><strong><em><i class="icon-edit-1"></i></em></strong></a>
            </td>-->
	        </tr>
	      <?php } ?>
	    </tbody>
	  </table>
		<a href="<?php echo base_url()?>daybook/book/<?php echo $this->session->flashdata('id_emp');?>"> <button type="button" class="btn btn-outline-success my-2 my-sm-0">Terminar</button></a>
		<a href="<?php echo base_url()?>daybook/del_entry/<?php echo $id_asiento;?>"> <button type="button" class="btn btn-outline-primary my-2 my-sm-0">Cancelar</button></a>
	</div>
</div>