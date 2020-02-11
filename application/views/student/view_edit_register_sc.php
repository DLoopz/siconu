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
        <!--
        <div class="alert alert-warning text-center" role="alert">
            Registro para <?php echo $info->nombre; ?>
        </div>
        -->

        <button id="btn_cancelar" class="btn btn-sm btn-outline-primary my-2 my-sm-0 float-right" onclick="location.reload()" title="Cancelar procedimiento"  style="display: none;">Cancelar</button>

        <br>
        <div class="panel-body">
            <?php if (isset($info_edit)) { ?>
            <form class="row justify-content-center" method="post" action="<?php echo base_url();?>stock_card/edit_register/<?php echo $id_empresa;?>">
                <div class="form-group col-md-7">
                    <div class="form-group" id="content_articulo">
                        <label for="">
                            Nombre del artículo *
                        </label>
                        <div class="form-group">
                            <!--Cantidad:-->
                            <input id="articulo" type="text" name="articulo" class="form-control" placeholder="Nombre del artículo" value="<?php echo set_value('articulo');?>">
                            <?php echo form_error('articulo'); ?>
                        </div>
                    </div>
                    <div class="form-group" id="content_unidad">
                        <label for="">
                            Tipo de unidad *
                        </label>
                        <div class="form-group">
                            <!--Cantidad:-->
                            <input id="unidad" type="text" name="unidad" class="form-control" placeholder="kg, pieza, etc" value="<?php echo set_value('unidad');?>">
                            <?php echo form_error('unidad') ?>
                        </div>
                        <br>
                    </div>
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
                        <div class="form-group">
                            <label for="">
                            Existencia
                            </label>
                            <div class="form-group">
                                <!--Cantidad:-->
                                <input id="existencia" type="text" name="cantidad_existencia" class="form-control" placeholder="Cantidad en números" value="<?php echo set_value('cantidad_existencia');?>">
                                <?php echo form_error('cantidad_existencia') ?>
                            </div>
                        </div>
                        <div class="form-group" style="display: none;">
                            <label for="">
                            Existencia actual
                            </label>
                            <div class="form-group">
                                <!--Cantidad:-->
                                <input id="existencia_actual" type="text" name="existencia_actual" class="form-control" placeholder="Cantidad en números" value="<?php echo $exis; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group" id="content_unidades">
                        <label for="">
                            Unidades *
                        </label>
                        <div class="form-group">
                            <!--Cantidad:-->
                            <?php if(isset($info_edit->entradas) || isset($info_edit->salidas)){?>
                                <?php if($info_edit->debe != 0 || $info_edit->haber != 0){?>
                                    <?php if($info_edit->entradas == 0 && $info_edit->salidas == 0 && $total >= 1){?>
                                        <input id="cantidad_unidades" type="text" name="cantidad_unidades" class="form-control" placeholder="Cantidad en números" value="<?php echo $info_edit->salidas;?>">
                                    <?php }else{ ?>
                                        <?php if($info_edit->entradas == 0 && $total >= 1){?>
                                            <input id="cantidad_unidades" type="text" name="cantidad_unidades" class="form-control" placeholder="Cantidad en números" value="<?php echo $info_edit->salidas;?>">
                                        <?php } ?>
                                        <?php if($info_edit->salidas == 0 && $total >= 1){?>
                                            <input id="cantidad_unidades" type="text" name="cantidad_unidades" class="form-control" placeholder="Cantidad en números" value="<?php echo $info_edit->entradas;?>">
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                            <?php echo form_error('cantidad_unidades') ?>
                        </div>
                        <div class="form-group">
                            <?php if($info_edit->entradas == 0 && $info_edit->salidas == 0 && $total > 1){?>
                                <div class="custom-control custom-radio custom-control-inline col-5">
                                    <input type="radio" id="entrada" name="unidades" class="custom-control-input" value="entrada" onchange="javascript:showContent()" <?php echo  set_radio('unidades', 'entrada', 'checked');?>>
                                    <label class="custom-control-label" for="entrada">Entrada</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline col-5">
                                    <input type="radio" id="salida" name="unidades" class="custom-control-input" value="salida" onchange="javascript:showContent()" <?php echo  set_radio('unidades', 'entrada', 'checked');?>>
                                    <label class="custom-control-label" for="salida">Salida</label>
                                </div>
                            <?php }else{ ?>
                                <?php if($info_edit->entradas == 0){?>
                                    <div class="custom-control custom-radio custom-control-inline col-5">
                                        <input type="radio" id="entrada" name="unidades" class="custom-control-input" value="entrada" onchange="javascript:showContent()" <?php echo  set_radio('unidades', 'entrada', 'checked');?>>
                                        <label class="custom-control-label" for="entrada">Entrada</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline col-5">
                                        <input type="radio" id="salida" name="unidades" class="custom-control-input" value="salida" onchange="javascript:showContent()" <?php echo  set_radio('unidades', 'entrada', 'checked');?> checked>
                                        <label class="custom-control-label" for="salida">Salida</label>
                                    </div>
                                <?php } ?>
                                <?php if($info_edit->salidas == 0){?>
                                    <div class="custom-control custom-radio custom-control-inline col-5">
                                        <input type="radio" id="entrada" name="unidades" class="custom-control-input" value="entrada" onchange="javascript:showContent()" <?php echo  set_radio('unidades', 'entrada', 'checked');?> checked>
                                        <label class="custom-control-label" for="entrada">Entrada</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline col-5">
                                        <input type="radio" id="salida" name="unidades" class="custom-control-input" value="salida" onchange="javascript:showContent()" <?php echo  set_radio('unidades', 'entrada', 'checked');?>>
                                        <label class="custom-control-label" for="salida">Salida</label>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                            <?php echo form_error('unidades'); ?>
                        </div>
                    </div>

                    <div class="form-group" id="content_costo_unitario">
                        <label for="">
                            Costo unitario *
                        </label>
                        <div class="form-group">
                            <!--Cantidad:-->
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">$</div>
                                </div>
                                <?php if($info_edit->entradas == 0 && $info_edit->salidas == 0 && $total > 1){?>
                                    <input type="text" class="form-control" id="cantidad_costos" name="cantidad_costos" placeholder="0.00" aria-describedby="inputGroupPrepend2" value="<?php echo $info_edit->unitario?>">
                                <?php }else{?>
                                    <?php if($info_edit->entradas == 0){?>
                                        <input type="text" class="form-control" id="cantidad_costos" name="cantidad_costos" placeholder="0.00" aria-describedby="inputGroupPrepend2" value="<?php echo $info_edit->unitario?>" disabled>
                                    <?php } ?>
                                       <?php if($info_edit->salidas == 0){?>
                                        <input type="text" class="form-control" id="cantidad_costos" name="cantidad_costos" placeholder="0.00" aria-describedby="inputGroupPrepend2" value="<?php echo $info_edit->unitario?>">
                                    <?php } ?>
                                <?php } ?>
                                <input type="text" class="form-control" id="aux_cu" name="aux_cu" aria-describedby="inputGroupPrepend2" value="<?php echo $costo_unitario;?>" style="display: none;">
                            </div>
                            <?php echo form_error('cantidad_costos') ?>
                        </div>
                    </div>
                </div>

                <div class="form-group col-md-5">
                    <div class="form-group" id="content_otras">
                        <label for="">
                            Otras operaciones
                        </label>
                        <div class="form-group">
                            <?php if($info_edit->entradas == 0 && $info_edit->salidas == 0 && $info_edit->debe != 0){?>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="gastosCompra" name="otras_operaciones" class="custom-control-input" value="gastosCompra" onchange="javascript:showContent()" <?php echo set_radio('otras_operaciones', 'gastosCompra', 'checked')?> checked>
                                    <label class="custom-control-label" for="gastosCompra">Gastos sobre compra</label>
                                </div>
                            <?php } ?>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="descuentosCompra" name="otras_operaciones" class="custom-control-input" value="descuentosCompra" onchange="javascript:showContent()" <?php echo set_radio('otras_operaciones', 'descuentosCompra', 'checked')?>>
                                <label class="custom-control-label" for="descuentosCompra">Descuentos sobre compra</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="rebajasCompra" name="otras_operaciones" class="custom-control-input" value="rebajasCompra" onchange="javascript:showContent()" <?php echo set_radio('otras_operaciones', 'rebajasCompra', 'checked')?>>
                                <label class="custom-control-label" for="rebajasCompra">Rebajas sobre compra</label>
                            </div>
                        </div>
                    </div>


                    <div class="form-group" id="content_devoluciones">
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
                    </div>

                    <?php if (empty($_POST['otras_operaciones']))
                    {?>
                        <div class="form-group" id="content" style="display: none;">
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
                                <?php echo form_error('afectacion') ?>
                            </div>
                        </div>
                    <?php } else {?>
                        <?php if($_POST['otras_operaciones'] == "gastosCompra" || $_POST['otras_operaciones'] == "descuentosCompra" || $_POST['otras_operaciones'] == "rebajasCompra")
                        {?>
                            <div class="form-group" id="content" style="display: block;">
                                <label for="">
                                    Afectación
                                </label>
                                <div class="form-group">
                                    <!--Cantidad:-->
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">$</div>
                                        </div>
                                        <input type="text" class="form-control" id="afectacion" name="afectacion" placeholder="0.00kk" aria-describedby="inputGroupPrepend2" value="<?php echo $info_edit->debe;?>">
                                    </div>
                                    <?php echo form_error('afectacion') ?>
                                </div>
                            </div>
                        <?php } ?>
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
        referencia = document.getElementById("referencia");
        cantidad_costos = document.getElementById("cantidad_costos");

        content_otras = document.getElementById("content_otras");
        content_devoluciones = document.getElementById("content_devoluciones");
        btn_cancelar = document.getElementById("btn_cancelar");

        check1 = document.getElementById("gastosCompra");
        check2 = document.getElementById("descuentosCompra");
        check3 = document.getElementById("rebajasCompra");

        check4 = document.getElementById("devolucionesCompra");
        check5 = document.getElementById("devolucionesVenta");

        check88 = document.getElementById("entrada");
        check99 = document.getElementById("salida");

        //var check6 = document.getElementById("referencia");
        var check7 = document.getElementById("cantidad_unidades");
        var check8 = document.getElementById("entrada");
        var check9 = document.getElementById("salida");
        var check10 = document.getElementById("cantidad_costos");

        //check = document.getElementById("gastosCompra, descuentosCompra, rebajasCompra");
        if (check1.checked || check2.checked || check3.checked)
        {
            element.style.display='block';
            btn_cancelar.style.display='block';
        }else
        {
            element.style.display='none';
            btn_cancelar.style.display='none';
        }

        if (check4.checked || check5.checked)
        {
            //element.style.display='block';
            btn_cancelar.style.display='block';
        }else
        {
            //element.style.display='none';
            btn_cancelar.style.display='none';
        }

        if(check1.checked)
        {
            btn_cancelar.style.display='block';
            content_existencia.style.display = 'none';
            content_unidades.style.display = 'none';
            content_costo_unitario.style.display = 'none';

            referencia.value = 'Gastos sobre compra';

            check7.value = 0;
            check10.value = 0;
        }

        if(check2.checked)
        {
            btn_cancelar.style.display='block';
            content_existencia.style.display = 'none';
            content_unidades.style.display = 'none';
            content_costo_unitario.style.display = 'none';

            referencia.value = 'Descuentos sobre compra';

            check7.value = 0;
            check10.value = 0;
        }

        if(check3.checked)
        {
            btn_cancelar.style.display='block';
            content_existencia.style.display = 'none';
            content_unidades.style.display = 'none';
            content_costo_unitario.style.display = 'none';

            referencia.value = 'Rebajas sobre compra';

            check7.value = 0;
            check10.value = 0;
        }

        if(check4.checked)
        {
            //alert("Devoluciones sobre compra");
            content_existencia.style.display = 'none';
            content_unidades.style.display = 'block';
            content_costo_unitario.style.display = 'block';

            referencia.value = 'Devoluciones sobre compra';

            check7.value = '';
            check10.value = '';
            check8.disabled = true;
            check9.checked = true;
            check9.disabled = false;

            check88.checked = false;
            //check99.checked = false;

            //check4.value = 'devolucionesCompra';
            //check10.value = 0;
        }
        if(check5.checked)
        {
            content_existencia.style.display = 'none';
            content_unidades.style.display = 'block';
            content_costo_unitario.style.display = 'block';

            referencia.value = 'Devoluciones sobre venta';

            check7.value = '';
            check10.value = '';
            check9.disabled = true;
            check8.checked = true;
            check8.disabled = false;

            //check88.checked = false;
            check99.checked = false;

            //check5.value = 'devolucionesCompra';
            //check10.value = 0;
        }
        if(check88.checked || check99.checked)
        {
            if(check4.checked || check5.checked)
            {
                content_otras.style.display='block';
                content_devoluciones.style.display='block';
                btn_cancelar.style.display='block';
            }else
            {
                content_otras.style.display='none';
                content_devoluciones.style.display='none';
                btn_cancelar.style.display='block';
            }
        }

        if(check88.checked)
        {
            check10.value = "";
            check10.disabled = false;
        }

        if(check99.checked && check4.checked == false)
        {
            check10.value = document.getElementById('aux_cu').value;
            check10.disabled = true;
        }

    }

    ///////////////////////////////////////////

    function habilitar_editar(){
        //alert("ENTRA A LA FUNCION DE habilitar_editar()");
        btn_cancelar = document.getElementById("btn_cancelar");

        var ex = document.getElementById('existencia_actual');
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

        content_existencia = document.getElementById("content_existencia");
        content_unidades = document.getElementById("content_unidades");
        content_otras = document.getElementById("content_otras");
        content_devoluciones = document.getElementById("content_devoluciones");
        content_costo_unitario = document.getElementById("content_costo_unitario");

        content_articulo = document.getElementById("content_articulo");
        content_unidad = document.getElementById("content_unidad");

        if(ex.value != '')
        {
            /*alert("VALOR DE EX(Existencia): "+ex.value);
            cu.disabled = false;
            en.disabled = false;
            sa.disabled = false;*/

            gc.disabled = false;
            dc.disabled = false;
            rc.disabled = false;

            devc.disabled = false;
            devv.disabled = false;

            exis.disabled = true;

            content_existencia.style.display = 'none';
            content_articulo.style.display = 'none';
            content_unidad.style.display = 'block';
        }else
        {
            cu.disabled = true;
            en.disabled = true;
            sa.disabled = true;

            gc.disabled = true;
            dc.disabled = true;
            rc.disabled = true;

            devc.disabled = true;
            devv.disabled = true;

            exis.disabled = false;

            //content_existencia.style.display='none';
            content_unidades.style.display='none';
            content_otras.style.display='none';
            content_devoluciones.style.display='none';
        }

        if(gc.checked)
        {
            //ref.value = "Gastos sobre compra";
            content_unidades.style.display='none';
            content_costo_unitario.style.display='none';
        }

        if(dc.checked)
        {
            //ref.value = "Descuentos sobre compra";
            content_unidades.style.display='none';
            content_costo_unitario.style.display='none';
        }

        if(rc.checked)
        {
            //ref.value = "Rebajas sobre compra";
            content_unidades.style.display='none';
            content_costo_unitario.style.display='none';
        }

        if(devc.checked)
        {
            en.disabled = true;
            en.checked = false;
            sa.checked = true;
        }

        if(devv.checked)
        {
            sa.disabled = true;
            sa.checked = false;
            en.checked = true;
        }

        if(devv.checked || devc.checked)
        {
            content_articulo.style.display = 'none';
            content_unidad.style.display = 'none';
            content_existencia.style.display = 'none';
        }

        if(en.checked || sa.checked)
        {
            content_articulo.style.display = 'none';
            content_unidad.style.display = 'none';
            content_existencia.style.display = 'none';
        }

        if(sa.checked && oo.value == null)
        {
            cc.value = document.getElementById('aux_cu').value;
            cc.disabled = true;
        }

        if(gc.checked || dc.checked || rc.checked)
        {
            btn_cancelar.style.display='block';
            af.style.display='block';
            content_existencia.style.display = 'none';
            content_unidades.style.display = 'none';
            content_unidad.style.display = 'none';
            content_costo_unitario.style.display = 'none';
        }
    }

    function cancelar()
    {

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
