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

    # Requerimos las librerias necesarias del sistema de correo electrónico y las aportamos manualmente en caso que fallase de forma automática.
    require 'vendor/autoload.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    # Conexión global
    require 'inc/conn.php';

    /*
        Selecciona de `tfg_gases` todos los registros que por defecto en la columna `mail` esté marcado como `no`.
        En caso de estar marcado como `no`, se les enviará a cada registro un correo electrónico con la información.
    */
    $rpp = $conn->query("SELECT * FROM tfg_gases WHERE mail='no'");while ($g = $rpp->fetch_assoc()) {
        
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->Host = $settings['email']['server']['host'];
        $mail->Port = $settings['email']['server']['port'];
        $mail->SMTPAuth = true;
        $mail->SMTPAutoTLS = true;
        $mail->Username = $settings['email']['server']['username'];
        $mail->Password = $settings['email']['server']['password'];
        $mail->setFrom($settings['email']['server']['username'], $settings['email']['server']['name']);
        $mail->addReplyTo($settings['email']['server']['username'], $settings['email']['server']['name']);
        $mail->addAddress($settings['email']['receptor']['username'], $settings['email']['receptor']['name']);
        $mail->isHTML(true);
        $mail->Subject = 'Hay nuevas medidas en ' . $g['SN'];
        $mail->Body = "Hola! Se han tomado nuevas medidas en ". $g['SN'] .".<br><br><b>Temperatura:</b> ". $g['temperatura'] ."". $settings['arduino']['temperatura']['symbol'] ."<br><b>CO2:</b> ". $g['CO2'] ."". $settings['arduino']['CO2']['symbol'] ."<br><b>NH3:</b> ". $g['NH3'] ."". $settings['arduino']['NH3']['symbol'] ."<br><b>Humedad:</b> ". $g['humedad'] ."". $settings['arduino']['humedad']['symbol'] ."<br><b>ITH:</b> ". $g['ITH'] ."". $settings['arduino']['ITH']['symbol'] ."<br><br><br>Para más información <a href='". $url ."/ino.php?id=". $g['ID'] ."'>haz clic aquí</a> para revisarlo a través de la página web.<br>O bien desde un enlace visual <a href='". $url ."/ino.php?id=". $g['ID'] ."'>". $url ."/ino.php?id=". $g['ID'] ."</a>";
        $mail->CharSet = "UTF-8";
        $mail->send();

        # Una vez enviado el correo, se marca el registro como `mail` en `yes` para no volver a enviar otro correo.
        mysqli_query($conn, "UPDATE tfg_gases SET mail='yes' WHERE ID=" . $g['ID']);
    }

?>