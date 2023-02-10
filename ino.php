<?php

    /*
        UNIVERSIDAD DE CÓRDOBA
        Escuela Politécnica Superior de Córdoba
        Departamento de Electrónica

        Desarrollo de un sistema sensor IoT de gases y comunicación a base de datos mediante LoraWan
        Autor: Carlos David Serrano Fernández
        Director(es): Ezequiel Herruzo Gómez y Jesús Rioja Bravo
        Curso 2022 - 2023
    */


    require 'header.php';
    if(!$_SESSION['id']){

      echo href($url, 0);
      die();

    }

    $get = htmlspecialchars(filter_var($_GET['id'], FILTER_SANITIZE_STRING));

    $rp = $conn->query("SELECT * FROM tfg_gases WHERE ID='$get'");$g = $rp->fetch_array();
    
    if(!$g['ID']) {

      echo href($url . '/home.php', 0);
      die();
      
    }

?>
<style>
  .collapsible-body {
    padding: 0px !important;
  }
</style>
<main>
<div class="container">
  <div class="row">
    
    <div class="col s12 <?= ($_SESSION['isAdmin'] > 0) ? "m4" : "m12" ?>">
      <a class="btn default-background" style="width: 100%;margin-bottom: 10px;" href="<?php echo $url; ?>/home.php"><i class="fal fa-arrow-alt-left"></i></a>
    </div>
    <?php if ($_SESSION['isAdmin'] > 0){ ?>
    <div class="col s6 m4">
      <a class="btn blue modal-trigger" style="width: 100%;margin-bottom: 10px;" href="#modal1"><i class="fal fa-pencil"></i></a>
    </div>
    <div class="col s6 m4">
      <form id="delete" method="POST" autocomplete="off" action="<?php echo $url; ?>/enviar.php?formulario=delete&g=<?php echo $g['ID']; ?>">
        <button type="submit" class="btn red" style="width: 100%;margin-bottom: 10px;"><i class="fal fa-trash"></i></button>
      </form>
    </div>
    <?php } ?>

    <div class="col s12 m6">
        <div class="card stats white-text black">
          <i class="icono fal fa-microchip"></i>
          <div class="card-content">
            <span class="card-title titl" style="padding: 38px 0px 0px 0px;"><?php echo $g['SN']; ?></span>
            <span class="card-title period" style="line-height: 15px;">SN<br><br></span>
          </div>
        </div>
    </div>
    <div class="col s12 m6">
        <div class="card stats white-text red">
          <i class="icono fal fa-temperature-high"></i>
          <div class="card-content">
            <span  class="card-title titl" style="padding: 38px 0px 0px 0px;"><b id="temperatura_txt"><?php echo $g['temperatura']; ?></b><?php echo $settings['arduino']['temperatura']['symbol']; ?></span>
            <span class="card-title period" style="line-height: 15px;">Temperatura<br><br></span>
          </div>
          <div class="left min"><?php echo $settings['arduino']['temperatura']['min']; ?><?php echo $settings['arduino']['temperatura']['symbol']; ?></div>
          <div class="right max"><?php echo $settings['arduino']['temperatura']['max']; ?><?php echo $settings['arduino']['temperatura']['symbol']; ?></div>
          <div class="progress">
              <div id="temperatura" class="determinate" style="width: <?php echo (($g['temperatura']-$settings['arduino']['temperatura']['min'])*100)/($settings['arduino']['temperatura']['max']-$settings['arduino']['temperatura']['min']); ?>%"></div>
          </div>
        </div>
    </div>
    <div class="col s12 m6">
        <div class="card stats white-text blue">
          <i class="icono fal fa-cloud"></i>
          <div class="card-content">
            <span class="card-title titl" style="padding: 38px 0px 0px 0px;"><b id="CO2_txt"><?php echo $g['CO2']; ?></b><?php echo $settings['arduino']['CO2']['symbol']; ?></span>
            <span class="card-title period" style="line-height: 15px;">CO2<br><br></span>
          </div>
          <div class="left min"><?php echo $settings['arduino']['CO2']['min']; ?><?php echo $settings['arduino']['CO2']['symbol']; ?></div>
          <div class="right max"><?php echo $settings['arduino']['CO2']['max']; ?><?php echo $settings['arduino']['CO2']['symbol']; ?></div>
          <div class="progress">
              <div id="CO2" class="determinate" style="width: <?php echo (($g['CO2']-$settings['arduino']['CO2']['min'])*100)/($settings['arduino']['CO2']['max']-$settings['arduino']['CO2']['min']); ?>%"></div>
          </div>
        </div>
    </div>
    <div class="col s12 m6">
        <div class="card stats white-text green">
          <i class="icono fal fa-flask"></i>
          <div class="card-content">
            <span class="card-title titl" style="padding: 38px 0px 0px 0px;"><b id="NH3_txt"><?php echo $g['NH3']; ?></b><?php echo $settings['arduino']['NH3']['symbol']; ?></span>
            <span class="card-title period" style="line-height: 15px;">NH3<br><br></span>
          </div>
          <div class="left min"><?php echo $settings['arduino']['NH3']['min']; ?><?php echo $settings['arduino']['NH3']['symbol']; ?></div>
          <div class="right max"><?php echo $settings['arduino']['NH3']['max']; ?><?php echo $settings['arduino']['NH3']['symbol']; ?></div>
          <div class="progress">
              <div id="NH3" class="determinate" style="width: <?php echo (($g['NH3']-$settings['arduino']['NH3']['min'])*100)/($settings['arduino']['NH3']['max']-$settings['arduino']['NH3']['min']); ?>%"></div>
          </div>
        </div>
    </div>
    <div class="col s12 m6">
        <div class="card stats white-text grey">
          <i class="icono fal fa-tint"></i>
          <div class="card-content">
            <span class="card-title titl" style="padding: 38px 0px 0px 0px;"><b id="humedad_txt"><?php echo $g['humedad']; ?></b><?php echo $settings['arduino']['humedad']['symbol']; ?></span>
            <span class="card-title period" style="line-height: 15px;">Humedad<br><br></span>
          </div>
          <div class="left min"><?php echo $settings['arduino']['humedad']['min']; ?><?php echo $settings['arduino']['humedad']['symbol']; ?></div>
          <div class="right max"><?php echo $settings['arduino']['humedad']['max']; ?><?php echo $settings['arduino']['humedad']['symbol']; ?></div>
          <div class="progress">
              <div id="humedad" class="determinate" style="width: <?php echo (($g['humedad']-$settings['arduino']['humedad']['min'])*100)/($settings['arduino']['humedad']['max']-$settings['arduino']['humedad']['min']); ?>%"></div>
          </div>
        </div>
    </div>
    <div class="col s12 m6">
        <div class="card stats white-text cyan">
          <i class="icono fal fa-satellite-dish"></i>
          <div class="card-content">
            <span class="card-title titl" style="padding: 38px 0px 0px 0px;"><b id="ITH_txt"><?php echo $g['ITH']; ?></b><?php echo $settings['arduino']['ITH']['symbol']; ?></span>
            <span class="card-title period" style="line-height: 15px;">ITH<br><br></span>
          </div>
          <div class="left min"><?php echo $settings['arduino']['ITH']['min']; ?><?php echo $settings['arduino']['ITH']['symbol']; ?></div>
          <div class="right max"><?php echo $settings['arduino']['ITH']['max']; ?><?php echo $settings['arduino']['ITH']['symbol']; ?></div>
          <div class="progress">
              <div id="ITH" class="determinate" style="width: <?php echo (($g['ITH']-$settings['arduino']['ITH']['min'])*100)/($settings['arduino']['ITH']['max']-$settings['arduino']['ITH']['min']); ?>%"></div>
          </div>
        </div>
    </div>
    

  </div>
