Ajax Captcha - Drag and drop 
====================

JeSurveille
---------------------
Ajax Captcha  avec JQuery et JQuery UI.

Ce captcha génère une image qui decrit une icone (parmis 5 presentes) , Il faut deplacer (drag and drop) cette icone dans l'endroit indiqué.

Les iconnes sont toutes parametrables. Vous pouvez creer votre pack d'iconnes.

Fonctionnement:
>// a ajouter dans votre formulaire et dans le fichier qui traite la reponse
><?php
>session_start();
>include "captcha/captcha.php";
>$captcha = new Captcha;
>?>



### Requis

> jQuery Version >= 1.5 
> PHP Version >= 5.2
> Bibliotheque GD