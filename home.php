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

?>
<main>
<div class="container">
  <div class="row">
    <div class="col s12 m12">
      <h3 class="card-title" style="padding: 40px 0px;"><b>Lista</b></h3>
    </div>

    <div class="col s12 m12">
      <table id="table" class="responsive-table">
        <thead>
          <tr>
              <th><i class="fal fa-microchip"></i> SN</th>
              <th><i class="fal fa-alarm-clock"></i> Fecha</th>
              <th><i class="fal fa-cloud"></i> CO2</th>
              <th><i class="fal fa-flask"></i> NH3</th>
              <th><i class="fal fa-temperature-high"></i> Temp.</th>
              <th><i class="fal fa-tint"></i> Humedad</th>
              <th><i class="fal fa-satellite-dish"></i> ITH</th>
          </tr>
        </thead>

        <tbody>
          
        <?php 
          # Consultamos en `tfg_gases` la lista completa
          $rpp = $conn->query("SELECT * FROM tfg_gases");while ($s = $rpp->fetch_assoc()) {
        ?>
          <tr data-href="<?php echo $url; ?>/ino.php?id=<?php echo $s['ID']; ?>">
            <td><?php echo $s['SN']; ?></td>
            <td><?php echo date("d M, Y", strtotime($s['FechaHora'])); ?> <?php echo date("H:i", strtotime($s['FechaHora'])); ?></td>
            <td><?php echo $s['CO2']; ?></td>
            <td><?php echo $s['NH3']; ?></td>
            <td><?php echo $s['temperatura']; ?></td>
            <td><?php echo $s['humedad']; ?></td>
            <td><?php echo $s['ITH']; ?></td>

          </tr>
        <?php } ?>
        </tbody>
      </table>
    </div>

  </div>
</div>
</main>
<script type="text/javascript">
$(document).ready( function () {

    // Indicamos que al poner el mouse por encima de cada registro, vaya al enlace que pongamos en el data-href
    $('#table').on('click', 'tbody tr', function() {
      window.location.href = $(this).data('href');
    });
    
    // Configuración de las tablas
    $('#table').DataTable( {
      "responsive": true,
      "bPaginate": true,
      "bLengthChange": true,
      "bInfo": false,
      "bFilter": true,
      "order": [[ 1, "desc" ]]
    } );
} );
</script>