</div>




  <!-- Modal Structure -->
  <div id="modal1" class="modal">
    <div class="modal-content">
      <h4>Editando: <?php echo $g['SN']; ?></h4>
      <div class="row">
        <form class="col s12" id="modify" method="POST" autocomplete="off" action="<?php echo $url; ?>/enviar.php?formulario=modify&g=<?php echo $g['ID']; ?>">
          <div class="row">
            <div class="input-field col s6">
              <input placeholder="SN" name="SN" value="<?php echo $g['SN']; ?>" type="text" class="validate">
              <label>SN</label>
            </div>
            <div class="input-field col s6">
              <input placeholder="CO2" name="CO2" value="<?php echo $g['CO2']; ?>" type="text" class="validate">
              <label>CO2</label>
            </div>
            <div class="input-field col s6">
              <input placeholder="NH3" name="NH3" value="<?php echo $g['NH3']; ?>" type="text" class="validate">
              <label>NH3</label>
            </div>
            <div class="input-field col s6">
              <input placeholder="Humedad" name="humedad" value="<?php echo $g['humedad']; ?>" type="text" class="validate">
              <label>Humedad</label>
            </div>
            <div class="input-field col s6">
              <input placeholder="Temperatura" name="temperatura" value="<?php echo $g['temperatura']; ?>" type="text" class="validate">
              <label>Temperatura</label>
            </div>
            <div class="input-field col s6">
              <input placeholder="ITH" name="ITH" value="<?php echo $g['ITH']; ?>" type="text" class="validate">
              <label>ITH</label>
            </div>
          </div>
        
      </div>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
      <button type="submit" href="#!" class="waves-effect waves-green btn-flat">Guardar cambios</button>
    </div>
    </form>
  </div>



</main>
<script>
jQuery(document).ready(function($){
  // Leemos el formulario del id="delete" y el resultado enviado en action="" nos lo muestre en server-results
  $("#delete").submit(function(event){
      event.preventDefault();
      var post_url = $(this).attr("action");
      var request_method = $(this).attr("method");
      var form_data = $(this).serialize();
      
      $.ajax({
          url : post_url,
          type: request_method,
          data : form_data
      }).done(function(response){
          $("#server-results").html(response);
      });
  });
  // Leemos el formulario del id="modify" y el resultado enviado en action="" nos lo muestre en server-results
  $("#modify").submit(function(event){
      event.preventDefault();
      var post_url = $(this).attr("action");
      var request_method = $(this).attr("method");
      var form_data = $(this).serialize();
      
      $.ajax({
          url : post_url,
          type: request_method,
          data : form_data
      }).done(function(response){
          $("#server-results").html(response);
      });
  });


function CallPerc(){
  $.get( "<?php echo $url; ?>/get.php?id=<?php echo $g['ID']; ?>", function( data ) {

    $('#temperatura').width(data[0].percentage_temperatura + '%'),
    $('#temperatura_txt').html(data[0].temperatura),

    $('#CO2').width(data[0].percentage_CO2 + '%'),
    $('#CO2_txt').html(data[0].CO2),

    $('#NH3').width(data[0].percentage_NH3 + '%'),
    $('#NH3_txt').html(data[0].NH3),

    $('#humedad').width(data[0].percentage_humedad + '%'),
    $('#humedad_txt').html(data[0].humedad),

    $('#ITH').width(data[0].percentage_ITH + '%'),
    $('#ITH_txt').html(data[0].ITH);

  });
}


setInterval(() => {
  CallPerc();
}, 1000);

});
</script>