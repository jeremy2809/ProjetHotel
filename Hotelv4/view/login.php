<?php
$title = 'Se connecter';
$auth = App::getAuth();
$db = App::getDatabase();
$auth->connectFromCookie($db);


if($auth->user()){
    App::redirect('account.php');
}

if(!empty($_POST) && !empty($_POST['email']) && !empty($_POST['password'])){

    $user = $auth->login($db,$_POST['email'],$_POST['password'], isset($_POST['remember']));
    $session = Session::getInstance();
    if($user){

        $session->setFlash('succes',' Vous etes connecté');
        App::redirect('accueil.php');
    }else{

        $session->setFlash('danger',"identifiant ou mot de passe incorrecte");
    }
}

?>
<?php ob_start(); ?>

<section class="inscription alignctr">
<div class="fadeInLeftBig">
<h1>Se connecter</h1>
</div>


<form action="" method="POST">

<label>Votre email
<input type="text" name="email" placeholder="Votre email" />
</label>
<label>Votre mot de passe
<input type="password" name="password" placeholder=" Votre mot de passe" />
</label>
<div class="hoverforget">
<a href="forget.php">(J'ai oublié mon mot de passe)</a>
</div>
<div class="checkbox">
<label>
<input type="checkbox" name="remember"  value="1"/> Se souvenir de moi
</label>
</div>

<button type="submit" class="btn">Se connecter</button>
</form>
<div class="hoverforget">
<a href="register.php">Je n'ai pas de compte</a>
</div>
</section>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>

