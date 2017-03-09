<?php
	session_start();
	unset ($_SESSION['zalogowany']);
	unset ($_SESSION['user']);
	header("Location:../index.php");
?>
