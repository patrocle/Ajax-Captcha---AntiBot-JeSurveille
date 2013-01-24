<?php
session_start();
include 'captcha.class.php';
$captcha= new Captcha;

// recuperation du contenu du captcha
if (isset($_POST["type"]) && $_POST["type"]=='txt'&& isset($_POST["key_picto"]) && $_POST["key_picto"]==$_SESSION["key_picto"]){
	echo $captcha->genText();
}
// au momment du drag and drop de l'icone on met en session rand si la bonne iconne a été placée
if (isset($_GET["type"]) && $_GET["type"]==2){
	echo $captcha->genSecondAccess($_GET["pass"]);
}

// recuperation d'un nouveau captcha
if (isset($_POST["type"]) && $_POST["type"]=='refreshKey'){
	$keys = array();
	$keys['picto']=$captcha->genKeyPicto();
	$json_keys= json_encode($keys);
	header('Content-Type: application/json');
	echo $json_keys;
} 
?>

