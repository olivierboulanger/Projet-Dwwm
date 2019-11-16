<!-- page mdp oublié -->
<?php

if(isset($_POST)){
    if (!empty($_POST) && !empty($_POST['email'])) {
        require_once 'db.php';
        require_once 'functions.inc.php';
        $req = $pdo->prepare("SELECT * FROM users WHERE email=? AND confirmed_at IS NOT NULL");
        $req->execute([$_POST['email']]);
        $user = $req->fetch();
        if ($user) {
            session_start();
            $reset_token = str_random(60);
            $pdo->prepare('UPDATE users SET reset_token=?, reset_at=NOW() WHERE id=?')->execute([$reset_token, $user->id]);
            $_SESSION['flash']['success'] = "Les instructions de rappel de mot de passe vous ont été envoyé par mail!";
            mail($_POST['email'], 'Réinitialisation de votre mot de passe', "Afin de réinitialiser votre mot de passe, merci de cliquer sur ce lien\n\nhttp://http://localhost/BoomGoldBook%20avec%20date/reset.php?id={$user->id}&token=$reset_token");
            header('location: login.php');
            exit();
        } else {
            session_start();
            $_SESSION['flash']['danger'] = "Aucun compte ne correspond à cet email !";
        }
    }
}

?>


<div id="headerblock">
    <?php
    include_once("header.php");
    ?>
</div>

<h2 style="margin:10%">Mot de passe oublié</h2>

<div class="row">
    <form action="" method="POST" class="quest">

        <div class="form-group form-xs">
            <label for="">Email</label>
            <input type="email" name="email" class="form-control" />
        </div>

        <button type="submit" class="btn btn-default bg-primary text-primary">Envoyer</button>
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