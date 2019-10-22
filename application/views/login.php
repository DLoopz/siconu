    <div class="container">
        <div class="row margin_top_login text-center">
            <div class="col-md-6 col-md-offset-6">
                <figure class="figure"><br/><br/>
                    <img src="<?php echo base_url();?>source/img/fondologin.png" class="figure-img img-fluid rounded" alt="img-siconu" width="500px">                
                </figure>
            </div>
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-success">
                    <br><br>
                    <div class="panel-heading">
                        <h3 class="panel-title principal-color">Iniciar sesión</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="<?php echo base_url('login/login'); ?>">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Usuario" name="usuario" type="text" autofocus>
                                </div>
                                <?php echo form_error('usuario'); ?>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Contraseña" name="password" type="password">
                                </div>
                                <?php echo form_error('password'); ?>
                                <input class="btn btn-outline-primary btn-block" type="submit" value="Ingresar" name="login">
                                <?php
                                if($this->session->flashdata('msg'))
                                    echo $this->session->flashdata('msg');
                                ?>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>