<form action="<?php echo base_url();?>daybook/pdf" method='post' class="invisible">
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

  
  $(document).ready(function(){

      $("form").submit(function(e){
          var condicion = $("#rgpd").is(":checked");
          if(!condicion){
              e.preventDefault();
          }else{
              $("[name='enviar']").click(function(){
                  $(this).attr("disabled","disabled");
              });
          };  
      });
      $("input").blur(function(){
          $("[name='enviar']").removeAttr("disabled");
      })
      
  });


  $(window).ready(function(){

    habilitar();

    <?php if(isset($modal)) echo "$('#".$modal."').modal('show')";?>    

    $('table.table.table-hover.table-responsive-md.col-md-5:nth-child(2n)').addClass('offset-2');

    //no editar

      //echo print_r($exercises,1);
      /*
      [id_empresa] => 2
      [estado] => 0
      */
      
      var ejs = new Array();
      <?php 
        /*
        echo $asientos[0]->id_asiento;
        echo 'num asientos'.count($asientos);
        */
      ?>
      <?php 
      
        if (isset($exercises)) {
          for ($i=0; $i < count($exercises); $i++) { 
      ?>
        var ejs.push(<?php echo $exercises[$i]->id_empresa;?>) = <?php echo $exercises[$i]->id_empresa; ?>
      <?php  }} ?>
          

    

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

