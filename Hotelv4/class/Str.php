<?php

class Str{

    // function qui va nous permettre de generer un code
    static function random($lenght){
        // on stock toutes les lettres dispos
        $alphabet="0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
        // on prend la chaine de caractere, la repete (60fois $lenght) pour avoir plusieurs fois la memes lettres
        // on garde uniquement les 60 premiers caracteres
        return substr(str_shuffle(str_repeat($alphabet, $lenght)), 0 ,$lenght);

    }
}