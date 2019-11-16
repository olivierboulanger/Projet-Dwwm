<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once 'db.php';
require 'functions.inc.php';
$errors = array();
$success = false;

if (isset($_POST['msg'])) {
    if (empty($_POST['msg'])) {
        $errors['msg'] = "Aucun message saisi";
    } else if ((strlen($_POST['msg']) < 10) || (strlen($_POST['msg']) > 250)) {
        $errors['long'] = "Vous n'avez pas respecté le nombres de caractères !";
    }
    $req2 = $pdo->prepare('SELECT id FROM livror WHERE pseudo=? AND message=?');
    $req2->execute([$_SESSION['auth']->username, $_POST['msg']]);
    $user = $req2->fetch();
    if ($user) {
        $errors['already'] = "Vous avez déjà posté ce message !";
    }
    if (empty($errors)) {
        $req =  $pdo->prepare("INSERT into livror SET pseudo = ?, message = ?, date = NOW()");
        $req->execute([$_SESSION['auth']->username, htmlspecialchars($_POST['msg'])]);
        $success = true;
        mail('oliv.b13om@gmail.com', 'Nouveau Message Livre d\'Or',"Message en attente de modération");
    }
}

?>

<div id="headerblock">
    <?php
    $title = "Livre d'Or";
    $nav = 'livror';
    include_once("header.php");
    ?>
</div>

<div class="container">
    <?php if (!empty($errors)) : ?>
        <div class="alert alert-danger">
            <p>Vous n'avez pas rempli le formulaire correctement</p>
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li><?= $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <?php if ($success) : ?>
        <div class="alert alert-success">
            <?= "Merci pour votre message" ?>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-md-7">
            <?php
            if (isset($_SESSION['auth'])) { ?>
                <FORM style="margin:10%" action="" method="post">
                    <div class="form-group">
                        <h3>Votre message (entre 10 et 250 caractères)</h3>
                        <TEXTAREA name="msg" rows=15 cols=70 placeholder="Votre message ..." class="form-control"></TEXTAREA>
                        <button style="margin-top:50px;" type="submit" class="btn btn-default bg-primary text-primary">Valider</button>
                    </div>
                </FORM>
            <?php } else {
                ?>
                <div class="alert alert-danger">
                     Veuillez vous connecter pour laisser un message !
                </div>
                <FORM style="margin:10%">
                    <TEXTAREA name="msg2" rows=15 cols=70 placeholder="Votre message ..." disabled></TEXTAREA>
                </FORM>
            <?php
            }
            ?>
        </div>
        <div class="col-md-5">
            <?php

            $msgParPage = 5;
            $msgTotalsReq = $pdo->query('SELECT id FROM livror WHERE date_valid IS NOT NULL');
            $msgTotals = $msgTotalsReq->rowCount();
            $pagesTotales = ceil($msgTotals / $msgParPage);
            if (isset($_GET['page']) and !empty($_GET['page']) and $_GET['page'] > 0 and $_GET['page'] <= $pagesTotales) {
                $_GET['page'] = intval($_GET['page']);
                $pageCourante = $_GET['page'];
            } else {
                $pageCourante = 1;
            }
            $depart = ($pageCourante - 1) * $msgParPage;

            $allmsg = $pdo->query('SELECT * FROM livror WHERE date_valid IS NOT NULL ORDER BY id DESC LIMIT '.$depart.','.$msgParPage);
            while ($msg = $allmsg->fetch()) {
                ?>
                <br><br>
                <b style="color:#F28500"><?= $msg->pseudo ?> </b>
                <strong style="color:rgb(235, 197, 126);float:right"><?= $msg->date ?> </strong><br><br>
                <em style="color:white;text-align:center"><?= '"' . $msg->message . '"' ?> </em><br><br><br>
            <?php
            }
            ?>

            <?php
            for ($i = 1; $i <= $pagesTotales; $i++) {
                if ($i == $pageCourante) { ?>
                <b style="font-size:20px;"><?php
                    echo $i . ' '; ?></b><?php
                } else {
                    echo '<a style="font-size:20px" href="livror.php?page=' . $i . '">' . $i . '</a> ';
                }
            }
            ?>
        </div>
    </div>
</div>


<div id="headerblock">
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
</div>

<?php
