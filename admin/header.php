<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="CSS/app.css">
    <title><?php echo $title; ?></title>
</head>

<body>

    <nav class="navbar navbar-inverse navbar-fixed-top col-9">
        <div class="container">
            <div class="navbar-header">
            </div>
            <div class="collapse navbar-collapse" id="monmenu">
                <ul class="nav navbar-nav">
                </ul>
                <ul class="nav navbar-nav navbar-right">

                    <?php
                    if (isset($_SESSION['auth'])) {
                        ?>
                        <div>
                            <?php echo "<li style='margin-top:15px'><a href='../logout.php'><span class='glyphicon glyphicon-off'></span></a> Bienvenue " . $_SESSION['auth']->username . "</li>"; ?>
                        </div>
                    <?php
                    } else {
                        ?>

                        <li class="nav-item"><a class="nav-link <?php if ($nav === 'connexion') : ?>active<?php endif; ?>" href="../login.php"><span class="glyphicon glyphicon-user"></span> CONNEXION</a></li>
                        <li class="nav-item"><a class="nav-link <?php if ($nav === 'inscription') : ?>active<?php endif; ?>" href="../formulaire.php"><span class="glyphicon glyphicon-log-in"></span> INSCRIPTION</a></li>

                    <?php }
                    ?>

                </ul>
            </div>
        </div>
    </nav>

    <div class="container2">
        <?php if (isset($_SESSION['flash'])) : ?>
            <?php foreach ($_SESSION['flash'] as $type => $message) : ?>
                <div style="margin-left:20%" class="alert alert-<?= $type; ?>">
                    <?= $message; ?>
                </div>
            <?php endforeach ?>
            <?php unset($_SESSION['flash']); ?>
        <?php endif ?>
    </div>