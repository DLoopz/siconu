<?php 
require_once("/home/santiago/dompdf/autoload.inc.php");
use Dompdf\Dompdf;

$cont = $_POST["cont"];
$dompdf = new Dompdf();
$dompdf->loadHtml($cont);
$dompdf->setPaper('A4', 'landscape');
//ini_set("memory_limit","50M");//aumentar memoria
$dompdf->render();
$dompdf->stream('archivo');

echo "Archivo creado".$_POST['num'];

?>
