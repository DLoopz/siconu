

    <footer class="espacio-footer">
    	<div class="fondo-rosa text-center">
    		<br>
    		Copyright © Derechos Reservados <?php echo date('Y'); ?>  SICONU
    	</div>
    </footer>
  </body>
</html>


<script type="text/javascript">

  $(window).ready(function(){

    <?php if (isset($stock_card)) {echo "habilitar();";} ?>

    <?php if(isset($modal)) echo "$('#".$modal."').modal('show')";?>    

    $('table.table.table-hover.table-responsive-md.col-md-5:nth-child(2n)').addClass('offset-2');

  });

</script>


