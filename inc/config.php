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

    
    # Configuración CMS
    $url = "https://tfg.serranofernandez.com"; // Enlace de la web
    $name = "Arduino"; // Nombre del proyecto

    # Configuración regulable
    $settings = [
        # Valores min-max de los registros
        'arduino' => [
            'temperatura' => [
                'min' => '0',
                'max' => '50',
                'symbol' => 'ºC'
            ],
            'CO2' => [
                'min' => '100',
                'max' => '800',
                'symbol' => 'ppm'
            ],
            'NH3' => [
                'min' => '1',
                'max' => '150',
                'symbol' => 'ppb'
            ],
            'humedad' => [
                'min' => '0',
                'max' => '100',
                'symbol' => '%'
            ],
            'ITH' => [
                'min' => '50',
                'max' => '100',
                'symbol' => ''
            ]
        ],
        # Sistema de correo electrónico
        'email' => [
            'server' => [
                'host' => 'smtp-relay.sendinblue.com',
                'port' => '587',
                'name' => $name,
                'username' => 'correo@gmail.com',
                'password' => 'cambiarpass'
            ],
            'receptor' => [
                'name' => '',
                'username' => 'i72sefec@uco.es'
            ]
        ]
    ];
    

?>