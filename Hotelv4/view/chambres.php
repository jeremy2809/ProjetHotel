<?php $title = 'Nos chambres';
// require 'inc/autoload.php';
ob_start();?>
<div class="chambre fadeInLeftBig">
<h1>Liste de nos Chambres&Suites</h1>
</div>
<?php
 $db = App::getDatabase();
 $chambre = reservation::chambre($db);
    if($chambre):?>
        <div class="ligne">
        <?php foreach($chambre as $disponible =>$colonne): ?>
            <div class="colonne">
                <div class="box">
                <img class="img" src="view/img/chambres/<?=$colonne->photo; ?>">
                </div>
                <h2><?=$colonne->nom_chambre; ?></h2>
                <p><?=$colonne->description; ?></p>
                </div>
        <?php endforeach;?>
        </div>    
<?php endif; ?>  



<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>