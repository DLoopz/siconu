<form action="<?php echo base_url();?>daybook/pdf_balance" method='post' class="">
  <input type="text" id="id_empresa" name="id_empresa" value="<?php if(isset($id_empresa)) echo $id_empresa;?>" class="invisible">
  <input type="text" id="titulo" name="titulo" value="" class="invisible">
  <input type="text" id="contpdf" name="contpdf" class="invisible">
  <input type="submit" id="sendcont" name="sendcont" class="btn btn-info" value="Generar">
</form>

<script>


$(window).ready(function(){

	$("#sendcont").click(function() {
	  var tablas = '';
	  $(".table").each(function(){
	    //alert($(this).html());
	    tablas += '<table class="table table-bordered">' + $(this).html().trim(); + '</table>'
	  });
	  
	  contpdf = tablas;
	  //alert(contpdf);
	  $("#contpdf").val(String(contpdf));
	  console.log('valor asignado');
	  console.log($("#contpdf").val().trim());
	    
	});

});

</script>