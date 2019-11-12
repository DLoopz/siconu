<?php 
require_once("/home/santiago/dompdf/autoload.inc.php");
use Dompdf\Dompdf;

function generar()
{
/*
  $cont = "<script>cont</script>";
  $dompdf = new Dompdf();
  $dompdf->loadHtml($cont);
  $dompdf->setPaper('A4', 'landscape');
  //ini_set("memory_limit","50M");//aumentar memoria
  $dompdf->render();
  $dompdf->stream('archivo');
  */
  echo "<script>alert(generado)</script>";
}

?>


<input type="submit" id="cola" name="" value="Generar">
<div id="resultado"></div>




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

    
    /*
    $(".exito:first-child, .error:first-child").append("<span class='confirmacion' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>×</span></span>");

    $(".confirmacion").click(function() {
  		$(".exito:first-child, .error:first-child").hide();
		});

    */

    $('table.table.table-hover.table-responsive-md.col-md-5:nth-child(2n)').addClass('offset-2');

    $("#cola").click(function() {
     
      console.log($('body').html());
      var cont = $('body').html();
      alert(cont);
      document.write('<?php echo generar(); ?>');
      
    })

    

  });
  

</script>

