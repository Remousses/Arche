<?php
$to = 'remy91490@hotmail.fr';
$object = 'objet de l email';
$message = 'l email en lui-même';
 
$headers  = 'From: adresse de l expediteur'."\r\n";
$headers .= 'Reply-To: adresse destiner a la reponse'."\r\n";
$headers .= 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
mail($to, $object, $message, $headers);
?>