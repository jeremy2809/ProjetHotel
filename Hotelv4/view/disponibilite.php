<?php 

$title = 'Disponibilite';
// require 'inc/autoload.php';
ob_start(); 
$depart= null;
$arrive= null;
?>

<section class="reservation">
<div class="fadeInLeftBig">
<h1>Recherche de disponibilité</h1>
</div>
<form class="recherche alignctr" action="" method="post">
    <legend class="alignctr">Veuillez indiquer vos dates</legend>
    <input type="text" name="arrive" id="arrive"  autocomplete="off" placeholder="Arrivée">
    <input type="text" name="depart" id="depart" autocomplete="off" placeholder="Depart">
    <button type="submit" class="btn-2 alignctr">Recherche de disponibilité</button>
</form>

<div class="scroll alignctr">
<p>Scroll</p>
<p><i class="fas fa-arrow-down"></i></p>
</div>
</section>
<section class="opacity">
<?php

$datearrive = (isset($_POST["arrive"])) ? $_POST["arrive"] : NULL;
$datedepart = (isset($_POST["depart"])) ? $_POST["depart"] : NULL;

$db = App::getDatabase();

if($datedepart && $datearrive){

    $depart = reservation::convertiondate($datearrive);
    $arrive = reservation::convertiondate($datedepart);
    $dispo = reservation::chambredisponible($db,$arrive,$depart);
    
    if($dispo):?>
  
        <div class="ligne">
        <?php foreach($dispo as $disponible =>$colonne): ?>
            <div class="colonne alignctr">
                <div class="box">
                <img class="img" src="view/img/chambres/<?=$colonne->photo; ?>">
                </div>
                <h2><?=$colonne->nom_chambre; ?></h2>
                <p><?=$colonne->description; ?></p>
                <button  type="submit" class="reserver cool-link" name="reserver" value="<?= $colonne->nom_chambre;?>"><i class="fas fa-arrow-right"></i>&nbsp Reserver maintenant !</button>
                <a href="chambres.php" class="cool-link"><i class="fas fa-star-of-life"></i>&nbsp Plus d'information ... </a>
            </div>  
        <?php endforeach;?>
        </div>    
<?php else:
        Session::getInstance()->setFlash(('error'),"Désole nous n'avons plus de chambre disponible à ces dates");
      endif;
}else{

    $chambre = reservation::chambre($db);
    if($chambre):?>
        <div class="ligne">
        <?php foreach($chambre as $disponible =>$colonne): ?>
            <div class="colonne alignctr">
                <div class="box">
                <img class="img" src="view/img/chambres/<?=$colonne->photo; ?>">
                </div>
                <h2><?=$colonne->nom_chambre; ?></h2>
                <p><?=$colonne->description; ?></p>
                <a href="chambres.php" class="cool-link"><i class="fas fa-star-of-life"></i>&nbsp Plus d'information...</a>
            </div>
        <?php endforeach;?>     
        </div>    
<?php endif;   
}
?>
</section>
<!-- !!!Pop up hidden -->

<section>
<div class="position">
    <div class="confirme alignctr">
        <i class="far fa-calendar-check"></i>
        <p>Souhaitez vous réserver la <br>"<strong></strong>"</p>
        <p> du <?= $datearrive ?> au <?= $datedepart ?>
        <form action="" method="POST" >
        <input type="hidden" name="date_depart" value="<?= $depart ?> " />
        <input type="hidden" name="date_arrive" value="<?= $arrive ?>" />
        <input  type="hidden" name="chambre" value=""/>
        <button type="submit" name="confirmer" value="confirmer">Confirmer</button>
        <button class="fermer">Annuler</button>
        </form>   
    </div>
</div>
</section>



<?php
   App::getAuth();
  
    if(isset($_POST['confirmer'])) {
        if(isset($_SESSION['auth'])){
            Session::getInstance();
            $prenom = $_SESSION['auth']->prenom;
            reservation::book($db,$prenom,$chambre,$arrive,$depart);
            Session::getInstance()->setflash('success','Votre reservation à bien été pris en compte <br> Retrouver vos reservations dans la page -mon compte-');
            App::redirect('accueil.php');

        }else{
            Session::getInstance()->setFlash(('success'),"Vous devez etre connecté pour reserver une chambre");
            App::redirect('login.php');
        }
    }

?>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
