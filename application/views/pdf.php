
<div class="row">
	<form action="<?php echo base_url();?>daybook/pdf" method='post' class="">
	  <input type="text" id="id_empresa" name="id_empresa" value="<?php if(isset($id_empresa)) echo $id_empresa;?>" class="invisible">
	  <input type="text" id="titulo_pdf" name="titulo_pdf" value="<?php if(isset($titulo_pdf)) echo $titulo_pdf;?>" class="invisible">
	  <input type="text" id="titulo" name="titulo" value="" class="invisible">
	  <input type="text" id="contpdf" name="contpdf" class="invisible">
	  <input type="submit" id="sendcont" name="sendcont" class="btn btn-info" value="Generar PDF">
	</form>
</div>


<script>

$(window).ready(function(){

	$('table.table.table-hover.table-responsive-md.col-md-5:nth-child(2n)').addClass('offset-2');


	$("#sendcont").click(function() {

		var titulo_pdf = $('.nav-item.nav-link.active').attr("title"); //sacar title
		var titulo = '<div><h3 class="text-center">'+titulo_pdf+'</h3></div><hr class="line_sep">';

	  var container = '<div class="container">';
	  var tscheme = '<table class="table table-hover col-md-5 scheme">';
	  
	  var tablas = '';
	  tablas +=  titulo;
	  //console.log(titulo_pdf);

	  if (titulo_pdf != 'Esquemas de Mayor')
	  {
	  	$(".table").each(function(){
	  	  //alert($(this).html());
	  	  //console.log($(this).html());
	  	  if (titulo_pdf == 'Rayado Diario' || titulo_pdf == 'Tarjeta de Almacén'){
	  	 		$('table tr th:last-child, tbody tr td:last-child').toggle();
	  	  }
	  	  tablas += '<table class="table table-hover table-bordered">' + 
	  	  $(".table").html().trim() + '</table>'
	  	}); //fin each
	  	
		  	if (titulo_pdf == 'Rayado Diario' || titulo_pdf == 'Tarjeta de Almacén'){
		  		$('table tr th:last-child, tbody tr td:last-child').toggle();
	  		}
	  }
	  else
	  {
	  	<?php //para esquemas de mayor ?>
	  	tablas += container;
	  	$(".table").each(function(){
	  	  //alert($(this).html());
	  	  //console.log($(this).html());
	  	  $('table.table.table-hover.table-responsive-md.col-md-5:nth-child(2n)').addClass('offset-2');
	  	  $('table.table.table-hover.table-responsive-md.col-md-5:nth-child(2n)').addClass('scheme');
	  	  // agregar lo de la clase scheme
	  	  tablas += tscheme + $(this).html().trim(); + '</table>'
	  	});
	  }

	  //tablas += '</div></div>'; //CON CONtainer
	  //tablas += '</div></div>';


	  contpdf = tablas;
	  $("#contpdf").val(String(contpdf));
	  $("#titulo_pdf").val(String(titulo_pdf));
	  //console.log('valor asignado');
	  //console.log($("#contpdf").val().trim());
	  //console.log('fin');
	  
	    
	}); //fin clic


	/*
	$(".content_box a:not('.button')");
	$("#sendcont").click(function() {
		var v = $('table tr th:last-child, tbody tr td:last-child');
		console.log(v);
	});
	*/

});

</script>