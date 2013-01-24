<?php
session_start();
include "captcha/captcha.php";
$captcha = new Captcha;
?>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>Ajax Captcha</title>
	<script type="text/javascript" src="latest-jquery/jquery-1.5.1.min.js"></script>
	<script type="text/javascript" src="latest-jquery-ui/jquery-ui.min.js"></script>
	<script type="text/javascript" src="captcha/jquery.captcha.js"></script>
	<link href="captcha/captcha.css" rel="stylesheet" type="text/css" />
	<style type="text/css" media="screen">
		body { background-color: white; }
	</style>
	<script type="text/javascript" charset="utf-8">
		$(function() {
			$(".captcha-container").captcha({
				key_picto:"<?=$captcha->genKeyPicto();?>"
			});
			$('#submit').click( function(event) {
				$.ajax({
  					type: "POST",
  					url: "captcha/exemple.php",
  					data: $('#form').serialize(),
  					cache: false,
  					success: function(retour){
						alert (retour);
							var url ="captcha/captcha.php";
						$.ajax({
  							type: "POST",
  							url: url,
  							data: "type=refreshKey",
  							cache: false,
  							success: function(json){
								$('.captcha-left').empty();
  								$(".captcha-container").captcha({
									key_image:json.img,
									key_picto:json.picto
								});
  							}
 						});	
  					}
 				});	
			});
		});	
	</script>
</head>
<body>
 
<!-- Exemple de formulaire -->	
<form method="post" id="form">
	<!-- Début du Captcha captcha -->	
	<div class="captcha-container">
    	You must enable javascript to see captcha here!
    	<div id='captcha-bottom'><a href='http://www.jesurveille.fr'>Je Surveille</a> - AntiBot</div>
   	</div>
	<!-- Fin du Captcha -->
	<p><input id="submit" type="button" name="submit" value="Envoyer" /></p>
</form>
<!-- Fin de l'exemple -->

</body>	
</html>