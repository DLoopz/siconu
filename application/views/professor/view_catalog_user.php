<div class="container">
	<h3 class="text-center">Catálogo de Cuentas</h3>
	<!--<hr class="line_sep">-->
	<div class="">
		<?php
      if($this->session->flashdata('msg'))
        echo $this->session->flashdata('msg');
    ?>
  </div>
  <div class="">
    <a href="<?php echo base_url('professor'); ?>" class="btn btn-outline-success my-2 my-sm-0" aria-label="Left Align" title="Volver"><i class="icon-left-big"></i></a>

    <a href="<?php echo base_url('professor/add_account'); ?>" class="btn btn-outline-success my-2 my-sm-0" aria-label="Left Align" title="Agregar Cuenta"><i class="icon-plus-2"></i></a>

    <button class="btn btn-outline-danger my-2 my-sm-0" data-toggle="modal" data-target="#catalogo" title="Eliminar Catálogo"><strong><em><i class="icon-trash-empty"></i></em></strong></button>
    <hr class="line_sep">

  </div>

  <div> 
    <?php $flag=0; foreach ($types as $type) {?>
      <?php if ($type->id_tipo<3): ?>
        <h3 class="text-center" ><?php echo $type->nombre; ?></h3>
        <hr class="line_sep">
        <div class="row">
          <?php foreach ($clasifications as $cla) {?>
            <div class="col-6 espacio">
            <?php if ($type->id_tipo!=3){?>
                <h4 class="text-center"><?php echo $cla->nombre; ?></h4>
              <?php }else{$flag++;} ?>
              <?php if ($flag<2) {?> 
                <table class="table">
                  <head>
                    <tr>
                      <th>Folio</th>
                      <th>Cuenta</th>
                      <th colspan="2">Opciones</th>
                    </tr>
                  </head>
                  <tbody>
                  <?php $j=0; foreach ($accounts as $account){
                  if ($type->id_tipo==$account->tipo_id && $cla->id_clasificacion==$account->clasificacion_id) {$j++;?>
                    <tr>
                    <td><?php $folio=($account->tipo_id*1000)+($account->clasificacion_id*100)+$j; echo $folio; ?></td>
                    <td><?php echo $account->nombre;?></td>
                    <td colspan="2" class="row">
                    <!-- eliminar cuenta -->
                    <a class="btn btn-outline-danger my-2 my-sm-0 col-5"  href="" data-toggle="modal" data-target="#mi_modal" onclick="eliminar(<?php echo $account->id_catalogo_usuario;?>)" title="Eliminar Cuenta"><strong><em><i class="icon-trash-empty"></i></em></strong></a>
                    <!--editar cuenta-->
                    <a class="btn btn-outline-secondary my-2 my-sm-0 col-5 offset-1" href="<?php echo base_url() ?>professor/edit_account/<?php echo $account->id_catalogo_usuario;?>" title="Editar Cuenta"><strong><em><i class="icon-edit"></i></em></strong></a>
                    </td>
                    </tr>
                  <?php }
                  }?>
                  </tbody>
                </table>
              <?php } ?>
            </div>
          <?php } ?>
        </div>
      <?php else: ?>
        <h3 class="text-center" ><?php echo $type->nombre; ?></h3>
        <hr class="line_sep">
         <div class="row">
          <div class="col-6 espacio">
         <table class="table">
          <head>
            <tr>
              <th>Folio</th>
              <th>Cuenta</th>
              <th colspan="2">Opciones</th>
            </tr>
          </head>
          <tbody>
          <?php if (isset($accounts[0])): 
              $aux_cls=$accounts[0]->clasificacion_id;
          endif ?>
        <?php $j=0; foreach ($accounts as $account){
          if ($type->id_tipo==$account->tipo_id) {$j++;?>
            <?php if ($aux_cls!=$account->clasificacion_id): $j=1;  $aux_cls=$account->clasificacion_id; endif ?>
            <tr>
            <td><?php $folio=($account->tipo_id*1000)+($account->clasificacion_id*100)+$j; echo $folio; ?></td>
            <td><?php echo $account->nombre;?></td>
            <td colspan="2" >
            <!-- eliminar cuenta -->
            <a class="btn btn-outline-danger my-2 my-sm-0"  href="" data-toggle="modal" data-target="#mi_modal" onclick="eliminar(<?php echo $account->id_catalogo_usuario;?>)" title="Eliminar Cuenta"><strong><em><i class="icon-trash-empty"></i></em></strong></a>
            <!--editar cuenta-->
            <a class="btn btn-outline-secondary my-2 my-sm-0 col-5 offset-1" href="<?php echo base_url() ?>professor/edit_account/<?php echo $account->id_catalogo_usuario;?>" title="Editar Cuenta"><strong><em><i class="icon-edit"></i></em></strong></a>
            </td>
            </tr>
          <?php }
          }?>
          </tbody>
        </table>
        </div>
      </div>
      <?php endif ?>
    <?php } ?>

    <br><br>
  </div>
</div>

<!-- Modal de confirmación -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="mi_modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-tittle" id="modalTittle">Eliminar Cuenta</h5>
            </div>
            <div class="modal-body">
                 ¿Está seguro que desea eliminar la cuenta?
            </div>
            <div class="modal-footer">
               <form method="POST" action="<?php echo base_url() ?>professor/del_account">
                  <input type="hidden" id="eliminar" name="id_catalogo_usuario"></input>
                  <input type="reset" class="btn btn-outline-success my-2 my-sm-0" data-dismiss="modal" value="No">
                  <input type="submit" class="btn btn-outline-danger my-2 my-sm-0 margin_left_modal" value="Si">    
                </form>
            </div>
        </div>
    </div>
</div>

<?php //modal eliminar catalogo ?>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="catalogo">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-tittle" id="modalTittle">Eliminar Catálogo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                 ¿Está seguro que desea eliminar todo el catálogo?
            </div>
            <div class="modal-footer">
               <form method="POST" action="<?php echo base_url()?>/professor/del_accounts">
                  <input type="reset" class="btn btn-outline-success my-2 my-sm-0" data-dismiss="modal" value="No">
                  <input type="submit" name="del_cat" class="btn btn-outline-danger my-2 my-sm-0 margin_left_modal" value="Si">
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
