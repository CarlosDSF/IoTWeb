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
    require 'header.php'; 

    # Destruye la $_SESSION['id] actual.
    session_destroy();

    # Redirecciona instantáneamente a $url
    header("Location: $url");
?>