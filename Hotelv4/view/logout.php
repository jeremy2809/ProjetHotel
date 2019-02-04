<?php

// require 'inc/autoload.php';
App::getAuth()->logout();
Session::getInstance()->setFlash(('success'),"Vous etes maintenant deconnecté");
App::redirect('accueil.php');