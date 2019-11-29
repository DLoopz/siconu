<form action="<?php echo base_url();?>daybook/pdf" method='post'>
  <input type="text" id="contpdf" name="contpdf" class="invisible">
  <input type="submit" id="sendcont" name="sendcont" class="btn btn-info" value="Generar">
</form>


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

    <?php if(isset($modal)) echo "$('#".$modal."').modal('show')";?>    

    $('table.table.table-hover.table-responsive-md.col-md-5:nth-child(2n)').addClass('offset-2');

    $("#sendcont").click(function() {
      
      //console.log($('body').html());
      
      var heads = $('head').html();
      //var body = $('body').html();
      //var container = $('.container').html();

      var ntablas = $('table');
      var tables;
      tables = $('table').html(); //1

      for (var i = 0; i < ntablas.length; i++) {
        //tables += $('table:nth-child(i)').nextAll().html();
      }
      
      

      alert('tables');
      alert(Object.values(tables));

      //var contpdf = heads+table1+tables;
      //$("#contpdf").val(contpdf);
      console.log('');
      
    })

  });
  

  

  

</script>

