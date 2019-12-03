<?php 

/*
//sirve
require_once("/home/santiago/dompdf/autoload.inc.php");
use Dompdf\Dompdf;

$cont = $_POST["cont"];
$dompdf = new Dompdf();
$dompdf->loadHtml($cont);
$dompdf->setPaper('A4', 'landscape');
//ini_set("memory_limit","50M");//aumentar memoria
$dompdf->render();
$dompdf->stream('archivo');

  /*
  $(function(){
    $( "#cola" ).click(function(event)
    {
      event.preventDefault();

      $.ajax(
        {
          type:"post",
          url: "<?php echo base_url();?>daybook/pdf?>",
          data:{ contenido : $('body').html() },
          success: function(response)
          {
            //console.log(response);
            $("#message").html(response);
            //$('#cartmessage').show();
          },
          error: function()
          {
            alert("Fallo ajax!");
          }
        }
      );
    });
  });
  */

*/

?>
