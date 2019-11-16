<!-- page inscription -->
<?php

require_once 'db.php';
require_once 'functions.inc.php';
session_start();

if(isset($_POST)){
    if (!empty($_POST)) {
        $errors = array();
        $username = test_input($_POST['username']);
        if (empty($username) || !preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
            $errors['username'] = " Pseudo non saisi et/ou non valide";
        } else {
            $req = $pdo->prepare('SELECT id FROM users WHERE username=?');
            $req->execute([$username]);
            $user = $req->fetch();
            if ($user) {
                $errors['username'] = "Ce pseudo est déjà pris !";
            }
        }
        if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Votre email n'est pas valide !";
        } else {
            $req = $pdo->prepare('SELECT id FROM users WHERE email=?');
            $req->execute([$_POST['email']]);
            $user = $req->fetch();
            if ($user) {
                $errors['email'] = "Cet email est déjà utilisé !";
            }
        }
        if (empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']) {
            $errors['password'] = "Vous n'avez pas saisi de mot de passe et/ou ils ne correspondent pas !";
        }
        if (!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$#', $_POST['password'])){
            $errors['password'] = "Vous n'avez pas respecté les caractères et/ou la longueur du mot de passe !"; 
        }
    
        if (empty($errors)) {
            $req =  $pdo->prepare("INSERT into users SET username = ?, email = ?, password = ?, confirmation_token = ?");
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $token = str_random(60);
            $req->execute([$_POST['username'], $_POST['email'], $password, $token]);
            $user_id = $pdo->lastInsertId();
            mail($_POST['email'], 'Confirmation de votre compte', "Afin de valider votre compte merci de cliquer sur ce lien\n\nhttp://http://localhost/BoomGoldBook%20avec%20date/confirm.php?id=$user_id&token=$token");
            $_SESSION['flash']['success'] = 'Un email de confirmation vous a été envoyé pour valider votre compte';
            header('Location: login.php');
            exit();
        }
    }
}


?>
    <?php
    $title = "Inscription";
    $nav = "inscription";
    require("header.php");
    ?>

<h1 style="margin-top:200px;margin-left:20%;">S'inscrire</h1>

<?php if (!empty($errors)) : ?>
    <div class="err">
        <p>Vous n'avez pas rempli le formulaire correctement</p>
        <ul>
            <?php foreach ($errors as $error) : ?>
                <li><?= $error; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div class="row">
    <form action="" method="POST" class="quest">

        <div class="form-group form-xs">
            <label for="">Pseudo</label>
            <input type="text" name="username" class="form-control" />
        </div>

        <div class="form-group">
            <label for="">Email</label>
            <input type="text" name="email" class="form-control" />
        </div>

        <div class="form-group">
            <label for="">Mot de passe (au moins 8 caractères, 1 majuscule, 1 minuscule et 1 caractère spécial)</label>
            <input type="password" name="password" class="form-control" />
        </div>

        <div class="form-group">
            <label for="">Confirmez votre mot de passe</label>
            <input type="password" name="password_confirm" class="form-control" />
        </div>

        <button type="submit" class="btn btn-default bg-primary text-primary">M'inscrire</button>
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