<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Sprawdź, czy formularz został wysłany
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

        header("Location: kontakt.php");
    } catch (Exception $e) {
        header("Location: kontakt.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontakt</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">    
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="img/RadioActive_iconW.png">
</head>

<header>
    <img class='logo' src="img/RadioActive_logoB.png" alt="Logo HereBox"/>
    <div class="menu">
        <button class='menubutton btn-animate btn btn-success' type="button"><a href="index.php" style="color: white; text-decoration: none;">Strona Główna</a></button>
        <button class='menubutton btn-animate btn btn-success' type="button"><a href="dane.html" style="color: white; text-decoration: none;">Działaj!</a></button>
        <button class='menubutton btn-animate btn btn-success' type="button"><a href="kontakt.php" style="color: white; text-decoration: none;">Kontakt</a></button>
        <p>Website made by: szmurk0 <3</p>
    </div>
</header>

<body style='background-image: linear-gradient(to bottom right, rgb(0, 106, 255), burlywood);'>
    
<div>
    <div class="wave"></div>
    <div class="wave"></div>
    <div class="wave"></div>
</div>

    <div class="container">
      <img src="img/shape.png" class="square" alt="" />
      <div class="form">
        <div class="contact-info">
          <b><h3 class="title">Kontakt</h3></b>
          <p class="text">
            Napisz kub zadzwoń do nas dowolną drogą komunikacji. Kompotentna osoba szybko odpowie, doradzi i rozwieje wątpliowści! :D
          </p>

          <div class="info">
            <div class="information">
              <img src="img/location.png" class="icon" alt="" />
              <b><p>ZS4 Tychy</p></b>
            </div>
            <div class="information">
              <img src="img/email.png" class="icon" alt="" />
              <b><p>radiooactivv@gmail.com</p></b>
            </div>
            <div class="information">
              <img src="img/phone.png" class="icon" alt="" />
              <b><p>451-129-041</p></b>
            </div>
          </div>

          <div class="social-media">
            <p></p>
            <div class="social-icons">

            </div>
          </div>
        </div>

        <div class="contact-form">
          <span class="circle one"></span>
          <span class="circle two"></span>

           <form action="upload1.php" method="post" enctype="multipart/form-data" autocomplete="off">
            <h3 class="title">Skontaktuj się z nami!</h3>
            <div class="input-container">
              <input type="text" name="name" class="input" required  />
              <label for="">Imie</label>
              <span>Imie</span>
            </div>
            <div class="input-container">
                <input type="email" name="sender_email" class="input" />
                <label for="">Twój Email</label>
                <span>Twój Email</span>
            </div>
            <div class="input-container">
              <input type="tel" name="phone" class="input" required  />
              <label for="">Nr. Telefonu</label>
              <span>Nr. Telefonu</span>
            </div>
            <div class="input-container textarea">
                <textarea name="sender_message" class="input"></textarea>
                <label for="">Wiadomość od Ciebie</label>
                <span>Wiadomość od Ciebie</span>
            </div>
            <input type="submit" value="Wyślij!" class="btn" />
          </form>
        </div>
      </div>
    </div>

    <style>
        
        body {
            margin: auto;
            overflow: auto;
            background: linear-gradient(315deg, rgba(101,0,94,1) 3%, rgba(60,132,206,1) 38%, rgba(48,238,226,1) 68%, rgba(255,25,25,1) 98%);
            animation: gradient 15s ease infinite;
            background-size: 400% 400%;
            background-attachment: fixed;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 0%;
            }
            50% {
                background-position: 100% 100%;
            }
            100% {
                background-position: 0% 0%;
            }
        }



        .wave {
            background: rgb(255 255 255 / 25%);
            border-radius: 1000% 1000% 0 0;
            position: fixed;
            width: 200%;
            height: 12em;
            animation: wave 10s -3s linear infinite;
            transform: translate3d(0, 0, 0);
            opacity: 0.8;
            bottom: 0;
            left: 0;
            z-index: -1;
        }

        .wave:nth-of-type(2) {
            bottom: -1.25em;
            animation: wave 18s linear reverse infinite;
            opacity: 0.8;
        }

        .wave:nth-of-type(3) {
            bottom: -2.5em;
            animation: wave 20s -1s reverse infinite;
            opacity: 0.9;
        }

        @keyframes wave {
            2% {
                transform: translateX(1);
            }
            25% {
                transform: translateX(-25%);
            }
            50% {
                transform: translateX(-50%);
            }
            75% {
                transform: translateX(-25%);
            }
            100% {
                transform: translateX(1);
            }
        }
    </style>


    <script>

        const inputs = document.querySelectorAll(".input");

        function focusFunc() {
        let parent = this.parentNode;
        parent.classList.add("focus");
        }

        function blurFunc() {
        let parent = this.parentNode;
        if (this.value == "") {
            parent.classList.remove("focus");
        }
        }

        inputs.forEach((input) => {
        input.addEventListener("focus", focusFunc);
        input.addEventListener("blur", blurFunc);
        });

        
    </script>
  </body>
</html>
