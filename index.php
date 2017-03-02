<?php
	session_start();
	$user=$_POST['user'];
	$haslo=$_POST['user'];
	$login=htmlentities($login,ENT_QUOTES,"UTF-8");
	$haslo=htmlentities($haslo,ENT_QUOTES,"UTF-8");
	$haslo_hash=password_hash($haslo,PASSWORD_DEFAULT);
	require_once "connect.php"
	try{
		$pdo = new PDO('mysql:host='.$host.';dbname='.$db_name, $username, $password );
	}
	catch{
	}
?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
<title>Moja pierwsza gra przeglądarkowa</title>
<meta charset="utf-8"/>
<meta name="description" content="Pierwsza gra posiadająca własny system logowania i surowców.Wciągająca jak żadna inna!!"/>
<meta name="keywords" content="gra,strategia,logowanie,najlepsza"/>
<meta http-equiv="X-UA Compatible" content="IE=edge,chrome=1"/>
<link rel="stylesheet" href="style.css" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Lato:400,900&amp;subset=latin-ext" rel="stylesheet">
</head>
<body>
<div id="container">
	<div id="logo">
	TIBIJA-Wersja Exclusive
	</div>
	<div class="logrej">
		<form id="login" action="" method="post" >
			Login:<input type="text" name="user" placeholder="Podaj login" autofocus/></br>
			Hasło:<input type="password" name="haslo" placeholder="Podaj hasło"/></br>
			<input type="submit" value="Zaloguj"/>
		</form>
	</div>
	<div class="logrej">
		<a href="rejestracja.php" id="stworz">Nie masz jeszcze konta?!</br></br>
		Koniecznie utwórz je w naszym serwisie!!</a>
	</div>
	<div style="clear:both"></div>
</div>
</body>
</html>