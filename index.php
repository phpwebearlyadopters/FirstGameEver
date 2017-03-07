<?php
	session_start();
	 if (isset($_POST['user'])) {
        $user = $_POST['user'];
        $haslo = $_POST['haslo'];
        $user = htmlentities($user, ENT_QUOTES, "UTF-8");
        $haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");
		
		require_once "connect.php";
    try{
        $pdo = new PDO('mysql:host='.$host.';dbname='.$db_name, $db_user, $db_password );
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$log=$pdo->prepare('SELECT login ,haslo FROM uzytkownicy WHERE login=:login ');
		$log->bindParam(':login', $user, PDO::PARAM_STR,20);
		$log->execute();
		$wynik=$log->rowCount();
			if($wynik>0){
				$dane=$log->fetch();
			if(password_verify($haslo, $dane['haslo']))
					{
					$_SESSION['zalogowany'];
					header("Location:gra/gra.php");
						
				}
				else
				{
					$blad="Niepoprawny login lub hasło!";
				}
			}
		}
	 
	catch (PDOException $e) {
			echo '<span style="color:red">Błąd serwera! Prosimy spróbować później!</span>';
			echo "</br> Informacja developerska:".$e;
    }
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
		<span class="error"><?php
				if(isset($blad))
			{
				echo $blad;
				unset($blad);
			}
			?></span>
	</div>
	<div class="logrej">
		<a href="rejestracja.php" id="stworz">Nie masz jeszcze konta?!</br></br>
		Koniecznie utwórz je w naszym serwisie!!</a>
	</div>
	<div style="clear:both"></div>
</div>
</body>
</html>