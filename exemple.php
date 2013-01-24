<?php
session_start();
include "captcha/captcha.php";
$captcha = new Captcha;
?> 
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>Ajax Captcha</title>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
	<script type="text/javascript" src="captcha/jquery.captcha.js"></script>
	<link href="captcha/captcha.css" rel="stylesheet" type="text/css" />
	<style type="text/css" media="screen">
		body { background-color: white; }
	</style>
	<script type="text/javascript" charset="utf-8">
		$(function() {
			$(".captcha-container").captcha({
				key_picto:"<?=$captcha->genKeyPicto();?>",
				url : "captcha/captcha.php",
				key_picto:"<?=$captcha->genKeyPicto();?>",
			});
			$('#submit').click( function(event) {
				$.ajax({
  					type: "POST",
  					url: "exemple-post-action.php",		//the url of the "action" page
  					data: $('#form').serialize(),	// #from is the id of your form...
  					cache: false,
  					success: function(retour){		//your action after the validation or not
						alert (retour);				
						retry();
  					}
 				});	
			});
			
			function retry(){
				var url ="captcha/captcha.php";
				$.ajax({
					type: "POST",
					url: url,
					data: "type=refreshKey",
					cache: false,
					success: function(json){
						$('.captcha-left').empty();
						$(".captcha-container").captcha({
							key_picto:json.picto
						});
					}
				});	
			}
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
