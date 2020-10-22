</div>

    <footer class="espacio-footer">
    	<div class="fondo-rosa text-center"><br>Copyright © Derechos Reservados <?php echo date('Y'); ?>  SICONU</div>
    </footer>
  </body>
</html>


<script type="text/javascript">

  $(window).ready(function(){
    <?php if(isset($modal)) echo "$('#".$modal."').modal('show');";?>
    $('table.table.table-hover.table-responsive-md.col-md-5:nth-child(2n)').addClass('offset-2');
  });

  $(window).ready(function(){

    var titulo_pdf = $('.nav-item.nav-link.active').attr("title"); //sacar title
    if (titulo_pdf == 'Balance General')
    {
      $("#nav-profile-tab").click(function(){
        $("form").attr({"action":"<?php echo base_url();?>daybook/pdf_cuenta"});
      });
      $("#nav-home-tab").click(function(){
        $("form").attr({"action":"<?php echo base_url();?>daybook/pdf"});
      });
    }

    
    $("#sendcont").click(function() {

      var titulo_pdf = $('.nav-item.nav-link.active').attr("title"); //sacar title
      var titulo = '<div><h3 class="text-center">'+titulo_pdf+'</h3></div><hr class="line_sep">';

      var container = '<div class="container">';
      var tscheme = '<table class="table table-hover col-md-5 scheme" style="background: white;">';
      
      
      
      var tablas = '';
      tablas +=  titulo;
      console.log(titulo_pdf);
      //alert($(this).html());
      //console.log($(this).html());


      if (titulo_pdf != 'Esquemas de Mayor'  && titulo_pdf != 'Estado de resultados')
      {
        $(".table").each(function(){
          if (titulo_pdf == 'Rayado Diario' || titulo_pdf == 'Tarjeta de Almacén')
          {
            $('table tr th:last-child, tbody tr td:last-child').toggle();
          }
          //if (titulo_pdf != 'Tarjeta de Almacén') {
            tablas += '<table class="table table-hover table-bordered">' + $(".table").html().trim() + '</table>'
          //}
          //else{ tablas += '<table class="table table-hover">' + $(".table").html().trim() + '</table>' }
        }); //fin each
        if (titulo_pdf == 'Rayado Diario' || titulo_pdf == 'Tarjeta de Almacén')
        {
          $('table tr th:last-child, tbody tr td:last-child').toggle();
        }

        //para formato de cuenta
        if (titulo_pdf == 'Balance General' && $("#nav-profile").hasClass('active'))
        {
          var tablas = '';
          tablas += container + titulo;

          //balance f cuenta
          $(".tab-pane.fade.show.active").each(function(){
            console.log('entra al activo');
            //tablas += container;
            tablas += $(".bg-cuenta").html();
            console.log($(".bg-cuenta").html());
            tablas += '</div>';
            console.log('entra al formato');
          }); //fin each nav
        }

      }
      else
      {
        <?php //para esquemas de mayor ?>
        tablas += container;

        // agregar lo de la clase scheme
        if (titulo_pdf == 'Esquemas de Mayor') {
          $(".table").each(function(){
                tablas += tscheme + $(this).html().trim() + '</table>';// + '</div>';              
          });
        }
        else
        { 
          $(".table-responsive").each(function(){
            tablas += '<div class="table-responsive">';
            tablas += $(this).html().trim();
            tablas += '</div>';
          });
        }
        
      }
      tablas += '</div>'; //div container

      contpdf = tablas;

      //alert($("#contpdf").val().trim());
      $("#contpdf").val(String(contpdf));
      $("#titulo_pdf").val(String(titulo_pdf));
      //console.log('');
      console.log($("#contpdf").val().trim());
      //console.log('fin');
            
    }); //fin clic


  });

</script>


