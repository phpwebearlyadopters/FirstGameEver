<?php
	session_start();
	 if (isset($_POST['user'])) {
        $user = $_POST['user'];
        $haslo = $_POST['user'];
        $user = htmlentities($login, ENT_QUOTES, "UTF-8");
        $haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");
        $haslo_hash = password_hash($haslo, PASSWORD_DEFAULT);
    }
	  require_once "connect.php";
    try{
        $pdo = new PDO('mysql:host='.$host.';dbname='.$db_name, $db_user, $db_password );
    } catch (Exception $e) {
    }


renderTemplate('homepage');


function renderTemplate($templateName) {
	$path = __DIR__ . '/templates/' . $templateName . '.php';
	require_once $path;
}


?>
