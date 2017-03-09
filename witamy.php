<?php
	session_start();
	if((!isset($_SESSION['udalosie'])))
	{
		header("Location:index.php");
		exit();
	}
	else
	{
		unset ($_SESSION['udalosie']);
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
<link rel="stylesheet" href="style1.css" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Lato:400,900&amp;subset=latin-ext" rel="stylesheet">
</head>
<body>
<div id="container">
	<div id="logo">
	<a href="index.php" id="dzieki">Dziękujemy za rejestrację w serwisie. Zapraszamy do logowania się na swoje konto</a>
	</div>
	
</body>
</html>