<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>

        <!-- FONT AWESOME -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
        <!-- fichiers CSS -->
        
        <link href="view/css/reset.css" rel="stylesheet" />
        <link href="view/css/style.css" rel="stylesheet" />
        <link href="view/css/pop.css" rel="stylesheet" />
        <link href="view/css/header.css" rel="stylesheet" />
        <link href="view/css/accueil.css" rel="stylesheet" />
        <link href="view/css/register.css" rel="stylesheet" />
        <link href="view/css/reservation.css" rel="stylesheet" />
        <link href="view/css/chambre.css" rel="stylesheet" />
        <link href="view/css/footer.css" rel="stylesheet" />
        <link href="view/css/grid.css" rel="stylesheet" />
        
        
        <!-- css datpicker jqeryui -->
        <link href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css" rel="stylesheet"/>
        <!-- GOOGLE FONT -->
	    <link href="https://fonts.googleapis.com/css?family=Comfortaa|Lato|Slabo+27px" rel="stylesheet">  
          
    </head>
        
    <body>

    <header>
       <?php include('header.php'); ?>
    </header>
    <main>
        <?= $content ?>
    </main>
    <footer>
    <?php include('footer.php'); ?>
    </footer>
    </body>
    
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="view/js/index.js"></script>
    
 
</html>