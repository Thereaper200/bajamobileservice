<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

$destinatario = $_POST['destinatario'];
$asunto = "Verificación de Cita - BMS";
$mensaje_cliente = "¡Registro exitoso!\n\nGracias por completar el formulario de registro. Nos complace informarte que tu solicitud ha sido recibida correctamente. Un técnico altamente capacitado te contactará en un plazo máximo de 3 días hábiles para atender tu solicitud.\n\nSi tienes alguna pregunta adicional o necesitas más asistencia, no dudes en contactarnos. ¡Estamos aquí para ayudarte!\n\n¡Muchas gracias por confiar en nuestros servicios!\n\nAtentamente,\nEl equipo de soporte técnico.";

// Construir el mensaje para enviar a bajamobileservice@gmail.com
$mensaje_tu_correo = "Detalles de la cita:\n\n";
$mensaje_tu_correo .= "Nombre: " . $_POST['nombre'] . " " . $_POST['apellidos'] . "\n";
$mensaje_tu_correo .= "Teléfono: " . $_POST['telefono'] . "\n";
$mensaje_tu_correo .= "Dirección: " . $_POST['direccion'] . "\n";
$mensaje_tu_correo .= "Calle: " . $_POST['calle'] . "\n";
$mensaje_tu_correo .= "Colonia: " . $_POST['colonia'] . "\n";
$mensaje_tu_correo .= "Número Interior: " . $_POST['numeroint'] . "\n";
$mensaje_tu_correo .= "Número Exterior: " . $_POST['numeroext'] . "\n";
$mensaje_tu_correo .= "Código Postal: " . $_POST['codigopost'] . "\n";
$mensaje_tu_correo .= "Referencias: " . $_POST['ref'] . "\n";
$mensaje_tu_correo .= "Fecha de Cita: " . $_POST['fecha'] . "\n";
$mensaje_tu_correo .= "Marca: " . $_POST['marca'] . "\n";
$mensaje_tu_correo .= "Tipo de Dispositivo: " . $_POST['tipo_dispositivo'] . "\n";
$mensaje_tu_correo .= "Dispositivo: " . $_POST['dispositivo'] . "\n";
$mensaje_tu_correo .= "Falla: " . $_POST['falla'] . "\n";
$mensaje_tu_correo .= "Descripción del Problema:\n" . $_POST['descripcion_problema'];

$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = SMTP::DEBUG_OFF;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'bajamobileservice@gmail.com';
    $mail->Password = '';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    $mail->setFrom('bajamobileservice@gmail.com', 'BajaMobileService');
    $mail->addAddress($destinatario);

    $mail->isHTML(true);
    $mail->Subject = $asunto;
    $mail->Body = $mensaje_cliente;

    $mail->send();

    $mail->clearAddresses();
    $mail->addAddress('bajamobileservice@gmail.com');

    $asunto_tu_correo = 'Nueva Cita Agendada - BMS';

    $mail->Subject = $asunto_tu_correo;
    $mail->Body = $mensaje_tu_correo;

    $mail->send();

    header('Location: correo_enviado.html');
    exit();
} catch (Exception $e) {
    echo 'Error al enviar el correo: ', $mail->ErrorInfo;
}
?>
