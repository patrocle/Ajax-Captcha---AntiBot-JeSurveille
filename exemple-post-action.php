<?
session_start();
include "captcha/captcha.php";
$captcha = new Captcha;

if(isset($_POST['captcha']) && $captcha->validate($_POST)){
	echo "ok";
}
elseif(isset($_POST['captcha'])){
	echo "Echec";
}
else{
	echo "Captcha non remplie";
}

?> 