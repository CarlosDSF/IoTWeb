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
    
    if($_SESSION['id']){

        echo href($url . '/home.php', 0);
        die();

    } else {

        echo href($url . '/login.php', 0);
        die();

    }

?>