<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Pobierz dane z formularza
$senderEmail = isset($_POST['sender_email']) ? $_POST['sender_email'] : '';
$senderMessage = isset($_POST['sender_message']) ? $_POST['sender_message'] : '';

// Ustawienia dla PHPMailer
$mail = new PHPMailer(true);

try {
    // Konfiguracja serwera SMTP
    $mail->isSMTP();
    $mail->Host       = 'smtp.poczta.onet.pl';  // Adres serwera SMTP
    $mail->SMTPAuth   = true;                 // Włącz autoryzację SMTP
    $mail->Username   = 'oszmurlo2006@onet.pl';   // Twój stały adres e-mail
    $mail->Password   = 'Neuca1982';      // Hasło do konta e-mail
    $mail->SMTPSecure = 'tls';                // Użyj TLS
    $mail->Port       = 587;                  // Port serwera SMTP

    // Adres nadawcy (stały adres e-mail)
    $mail->setFrom('oszmurlo2006@onet.pl', 'RadioActive Sender');

    // Adres odbiorcy
    $mail->addAddress('radiooactivv@gmail.com');

    $mail->Subject = 'Nowa wiadomość! - RadioActive';

    // Treść e-maila z opcjonalnym opisem i wiadomością od osoby wysyłającej
    $mail->Body = 'Dostarczono nową wiadomość!' . PHP_EOL;
    if (!empty($senderMessage)) {
        $mail->Body .= 'Wiadomość od Ciebie: ' . $senderMessage . PHP_EOL;
    }

    // Dodaj adres e-mail osoby wysyłającej do treści wiadomości
    if (!empty($senderEmail)) {
        $mail->Body .= 'Adres e-mail osoby wysyłającej: ' . $senderEmail . PHP_EOL;
    }

    // Wysyłanie e-maila
    $mail->send();

    header("Location: index.php");
} catch (Exception $e) {
    header("Location: index.php");
}
?>
