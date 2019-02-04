<?php
$title='Réinitialisation de mot de passe';
require 'inc/autoload.php';

if(!empty($_POST) && !empty($_POST['email'])){
   $db = App::getDatabase();
   $auth = App::getAuth();
   $session = Session::getInstance();

   if($auth->resetPassword($db, $_POST['email'])){
        $session->setFlash('success','Les instructions du rappel du mot de passe vous on été envoyées par emails');
        App:: redirect('login.php');
   }else{
        $session->setFlash('danger','Aucun compte ne correspond à cet adresse');
   }
    
}

?>

<?php ob_start(); ?>
<section class="inscription">
<div class="fadeInLeftBig">
<h1>Mot de passe oublié</h1>
</div>
<form action="" method="POST">
    <label>Veuillez rentrer votre email
    <input type="email" name="email" />
    </label>
<button type="submit" class="btn btn-primary">Envoyer</button>
</form>
</section>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>


