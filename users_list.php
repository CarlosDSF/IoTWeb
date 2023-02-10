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
    if(!$_SESSION['id'] || $_SESSION['isAdmin'] != 1){

      echo href($url, 0);
      die();

    }

?>
<main>
<div class="container">
  <div class="row">
    <div class="col s12 m12">
      <h3 class="card-title" style="padding: 40px 0px;"><b>Lista de usuarios</b></h3>
    </div>

    <div class="col s12 m12">
      <table id="table" class="responsive-table">
        <thead>
          <tr>
              <th><i class="fal fa-id-card"></i> ID</th>
              <th><i class="fas fa-user"></i> Usuario</th>
              <th><i class="fas fa-user-cog"></i> Opciones</th>
          </tr>
        </thead>

        <tbody>
          
        <?php 
          # Consultamos en `admin` la lista completa de usuarios
          $users = $conn->query("SELECT * FROM admin ORDER by ID DESC");while ($u = $users->fetch_assoc()) {
        ?>
          <tr>
            <td><?php echo $u['ID']; ?></td>
            <td><?php echo $u['usuario']; ?></td>
            <td><a class="modal-trigger" href="#modal<?php echo $u['ID']; ?>"><i class="fas fa-trash-alt"></i></a></td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
    </div>

  </div>
</div>

<!-- Modal Structure -->
<?php 
    # Consultamos en `admin` la lista completa de usuarios
    $users = $conn->query("SELECT * FROM admin ORDER by ID DESC");while ($u = $users->fetch_assoc()) {
?>
    <div id="modal<?php echo $u['ID']; ?>" class="modal">
    <div class="modal-content">
      <h4>Borrando: <?php echo $u['usuario']; ?></h4>
      <div class="row">
        ¿Estás seguro que deseas eliminar la cuenta <b><?php echo $u['usuario']; ?></b>?
      </div>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
      <button onclick="DeleteUser(<?php echo $u['ID']; ?>); return false;" class="waves-effect waves-green btn-flat">Borrar Usuario</button>
    </div>
</div>
<?php } ?>

</main>
<script type="text/javascript">
$(document).ready( function () {
    // Configuración de las tablas
    $('#table').DataTable( {
      "responsive": true,
      "bPaginate": true,
      "bLengthChange": true,
      "bInfo": false,
      "bFilter": true,
      "order": [[ 0, "desc" ]]
    } );
} );

function DeleteUser(ID){
    $.ajax({
        url : "<?php echo $url; ?>/enviar.php?formulario=deleteUser",
        type: "POST",
        data: {
            u: ID,
        }
    }).done(function(response){
        $("#server-results").html(response);
    });
}
</script>