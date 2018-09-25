<?php

$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
switch ($lang){
    case "es":
        //echo "PAGE ES";
        $okMessage = '¡Tu consulta se envió con éxito! Te estaré contactando a la brevedad. ¡Muchas Gracias!';
        $errorMessage = '¡Ooops! Hubo un problema para enviar tu consulta, por favor volvé a intentarlo más tarde';
        break;
    case "en":
        //echo "PAGE EN";
        $okMessage = 'Contact form successfully submitted. Thank you, I will get back to you soon!';
        $errorMessage = 'There was an error while submitting the form. Please try again later';
        break;        
    default:
        //echo "PAGE ES - Setting Default";
        $okMessage = '¡Tu consulta se envió con éxito! Te estaré contactando a la brevedad. ¡Muchas Gracias!';
        $errorMessage = '¡Ooops! Hubo un problema para enviar tu consulta, por favor volvé a intentarlo más tarde';
        break;
}

// configure
$from = 'Formulario de contacto web <demo@domain.com>';
$sendTo = 'Formulario de contacto web <ledisalvo@gmail.com>'; // Add Your Email
$subject = 'Nuevo mensaje de un usuario';
$fields = array('name' => 'Nombre', 'subject' => 'Asunto', 'email' => 'Email', 'message' => 'Mensaje'); // array variable name => Text to appear in the email

// let's do the sending

try
{
    $emailText = "Mensaje desde el formulario de contacto web\n===========================================\n";

    foreach ($_POST as $key => $value) {

        if (isset($fields[$key])) {
            $emailText .= "$fields[$key]: $value\n";
        }
    }

    $headers = array('Content-Type: text/plain; charset="UTF-8";',
        'From: ' . $from,
        'Reply-To: ' . $from,
        'Return-Path: ' . $from,
    );
    
    mail($sendTo, $subject, $emailText, implode("\n", $headers));

    $responseArray = array('type' => 'success', 'message' => $okMessage);
}
catch (\Exception $e)
{
    $responseArray = array('type' => 'danger', 'message' => $errorMessage);
}

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $encoded = json_encode($responseArray);

    header('Content-Type: application/json');

    echo $encoded;
}
else {
    echo $responseArray['message'];
}
