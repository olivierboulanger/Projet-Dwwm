<!-- page de reinitialisation du mot de passe -->
<?php

if (isset($_GET['id']) && isset($_GET['token'])){
   require 'db.php';
   require 'functions.inc.php';
   $req = $pdo->prepare('SELECT * FROM users WHERE id=? AND reset_token IS NOT NULL AND reset_token=? AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)');
   $req->execute([$_GET['id'], $_GET['token']]);
   $user = $req->fetch();
   if($user){
        if(!empty($_POST)){
            if(!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$#', $_POST['password'])){
                session_start();
                $_SESSION['flash']['danger'] = "Vous n'avez pas respecté les caractères et/ou la longueur du mot de passe ! Ré-essayez en cliquant sur le lien envoyé !";
                header('location: login.php');
                exit();
            }
            if (!empty($_POST['password']) && $_POST['password'] == $_POST['password_confirm']){
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
                $pdo->prepare('UPDATE users SET password=?, reset_at = NULL, reset_token = NULL')->execute([$password]);
                session_start();
                $_SESSION['flash']['success'] = "Votre mot de passe a bien été modifié ! ";
                $_SESSION['auth'] = $user;
                header('location: account.php');
                exit();
            }
        }
   } else {
       session_start();
       $_SESSION['flash']['danger'] = "Ce token n'est pas valide !";
       header('location: login.php');
       exit();
   }
} else{
    header('loation: login.php');
    exit();
}

?>


<div id="headerblock">
    <?php
    include_once("header.php");
    ?>
</div>

<h2>Reinitialiser le mot de passe</h2>

<div class="row">
    <form action="" method="POST" class="quest">

        <div class="form-group">
            <label for="">Mot de passe  (au moins 8 caractères, 1 majuscule, 1 minuscule et 1 caractère spécial)</label>
            <input type="password" name="password" class="form-control" />
        </div>
        
        <div class="form-group">
            <label for="">Confirmation du mot de passe</label>
            <input type="password" name="password_confirm" class="form-control" />
        </div>

        <button type="submit" class="btn btn-default bg-primary text-primary">Réintilialiser le mot de passe</button>
    </form>
</div>




<div id="footerblock">
    <nav class="navbar navbar-inverse navbar-fixed-bottom">
        <div class="container">
            <div class="collapse navbar-collapse" id="monmenu">
                <ul class="nav navbar-nav">
                    <li><a href="#">© Copyright by Monsieur Neemo & Donatello</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li> <a href="https://www.facebook.com/pages/category/Sports---Recreation/Boom-Trikes-Nord-Pas-De-Calais-232764863430149/" target="blank"><img src="images/facebook.png"></a>
                    </li>
                </ul>
            </div>
        </div>
</div>
</body>