<?php require_once 'inc/autoload.php';?>
<?php App::getAuth() ;?>


<div class="header">
    <a href="accueil.php" class="logo"><img src="view/img/logo.png" alt="logo"></a>
    <div id="nav">
        <nav id="nav1">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-pinterest-p"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
        </nav>
        <nav id="nav2">
        <?php if (isset($_SESSION['auth'])): ?>
            <a href="account.php" class="bjr">Bonjour <span><?= htmlspecialchars($_SESSION['auth']->prenom); ?></span></a>
            <a href="logout.php">Se déconnecter</a>
            <?php else: ?>
            <a  href="register.php">Inscription</a>
            <a  href="login.php">Se connecter</a>
        <?php endif; ?>   
        </nav>
        <nav id="nav3">
			<a href="photos.php">Photos</a>
			<a href="chambres.php">Chambres & Suites</a>
			<a href="disponibilite.php">Reservation</a>
        </nav>
    </div>

<!-- Menu accordeon Responsive -->
    <div id="accordeon" class="overlay">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="overlay-content">
        <?php if (isset($_SESSION['auth'])): ?>
            <a href="logout.php">Se déconnecter</a>
            <a href="account.php" class="bjr">Bonjour <span><?= htmlspecialchars($_SESSION['auth']->prenom); ?></span></a>
            <?php else: ?>
            <a href="register.php">Inscription</a>
            <a href="login.php">Se connecter</a>
            <?php endif; ?> 
            <a href="photos.php">Photos</a>
			<a href="chambres.php">Chambres & Suites</a>
			<a href="disponibilite.php">Reservation</a>  
        </div>
    <p class="menu"  onclick="openNav()">&#9776;</p>
    </div>
</div>

 <!-- On verifie si on a un message flash à afficher -->
<?php if(Session::getInstance()->hasFlashes()): ?>
    <?php foreach(Session::getInstance()->getFlashes() as $type =>$message) :?>
        <div class="alert" role="alert"<?= $type; ?>">
            <?= $message; ?>
        </div>
    <?php endforeach; ?>
<!-- On detruit les mesages -->
<?php endif ; ?>


      
<!-- Creation du tableau d'erreur -->
<?php if(!empty($errors)): ?>
    <div class="alert">
        <p>Vous n'avez pas rempli le formulaire correctement</p>
        <ul>
            <?php foreach($errors as $error): ?>
            <li><?= $error ; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>		
