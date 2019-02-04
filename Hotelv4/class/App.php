<?php

    class App{

        static $db = null;
        static $url='';
        //design pattern
        static function getDatabase(){
        // Permet l execution de la db maximum 1 seul fois si on lance $db= App::getDatabase() plusieurs fois!!!
        // echo '----- la Fonction----'
            if(!self::$db){
        // echo '----- Initialisation----'
        //remplacer le $login par le login et le $password par le password de la bdd et aussi le nom de la la base
                self::$db = new Database($login,$database_name,$password);
        }
            return self::$db;
        }
        //Redirection des pages
        static function redirect($page){
            header("location:$page");
            exit();
        }
        // Evite la réecriture des new auth..
        static function getAuth(){
           return new Auth(Session::getInstance(),['restriction_msg'=>'Vous devez être connecté pour acceder à la page !']);
           
        }

       

    }