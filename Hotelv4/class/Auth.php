<?php

class Auth{
    
    private $options = [

        'restriction_msg' => "Vous n'avez pas le droit d'accéder à cette page"
    ];

    private $session;
    //Permet d'une creation et d'un réutilisation (pour d'autre sites) avec les tableaux des messages 
    public function __construct($session, $options =[]){

       $this->options = array_merge($this->options);
       $this->session = $session;
    }
    // Securisation du mdp dans la bdd
    public function hashPassword($password){

        return password_hash($password, PASSWORD_BCRYPT);
    }
    //Enregistrement dans la bdd et envoie de mail pour la confirmation
    public function register($db,$nom, $prenom,$password, $email){

        $password = $this->hashPassword($password);
        // Creation d'une chaine de caractere via la fonction str_random(str.php)
        $token = Str::random(60);
        $db->query ("INSERT INTO users SET nom= ? , prenom=?, password = ?, email= ?, confirmation_token= ?",[$nom, $prenom, $password, $email, $token]);
        // On recupere le dernier id pour l'envoi de mail
        $user_id =$db->lastInsertId();
        // On envoi le mail avec le lien($token= chaine de 60 caracteres $userid(id))
        // adresse MAIL OVH liée à l’hébergement.
        $from  = "contact@jeremycauchois.fr";
        ini_set("SMTP", "smtp.jeremycauchois.fr");   // Pour les hébergements mutualisés Windows de OVH
        $JOUR  = date("Y-m-d");
        $HEURE = date("H:i");
        $Subject = "Confirmation de votre compte le- $JOUR $HEURE";
        $mail_Data = "";
        $mail_Data .= "<html> \n";
        $mail_Data .= "<head> \n";
        $mail_Data .= "<title> Subject </title> \n";
        $mail_Data .= "</head> \n";
        $mail_Data .= "<body> \n";
        $mail_Data .= "<b>$Subject </b> <br> \n";
        $mail_Data .= "<br> \n";
        $mail_Data .= "Afin de valider votre compte merci de le sur ce lien:<br>\n https://www.jeremycauchois.fr/confirm.php?id=$user_id&token=$token \n";
        $mail_Data .= "</body> \n";
        $mail_Data .= "</HTML> \n";
        $headers  = "MIME-Version: 1.0 \n";
        $headers .= "Content-type: text/html; charset=iso-8859-1 \n";
        $headers .= "From: $from  \n";
        $headers .= "Disposition-Notification-To: $from  \n";
        // Message de Priorité haute

        // -------------------------
        $headers .= "X-Priority: 1  \n";
        $headers .= "X-MSMail-Priority: High \n";
        $CR_Mail = TRUE;
        $CR_Mail = @mail ($email, $Subject, $mail_Data, $headers);
        if ($CR_Mail === FALSE){
            echo " ### CR_Mail=$CR_Mail - Erreur envoi mail <br> \n";
            }else{
            echo " *** CR_Mail=$CR_Mail - Mail envoyé<br> \n";
            }
    }
    //Confirmation via la lien inscrit dans le mail
    public function confirm($db, $user_id, $token){

        $user= $db->query('SELECT * FROM users WHERE id= ?',[$user_id])->fetch();
        // On verifie si un utilisateurs corresponds
        if ($user && $user->confirmation_token == $token){
            // On recupere l'id pour supp la confirmation_token de l'utilisateur et confirme l'heure de la confirmation
            $db->query('UPDATE users SET confirmation_token = NULL, confirmed_at = NOW() WHERE id = ?',[$user_id]);
            //On stock l'utilisateur(meme si les infos du token ne sont pas enlevé...)
            $this->session->write('auth',$user);
            return true;
    
        }
            return false;
    }

    public function restrict(){

        if (!$this->session->read('auth')){
            $this->session->setFlash('danger',$this->options['restriction_msg']);
            header('location: accueil.php');
            exit();
        }
    }
    //Retourne l'utilisateur en cours
    public function user(){

        if(!$this->session->read('auth')){
            return false;
        }
        return $this->session->read('auth');
    }
    public function connect($user){
        $this->session->write('auth',$user);
    }
    // Permet de se connecter automatiquement si l'on coche la case
    public function connectFromCookie($db){

        if(isset($_COOKIE['remember']) && !$this->user()){
           
            $remember_token = $_COOKIE['remember'];
            $parts = explode('==' , $remember_token);
            $user_id = $parts[0];
            $user = $db->query('SELECT * FROM users WHERE id = ?',[$user_id])->fetch();
            if($user){
                $expected = $user_id . '==' . $user->remember_token . sha1($user_id . 'harlem');
                if($expected == $remember_token){
                    $this->connect($user);
                    setcookie('remember',$remember_token, time() + 60*60*24*7);
                }else{
                    setcookie('remember',null, -1);
                }

            }else{
        
            }
        }
    }
    
    public function remember($db,$user_id){
        $remember_token = Str::random(250);
        $db->query('UPDATE users SET remember_token = ? WHERE id = ?',[$remember_token, $user_id]);
        setcookie('remember', $user_id . '==' . $remember_token . sha1($user_id . 'harlem'), time() + 60*60*24*7);
    }
    // Connection (remember false is on veut oui ou non se souvenir de l'utilisateur)
    public function login($db, $email, $password, $remember = false){

        $user = $db->query('SELECT * FROM users WHERE (email = :email) AND confirmed_at IS NOT NULL',['email'=> $email])->fetch();
        
            if (password_verify($password, $user->password)){
                $this->connect($user);
                if($remember){
                    $this->remember($db, $user_id);
                }
                    return $user;
            }else{
                    return false;
            } 
    }
    //Deconnection
    public function logout(){

        setcookie('remember', NULL, -1);
        $this->session->delete('auth');
    }
    
    public function resetPassword($db, $email){

        $user = $db->query('SELECT * FROM users WHERE  email =? AND confirmed_at IS NOT NULL', [$email])->fetch();
        
        if ($user){
            $reset_token = str::random(60);
            $db->query('UPDATE users SET reset_token = ?, reset_at = NOW() WHERE id = ?',[$reset_token, $user->id]);
             mail($_POST['email'],'Réinitialisation de votre mot de passe',"Pour reinitialiser votre mot de passe merci de cliquer sur ce lien\n\nhttp://localhost/workSpace/projet/Hotelv4/reset.php&id={$user->id}&token=$reset_token");
             return $user;
        }
          return false;
    }

    public function checkResetToken($db, $user_id, $token){

        $user = $db->query('SELECT * FROM users WHERE id = ? AND reset_token IS NOT NULL AND reset_token = ? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)',[$user_id, $token])->fetch();
        return $user;
       

    }

    public function changePassword($user_id,$password,$db){

        $password = $this->hashPassword($password);
        return  $db->query('UPDATE users SET password =?',[$password]);
        
    }


}