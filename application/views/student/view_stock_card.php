<div class="container" id="content">
    <div><h3 class="text-center">Tarjeta de Almacén</h3></div>
    <hr class="line_sep">
    <?php
        if($this->session->flashdata('msg'))
            echo $this->session->flashdata('msg');
    ?>
    <div class="row">

        <?php
            if($terminar == 0)
            {?>

                <?php if ($this->session->userdata('rol')==3 and $exercise->estado!=1) { ?>
                <div class="col-6">
                    <a id="add_register" href="<?php echo base_url();?>stock_card/add_register_card/<?php echo $id_empresa; ?>" class="btn btn-outline-success my-2 my-sm-0" aria-label="Left Align" title="Agregar Nuevo Registro">
                        <i class="icon-plus-2"></i>
                    </a>
                </div>
            <?php } ?>
            <?php}else
            {?>
            <?php
               echo '';
            }
        ?>
        <?php
            if($terminar == 1)
            {?>
                <div id="volver" class="col-12 text-right">
                    <a href="<?php echo base_url();?>student" class="btn btn-outline-info my-2 my-sm-0" aria-label="Left Align" title="Volver a Empresas"><i class="icon-home-1"></i></a>
                </div>
            <?php}else
            {?>
            <?php
               echo '';
            }
        ?>

    </div>
    <?php if(isset($articulo) or isset($unidad)){?>
        <div class="form-group text-center">
            <label for="">
                <b>Nombre de la empresa: </b><?php echo $empresa->nombre ?>
            </label><br>
            <label for="">
                <b>Nombre del artículo: </b><?php echo $articulo; ?>
            </label><br>
            <label for="">
                <b>Tipo de unidad: </b><?php echo $unidad; ?>
            </label><br>
        </div>
    <?php } ?>
    <br>
    <div class="table-responsive-md">
      <table class="table table-hover">
            <thead>
                <tr class="">
                    <th colspan="2" class="text-center"></th>
                    <th colspan="3" class="text-center td-l">Unidades</th>
                    <th colspan="2" class="text-center">Costos</th>
                    <th colspan="3" class="text-center">Valores</th>
                    <th></th>
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
                        <?php if(isset($sc->fecha)){?>
                            <td><?php echo $sc->fecha ?></td>
                        <?php } ?>
                        <?php if(isset($sc->referencia)){?>
                            <td><?php echo $sc->referencia ?></td>
                        <?php } ?>
                        <?php if(isset($sc->entradas)){?>
                            <td><?php echo $sc->entradas ?></td>
                        <?php } ?>
                        <?php if(isset($sc->salidas)){?>
                            <td><?php echo $sc->salidas ?></td>
                        <?php } ?>
                        <?php if(isset($sc->existencia)){?>
                            <td><?php echo $sc->existencia ?></td>
                        <?php } ?>
                        <?php if(isset($sc->unitario)){?>
                            <td>$ <?php echo number_format($sc->unitario, 2, ".", ","); ?></td>
                        <?php } ?>
                        <?php if(isset($sc->promedio)){?>
                            <td>$ <?php echo number_format($sc->promedio, 2, ".", ","); ?></td>
                        <?php } ?>
                        <?php if(isset($sc->debe)){?>
                            <td>$ <?php echo number_format($sc->debe, 2, ".", ","); ?></td>
                        <?php } ?>
                        <?php if(isset($sc->haber)){?>
                            <td>$ <?php echo number_format($sc->haber, 2, ".", ","); ?></td>
                        <?php } ?>
                        <?php if(isset($sc->saldo)){?>
                            <td>$ <?php echo number_format($sc->saldo, 2, ".", ","); ?></td>
                        <?php } ?>
                        <?php if(isset($sc->id_tarjeta)){?>
                            <td>
                                <!-- Eliminar registro -->
                                <?php
                                    if($ultimo == $sc->id_tarjeta and $terminar == 0)
                                    {?>
                                        <a id="delete_register" class="btn btn-outline-danger" href="" data-toggle="modal" data-target="#modal_sc" onclick="eliminar(<?php echo $sc->id_tarjeta;?>)" title="Eliminar Registro"><strong><em><i class="icon-trash-empty"></i></em></strong></a>
                                    <?php}else
                                    {?>
                                    <?php
                                       echo '';
                                    }
                                ?>
                            </td>
                        <?php } ?>
                    </tr>
                <?php } ?>
                <?php if(isset($sc)){?>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th scope="row">Total</th>
                        <td class="text-info">$ <?php echo number_format($compra, 2, ".", ","); ?></td>
                        <td class="text-info">$ <?php echo number_format($vendido, 2, ".", ","); ?></td>
                        <th></th>
                        <th></th>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <?php if (isset($sc)){?>
            <?php if ($btn_end == 1){?>
                <?php if ($terminar == 0){?>
                    <div class="form-group text-center">

                        <a id="_terminar" class="btn btn-outline-info" href="" data-toggle="modal" data-target="#modal_sc_terminar" onclick="terminar(<?php echo $sc->id_tarjeta;?>)" title="Terminar">Terminar</a>

                    </div>
                <?php } ?>
            <?php } ?>
        <?php } ?>

    </div>
    <?php if (!isset($sc)){?>
		<div class="text-center">
			<p class="text-danger">Aún no hay registros</p>
		</div>
	<?php } ?>

	<?php
        if($terminar == 1)
        {?>
            <div class="form-group" id="content_result">
                <label for="">
                    <b>Inventario inicial: </b><?php echo '$', number_format($ii, 2, ".", ","); ?>
                </label><br>
                <label for="">
                    <b>Compra: </b><?php echo number_format($compra, 2, ".", ","); ?>
                </label><br>
                <label for="">
                    <!--<b>Total de mercancías: </b><?php //echo '$', number_format($mercancias, 2, ".", ","); ?>-->
                    <b>Total de mercancías: </b><?php echo '$', number_format($ii + $compra, 2, ".", ","); ?>
                </label><br>
                <label for="">
                    <b>Inventario final: </b><?php echo number_format($if, 2, ".", ","); ?>
                </label><br>
                <label for="">
                    <b>Costo de lo vendido: </b><?php echo '$', number_format($vendido, 2, ".", ","); ?>
                </label><br>

                <div id="editor"></div>
                <?php $this->load->view('pdf'); ?>
            </div>
        <?php}else
        {?>
        <?php
           echo '';
        }
    ?>

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
                   <input type="submit" class="btn btn-outline-success my-2 my-sm-0 margin_left_modal tam" value="Si">
                   <input type="reset" class="btn btn-outline-danger my-2 my-sm-0" data-dismiss="modal" value="No">
               </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmación -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modal_sc_terminar">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-tittle" id="modalTittle">Terminar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Está seguro de terminar con los registros?
            </div>
            <div class="modal-footer">
               <form method="post" action="<?php echo base_url() ?>stock_card/terminar/<?php echo $id_empresa; ?>">
                   <input type="hidden" id="terminar" name="id_terminar"></input>
                   <input type="submit" class="btn btn-outline-success my-2 my-sm-0 margin_left_modal tam" value="Si">
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

    function terminar(id)
    {
        $('#terminar').val(id);
    }

    /*
    var doc = new jsPDF();
    var specialElementHandlers = {
        '#editor': function (element, renderer) {
            return true;
        }
    };
    */

    $('#cmd').click(function () {
        doc.fromHTML($('#content').html(), 15, 15, {
            'width': 170,
                'elementHandlers': specialElementHandlers
        });
        doc.save('sample-file.pdf');
    });

</script>
