<?php
session_start ();
if (isset ( $_GET ['img'] ) && isset ( $_SESSION ['item-' . $_GET ['img']] )) {
	header ( "Content-type: image/png" );
	readfile ( "imgs/item-" . $_SESSION ['item-' . $_GET ['img']] . ".png" );
	unset ( $_SESSION ['item-' . $_GET ['img']] );
} else {
	header ( "Content-type: image/gif" );
	readfile ( "imgs/blank.gif" );
} 

