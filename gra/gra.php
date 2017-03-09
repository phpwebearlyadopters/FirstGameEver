<?php
	session_start();
	if(!isset($_SESSION['zalogowany'])){
		header("Location:../index.php");
		exit();
	}
	?>
<!DOCTYPE HTML>
<html lang="pl">
<head>
<title>WITAJ W TIBIJI</title>
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
	<div id="dane">
	Witaj <?php echo "<b>".$_SESSION['user']."</b>"; ?>&nbsp;&nbsp;&nbsp;&nbsp; <a href="logout.php">[ Wyloguj się!!]</a>
	</div>
	<div id="menu">
	</div>
	<div id="content">
	</div>
	<div id="panel">
	</div>
	<div style="clear:both"></div>

	
	
	
	
	
</div>
</body>
</html>