<div class="container col-md-4">
    <div class="panel panel-primary col-md-offset-4">
        <div class="panel-heading">
            <h3 class="panel-tittle text-center">
                Agregar Nuevo Registro
            </h3>
        </div>
        <hr class="line_sep">
        <p class="text-danger">* Campos obligatorios</p>
        <div class="panel-body">
            <form method="post" action="<?php echo base_url();?>stock_card/add_register_card/<?php echo $id_empresa;?>">
                <div class="form-group">
                    <label for="">
                        Empresa selecionada:
                    </label>
                    (Aquí va el nombre de la empresa)
                    <!--
                    <h1 colspan="2" class="text-center text-uppercase"><?php echo $exercise->nombre; ?></h1>
                    -->
                </div>
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
                    <!--
                    <textarea name="descripcion" id="des" cols="30" rows="10" class="form-control"></textarea>
                    -->
                    <div class="form-group">
                        <!--Cantidad:-->
                        <input type="text" name="referencia" class="form-control" placeholder="Tipo de movimiento">
                        <?php echo form_error('referencia') ?>
                    </div>
                </div>
                
                
                <div class="<form-g></form-g>roup">
                    <label for="">
                        <b>Unidades </b>
                    </label>
                    <!--
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3">
                        <label class="form-check-label" for="<inl></inl>ineRadio3">Existencia</label>
                    </div>
                    -->
                    <div class="form-group">
                        <!--Cantidad:-->
                        <input type="text" name="cantidad_unidades" class="form-control" placeholder="Cantidad en números">
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
                        <b>Existencia:</b>
                    </label>
                    <div class="form-group">
                        <!--Cantidad:-->
                        <input type="text" name="cantidad_existencia" class="form-control" placeholder="Cantidad en números">
                        <?php echo form_error('cantidad_existencia') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="">
                        <b>Costos </b>
                    </label>
                    <div class="form-group">
                        <!--Cantidad:-->
                        <div class="input-group">
                            <input type="text" class="form-control" id="cantidad_costos" name="cantidad_costos" placeholder="Cantidad en números" aria-describedby="inputGroupPrepend2">
                        </div>
                        <?php echo form_error('cantidad_costos') ?>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-radio custom-control-inline col-5">
                            <input type="radio" id="unitario" name="costos" class="custom-control-input" value="unitario" chequed>
                            <label class="custom-control-label" for="unitario">Unitario</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline col-5">
                            <input type="radio" id="promedio" name="costos" class="custom-control-input" value="promedio">
                            <label class="custom-control-label" for="promedio">Promedio</label>
                        </div>
                    </div>
                </div>
                <input type="submit" name="add_entry" value="Continuar" class="btn btn-outline-success my-2 my-sm-0">
				<a href="<?php echo base_url()?>stock_card/list_sc/<?php echo $id_empresa; ?>"> <button type="button" class="btn btn-outline-primary my-2 my-sm-0">Cancelar</button></a>
            </form>
        </div>
    </div>
    <hr>
</div>


<!--

- Cuando compramos mercancía lo registramos en entrada
- En salida se registran cuando son ventas o alguna devolución
- Existencia (cantidad que se tiene del artículo)
- 

-->