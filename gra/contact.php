<?php
session_start();
if(isset($_POST['m_login']))
{
	$m_login=$_POST['m_login'];
	$m_mail=$_POST['m_mail'];
	$m_temat=$_POST['m_temat'];
	$m_opis=$_POST['m_opis'];
	$to="msienio@poczta.onet.pl";
	ini_set("SMTP","smtp.poczta.onet.pl." ); 
	ini_set('sendmail_from', $m_mail); 
	$headers='From:  ' . $m_login . ' <' . $m_mail .'>';
	//mail($to,$m_temat,$m_opis,$headers);
	$_SESSION['wyslano']=true;
	header("Location:gra.php");	
}
else{
	header("Location:gra.php");
}
?>

