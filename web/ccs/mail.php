<?php

if(true) {
     
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "Complejocultural@atsa.org.ar";
   // $email_to = "daniel.maccarrone@me.com";
    $email_subject = "RESERVAS";
    
	$error="";
     
    $first_name = $_POST['first_name']; // required
    $last_name = $_POST['last_name']; // required
    $email_from = $_POST['email']; // required
    $email2 = $_POST['email2']; // not required
    $mess = $_POST['msg']; // not required
    $address = $_POST['address']; // not required
    $price = (isset($_POST['price'])) ? $_POST['price'] : ''; // required
    $telephone =  $_POST['telephone']; // not required
    $error_message = "";
    $error_classes = array();
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'La dirección de Mail es incorrecta.<br />';
    $error_classes['make_a_reservation_input_3'] = 'et-input-error';
  }
    $string_exp = "/^[A-Za-z .'-]+$/";
    
  if(!preg_match($string_exp,$first_name)) {
    $error_message .= 'El nombre no parece correcto.<br />';
    $error_classes['make_a_reservation_input_1'] = 'et-input-error';
  }
  if(!preg_match($string_exp,$last_name)) {
    $error_message .= 'El apellido no parece correcto.<br />';
      $error_classes['make_a_reservation_input_2'] = 'et-input-error';
  }

  if($email_from != $email2) {
    $error_message .= 'La dirección de Mail y la confirmación no coinciden.<br />';
      $error_classes['make_a_reservation_input_4'] = 'et-input-error';
  }  
  
  if(strlen($error_message) > 0) {
	$valid=false; 
	$msg=$error_message;
    $return_array = array('valid' => $valid, "msg" => $msg, 'error_classes' => $error_classes);
	echo json_encode($return_array);
	
  } else {
    send_mail($email_to, $email_subject, $first_name, $last_name, $email_from, $telephone, $mess);
	$valid=true; 
	$msg="Mensaje enviado correctamente."; 
    $return_array = array('valid' => $valid, "msg" => $msg);
	echo json_encode($return_array);
  }

} 


function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
}
     
function send_mail($email_to, $email_subject, $first_name, $last_name, $email_from, $telephone, $mess){
    $email_message = "Reservacion.\n\n";
    $email_message .= "Nombre: ".clean_string($first_name)."\n";
    $email_message .= "Apellido: ".clean_string($last_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Telefono: ".clean_string($telephone)."\n";
    $email_message .= "Mensaje: ".clean_string($mess)."\n";
     
	// create email headers
	$headers = 'From: '.$email_from."\r\n".
	'Reply-To: '.$email_from."\r\n" .
	'X-Mailer: PHP/' . phpversion();
	@mail($email_to, $email_subject, $email_message, $headers); 
}




?>
 