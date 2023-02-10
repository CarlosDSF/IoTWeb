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

    if($_SESSION['id']){

      echo href($url, 0);
      die();

    }
    
?>

<style>
body {
  background: url(<?php echo $url; ?>/assets/images/bg1.jpg) 50%;
  background-size: cover;
  min-height: 969px;
}
</style>

<div class="cover"></div>

<div class="container">
  <div class="row">
    <div class="col s12 m12">
      <h3 class="card-title white-text center" style="padding: 40px 0px;"><b><?php echo $name; ?> Register</b></h3>
    </div>

    <div class="col s12 m12 l4 offset-l4">
      <div class="card">
    
        <div class="card-content center">
          <div class="row">
          <form id="login" method="POST" autocomplete="off" action="<?php echo $url; ?>/enviar.php?formulario=register">
            <div class="input-field col s12 m12">
              <i class="fal fa-user prefix"></i>
              <input type="text" name="usuario" id="user" autofocus class="validate" required>
              <label for="user">Usuario</label>
            </div>
            <div class="input-field col s12 m12">
              <i class="fal fa-lock-alt prefix"></i>
              <input type="password" name="password" id="password" class="validate" required>
              <label for="password">Contraseña</label>
            </div>
            <div class="input-field col s12 m12">
              <i class="fal fa-lock-alt prefix"></i>
              <input type="password" name="repassword" id="repassword" class="validate" required>
              <label for="password">Repetir Contraseña</label>
            </div>
            <div class="input-field col s12">
              <button type="submit" class="btn waves-effect waves-light col s12 default-background">Registrar cuenta</button>
            </div>
          </form>
            <div class="input-field col s12">
              <button onclick="location.href='/login.php';" class="btn waves-effect waves-light col s12 default-background">Volver al login</button>
            </div>
          </div>
        </div>
        
      </div>
    </div>

  </div>
</div>

<script>
  $("#login").submit(function(event){
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
</script>
<?php require 'footer.php'; ?>