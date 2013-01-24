Ajax Captcha JQUERY - Drag and drop 
====================
PHP / JQUERY / JQUERY UI
---------------------
###JeSurveille

Captcha Ajax pour formulaire avec JQuery et JQuery UI.

<img src="http://img11.hostingpics.net/pics/362047preview.png" alt="preview"/>


Ce captcha génère une image qui decrit une icone (parmis 5 presentes) , Il faut deplacer (drag and drop) cette icone dans l'endroit indiqué.

Les iconnes sont toutes parametrables. Vous pouvez creer votre pack d'iconnes.

Fonctionnement:

>`` // a ajouter dans votre formulaire et dans le fichier qui traite la reponse``
>
>``<?php``
>
>``session_start();``
>
>``include "captcha/captcha.php";``
>
>``$captcha = new Captcha;``
>
>``?>``

Je vous laisse découvrir l'exemple du formulaire ( exemple.php ) ainsi que la validation du captcha  (exemple-action.php)

### Requis 
> jQuery Version >= 1.5 
> PHP Version >= 5.2
> Bibliotheque GD