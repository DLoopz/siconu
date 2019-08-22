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

    $(<?php if(isset($modal)) echo "'#".$modal."'";?>).modal("show");

    $(".exito:first-child, .error:first-child").append("<span class='confirmacion' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>×</span></span>");

    $(".confirmacion").click(function() {
  		$(".exito:first-child, .error:first-child").hide();
		});

  }); 

</script>