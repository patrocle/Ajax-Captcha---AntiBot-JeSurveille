<?php
session_start(); 

$captcha= new Captcha;
if ($_POST["type"]=='txt'&&$_POST["key_picto"]==$_SESSION["key_picto"]){
	echo $captcha->genText();
}

if ($_GET["type"]==2){
	echo $captcha->genSecondAccess($_GET["pass"]);
}

if ($_POST["type"]=='refreshKey'){
	$keys = array();
	//$keys['img']=$captcha->genKeyImage();
	$keys['picto']=$captcha->genKeyPicto();
	$json_keys= json_encode($keys);
	header('Content-Type: application/json');
	echo $json_keys;
}




class Captcha{
	
	var $captachDir;
	var $picto;
	var $text;
	var $validate;
	
	function Captcha(){
		$this->captachDir="/captcha";
		$this->picto=array("stylo", "ciseau", "horloge", "coeur", "musique", "livre", "facebook", "chien", "maison");
		$this->text[0]="Glissez l'icone correspondante dans le cercle.<span>";
		$this->text[1]="</span>";
		$this->validate=false;
	}
	
	function genText(){
		$i=0;
		$images_captcha_html="";
		$images_captcha_in=array();
		while ($i!=5){
			$rand = rand(0,sizeof($this->picto)-1);
			if(!in_array($rand,$images_captcha_in)){
				$_SESSION['captcha-'.$i]=rand();
				$images_captcha_html.="<li class='captcha-". $i ."' id='captcha-". $i ."' >
										<img id='" . $_SESSION['captcha-'.$i] . "' src='" . $this->captachDir . "/imgs/item-" . $this->picto[$rand] . ".png' alt='captcha pitco' />
									</li>";
				$images_captcha_in[]=$rand;
				$i++;
			}
		}
		$rand = rand(0,4);
		$_SESSION['captcha'] = $rand;
		$_SESSION['PictoText'] = $this->picto[$images_captcha_in[$rand]];
		unset($_SESSION['key_picto']);//
		return "<div id='captcha-content'>
					<div id='captcha-left'>
						<p id='captcha-text'>" . $this->text[0] ."<img src='".$this->captachDir."/image.php?l=".rand()."' >". $this->text[1] . "</p>
						<ul id='captcha-task'> " . $images_captcha_html . " </ul>
					</div>
					<div id='captcha-right-content'>
						<p id='captcha-right'></p>
					</div>
					<div id='captcha-reload'>
						<img src='".$this->captachDir."/imgs/refresh.png' id='captcha-reload-img'>
					</div>
					<div id='captcha-bottom'><a href='http://www.jesurveille.fr'>Je Surveille</a> - AntiBot</div>
				</div>";
	}
/*	function genKeyImage(){
		$key_image=rand(0,9000); 
		$_SESSION['key_image']=$key_image;
		return $key_image;
	}*/
	
	function genKeyPicto(){
		$key_picto=rand(0,9000); 
		$_SESSION['key_picto']=$key_picto;
		return $key_picto;
	}
	
	
	function validate($post){
		if($_POST['captcha'] == $_SESSION['captcha-'. $_SESSION['captcha']] && $_POST['coucou'] == $_SESSION['captcha2'] && $_POST['coucou1']==false && $_POST['coucou2']==true){
				$this->validate=true;
		}
		unset($_SESSION['captcha']);
		unset($_SESSION['captcha2']);
		return $this->validate;
	}
	
	function genSecondAccess($pass){
		$rand = rand(0,400);
		if($_SESSION['captcha-'. $_SESSION['captcha']]==$_GET["pass"]){
			$_SESSION['captcha2'] = $rand;
		}	
		echo $rand;
	}
	
}

?>
