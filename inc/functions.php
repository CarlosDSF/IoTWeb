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

    
    # La función alert avisa con un mensaje en los formularios con diferentes tipos de estados.
    function alert($a,$b){
        /*
            $a -> cuerpo mensaje
            $b -> color
            $c -> tipo de mensaje (estados: warning, error, success, info, question)
        */
        echo '
        <script>
            M.toast(
                {
                    html: "'.$a.'",
                    classes: "rounded '.$b.'"
                }
            )
        </script>
        ';
    }

    # La función href básicamente redirecciona al sitio web que se indique en la variable después de X*1000 segundos.
    function href($a, $b){
        /*
            $a -> enlace
            $b -> segundos (1 segundo = 1000)
        */
        echo "
        <script>
            var timer = setTimeout(function() {
                window.location='$a'
            }, $b);
        </script>
        ";
    }

?>