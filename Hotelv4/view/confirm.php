<?php 
// require 'inc/autoload.php';

$db = App::getDatabase();


// On verifie si un utilisateurs corresponds
if (App::getAuth()->confirm($db,$_GET['id'],$_GET['token'],Session::getInstance())){
  
   // On informe l'utilisateur avec un message flash
   Session::getInstance()->setFlash('success',"Merci d'avoir valider votre compte");
    //On stock l'utilisateur(meme si les infos du token ne sont pas enlevé...)
   App::redirect('account.php');

}else{
    // On redirige l'utilsiateur avec un mess flash si le token n'est plus valide
    Session::getInstance()->setFlash('danger',"Ce token n'est plus valide");
    App::redirect('login.php');
    
}


