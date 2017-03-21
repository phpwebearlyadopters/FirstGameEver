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
<link rel="stylesheet" href="style3.css" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Lato:400,900&amp;subset=latin-ext" rel="stylesheet">
<script src="jquery-3.1.1.min.js"></script>
<script type="text/javascript">
		
		var change1=function(){
			document.getElementById("home").style.display="none";
			document.getElementById("character").style.display="block";
			document.getElementById("statistics").style.display="none";
			document.getElementById("contact").style.display="none";
			
		}
		var change2=function(){
			document.getElementById("home").style.display="none";
			document.getElementById("character").style.display="none";
			document.getElementById("statistics").style.display="block";
			document.getElementById("contact").style.display="none";
			
		}
		var change3=function(){
			document.getElementById("home").style.display="none";
			document.getElementById("character").style.display="none";
			document.getElementById("statistics").style.display="none";
			document.getElementById("contact").style.display="block";
			
		}
		
				
				
		
</script>
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
		<ul>
			<a href="#" onclick="location.reload(true)"  class="menu"><li>Strona główna</li></a>
			<a href="#" onclick="change1()" class="menu"><li>Postać</li></a>
			<a href="#" onclick="change2()" class="menu"><li>Statystyki</li></a>
			<a href="#" onclick="change3()" class="menu"><li>Kontakt</li></a>
		</ul>
	</div>
	<div id="content">
		<div id="home">
		ELO ELO
		<?php
			if(isset($_SESSION['wyslano'])){
				echo "<script>document.getElementById('home').innerHTML='Dziękujemy za kontakt z administracją!';</script>";
				unset ($_SESSION['wyslano']);
				}
				?>
		
		
		</div>
		<div id="character">
			ELO ELO ELO
		</div>
		<div id="statistics">
			ELO ELO ELO ELO
		</div>
		<div id="contact" style="z-index:100">
			<h1>Skontaktuj się z nami!</h1>
			<form method="post" action="contact.php">
				Podaj login z gry:</br>
				<input type="text" name="m_login"/></br>
				Podaj email:</br>
				<input type="email" name="m_mail" /></br>
				Wybierz typ problemu:</br>
				<select name="m_temat">
					<option>Tu wpisz pierwszą możliwość</option>
					<option>Tu wpisz drugą możliwość</option>
				</select></br>
				Opis problemu:</br>
				<input type="text" name="m_opis" /></br>
				<input type="submit" value="Wyślij zgłoszenie"/>
			</form>
			
		</div>
			
	</div>
	<div id="panel">
	</div>
	<div style="clear:both"></div>

	
	
	
	
	
</div>
</body>
</html>