<div class="container">
    <p class="text-light bg-dark">
        <div class="text-center">
            <h3>Tarjeta de Almacén</h3>
        </div>
    </p>
    <hr class="line_sep">
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
                <!--
                <tr class="table-danger">
                    <th>Inventario inicial</th>
                    <th>1</th>
                </tr>
                <tr class="table-danger">
                    <th>Compra</th>
                </tr>
                <tr class="table-danger">
                    <th>Total de mercancías</th>
                </tr>
                <tr class="table-danger">
                    <th>Inventario final</th>
                </tr>
                <tr class="table-danger">
                    <th>Costo de lo vendido</th>
                </tr>
                -->
            </thead>
            <tbody>
                <?php foreach ($stock_card as $sc)
                {?>
                    <tr>
                        <td><?php echo $sc->fecha?></td>
                        <td><?php echo $sc->referencia?></td>
                        <td><?php echo $sc->entradas?></td>
                        <td><?php echo $sc->salidas?></td>
                        <td><?php echo $sc->existencia?></td>
                        <td>$ <?php echo $sc->unitario?></td>
                        <td>$ <?php echo $sc->promedio?></td>
                        <td>$ <?php echo $sc->debe?></td>
                        <td>$ <?php echo $sc->haber?></td>
                        <td>$ <?php echo $sc->saldo?></td>
                        <td>
                            <!-- Eliminar registro -->
                            <?php
                                if($ultimo == $sc->id_tarjeta)
                                {?>
                                    <a class="btn btn-outline-danger" href="" data-toggle="modal" data-target="#modal_sc" onclick="eliminar(<?php echo $sc->id_tarjeta;?>)" title="Eliminar Registro"><strong><em><i class="icon-trash-empty"></i></em></strong></a>
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
                    <a href=""> <button type="button" id="btn_end" class="btn btn-outline-primary my-2 my-sm-0" onclick="view_result();">Terminar registros</button></a>
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

	<div class="form-group" id="content_result">
        <label for="">
            <b>Inventario inicial: $</b><?php echo $ii; ?>
        </label><br>
        <label for="">
            <b>Compra: </b></b><?php echo $compra; ?>
        </label><br>
        <label for="">
            <b>Total de mercancías: $</b></b><?php echo $mercancias; ?>
        </label><br>
        <label for="">
            <b>Inventario final: </b></b><?php echo $if; ?>
        </label><br>
        <label for="">
            <b>Costo de lo vendido: $</b></b><?php echo $vendido; ?>
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

        btn_end = document.getElementById("btn_end");
        content_result = document.getElementById("content_result");

        content_result.style.display = 'none';
    }
</script>
