<?php
class Captcha {
	var $captachDir;
	var $picto;
	var $text;
	var $validate;
	function Captcha() {
		$this->captachDir = "captcha";
		$this->picto = array ("ciseaux","coeur","eclair","etoile","facebook","ordinateur","pile", "poisson","smiley", "tasse","twitter","panda","cochon","voiture"  );
		$this->text [0] = "Glissez l'icone correspondante dans le cercle.<span>";
		$this->text [1] = "</span>";
		$this->validate = false;
	}
	function genText() {
		$i = 0;
		$images_captcha_html = "";
		$images_captcha_in = array ();
		while ( $i != 5 ) {
			$rand = rand ( 0, sizeof ( $this->picto ) - 1 );
			if (! in_array ( $rand, $images_captcha_in )) {
				$_SESSION ['captcha-' . $i] = rand ();
				$rand_item = rand ( 0, 10000 );
				$_SESSION ['item-' . $rand_item] = $this->picto [$rand];
				$images_captcha_html .= "<li class='captcha-" . $i . "' id='captcha-" . $i . "' > <img id='" . $_SESSION ['captcha-' . $i] . "' src='" . $this->captachDir . "/item.php?img=" . $rand_item . "' alt='captcha pitco' /> </li>";
				$images_captcha_in [] = $rand;
				$i ++;
			}
		}
		$rand = rand ( 0, 4 );
		$_SESSION ['captcha'] = $rand;
		$_SESSION ['PictoText'] = $this->picto [$images_captcha_in [$rand]];
		unset ( $_SESSION ['key_picto'] ); //
		return "<div id='captcha-content'>
   					<div id='captcha-left'>
    					<p id='captcha-text'>" . $this->text [0] . "<img src='" . $this->captachDir . "/image.php?l=" . rand () . "' >" . $this->text [1] . "</p>
    					<ul id='captcha-task'> " . $images_captcha_html . " </ul>
    				</div>
    				<div id='captcha-right-content'>
    					<p id='captcha-right'></p>
    				</div>
    				<div id='captcha-reload'>
    					<img src='" . $this->captachDir . "/imgs/refresh.png' id='captcha-reload-img'>
    				</div>
    				<div id='captcha-bottom'><a href='http://www.jesurveille.fr'>Je Surveille</a> - AntiBot</div>
    			</div>";
	}
	function genKeyPicto() {
		$key_picto = rand ( 0, 9000 );
		$_SESSION ['key_picto'] = $key_picto;
		return $key_picto;
	}
	function validate($post) {
		if (isset ( $_SESSION ['captcha'] ) && isset ( $_SESSION ['captcha-' . $_SESSION ['captcha']] ) && isset ( $_SESSION ['captcha2'] ) && isset ( $post ['captcha'] ) && $post ['captcha'] == $_SESSION ['captcha-' . $_SESSION ['captcha']] && isset ( $post ['coucou'] ) && $post ['coucou'] == $_SESSION ['captcha2'] && isset ( $post ['coucou2'] ) && $post ['coucou2'] == true) {
			$this->validate = true;
		}
		if (isset ( $_SESSION ['captcha'] ) && isset ( $_SESSION ['captcha-' . $_SESSION ['captcha']] )) 
			unset ( $_SESSION ['captcha-' . $_SESSION ['captcha']] );
		if (isset ( $_SESSION ['captcha'] ))
			unset ( $_SESSION ['captcha'] );
		if (isset ( $_SESSION ['captcha2'] ))
			unset ( $_SESSION ['captcha2'] );
		return $this->validate;
	}
	function genSecondAccess($pass) {
		$rand = rand ( 0, 400 );
		if (isset ( $_SESSION ['captcha'] ) && isset ( $_SESSION ['captcha-' . $_SESSION ['captcha']] ) && $_SESSION ['captcha-' . $_SESSION ['captcha']] == $pass) {
			$_SESSION ['captcha2'] = $rand;
		}
		echo $rand;
	}
}
?>

