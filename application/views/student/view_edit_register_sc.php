<script type="text/javascript">

  $(window).ready(function(){


    <?php if(isset($modal)) echo "$('#".$modal."').modal('show');";?>

    $('table.table.table-hover.table-responsive-md.col-md-5:nth-child(2n)').addClass('offset-2');
      habilitar_editar();
  });

</script>


<div class="container col-md-6">
    <div class="panel panel-primary col-md-offset-4">
        <div class="panel-heading">
            <h3 class="panel-tittle text-center">
                Editar Registro
            </h3>
        </div>
        <hr class="line_sep">

        <div class="alert alert-info text-center" role="alert" id="tipo" style="display:none;">
            <?php echo $info_edit->tipo_registro."<br>"; ?>
        </div>
        <div class="text-center" role="alert" style="display:none;">
            <?php echo form_error('articulo') ?>
            <?php echo form_error('unidad') ?>
            <?php echo form_error('fecha_sc') ?>
            <?php echo form_error('referencia') ?>
            <?php echo form_error('catidad_existencia') ?>
            <?php echo form_error('cantidad_unidades') ?>
            <?php echo form_error('cantidad_costos') ?>
            <?php echo form_error('unidades') ?>
            <?php echo form_error('afectacion') ?>
        </div>


        <button id="btn_cancelar" class="btn btn-sm btn-outline-primary my-2 my-sm-0 float-right" onclick="location.reload()" title="Cancelar procedimiento" style="display: none;">Cancelar</button>

        <br>
        <div class="panel-body">
            <?php if (isset($info_edit)) { ?>
                <form class="row justify-content-center" method="post" action="<?php echo base_url();?>stock_card/edit_register/<?php echo $id_empresa;?>">
                    <div class="form-group col-md-7">
                        <?php if($info_edit->tipo_registro == 1){?>
                            <div class="form-group" id="content_articulo">
                                <label for="">
                                    Nombre del artículo *
                                </label>
                                <div class="form-group">
                                    <!--Cantidad:-->
                                    <input id="articulo" type="text" name="articulo" class="form-control" placeholder="Nombre del artículo" value="<?php echo $info_edit->nombre_articulo;?>">
                                    <?php echo form_error('articulo'); ?>
                                </div>
                            </div>
                            <div class="form-group" id="content_unidad">
                                <label for="">
                                    Tipo de unidad *
                                </label>
                                <div class="form-group">
                                    <!--Cantidad:-->
                                    <input id="unidad" type="text" name="unidad" class="form-control" placeholder="kg, pieza, etc" value="<?php echo $info_edit->tipo_unidad;?>">
                                    <?php echo form_error('unidad') ?>
                                </div>
                                <br>
                            </div>
                        <?php } ?>
                        <div class="form-group" >
                            <label>
                                Seleccione la fecha *
                            </label>
                            <input id="fecha" type="date" name="fecha_sc" class="form-control" value="<?php echo $info_edit->fecha;?>">
                            <input id="fecha_anterior" type="date" name="fecha_anterior" class="form-control" value="<?php echo $fecha_anterior; ?>" style="display: none;">
                            <?php echo form_error('fecha_sc');?>
                        </div>

                        <div class="form-group">
                            <label for="">
                                Referencia *
                            </label>
                            <div class="form-group">
                                <!--Cantidad:-->
                                <input id="referencia" type="text" name="referencia" class="form-control" placeholder="Tipo de movimiento" value="<?php echo $info_edit->referencia;?>">
                                <?php echo form_error('referencia') ?>
                            </div>
                        </div>

                        <div class="form-group" id="content_existencia">
                            <?php if($info_edit->tipo_registro == 1) { ?>
                                <div class="form-group">
                                    <label for="">
                                    Existencia *
                                    </label>
                                    <div class="form-group">
                                        <!--Cantidad:-->
                                        <input id="existencia" type="text" name="cantidad_existencia" class="form-control" placeholder="Cantidad en números" value="<?php echo $info_edit->existencia;?>">
                                        <?php echo form_error('cantidad_existencia') ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>

                        <div class="form-group" id="content_unidades">
                            <div class="form-group">
                                <!--Cantidad:-->
                                <?php if($info_edit->tipo_registro == 2){?>
                                    <label for="">
                                        Unidades *
                                    </label>
                                    <input id="cantidad_unidades" type="text" name="cantidad_unidades" class="form-control" placeholder="Cantidad en números" value="<?php echo $info_edit->entradas;?>">
                                    <?php echo form_error('cantidad_unidades') ?>
                                <?php } ?>
                                <?php if($info_edit->tipo_registro == 3){?>
                                    <label for="">
                                        Unidades *
                                    </label>
                                    <input id="cantidad_unidades" type="text" name="cantidad_unidades" class="form-control" placeholder="Cantidad en números" value="<?php echo $info_edit->salidas;?>">
                                    <?php echo form_error('cantidad_unidades') ?>
                                <?php } ?>
                                <?php if($info_edit->tipo_registro == 4 || $info_edit->tipo_registro == 5 || $info_edit->tipo_registro == 6){?>
                                    <label for="">
                                        Unidades *
                                    </label>
                                    <input id="cantidad_unidades" type="text" name="cantidad_unidades" class="form-control" placeholder="Cantidad en números" value="<?php echo set_value('cantidad_unidades');?>">
                                    <?php echo form_error('cantidad_unidades') ?>
                                <?php } ?>
                                <?php if($info_edit->tipo_registro == 7){?>
                                    <label for="">
                                        Unidades *
                                    </label>
                                    <input id="cantidad_unidades" type="text" name="cantidad_unidades" class="form-control" placeholder="Cantidad en números" value="<?php echo $info_edit->salidas;?>">
                                    <?php echo form_error('cantidad_unidades') ?>
                                <?php } ?>
                                <?php if($info_edit->tipo_registro == 8){?>
                                    <label for="">
                                        Unidades *
                                    </label>
                                    <input id="cantidad_unidades" type="text" name="cantidad_unidades" class="form-control" placeholder="Cantidad en números" value="<?php echo $info_edit->entradas;?>">
                                    <?php echo form_error('cantidad_unidades') ?>
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <?php if($info_edit->tipo_registro == 2){?>
                                    <div class="custom-control custom-radio custom-control-inline col-5">
                                        <input type="radio" id="entrada" name="unidades" class="custom-control-input" value="entrada" onchange="javascript:showContent()" <?php echo  set_radio('unidades', 'entrada', 'checked');?> checked>
                                        <label class="custom-control-label" for="entrada">Entrada</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline col-5">
                                        <input type="radio" id="salida" name="unidades" class="custom-control-input" value="salida" onchange="javascript:showContent()" <?php echo  set_radio('unidades', 'salida', 'checked');?>>
                                        <label class="custom-control-label" for="salida">Salida</label>
                                    </div>
                                <?php } ?>

                                <?php if($info_edit->tipo_registro == 3){?>
                                    <div class="custom-control custom-radio custom-control-inline col-5">
                                        <input type="radio" id="entrada" name="unidades" class="custom-control-input" value="entrada" onchange="javascript:showContent()" <?php echo  set_radio('unidades', 'entrada', 'checked');?>>
                                        <label class="custom-control-label" for="entrada">Entrada</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline col-5">
                                        <input type="radio" id="salida" name="unidades" class="custom-control-input" value="salida" onchange="javascript:showContent()" <?php echo  set_radio('unidades', 'salida', 'checked');?> checked>
                                        <label class="custom-control-label" for="salida">Salida</label>
                                    </div>
                                <?php } ?>

                                <?php if($info_edit->tipo_registro == 4 || $info_edit->tipo_registro == 5 || $info_edit->tipo_registro == 6){?>
                                    <div class="custom-control custom-radio custom-control-inline col-5">
                                        <input type="radio" id="entrada" name="unidades" class="custom-control-input" value="entrada" onchange="javascript:showContent()" <?php echo  set_radio('unidades', 'entrada', 'checked');?>>
                                        <label class="custom-control-label" for="entrada">Entrada</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline col-5">
                                        <input type="radio" id="salida" name="unidades" class="custom-control-input" value="salida" onchange="javascript:showContent()" <?php echo  set_radio('unidades', 'salida', 'checked');?>>
                                        <label class="custom-control-label" for="salida">Salida</label>
                                    </div>
                                <?php } ?>

                                <?php if($info_edit->tipo_registro == 7){?>
                                    <div class="custom-control custom-radio custom-control-inline col-5">
                                        <input type="radio" id="entrada" name="unidades" class="custom-control-input" value="entrada" onchange="javascript:showContent()" <?php echo  set_radio('unidades', 'entrada', 'checked');?> disabled>
                                        <label class="custom-control-label" for="entrada">Entrada</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline col-5">
                                        <input type="radio" id="salida" name="unidades" class="custom-control-input" value="salida" onchange="javascript:showContent()" <?php echo  set_radio('unidades', 'salida', 'checked');?> checked>
                                        <label class="custom-control-label" for="salida">Salida</label>
                                    </div>
                                <?php } ?>

                                <?php if($info_edit->tipo_registro == 8){?>
                                    <div class="custom-control custom-radio custom-control-inline col-5">
                                        <input type="radio" id="entrada" name="unidades" class="custom-control-input" value="entrada" onchange="javascript:showContent()" <?php echo  set_radio('unidades', 'entrada', 'checked');?> checked>
                                        <label class="custom-control-label" for="entrada">Entrada</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline col-5">
                                        <input type="radio" id="salida" name="unidades" class="custom-control-input" value="salida" onchange="javascript:showContent()" <?php echo  set_radio('unidades', 'salida', 'checked');?> disabled>
                                        <label class="custom-control-label" for="salida">Salida</label>
                                    </div>
                                <?php } ?>

                                <?php echo form_error('unidades'); ?>
                            </div>
                        </div>

                        <div class="form-group" id="content_costo_unitario">
                            <?php if($info_edit->tipo_registro == 1 || $info_edit->tipo_registro == 2 || $info_edit->tipo_registro == 7) { ?>
                                <label for="">
                                    Costo unitario *
                                </label>
                                <div class="form-group">
                                    <!--Cantidad:-->
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">$</div>
                                        </div>
                                        <input type="text" class="form-control" id="cantidad_costos" name="cantidad_costos" placeholder="0.00" aria-describedby="inputGroupPrepend2" value="<?php echo $info_edit->unitario;?>">
                                    </div>
                                    <?php echo form_error('cantidad_costos') ?>
                                </div>
                            <?php } ?>
                            <?php if($info_edit->tipo_registro == 3) { ?>
                                <label for="">
                                    Costo unitario *
                                </label>
                                <div class="form-group">
                                    <!--Cantidad:-->
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">$</div>
                                        </div>
                                        <input type="text" class="form-control" id="cantidad_costos" name="cantidad_costos" placeholder="0.00" aria-describedby="inputGroupPrepend2" value="<?php echo $info_edit->unitario;?>" disabled>
                                    </div>
                                    <?php echo form_error('cantidad_costos') ?>
                                </div>
                            <?php } ?>
                            <?php if($info_edit->tipo_registro == 4 || $info_edit->tipo_registro == 5 || $info_edit->tipo_registro == 6) { ?>
                                <label for="">
                                    Costo unitario *
                                </label>
                                <div class="form-group">
                                    <!--Cantidad:-->
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">$</div>
                                        </div>
                                        <input type="text" class="form-control" id="cantidad_costos" name="cantidad_costos" placeholder="0.00" aria-describedby="inputGroupPrepend2" value="<?php echo set_value('cantidad_costos');?>">
                                    </div>
                                    <?php echo form_error('cantidad_costos') ?>
                                </div>
                            <?php } ?>
                            <?php if($info_edit->tipo_registro == 8) { ?>
                                <label for="">
                                    Costo unitario *
                                </label>
                                <div class="form-group">
                                    <!--Cantidad:-->
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">$</div>
                                        </div>
                                        <input type="text" class="form-control" id="cantidad_costos" name="cantidad_costos" placeholder="0.00" aria-describedby="inputGroupPrepend2" value="<?php echo $info_edit->unitario;?>">
                                    </div>
                                    <?php echo form_error('cantidad_costos') ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="form-group col-md-5">
                        <div class="form-group" id="content_otras">
                            <?php if($info_edit->tipo_registro != 4 && $info_edit->tipo_registro != 5 && $info_edit->tipo_registro != 6 && $total > 1){?>
                                <label for="">
                                    Otras operaciones
                                </label>
                                <div class="form-group">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="gastosCompra" name="otras_operaciones" class="custom-control-input" value="gastosCompra" onchange="javascript:showContent()" <?php echo  set_radio('otras_operaciones', 'gastosCompra', 'checked');?>>
                                        <label class="custom-control-label" for="gastosCompra">Gastos sobre compra</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="descuentosCompra" name="otras_operaciones" class="custom-control-input" value="descuentosCompra" onchange="javascript:showContent()" <?php echo set_radio('otras_operaciones', 'descuentosCompra', 'checked');?>>
                                        <label class="custom-control-label" for="descuentosCompra">Descuentos sobre compra</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="rebajasCompra" name="otras_operaciones" class="custom-control-input" value="rebajasCompra" onchange="javascript:showContent()" <?php echo  set_radio('otras_operaciones', 'rebajasCompra', 'checked');?>>
                                        <label class="custom-control-label" for="rebajasCompra">Rebajas sobre compra</label>
                                    </div>
                                </div>
                            <?php } ?>

                            <?php if($info_edit->tipo_registro == 4){?>
                                <label for="">
                                    Otras operaciones
                                </label>
                                <div class="form-group">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="gastosCompra" name="otras_operaciones" class="custom-control-input" value="gastosCompra" onchange="javascript:showContent()" <?php echo  set_radio('otras_operaciones', 'gastosCompra', 'checked');?> checked>
                                        <label class="custom-control-label" for="gastosCompra">Gastos sobre compra</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="descuentosCompra" name="otras_operaciones" class="custom-control-input" value="descuentosCompra" onchange="javascript:showContent()" <?php echo  set_radio('otras_operaciones', 'descuentosCompra', 'checked');?>>
                                        <label class="custom-control-label" for="descuentosCompra">Descuentos sobre compra</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="rebajasCompra" name="otras_operaciones" class="custom-control-input" value="rebajasCompra" onchange="javascript:showContent()" <?php echo  set_radio('otras_operaciones', 'rebajasCompra', 'checked');?>>
                                        <label class="custom-control-label" for="rebajasCompra">Rebajas sobre compra</label>
                                    </div>
                                </div>
                            <?php } ?>

                            <?php if($info_edit->tipo_registro == 5){?>
                                <label for="">
                                    Otras operaciones
                                </label>
                                <div class="form-group">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="gastosCompra" name="otras_operaciones" class="custom-control-input" value="gastosCompra" onchange="javascript:showContent()" <?php echo  set_radio('otras_operaciones', 'gastosCompra', 'checked');?>>
                                        <label class="custom-control-label" for="gastosCompra">Gastos sobre compra</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="descuentosCompra" name="otras_operaciones" class="custom-control-input" value="descuentosCompra" onchange="javascript:showContent()" <?php echo  set_radio('otras_operaciones', 'descuentosCompra', 'checked');?> checked>
                                        <label class="custom-control-label" for="descuentosCompra">Descuentos sobre compra</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="rebajasCompra" name="otras_operaciones" class="custom-control-input" value="rebajasCompra" onchange="javascript:showContent()" <?php echo  set_radio('otras_operaciones', 'rebajasCompra', 'checked');?>>
                                        <label class="custom-control-label" for="rebajasCompra">Rebajas sobre compra</label>
                                    </div>
                                </div>
                            <?php } ?>

                            <?php if($info_edit->tipo_registro == 6){?>
                                <label for="">
                                    Otras operaciones
                                </label>
                                <div class="form-group">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="gastosCompra" name="otras_operaciones" class="custom-control-input" value="gastosCompra" onchange="javascript:showContent()" <?php echo  set_radio('otras_operaciones', 'gastosCompra', 'checked');?>>
                                        <label class="custom-control-label" for="gastosCompra">Gastos sobre compra</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="descuentosCompra" name="otras_operaciones" class="custom-control-input" value="descuentosCompra" onchange="javascript:showContent()" <?php echo  set_radio('otras_operaciones', 'descuentosCompra', 'checked');?>>
                                        <label class="custom-control-label" for="descuentosCompra">Descuentos sobre compra</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="rebajasCompra" name="otras_operaciones" class="custom-control-input" value="rebajasCompra" onchange="javascript:showContent()" <?php echo  set_radio('otras_operaciones', 'rebajasCompra', 'checked');?> checked>
                                        <label class="custom-control-label" for="rebajasCompra">Rebajas sobre compra</label>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>


                        <div class="form-group" id="content_devoluciones">
                            <?php if ($info_edit->tipo_registro != 7 && $info_edit->tipo_registro != 8 && $total > 1)
                            {?>
                                <label for="">
                                    Devolución
                                </label>
                                <div class="form-group">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="devolucionesCompra" name="otras_operaciones" class="custom-control-input" value="devolucionesCompra" onchange="javascript:showContent()" <?php echo  set_radio('otras_operaciones', 'devolucionesCompra', 'checked');?>>
                                        <label class="custom-control-label" for="devolucionesCompra">Devoluciones sobre compra</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="devolucionesVenta" name="otras_operaciones" class="custom-control-input" value="devolucionesVenta" onchange="javascript:showContent()" <?php echo  set_radio('otras_operaciones', 'devolucionesVenta', 'checked');?>>
                                        <label class="custom-control-label" for="devolucionesVenta">Devoluciones sobre venta</label>
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if ($info_edit->tipo_registro == 7)
                            {?>
                                <label for="">
                                    Devolución
                                </label>
                                <div class="form-group">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="devolucionesCompra" name="otras_operaciones" class="custom-control-input" value="devolucionesCompra" onchange="javascript:showContent()" <?php echo  set_radio('otras_operaciones', 'devolucionesCompra', 'checked');?> checked>
                                        <label class="custom-control-label" for="devolucionesCompra">Devoluciones sobre compra</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="devolucionesVenta" name="otras_operaciones" class="custom-control-input" value="devolucionesVenta" onchange="javascript:showContent()" <?php echo  set_radio('otras_operaciones', 'devolucionesVenta', 'checked');?>>
                                        <label class="custom-control-label" for="devolucionesVenta">Devoluciones sobre venta</label>
                                    </div>
                                </div>
                            <?php } elseif($info_edit->tipo_registro == 8)
                            {?>
                                <label for="">
                                    Devolución
                                </label>
                                <div class="form-group">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="devolucionesCompra" name="otras_operaciones" class="custom-control-input" value="devolucionesCompra" onchange="javascript:showContent()" <?php echo  set_radio('otras_operaciones', 'devolucionesCompra', 'checked');?>>
                                        <label class="custom-control-label" for="devolucionesCompra">Devoluciones sobre compra</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="devolucionesVenta" name="otras_operaciones" class="custom-control-input" value="devolucionesVenta" onchange="javascript:showContent()" <?php echo  set_radio('otras_operaciones', 'devolucionesVenta', 'checked');?> checked>
                                        <label class="custom-control-label" for="devolucionesVenta">Devoluciones sobre venta</label>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>

                        <?php if ($info_edit->tipo_registro != 1 && $info_edit->tipo_registro != 4 && $info_edit->tipo_registro != 5 && $info_edit->tipo_registro != 6)
                        {?>
                            <div class="form-group" id="content" style="display:none;">
                                <label for="">
                                    Afectación
                                </label>
                                <div class="form-group ">
                                    <!--Cantidad:-->
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">$</div>
                                        </div>
                                        <input type="text" class="form-control" id="afectacion" name="afectacion" placeholder="0.00" aria-describedby="inputGroupPrepend2" value="<?php echo set_value('afectacion');?>">
                                    </div>
                                </div>
                                <?php echo form_error('afectacion') ?>
                            </div>
                        <?php } ?>
                        <?php if ($info_edit->tipo_registro == 4)
                        {?>
                            <div class="form-group" id="content">
                                <label for="">
                                    Afectación
                                </label>
                                <div class="form-group">
                                    <!--Cantidad:-->
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">$</div>
                                        </div>
                                        <input type="text" class="form-control" id="afectacion" name="afectacion" placeholder="0.00" aria-describedby="inputGroupPrepend2" value="<?php echo $info_edit->debe;?>">
                                    </div>
                                </div>
                                <?php echo form_error('afectacion') ?>
                            </div>
                        <?php } ?>
                        <?php if ($info_edit->tipo_registro == 5 || $info_edit->tipo_registro == 6)
                        {?>
                            <div class="form-group" id="content">
                                <label for="">
                                    Afectación
                                </label>
                                <div class="form-group">
                                    <!--Cantidad:-->
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">$</div>
                                        </div>
                                        <input type="text" class="form-control" id="afectacion" name="afectacion" placeholder="0.00" aria-describedby="inputGroupPrepend2" value="<?php echo $info_edit->haber;?>">
                                    </div>
                                </div>
                                <?php echo form_error('afectacion') ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="col-md-12 text-danger">
                        <?php echo form_label('* Campo Obligatorio')?>
                    </div>
                    <br/>
                    <hr class="col-md-11">
                    <div class="panel-footer text-center">
                        <input type="submit" name="add_entry" value="Guardar" class="btn btn-outline-success my-2 my-sm-0">
                        <a href="<?php echo base_url()?>stock_card/list_sc/<?php echo $id_empresa; ?>"> <button type="button" class="btn btn-outline-primary my-2 my-sm-0 margin_left_btn tam_btn">Volver</button></a>
                    </div>
                </form>
            <?php } ?>
        </div>
    </div>
    <hr>
</div>

<script type="text/javascript">
    function showContent()
    {
        element = document.getElementById("content");
        content_existencia = document.getElementById("content_existencia");
        content_unidades = document.getElementById("content_unidades");
        content_costo_unitario = document.getElementById("content_costo_unitario");
        content_otras = document.getElementById("content_otras");
        content_devoluciones = document.getElementById("content_devoluciones");

        btn_cancelar = document.getElementById("btn_cancelar");
        referencia = document.getElementById("referencia");
        cantidad_costos = document.getElementById("cantidad_costos");
        gastosCompra = document.getElementById("gastosCompra");
        descuentosCompra = document.getElementById("descuentosCompra");
        rebajasCompra = document.getElementById("rebajasCompra");
        devolucionesCompra = document.getElementById("devolucionesCompra");
        devolucionesVenta = document.getElementById("devolucionesVenta");
        entrada = document.getElementById("entrada");
        salida = document.getElementById("salida");
        cantidad_unidades = document.getElementById("cantidad_unidades");
        afectacion = document.getElementById("afectacion");

        if(gastosCompra.checked)
        {
            cantidad_unidades.value = 1;
            cantidad_costos.value = 1;

            content_unidades.style.display = 'none';
            content_costo_unitario.style.display = 'none';

            referencia.value = "Gastos sobre compra";
            element.style.display = 'block';
            btn_cancelar.style.display = 'block';
        }
        if(descuentosCompra.checked)
        {
            cantidad_unidades.value = 1;
            cantidad_costos.value = 1;

            content_unidades.style.display = 'none';
            content_costo_unitario.style.display = 'none';

            referencia.value = "Descuentos sobre compra";
            element.style.display = 'block';
            btn_cancelar.style.display = 'block';
        }
        if(rebajasCompra.checked)
        {
            cantidad_unidades.value = 1;
            cantidad_costos.value = 1;

            content_unidades.style.display = 'none';
            content_costo_unitario.style.display = 'none';

            referencia.value = "Rebajas sobre compra";
            element.style.display='block';
            btn_cancelar.style.display='block';
        }
        if(devolucionesCompra.checked)
        {
            referencia.value = "Devoluciones sobre compra";
            content_unidades.style.display = "block";
            content_costo_unitario.style.display = "block";
            element.style.display = "none";
            btn_cancelar.style.display='block';
            salida.checked = true;
            salida.disabled = false;
            entrada.checked = false;
            entrada.disabled = true;
            cantidad_costos.disabled = false;
        }
        if(devolucionesVenta.checked)
        {
            referencia.value = "Devoluciones sobre venta";
            btn_cancelar.style.display='block';
            entrada.checked = true;
            entrada.disabled = false;
            salida.checked = false;
            salida.disabled = true;
        }
    }

    function habilitar_editar()
    {
        btn_cancelar = document.getElementById("btn_cancelar");
        var af = document.getElementById('content');
        var ref = document.getElementById('referencia');
        var cu = document.getElementById('cantidad_unidades');
        var cc = document.getElementById("cantidad_costos");
        var en = document.getElementById('entrada');
        var sa = document.getElementById('salida');
        var oo = document.getElementById('otras_operaciones');
        var gc = document.getElementById('gastosCompra');
        var dc = document.getElementById('descuentosCompra');
        var rc = document.getElementById('rebajasCompra');
        var devc = document.getElementById('devolucionesCompra');
        var devv = document.getElementById('devolucionesVenta');
        var exis = document.getElementById('existencia');
        var afectacion = document.getElementById('afectacion');

        content_existencia = document.getElementById("content_existencia");
        content_unidades = document.getElementById("content_unidades");
        content_otras = document.getElementById("content_otras");
        content_devoluciones = document.getElementById("content_devoluciones");
        content_costo_unitario = document.getElementById("content_costo_unitario");
        content_articulo = document.getElementById("content_articulo");
        content_unidad = document.getElementById("content_unidad");

        if(gc.checked)
        {
            ref.value = "Gastos sobre compra";
            content_unidades.style.display = "none";
            content_costo_unitario.style.display = "none";
            af.style.display = "block";
        }
        if(dc.checked)
        {
            ref.value = "Descuentos sobre compra";
            content_unidades.style.display = "none";
            content_costo_unitario.style.display = "none";
            af.style.display = "block";
        }
        if(rc.checked)
        {
            ref.value = "Rebajas sobre compra";
            content_unidades.style.display = "none";
            content_costo_unitario.style.display = "none";
            af.style.display = "block";
        }
        if(devc.checked)
        {
            ref.value = "Devoluciones sobre compra";
            //content_unidades.style.display = "block";
            //content_costo_unitario.style.display = "block";
            af.style.display = "none";
            sa.checked = true;
            en.checked = false;
            en.disabled = true;
        }
        if(devv.checked)
        {
            ref.value = "Devoluciones sobre venta";
            af.style.display = "none";
            en.disabled = false;
            en.checked = true;
            sa.checked = false;
            sa.disabled = true;
        }
    }

</script>


<!--

- Cuando compramos mercancía lo registramos en entrada
- En salida se registran cuando son ventas o alguna devolución
- Existencia (cantidad que se tiene del artículo)
-
- Lo que se regresa a un proveedor sale al costo que entró,
  y lo que nos regresan  de un cliente, entra al costo que salió.

-->
