<?php
// Titre de la page dans la var
$title = 'Inscription';
// require_once 'inc/autoload.php';

// On verifie si envoi de var
if(!empty($_POST)){
    // Creation du tableau errors
    $errors=array();
    // Connexion a la db
    $db = App::getDatabase();
    $validator = new Validator($_POST);
    // + Verification de la syntaxe/existence/validite avec la class Validator.php
    $validator->isAlpha('nom', "Votre nom n'est pas valide");
    $validator->isAlpha('prenom', "Votre prenom n'est pas valide");
    $validator->isEmail('email',"Votre email n'est pas valide");
    if($validator->isValid()){
        $validator->isUniq('email',$db,'users',"Cet email est déjà utilisé pour un autre compte");
    }
    $validator->isConfirmed('password',"Vous devez entrer un mot de passe valide");
    // + Securisation du password avec password crypt et insertion du compte dans la bdd   
    if($validator->isValid()){

        
        App::getAuth()->register($db,$_POST['nom'],$_POST['prenom'],$_POST['password'],$_POST['email']);
        // On previens l'utilisateur avec un mess flash
        Session::getInstance()->setflash('success','Un email de confirmation vous à été envoyé pour valider votre compte');
        App::redirect('accueil.php');


    }else{
        $errors = $validator->getErrors();
    }
}

// On insert dans la var $content
ob_start(); ?>



<!-- Creation du formulaire -->
<section class="inscription alignctr">
<div class="fadeInLeftBig">
<h1>Inscrivez-vous</h1>
</div>
<form action="" method="POST">

<label>Votre Nom
<input type="text" name="nom" placeholder="Exemple :Dupond"/>
</label>
<label>Votre Prenom
<input type="text" name="prenom" placeholder="Exemple :Bernard" />
</label>
<label>Votre Email
<input type="email" name="email" placeholder="Exemple :dupond@yahoo.fr" />
<label>Votre mot de passe
<input type="password" name="password" placeholder="Votre mot de passe"/>
<label>Confirmer votre mot de passe
<input type="password" name="password_confirm" placeholder="Confirmation de votre mot de passe" />
</label>
<div>
<button type="submit" class="btn">M'inscrire</button>
</div>
</form>
</section>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
