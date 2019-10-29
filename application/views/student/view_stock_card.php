<div class="container">

    <div class="text-center">
        <h3>Tarjeta de Almacén</h3>
    </div>
    <hr class="line_sep">
    <?php
        if($this->session->flashdata('msg'))
            echo $this->session->flashdata('msg');
    ?>
    <div class="row">
        <div class="col-6">
            <a id="add_register" href="<?php echo base_url();?>stock_card/add_register_card/<?php echo $id_empresa; ?>" class="btn btn-outline-success my-2 my-sm-0" aria-label="Left Align" title="Agregar Nuevo Registro">
                <i class="icon-plus-2"></i>

    <?php
        if($this->session->flashdata('msg'))
            echo $this->session->flashdata('msg');
    ?>
    <div class="row">
        <div class="col-6">
            <a href="<?php echo base_url();?>stock_card/add_register_card/<?php echo $id_empresa; ?>" class="btn btn-outline-success my-2 my-sm-0" aria-label="Left Align" title="Agregar Nuevo Registro">
                <i class="icon-plus-2"></i>
            </a>
        </div>
        <div id="volver" class="col-6 text-right">
            <a href="<?php echo base_url();?>student" class="btn btn-outline-info my-2 my-sm-0" aria-label="Left Align" title="Volver a Empresas"><i class="icon-left-open"></i></a>
        </div>
    </div>
        </div>
        <div class="col-6 text-right">
            <a href="<?php echo base_url();?>student/close_exercise/<?php echo $id_empresa;?>" class="btn btn-outline-danger my-2 my-sm-0" aria-label="Left Align" title="Cerrar Empresa"><i class="icon-cancel-circled"></i></a>
            <a href="<?php echo base_url();?>student" class="btn btn-outline-info my-2 my-sm-0" aria-label="Left Align" title="Regresar a Empresas"><i class="icon-home-1"></i></a>
        </div>
    </div>
    <br>
    <div class="table-responsive-md">
      <table class="table table-hover">
            <thead>
                <tr class="">
                    <th colspan="2" class="text-center"></th>
                    <th colspan="3" class="text-center">Unidades</th>
                    <th colspan="2" class="text-center">Costos</th>
                    <th colspan="3" class="text-center">Valores</th>
                </tr>
                <tr>
                    <th scope="col">Fecha</th>
                    <th scope="col">Referencia</th>
                    <th scope="col">Entrada</th>
                    <th scope="col">Salida</th>
                    <th scope="col">Existencia</th>
                    <th scope="col">Unitario</th>
                    <th scope="col">Medio</th>
                    <th scope="col">Debe</th>
                    <th scope="col">Haber</th>
                    <th scope="col">Saldo</th>
                    <th scope="col">Opciones</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php foreach ($stock_card as $sc)
                {?>
                    <tr>
                        <td><?php echo $sc->fecha ?></td>
                        <td><?php echo $sc->referencia ?></td>
                        <td><?php echo $sc->entradas ?></td>
                        <td><?php echo $sc->salidas ?></td>
                        <td><?php echo $sc->existencia ?></td>
                        <td>$ <?php echo number_format($sc->unitario, 2, ".", ","); ?></td>
                        <td>$ <?php echo number_format($sc->promedio, 2, ".", ","); ?></td>
                        <td>$ <?php echo number_format($sc->debe, 2, ".", ","); ?></td>
                        <td>$ <?php echo number_format($sc->haber, 2, ".", ","); ?></td>
                        <td>$ <?php echo number_format($sc->saldo, 2, ".", ","); ?></td>
                        <td>
                            <!-- Eliminar registro -->
                            <?php
                                if($ultimo == $sc->id_tarjeta)
                                {?>
                                    <a id="delete_register" class="btn btn-outline-danger" href="" data-toggle="modal" data-target="#modal_sc" onclick="eliminar(<?php echo $sc->id_tarjeta;?>)" title="Eliminar Registro"><strong><em><i class="icon-trash-empty"></i></em></strong></a>
                                <?php}else
                                {?>
                                <?php
                                   echo '';
                                }
                            ?>

                        </td>
                        
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <?php
            if($terminar == 1)
            {?>
                <div class="form-group text-center">
                    <input id="btn_end" type="button" class="btn btn-outline-primary my-2 my-sm-0" value="Terminar" onclick="javascript:view_result();">
                </div>
            <?php}else
            {?>
            <?php
               echo '';
            }
        ?>
    </div>
    <?php if (!isset($sc)){?>
		<div class="text-center">
			<p class="text-danger">Aún no hay registros</p>
		</div>
	<?php } ?>

	<div class="form-group" id="content_result" style="display: none;">
        <label for="">
            <b>Inventario inicial: </b><?php echo '$', number_format($ii, 2, ".", ","); ?>
        </label><br>
        <label for="">
            <b>Compra: </b><?php echo number_format($compra, 2, ".", ","); ?>
        </label><br>
        <label for="">
            <b>Total de mercancías: </b><?php echo '$', number_format($mercancias, 2, ".", ","); ?>
        </label><br>
        <label for="">
            <b>Inventario final: </b><?php echo number_format($if, 2, ".", ","); ?>
        </label><br>
        <label for="">
            <b>Costo de lo vendido: </b><?php echo '$', number_format($vendido, 2, ".", ","); ?>
        </label><br>
    </div>
</div>

<!-- Modal de confirmación -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modal_sc">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-tittle" id="modalTittle">Eliminar Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Está seguro de eliminar el registro?
            </div>
            <div class="modal-footer">
               <form method="post" action="<?php echo base_url() ?>stock_card/delete_register/<?php echo $id_empresa; ?>">
                   <input type="hidden" id="eliminar" name="id_register"></input>
                   <input type="submit" class="btn btn-outline-success my-2 my-sm-0 margin_left_modal" value="Si">
                   <input type="reset" class="btn btn-outline-danger my-2 my-sm-0" data-dismiss="modal" value="No">
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

    function view_result()
    {
        content_result = document.getElementById("content_result");
        add_register = document.getElementById("add_register");
        delete_register = document.getElementById("delete_register");
        men_val = document.getElementById("men_val");
        //volver = document.getElementById("volver");

        btn_end = document.getElementById("btn_end");

        content_result.style.display = 'block';
        add_register.style.display = 'none';
        delete_register.style.display = 'none';
        btn_end.style.display = 'none';
        men_val.style.display = 'none';
        //volver.style.display = 'none';
    }
</script>

    </div>
</div>
