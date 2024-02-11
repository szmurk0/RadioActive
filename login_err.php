<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="img/RadioActive_iconW.png">
    <title>Login RadioActive</title>

    

    <!-- Font Awesome (for icons) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- CSS file -->
    <link rel="stylesheet" href="stylesLogin.css" />
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(to bottom right, rgb(0, 106, 255), burlywood);
            animation: gradient 10s ease infinite;
            background-size: 400% 400%;
            margin: 0;
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

        .wrapper {
            position: relative;
            width: 400px;
            height: 450px;
            background: transparent;
            border: 2px solid rgba(255, 255, 255, 0.5);
            border-radius: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(15px);
        }

        .wrapper h1 {
            font-size: 1.6em;
            color: #fff;
            text-align: center;
            margin-bottom: 20px;
        }

        .wrapper p {
            font-size: 1.3em;
            color: white;
            text-align: center;
            margin-bottom: 20px;
        }

        .wrapper .btn {
            width: 40%;
            max-width: 300px;
            height: 40px;
            background: #fff;
            outline: none;
            border: none;
            border-radius: 40px;
            cursor: pointer;
            font-size: 1em;
            font-weight: 500;
            color: #000;
            margin-top: auto;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center; /* Dodane */
            padding: 0 20px;
        }

        .wrapper .btn a {
            text-decoration: none;
            color: #000;
        }

        .wrapper .wave {
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

        .wrapper .wave:nth-of-type(2) {
            bottom: -1.25em;
            animation: wave 18s linear reverse infinite;
            opacity: 0.8;
        }

        .wrapper .wave:nth-of-type(3) {
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
</head>

<body>
    <div class="wave"></div>
    <div class="wave"></div>
    <div class="wave"></div>

    <div class="wrapper">
        <br><br>
        <h1>Nie udało się zalogować</h1>
        <br>
        <p>Sprawdź czy dane wprowadzone są poprawne.</p>
        <button type="submit" class="btn"><a href="login.html"> Powrót </a></button>
        <br>
    </div>
</body>

</html>
