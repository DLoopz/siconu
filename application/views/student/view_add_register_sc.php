<div class="container col-md-4">
    <div class="panel panel-primary col-md-offset-4">
        <div class="panel-heading">
            <h3 class="panel-tittle text-center">
                Agregar Nuevo Registro
            </h3>
        </div>
        <hr class="line_sep">
        <div class="alert alert-warning text-center" role="alert">
            Registro para <?php echo $info->nombre; ?>
        </div>
        <p class="text-danger">* Campos obligatorios</p>
        <div class="panel-body">
            <form method="post" action="<?php echo base_url();?>stock_card/add_register_card/<?php echo $id_empresa;?>">
                <div class="form-group" >
                    <label>
                        <b>Seleccione la fecha *</b>
                    </label>
                    <input id="fecha" type="date" name="fecha_sc" class="form-control" value="<?php echo set_value('fecha_sc');?>">
                    <?php echo form_error('fecha_sc');?>
                </div>
                
                <div class="form-group">
                    <label for="">
                        <b>Referencia *</b>
                    </label>
                    <div class="form-group">
                        <!--Cantidad:-->
                        <input id="referencia" type="text" name="referencia" class="form-control" placeholder="Tipo de movimiento" value="<?php echo set_value('referencia');?>">
                        <?php echo form_error('referencia') ?>
                    </div>
                </div>
                
                <div class="form-row" id="content_existencia">
                    <div class="form-group col-md-8">
                        <label for="">
                        <b>Existencia:</b>
                        </label>
                        <div class="form-group">
                            <!--Cantidad:-->
                            <input id="existencia" type="text" name="cantidad_existencia" class="form-control" placeholder="Cantidad en números" value="<?php echo set_value('cantidad_existencia');?>">
                            <?php echo form_error('cantidad_existencia') ?>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="">
                        <b>Existencia actual</b>
                        </label>
                        <div class="form-group">
                            <!--Cantidad:-->
                            <input id="existencia_actual" type="text" name="existencia_actual" class="form-control" placeholder="Cantidad en números" value="<?php echo $exis; ?>" disabled>
                        </div>
                    </div>
                </div>
                
                <div class="form-group" id="content_unidades">
                    <label for="">
                        <b>Unidades *</b>
                    </label>
                    <div class="form-group">
                        <!--Cantidad:-->
                        <input id="cantidad_unidades" type="text" name="cantidad_unidades" class="form-control" placeholder="Cantidad en números" value="<?php echo set_value('cantidad_unidades');?>">
                        <?php echo form_error('cantidad_unidades') ?>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-radio custom-control-inline col-5">
                            <input type="radio" id="entrada" name="unidades" class="custom-control-input" value="entrada" chequed>
                            <label class="custom-control-label" for="entrada">Entrada</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline col-5">
                            <input type="radio" id="salida" name="unidades" class="custom-control-input" value="salida">
                            <label class="custom-control-label" for="salida">Salida</label>
                        </div>
                    </div>
                </div>

                <div class="form-group" id="content_costo_unitario">
                    <label for="">
                        <b>Costo unitario *</b>
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
                </div>

                <div class="form-group" id="content_otras">
                    <label for="">
                        <b>Otras operaciones</b>
                    </label>
                    <div class="form-group">
                        <div class="custom-control custom-radio custom-control-inline col-5">
                            <input type="radio" id="gastosCompra" name="otras_operaciones" class="custom-control-input" value="gastosCompra" onchange="javascript:showContent()">
                            <label class="custom-control-label" for="gastosCompra">Gastos sobre compra</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline col-5">
                            <input type="radio" id="descuentosCompra" name="otras_operaciones" class="custom-control-input" value="descuentosCompra" onchange="javascript:showContent()">
                            <label class="custom-control-label" for="descuentosCompra">Descuentos sobre compra</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline col-5">
                            <input type="radio" id="rebajasCompra" name="otras_operaciones" class="custom-control-input" value="rebajasCompra" onchange="javascript:showContent()">
                            <label class="custom-control-label" for="rebajasCompra">Rebajas sobre compra</label>
                        </div>
                    </div>
                </div>


                <div class="form-group" id="content_devoluciones">
                    <label for="">
                        <b>Devolución</b>
                    </label>
                    <div class="form-group">
                        <div class="custom-control custom-radio custom-control-inline col-5">
                            <input type="radio" id="devolucionesCompra" name="otras_operaciones" class="custom-control-input" value="" onchange="javascript:showContent()">
                            <label class="custom-control-label" for="devolucionesCompra">Devoluciones sobre compra</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline col-5">
                            <input type="radio" id="devolucionesVenta" name="otras_operaciones" class="custom-control-input" value="" onchange="javascript:showContent()">
                            <label class="custom-control-label" for="devolucionesVenta">Devoluciones sobre venta</label>
                        </div>
                    </div>
                </div>

                <div class="form-group" id="content" style="display: none;">
                    <label for="">
                        <b>Afectación:</b>
                    </label>
                    <div class="form-group">
                        <!--Cantidad:-->
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">$</div>
                            </div>
                            <input type="text" class="form-control" id="afectacion" name="afectacion" placeholder="0.00" aria-describedby="inputGroupPrepend2">
                        </div>
                        <?php echo form_error('cantidad_costos') ?>
                    </div>
                </div>

                <input type="submit" name="add_entry" value="Agregar" class="btn btn-outline-success my-2 my-sm-0">
				<a href="<?php echo base_url()?>stock_card/list_sc/<?php echo $id_empresa; ?>"> <button type="button" class="btn btn-outline-primary my-2 my-sm-0">Volver</button></a>
            </form>
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

        check1 = document.getElementById("gastosCompra");
        check2 = document.getElementById("descuentosCompra");
        check3 = document.getElementById("rebajasCompra");

        check4 = document.getElementById("devolucionesCompra");
        check5 = document.getElementById("devolucionesVenta");

        //var check6 = document.getElementById("referencia");
        var check7 = document.getElementById("cantidad_unidades");
        var check8 = document.getElementById("entrada");
        var check9 = document.getElementById("salida");
        var check10 = document.getElementById("cantidad_costos");

        //check = document.getElementById("gastosCompra, descuentosCompra, rebajasCompra");
        if (check1.checked || check2.checked || check3.checked)
        {
            element.style.display='block';
        }else
        {
            element.style.display='none';
        }

        if(check1.checked)
        {
            content_existencia.style.display = 'none';
            content_unidades.style.display = 'none';
            content_costo_unitario.style.display = 'none';

            referencia.value = 'Gastos sobre compra';

            check7.value = 0;
            check10.value = 0;
        }

        if(check2.checked)
        {
            content_existencia.style.display = 'none';
            content_unidades.style.display = 'none';
            content_costo_unitario.style.display = 'none';

            referencia.value = 'Descuentos sobre compra';

            check7.value = 0;
            check10.value = 0;
        }

        if(check3.checked)
        {
            content_existencia.style.display = 'none';
            content_unidades.style.display = 'none';
            content_costo_unitario.style.display = 'none';

            referencia.value = 'Rebajas sobre compra';

            check7.value = 0;
            check10.value = 0;
        }

        if(check4.checked)
        {
            content_existencia.style.display = 'none';
            content_unidades.style.display = 'block';
            content_costo_unitario.style.display = 'block';

            referencia.value = 'Devoluciones sobre compra';

            check7.value = '';
            check10.value = '';
            check8.disabled = true;
            check9.checked = true;

            check4.value = 'devolucionesCompra';
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
            check8.checked = true;
            check9.disabled = true;

            check4.value = 'devolucionesCompra';
            //check10.value = 0;
        }

    }

    ///////////////////////////////////////////

    function habilitar(){
        var ex = document.getElementById('existencia_actual');

        var cu = document.getElementById('cantidad_unidades');
        var en = document.getElementById('entrada');
        var sa = document.getElementById('salida');

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

        if(ex.value != 0)
        {
            cu.disabled = false;
            en.disabled = false;
            sa.disabled = false;

            gc.disabled = false;
            dc.disabled = false;
            rc.disabled = false;

            devc.disabled = false;
            devv.disabled = false;

            exis.disabled = true;

            content_existencia.style.display='none';

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
    }

    function validate_radio()
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
