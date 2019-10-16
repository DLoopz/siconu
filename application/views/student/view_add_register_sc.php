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
                <div class="form-group">
                    <label>
                        <b>Seleccione la fecha *</b>
                    </label>
                    <input type="date" name="fecha_sc" class="form-control" value="<?php echo set_value('fecha_sc');?>">
                    <?php echo form_error('fecha_sc');?>
                </div>
                
                <div class="form-group">
                    <label for="">
                        <b>Referencia *</b>
                    </label>
                    <div class="form-group">
                        <!--Cantidad:-->
                        <input type="text" name="referencia" class="form-control" placeholder="Tipo de movimiento" value="<?php echo set_value('referencia');?>">
                        <?php echo form_error('referencia') ?>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="">
                        <b>Existencia:</b>
                        </label>
                        <div class="form-group">
                            <!--Cantidad:-->
                            <input id="existencia" type="text" name="cantidad_existencia" class="form-control" placeholder="Cantidad en números" value="<?php echo set_value('cantidad_existencia');?>">
                            <?php echo form_error('cantidad_existencia') ?>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">
                        <b>Existencia actual</b>
                        </label>
                        <div class="form-group">
                            <!--Cantidad:-->
                            <input id="existencia_actual" type="text" name="existencia_actual" class="form-control" placeholder="Cantidad en números" value="<?php echo $exis; ?>" disabled>
                        </div>
                    </div>
                </div>
                
                <div class="<form-g></form-g>roup">
                    <label for="">
                        <b>Unidades </b>
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

                <div class="form-group">
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

                <div class="form-group">
                    <label for="">
                        <b>Otras operaciones</b>
                    </label>
                    <div class="form-group">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="gastosCompra" name="otras_operaciones" class="custom-control-input" value="gastosCompra" onchange="javascript:showContent()">
                            <label class="custom-control-label" for="gastosCompra">Gastos sobre compra</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="descuentosCompra" name="otras_operaciones" class="custom-control-input" value="descuentosCompra" onchange="javascript:showContent()">
                            <label class="custom-control-label" for="descuentosCompra">Descuentos sobre compra</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="rebajasCompra" name="otras_operaciones" class="custom-control-input" value="rebajasCompra" onchange="javascript:showContent()">
                            <label class="custom-control-label" for="rebajasCompra">Rebajas sobre compra</label>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label for="">
                        <b>Devolución</b>
                    </label>
                    <div class="form-group">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="devolucionesCompra" name="otras_operaciones" class="custom-control-input" value="" onchange="javascript:showContent()">
                            <label class="custom-control-label" for="devolucionesCompra">Devoluciones sobre compra</label>
                        </div>
                        <div class="custom-control custom-radio">
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

        check1 = document.getElementById("gastosCompra");
        check2 = document.getElementById("descuentosCompra");
        check3 = document.getElementById("rebajasCompra");

        check4 = document.getElementById("devolucionesCompra");
        check5 = document.getElementById("devolucionesVenta");
        //check = document.getElementById("gastosCompra, descuentosCompra, rebajasCompra");
        if (check1.checked || check2.checked || check3.checked || check4.checked || check5.checked)
        {
            element.style.display='block';
        }else
        {
            element.style.display='none';
        }
    }

    ///////////////////////////////////////////

        function habilitar(){

            var ex = document.getElementById('existencia_actual');

            var cu = document.getElementById('cantidad_unidades');
            var en = document.getElementById('entrada');
            var sa = document.getElementById('salida');

            var ex = document.getElementById('existencia');

            if(ex.value == 0)
            {
                cu.disabled = true;
                en.disabled = true;
                sa.disabled = true;

                ex.disabled = false;
            }else
            {
                cu.disabled = false;
                en.disabled = false;
                sa.disabled = false;

                ex.disabled = true;
            }
        }
</script>


<!--

- Cuando compramos mercancía lo registramos en entrada
- En salida se registran cuando son ventas o alguna devolución
- Existencia (cantidad que se tiene del artículo)
- 

-->
