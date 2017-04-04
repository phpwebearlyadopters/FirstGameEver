<?php
	session_start();
	
	if(isset($_POST['usun_konto'])){
		$login=$_SESSION['user'];
		require_once "connect.php";
		try{
			$pdo = new PDO('mysql:host='.$host.';dbname='.$db_name, $db_user, $db_password );
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$del=$pdo->exec("DELETE FROM uzytkownicy WHERE login='$login'");
			unset ($_SESSION['zalogowany']);
			unset ($_SESSION['user']);
			$dzieki="Twoje konto zostało usunięte! Dziękujemy za wspólną grę </br>
							<a href='../index.php'>Powrót do strony głównej</a>";
		}
		catch (PDOException $e) {
			echo '<span style="color:red">Błąd serwera! Prosimy spróbować później!</span>';
			echo "</br> Informacja developerska:".$e;
      };	
	}
?>

<!DOCTYPE HTML>
<html lang="pl">
<head>
</head>
<body>
<?php
	if(isset($dzieki)){
		echo $dzieki;
		unset($dzieki);
	}
	?>
</body>
</html>