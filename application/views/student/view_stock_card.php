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
                        <td><?php echo $sc->unitario?></td>
                        <td><?php echo $sc->promedio?></td>
                        <td><?php echo $sc->debe?></td>
                        <td><?php echo $sc->haber?></td>
                        <td><?php echo $sc->saldo?></td>
                        
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
