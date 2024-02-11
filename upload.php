<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$uploadDir = 'uploads/'; // Katalog, do którego pliki mają być przesyłane

if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
    $tempFile = $_FILES['file']['tmp_name'];
    $fileName = $_FILES['file']['name'];
    $targetFile = $uploadDir . $fileName;

    if (move_uploaded_file($tempFile, $targetFile)) {
        // Plik przesłano pomyślnie

        // Pobierz opcjonalny opis
        $description = isset($_POST['description']) ? $_POST['description'] : '';

        // Ustawienia dla PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Konfiguracja serwera SMTP
            $mail->isSMTP();
            $mail->Host       = 'smtp.poczta.onet.pl';  // Adres serwera SMTP
            $mail->SMTPAuth   = true;                 // Włącz autoryzację SMTP
            $mail->Username   = 'oszmurlo2006@onet.pl';   // Twój adres e-mail radiooactivv@gmail.com
            $mail->Password   = 'Neuca1982';      // Hasło do konta e-mail
            $mail->SMTPSecure = 'tls';                // Użyj TLS
            $mail->Port       = 587;                  // Port serwera SMTP

            // Adres nadawcy
            $mail->setFrom('oszmurlo2006@onet.pl', 'RadioActive');

            // Adres odbiorcy
            $mail->addAddress('radiooactivv@gmail.com');

            // Dodaj załącznik (przesłany plik)
            $mail->addAttachment($targetFile, $fileName);

            // Temat e-maila
            $mail->Subject = 'Nowy plik! - RadioActive';

            // Treść e-maila z opcjonalnym opisem
            $mail->Body = 'Dostarczono nowy plik!' . PHP_EOL;
            if (!empty($description)) {
                $mail->Body .= 'Opis: ' . $description;
            }

            // Wysyłanie e-maila
            $mail->send();

            header("Location: index.php");
        } catch (Exception $e) {
            header("Location: index.php");
        }
    } else {
        header("Location: index.php");
    }
} else {
    header("Location: index.php");
}

?>
