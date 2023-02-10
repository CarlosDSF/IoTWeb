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

    
    # No mostrar errores de código PHP/MySQL en la web.
    error_reporting(0);

    # [DB] Conexión a la base de datos.
    $conn = mysqli_connect(
        'localhost',
        'arduino',
        '3&Av4at79',
        'arduino'
    );

    # Creamos session para los usuarios.
    session_start();
    
    # Identificamos al usuario a través del $_SESSION['id].
    if($_SESSION['id']){

        $result_sql_user = $conn->query("SELECT * FROM admin WHERE ID='". $_SESSION['id'] ."'");
        $user = $result_sql_user->fetch_array();
        
    }

    # Funciones
    require 'functions.php';

    # Configuración
    require 'config.php';

    

?>