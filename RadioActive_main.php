<!DOCTYPE html>
<html>
	<head>
		<meta name="charset" content="uft-8"/><meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href='styleRA.css'/>
		<meta http-equiv="refresh" content="2"/>
		<title>RadioActive • panel</title>
		<link rel="icon" type="image/x-icon" href="img/RadioActive_iconW.png">
	</head>
	<body style='background-image: linear-gradient(to bottom right, blue, burlywood);'>
		<?php
			$host = 'localhost'; $user = 'root'; $pass = ''; $db = 'dbRA';
		?>
		<header>
			<img class='logo' src="img/RadioActive_logoB.png" alt="Logo HereBox"/>
			<div class="menu">
				<button class='menubutton' type="button" onclick="alert('Strona niedostępna! Serwis w budowie...')">Dane</button>
				<button class='menubutton' type="button" onclick="alert('Strona niedostępna! Serwis w budowie...')">Pomoc</button>
			</div>
		</header>
		<main>
			<div class='widget widget2a'>
				<p class="heading">Lista zadań</p>
				<p>
					<?php
						/* content */
					?>
				</p>
			</div>
			<div class='widget widget2b'>
				<p class="heading">Panel dnia • XX.XX.20XX</p>
				<p>Brak</p>
			</div>
			<div class='widget widget2a'>
				<p class="heading">Prześlij plik</p>
				<p>
					<?php
						/* content */
					?>
				</p>
			</div>
			<div class='widget widget1'>
				<p class="heading">Baza plików</p>
				<p>
					<?php
						/* content */
					?>
				</p>
			</div>
		</main>
	</body>
</html>