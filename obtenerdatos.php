<?php
# Conexión global
require 'inc/conn.php';
	# Recepción de datos The Things Network
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$content = trim(file_get_contents("php://input"));
		$decoded = json_decode($content, TRUE);
		$sn = $decoded['uplink_message']['decoded_payload']['sn'];
		$nh = $decoded['uplink_message']['decoded_payload']['nh'];
		$co = $decoded['uplink_message']['decoded_payload']['co'];
		$tempe = $decoded['uplink_message']['decoded_payload']['temp'];
		$hum = $decoded['uplink_message']['decoded_payload']['hum'];
		$pres = $decoded['uplink_message']['decoded_payload']['pres'];
		$alti = $decoded['uplink_message']['decoded_payload']['alti'];
		
		

		$ith = ((1.8)*$tempe + 32) - (0.55 - 0.55 * $hum/100)*(1.8 * $tempe - 26); // Formula de ITH
		
		
		
		#Inserción en la base de datos
		$rpp = $conn->query ("INSERT INTO tfg_gases (SN, CO2, NH3, humedad, temperatura, ITH) VALUES ('$sn','$co','$nh','$hum','$tempe','$ith')");
		
		if (!$rpp ) {
			echo "Hubo un error: " . $conn->error;
			die();
		}
	}
?>