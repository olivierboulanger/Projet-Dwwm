<!-- page connexion au compte -->
<?php
try {
    if (isset($_POST)) {
        if ((empty($_POST['username']) && !empty($_POST['password'])) || (!empty($_POST['username']) && empty($_POST['password']))){
            session_start();
            $_SESSION['flash']['danger'] = "Veuillez renseigner les 2 champs !";
        }
        if (!empty($_POST) && !empty($_POST['username']) && !empty($_POST['password'])) {
            require_once 'db.php';
            require_once 'functions.inc.php';
            $req = $pdo->prepare("SELECT * FROM users WHERE (username=:username OR email=:username) AND confirmed_at IS NOT NULL");
            $req->execute(['username' => $_POST['username']]);
            $user = $req->fetch();
            if (password_verify($_POST['password'], $user->password)) {
                session_start();
                $_SESSION['auth'] = $user;
                $_SESSION['flash']['success'] = "Vous êtes maintenant connecté !";
                if ($_POST['username'] == "admin") {
                    header('location: admin/admin.php');
                    exit();
                } else {
                    header('location: account.php');
                }
                exit();
            } else {
                session_start();
                $_SESSION['flash']['danger'] = "Identifiant ou mot de passe incorrect !";
            }
        }
    }
} catch (Exception $e) {
    $_SESSION['flash']['danger'] = "Oups ! Une erreur inconnue est survenue.";
}
?>


<div id="headerblock">
    <?php
    $title = "Connexion";
    $nav = "connexion";
    include_once("header.php");
    ?>
</div>

<div class="row">
    <form action="" method="POST" class="quest">

        <div class="form-group form-xs">
            <label for="">Pseudo ou Email</label>
            <input type="text" name="username" class="form-control" />
        </div>

        <div class="form-group">
            <label for="">Mot de passe <a href="forget.php">(mot de passe oublié)</a></label>
            <input type="password" name="password" class="form-control" />
        </div>

        <button type="submit" class="btn btn-default bg-primary text-primary">Se Connecter</button>
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