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

    # Conexión global
    require 'inc/conn.php'; 

?>
<!DOCTYPE html>
  <html>
    <head>
      
      <title><?php echo $name; ?></title>
      <link rel="icon" type="image/png" href="<?php echo $url; ?>/assets/images/motherboard.png">

      <!-- Fuentes -->
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Ubuntu:regular,bold&subset=Latin">

      <!-- CSS -->
      <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>/assets/css/all.css">
      <link type="text/css" rel="stylesheet" href="<?php echo $url; ?>/assets/css/materialize.min.css"  media="screen,projection"/>
      <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" />
      <link rel="stylesheet" type="text/css" href="<?php echo $url; ?>/assets/css/style.css?v=<?php echo time(); ?>" />

      <!-- JS -->
      <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
      <script type="text/javascript" src="<?php echo $url; ?>/assets/js/materialize.min.js"></script>
      <script type="text/javascript" src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

      <!-- Metas -->
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <meta name="theme-color" content="#006687">

      <!-- 
        ##
        # Scripts para inicializar el sidenav y modal
        ##

        sidenav: Es el menú que se desplaza de la izquierda a la derecha.
        modal: Cuando editas un registro, es el box que se abre.
    
      -->
      <script>
        $(document).ready(function(){
            $('.sidenav').sidenav();
            $('.modal').modal();
        });
      </script>
    </head>

    <body>

    <main id="main">
    
    <!-- En `server-results` se mostrarán las alertas de los formularios -->
    <div id="server-results"></div>
    <?php if($_SESSION['id']){ ?>
        <header>
        <nav class="default-background">
            <div class="nav-wrapper">
            <a href="<?php echo $url; ?>/home.php" class="brand-logo center"><?php echo $name; ?></a>
            <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul class="left hide-on-med-and-down">
                <li><a style="display: block;" href="#" data-target="slide-out" class="sidenav-trigger"><i style="font-size: 26px !important;" class="material-icons">menu</i></a></li>
            </ul>
            </div>
        </nav>
    

        <ul id="slide-out" class="sidenav">
            <li><a class="subheader"><?php echo $name; ?></a></li>
            <li><a href="<?php echo $url; ?>/home.php"><i class="fas fa-home"></i> Inicio</a></li>
            <?php if ($_SESSION['isAdmin'] > 0){ ?><li><a href="<?php echo $url; ?>/users_list.php"><i class="fas fa-th-list"></i> Lista de usuarios</a></li><?php } ?>
            <li><a href="<?php echo $url; ?>/logout.php"><i class="fas fa-door-closed"></i> Cerrar sesión</a></li>
        </ul>
        </header>
    <?php } ?>