<?php $title = 'Nos photos';
// require 'inc/autoload.php';
ob_start();?>


<div class="container_grid">
            <div><img src="view/img/plage.jpg" alt="image de la plage"/></div>
            <div class="vertical"><img src="view/img/hotel.jpg" alt="image de la hotel"/></div>
	        <div><img src="view/img/chambres.jpg" alt="image de la chambre"/></div>
            <div class="horizontal"><img src="view/img/relaxation.jpg" alt="image de relaxation"/></div>
	        <div><img src="view/img/pont.jpg" alt="image de la plage"/></div>
            <div class ="vertical"><img src="view/img/suites.jpg" alt="image de la suite"/></div>
            <div><img src="view/img/service.jpg" alt="image du service"/></div>
            <div class="big"><img src="view/img/map.jpg" alt="image de la map"/></div>
            <div><img src="view/img/chambres/chambre1.jpg" alt="image d'une chambre"/></div>
            <div class="vertical"><img src="view/img/chambres/chambre2.jpg" alt="image d'une chambre"/></div>
            <div><img src="view/img/chambres/chambre3.jpg" alt="image d'une chambre"/></div>
            <div class="horizontal"><img src="view/img/chambres/chambre4.jpg" alt="image d'une chambre"/></div>
            <div><img src="view/img/chambres/chambre5.jpg" alt="image d'une chambre"/></div>
            <div class="big"><img src="view/img/boat.jpg" alt="image de la plage"/></div>
            <div><img src="view/img/vague.jpg" alt="image de la plage"/></div>
            <div class="horizontal"><img src="view/img/plage5.jpg" alt="image de la plage"/></div>
        </div>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>