<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: Content-Type");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';
$mail->Encoding = 'base64';

$params = json_decode(file_get_contents('php://input'));

$assunto = $params->name;
$email = $params->email;
$mensagem = $params->message;

$response = '';

$bodyTemplate = "
<style type='text/css'>
	.main {
		width: 100%;
	}
	
	.email {
		width: 60%;
		margin-left: 20%;
		border: solid 1px #000000;
	}
	
	.bold {
		font-weight: 700;
	}
</style>
<html>
	<div class='main'>
		<div class='email'>
			<p> <span class='bold'>De:</span> $nome ($email) </p>
			<!-- <p> <span class='bold'>Telefone:</span> $telefone </p>
			<p> <span class='bold'>Assunto:</span> $assunto </p> -->
			<p>$mensagem</p>
			<p> Este e-mail foi enviado através do formulário de contato do site: MACTECH </p>
		</div>
	</div>
</html>
";

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.hostinger.com'; 
    $mail->SMTPAuth = true;
    $mail->Username = 'matheuscorona@mactechnology.com.br';
    $mail->Password = 'Maths@!2021';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    //Recipients
    $mail->setFrom('matheuscorona@mactechnology.com.br');
    $mail->addAddress('matheuscorona@mactechnology.com.br');

    //Content
    $mail->isHTML(true);
    $mail->Subject = 'Contato via formulario do Site';
    $mail->Body = $bodyTemplate;

    $mail->send();
    echo json_encode(200);
} catch (Exception $e) {
    echo json_encode($mail->ErrorInfo);
}
?>