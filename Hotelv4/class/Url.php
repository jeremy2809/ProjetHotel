<?php


class Url{

    private $page;
    private $url='';
    //redirection des pages view
    public function  redirecturl(){
     

        if(isset($_GET['url'])){
            $this->url = explode('/',$_GET['url']);
        }

        if($this->url == ''){
            require 'view/accueil.php';
            die();
        }

        switch($this->page = $this->url[0]){

            case 'disponibilite.php':
            require "view/disponibilite.php";
            break;

            case 'accueil.php':
            require "view/accueil.php";
            break;

            case 'login.php':
            require "view/login.php";
            break;

            case 'logout.php':
            require "view/logout.php";
            break;

            case 'register.php':
            require "view/register.php";
            break;

            case 'confirm.php':
            require "view/confirm.php";
            break;

            case 'account.php':
            require "view/account.php";
            break;
            
            case 'forget.php':
            require "view/forget.php";
            break;

            case 'reset.php':
            require "view/reset.php";
            break;

            case 'chambres.php':
            require "view/chambres.php";
            break;

            case 'photos.php':
            require "view/photos.php";
            break;

        }
       
        
    }
}
           
             
       

    

           
                        
  
       
      
   
            

        // var_dump($url[0]);
        // $this->page =$url[0];
        // var_dump($this->page);
        // die();
    