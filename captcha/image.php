<?php 
session_start(); 
$text = $_SESSION['PictoText'];

    // constant values
    $backgroundSizeX = 2000;
    $backgroundSizeY = 350;
    $sizeX = 110;
    $sizeY = 30;
    $fontFile = "./SayonaraTrashFree.ttf";
    $textLength = strlen($text);

    // generate random security values
    $backgroundOffsetX = rand(0, $backgroundSizeX - $sizeX - 1);
    $backgroundOffsetY = rand(0, $backgroundSizeY - $sizeY - 1);
    $angle = rand(-5, 5);
    $fontColorR = rand(0, 127);
    $fontColorG = rand(0, 127);
    $fontColorB = rand(0, 127);

    $fontSize = 12;// rand(14, 14);
    $textX = (int)(80 - 0.9 * $textLength * $fontSize); // these coefficients are empiric
    $textY = (int)($sizeY - 0.2 * $fontSize); // don't try to learn how they were taken out

    $gdInfoArray = gd_info();
    if (! $gdInfoArray['PNG Support'])
        echo "error1";

    // create image with background
    $src_im = imagecreatefrompng( "imgs/background.png");
    if (function_exists('imagecreatetruecolor')) {
        // this is more qualitative function, but it doesn't exist in old GD
        $dst_im = imagecreatetruecolor($sizeX, $sizeY);
        $resizeResult = imagecopyresampled($dst_im, $src_im, 0, 0, $backgroundOffsetX, $backgroundOffsetY, $sizeX, $sizeY, $sizeX, $sizeY);
    } else {
        // this is for old GD versions
        $dst_im = imagecreate( $sizeX, $sizeY );
        $resizeResult = imagecopyresized($dst_im, $src_im, 0, 0, $backgroundOffsetX, $backgroundOffsetY, $sizeX, $sizeY, $sizeX, $sizeY);
    }

    if (! $resizeResult)
      echo "error1";

    // write text on image
    if (! function_exists('imagettftext'))
        echo "error";
    $color = imagecolorallocate($dst_im, $fontColorR, $fontColorG, $fontColorB);
    imagettftext($dst_im, $fontSize, -$angle, $textX, $textY, $color, $fontFile, strtoupper($text));

	 
	 $matrix_blur = array
(
    array(1, 1, 1),
    array(1, 1, 1),
    array(1, 1, 1),
);
	/// imageconvolution($dst_im, $matrix_blur,12,0); // pas obligatoire...
	 
	 $matrix_blur = array
(
    array(-1, -1, -1),
    array(-1, 18, -1),
    array(-1, -1, -1),
);
	 imageconvolution($dst_im, $matrix_blur,10,0); // pas obligatoire...
    // output header
    header("Content-Type: image/png");

    // output image
    imagepng($dst_im);

    // free memory
    imagedestroy($src_im);
    imagedestroy($dst_im);

?>