<?php
	session_start();
	if(isset($_SESSION['zalogowany'])){
		header("Location:gra/gra.php");
	}
	
	if(isset($_POST['email']))
	{
		//Zakładamy ze wszystko bedzie gut
		$wszystko_OK=true;
		//Poprawnosc loginu
		$login=$_POST['login'];
		//Dlugosc nicku
		if((strlen($login))<3 || (strlen($login)>20))
		{
			$wszystko_OK=false;
			$e_login="Login musi posiadać od 3 do 20 znaków!!";
		}
		if((ctype_alnum($login))==false ||(strlen($login!=0)))
		{
			$wszystko_OK=false;
			$e_login="Login nie może posiadać polskich znaków oraz symboli!!";
		}
	//Pora na maila:
		$email=$_POST['email'];
	//sanityzacja maila
		$emailS=filter_var($email,FILTER_SANITIZE_EMAIL);
		if((filter_var($emailS,FILTER_VALIDATE_EMAIL)==false) || ($emailS!=$email))
		{
			$wszystko_OK=false;
			$e_email="Niepoprawny adres e-mail! \n";
		}
		//hasła
		$pass1=$_POST['pass1'];
		$pass2=$_POST['pass2'];
		if((strlen($pass1))<8 || (strlen($pass1)>24))
		{
			$wszystko_OK=false;
			$e_pass="Hasło musi zawierać od 8 do 24 znaków!" ;
		}
		if($pass1!=$pass2)
		{
			$wszystko_OK=false;
			$e_pass="Podane hasła nie są identyczne!";
		}
		//regulamin
		if(!isset($_POST['regulamin']))
		{
			$wszystko_OK=false;
			$e_reg="Zaakceptuj regulamin!";
		}
		//bot or not bot
		$sekret="6LcoaBYUAAAAABSaXJ5ochy62m6KWktQJptDy7yj";
		$sprawdz=file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$_POST['g-recaptcha-response']);
		$odpowiedz=json_decode($sprawdz);
		if($odpowiedz->success==false)
		{
			$wszystko_OK=false;
			$e_bot="Ty nicponiu jesteś robotem?!";
		}
		$login=htmlentities($login,ENT_QUOTES,"UTF-8");
		$pass1=htmlentities($pass1,ENT_QUOTES,"UTF-8");
		$pass2=htmlentities($pass2,ENT_QUOTES,"UTF-8");
		$email=htmlentities($email,ENT_QUOTES,"UTF-8");
		$pass_hash= password_hash($pass1,PASSWORD_DEFAULT);
		
		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);//linia przy try-catch aby przy bledzie wyrzucal wyjatek a nie warning
		
		try
		{
			$polaczenie=new mysqli($host,$db_user,$db_password,$db_name);
			if ($polaczenie->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
			//Czy istnieje mail w bazie
			$rezultat=$polaczenie->query("SELECT id FROM uzytkownicy WHERE mail='$email'");	
			if(!$rezultat)throw new Exception($polaczenie->error); //rzuca bledem jesli cos sie nie uda w zapytaniu
			$wynik=$rezultat->num_rows; //zwraca ilosc wierszy 
			if($wynik>0)
			{
				$wszystko_OK=false;
				$e_email="Istnieje konto z takim adresem e-mail!";
			}
			//Czy istnieje login w bazie
			$rezultat=$polaczenie->query("SELECT id FROM uzytkownicy WHERE login='$login'");	
			if(!$rezultat)throw new Exception($polaczenie->error); //rzuca bledem jesli cos sie nie uda w zapytaniu
			$wynik=$rezultat->num_rows; //zwraca ilosc wierszy 
			if($wynik>0)
			{
				$wszystko_OK=false;
				$e_login="Istnieje konto o takim nicku!";
			}
			if($wszystko_OK==true)
			{
				if($polaczenie->query("INSERT INTO uzytkownicy VALUES (NULL, '$login', '$pass_hash', '$email')"))
				{
					$_SESSION['udalosie']=true;
					header("Location:witamy.php");
				}
				else
				{
				throw new Exception($polaczenie->error);
				}
			}
			$polaczenie->close();
			}
		}
		catch(Exception $e)
		{
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
<link rel="stylesheet" href="style1.css" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Lato:400,900&amp;subset=latin-ext" rel="stylesheet">
<script src='https://www.google.com/recaptcha/api.js'></script>
<script type="text/javascript">
	var regulamin=function(){
		document.getElementById("myModal").style.display="block";
	};
	var zamknij=function(){
		document.getElementById("myModal").style.display="none";
	}
</script>
</head>

<body>
<div id="container">
	<div id="logo">
	TIBIJA-Wersja Exclusive
	</div>
	<div id="myModal" class="modal">
		
	<span class="close" onclick="zamknij()">&times;</span>
		<div class="modal-content">
		
			<h1>Regulamin gry</h1>
			<ol>
				<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
					<ul>
						<li>Praesent malesuada ipsum eu magna consectetur dapibus.</li>
						<li>Duis at eros non ipsum venenatis facilisis.</li>
					</ul></li>
				<li>Fusce sagittis orci sit amet fermentum bibendum.
					<ul>
						<li>Sed porta risus sed magna vulputate sodales ac quis metus.</li>
					</ul></li>
				<li>Nullam porta magna vel ullamcorper euismod.
					<ul>
						<li>Mauris faucibus est et aliquam congue.</li>
						<li>Aliquam rutrum arcu in vehicula sollicitudin.</li>
						<li>Cras eu risus fermentum, condimentum turpis in, tempor libero.</li>
						<li>Aliquam venenatis turpis in mauris pulvinar, sed cursus leo gravida.</li>
						<li>Aliquam tincidunt ligula a sapien sagittis tempor.</li>
					</ul></li>
				<li>Nulla vehicula libero sed scelerisque fermentum.
					<ul>
						<li>Etiam eu quam in ex fermentum fringilla.</li>
						<li>Maecenas ullamcorper nisl quis elit dignissim, nec blandit nulla imperdiet.</li>
						<li>Sed posuere tellus a odio dictum, sit amet finibus nulla sodales.</li>
					</ul></li>
				<li>Nulla feugiat est cursus, congue nibh eget, tincidunt lorem.
					<ul>
						<li>Etiam volutpat eros eget molestie aliquet.</li>
						<li>Morbi imperdiet libero ac orci varius porttitor.</li>
						<li>Vestibulum auctor dolor eu urna faucibus, ut lacinia ligula sagittis.</li>
					</ul></li>
				<li>Phasellus elementum orci sed semper consectetur.
					<ul>
						<li>Cras pretium magna non leo dictum vehicula.</li>
						<li>Phasellus ut turpis tristique, vehicula felis malesuada, placerat odio.</li>
						<li>Maecenas at sem vel justo hendrerit hendrerit.</li>
						<li>Aenean pharetra nulla vel commodo posuere.</li>
					</ul></li>
				<li>Morbi sed lacus lobortis nunc tempus auctor nec id elit.
					<ul>
						<li>Vestibulum quis est a turpis mollis tempor nec eget justo.</li>
						<li>Maecenas et leo nec lacus vulputate varius ut quis tellus.</li>
						<li>Maecenas a dolor quis massa dapibus vehicula eget eget nisi.</li>
						<li>Maecenas aliquet lectus et rhoncus rhoncus.</li>
					</ul></li>
				<li>Curabitur luctus tortor ut pulvinar lacinia.
					<ul>
						<li>Morbi a dui vel tortor elementum sollicitudin sit amet vitae libero.</li>
						<li>Sed quis augue non velit porttitor fermentum.</li>
						<li>Vivamus eleifend nisi vel eros lobortis, eget pulvinar est gravida.</li>
						<li>Phasellus sed libero sollicitudin neque vulputate consequat eget ac tortor.</li>
					</ul></li>
			</ol>
		</div>

	</div>
	<form method="post" id="utworz">
		Podaj login:</br>
		<input type="text" name="login" autofocus /></br>
		<span class="error"><?php
			if(isset($e_login))
			{
				echo $e_login;
				unset($e_login);
			}
		?></span>
		Podaj hasło:</br>
		<input type="password" name="pass1" /></br>
		<span class="error"><?php
			if(isset($e_pass))
			{
				echo $e_pass ;
				unset($e_pass);
			}
		?></span> 
		Powtórz hasło:</br>
		<input type="password" name="pass2"/></br>
		Podaj e-mail:</br>
		<input type="email" name="email"/></br>
		<span class="error"><?php
			if(isset($e_email))
			{
				echo $e_email;
				unset($e_email);
			}
		?></span></br>
		Akceptacja <a href="#" id="popup" onclick="regulamin()">regulaminu</a>:<input type="checkbox" name="regulamin"/></br>
		<span class="error"><?php
			if(isset($e_reg))
			{
				echo $e_reg;
				unset($e_reg);
			}
		?></span></br>
	
		<div class="g-recaptcha" data-sitekey="6LcoaBYUAAAAAK0dIzXrQsW9xjGzLEcg0p0CYnv0"></div>
		<span class="error"><?php
			if(isset($e_bot))
			{
				echo $e_bot ;
				unset($e_bot);
			}
		?></span></br>
		<input type="submit" value="Stwórz konto"/>
	</form>
	
	<a href="index.php" id="powrot">Powrót do strony głównej</a>
	
	
	
</body>
</html>