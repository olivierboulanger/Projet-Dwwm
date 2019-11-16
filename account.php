<!-- page du compte et modification du mot de passe -->
<?php
session_start();
require 'functions.inc.php';
logged_only();

if(isset($_POST)){
    if (!empty($_POST)) {
        if (empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']) {
            $_SESSION['flash']['danger'] = "Les mots de passe ne correspondent pas";
        }
        else if (!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$#', $_POST['password'])) {
            $_SESSION['flash']['danger'] = "Vous n'avez pas respecté les caractères et/ou la longueur du mot de passe !";
        }
         else {
            $user_id = $_SESSION['auth']->id;
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            require_once 'db.php';
            $pdo->prepare('UPDATE users SET password = ? WHERE id = ?')->execute([$password, $user_id]);
            $_SESSION['flash']['success'] = "Votre mot de passe a bien été modifié !";
        }
    }
}

?>


<?php
$title= "Mon compte";
$nav = "account";
require 'header.php';

?>
<div class="acc">
    <h2>Bonjour <?= $_SESSION['auth']->username; ?></h2>
    <h2>Votre mail : <?= $_SESSION['auth']->email; ?></h2>
    <ul>
        <li><a href="#" onclick="show()">Modifier son mot de passe</a></li>
    </ul>
    <div id="modify" class="none">

        <form action="" method="post">
            <div class="form-group">
                <input class="form-control" type="password" name="password" placeholder="Change de mot de passe (au moins 8 caractères, 1 majuscule, 1 minuscule et 1 caractère spécial)">
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="password_confirm" placeholder="Confirmation du mot de passe">
            </div>
            <button class="btn btn-primary">Changer mon mot de passe</button>
        </form>
    </div>

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
<script>
    function show() {
        var sh = document.getElementById("modify");
        sh.className="block";
    }
</script>