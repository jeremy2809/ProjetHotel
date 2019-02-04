<?php $title = 'Accueil'; ?>

<?php ob_start(); ?>
<div id="accueil">
	<section id="bienvenue">
		<div class="fadeInLeftBig container centrer">
			<h1>Bienvenue à l'Hôtel Le Poaizard Resort</h1>
			<a href="https://www.youtube.com/watch?v=qbkEtX4OL34"class="cta"><i class="fas fa-video"></i>&nbsp Regarder la video</a>
		</div>
	</section>		 
	<section id="presentation" class="container">
		<article class="alignctr service">
			<a href="photos.php"><img src="view/img/service.jpg" alt="image sur le service de l'hotel" class="imgrelaxation"></a>
			<div class="container">
			<p>Iamque non umbratis fallaciis res agebatur, sed qua palatium est extra muros, armatis omne circumdedit. ingressusque obscuro iam die, ablatis regiis indumentis Caesarem tunica texit et paludamento communi, eum post haec nihil passurum velut mandato principis iurandi crebritate confirmans et statim inquit exsurge et inopinum carpento privato inpositum ad Histriam duxit prope oppidum Polam, ubi quondam peremptum Constantini filium accepimus Crispum.</p>
			<a href="chambres.php" class="cool-link"><i class="fas fa-star-of-life"></i>&nbsp Plus d'information ...</a>
			<div>
		</article>
		<img src="view/img/pont2.jpg" alt="Presentation des chambres sur pilotis" class="pont">
		<div class="alignctr">
		<img class="imgmap" src="view/img/map.jpg" alt="Presentation des chambres sur pilotis" class="pont">
		</div>		
	</section>
</div>


<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>