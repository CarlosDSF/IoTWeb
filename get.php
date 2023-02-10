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
    # Converitmos el archivo de php a json
    header('Content-Type: application/json');
    $json = array();

    $get = htmlspecialchars(filter_var($_GET['id'], FILTER_SANITIZE_STRING));

    # Obtenemos el ID de `tfg_gases`.
    $wr = $conn->query("SELECT * FROM tfg_gases WHERE ID='$get'");
    # En caso que no exista, le diremos que no muestre nada.
    if($wr->num_rows <= 0){
        die();
    }
    # Cuyo caso exista, mostrará los resultados en json
    while ($w = $wr->fetch_assoc()) {
        $json[] = array(
            'ID' => $w['ID'],
            'FechaHora' => $w['FechaHora'],
            'SN' => $w['SN'],
            'CO2' => $w['CO2'],
            'NH3' => $w['NH3'],
            'humedad' => $w['humedad'],
            'temperatura' => $w['temperatura'],
            'ITH' => $w['ITH'],
            'percentage_CO2' => (($w['CO2']-$settings['arduino']['CO2']['min'])*100)/($settings['arduino']['CO2']['max']-$settings['arduino']['CO2']['min']),
            'percentage_NH3' => (($w['NH3']-$settings['arduino']['NH3']['min'])*100)/($settings['arduino']['NH3']['max']-$settings['arduino']['NH3']['min']),
            'percentage_humedad' => (($w['humedad']-$settings['arduino']['humedad']['min'])*100)/($settings['arduino']['humedad']['max']-$settings['arduino']['humedad']['min']),
            'percentage_temperatura' => (($w['temperatura']-$settings['arduino']['temperatura']['min'])*100)/($settings['arduino']['temperatura']['max']-$settings['arduino']['temperatura']['min']),
            'percentage_ITH' => (($w['ITH']-$settings['arduino']['ITH']['min'])*100)/($settings['arduino']['ITH']['max']-$settings['arduino']['ITH']['min'])
        );
    }
    print_r(str_replace($rep_a, $rep_b, json_encode($json)));


?>