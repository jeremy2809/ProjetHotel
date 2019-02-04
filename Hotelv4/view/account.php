<?php 
// Titre de la page dans la var
$title = 'Compte';

$db = App::getDatabase();
App::getAuth()->restrict(Session::getinstance());
// On verifie si envoi de var
if(!empty($_POST)){

    $errors=array();
    
    $validator = new Validator($_POST);
    $validator->isConfirmed('password',"Vous devez entrer un mot de passe valide");
    
    if($validator->isValid()){
        
        App::getAuth()->changePassword($user_id,$_POST['password'],$db);
        Session::getInstance()->setflash('success','Votre mot de passe a bien été mis à jour');
        App::redirect('accueil.php');
        
    }else{

        $errors = $validator->getErrors();
    }
}

?>

<?php ob_start(); ?>
<section class="inscription alignctr">
<div class="fadeInLeftBig">
<h1>Votre compte</h1>
</div>
<form action="" method="post">
<legend class="alignctr">Changement du mot de passe</legend>
    <label>Inserer votre nouveau mot de passe
        <input  type="password" name="password" placeholder="changer de mot de passe"/>
    </label>
    <label>Veuillez inserer votre confirmation de mot de passe
        <input  type="password" name="password_confirm" placeholder="confirmation du mot de passe"/>
    </label>
        <button class="btn">Changer mon mot de passe</button>
</form>
</section>

<section id="historique" class="alignctr">
    <?php
    $prenom = $_SESSION['auth']->prenom;
    $historique = reservation::historique($db,$prenom);
    if($historique):?>
        <p><i class="far fa-calendar-alt"></i>
        
        <?php foreach($historique as $chambres =>$colonne): ?>
                <table id="tableau">
                <thead>
                    <tr>
                        <th colspan="1">Votre chambre</th>
                        <th colspan="1">Date d'arrivée</th>
                        <th colspan="1">Date de depart</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?=$colonne->nom_chambre; ?></td>
                        <td><?=$colonne->date_depart; ?></td>
                        <td><?=$colonne->date_arrive; ?></td>
                    </tr>
                </tbody>
                </table>
        <?php endforeach;?>
        </div>
    <?php endif;?>
</section>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>