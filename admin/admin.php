<?php

require 'vendor/autoload.php';
require 'src/models/Connect.php';
require 'src/models/Repository.php';
require 'config/config.php';

use App\models\Repository;
$rep = new Repository();
$articles = $rep->getAllMessages();

?>

<div id="headerblock">
    <?php
    $nav = "admin";
    $title = "Admin";
    include_once("header.php");
    ?>
</div>

<div class="mt-5">
<h2 style="color:black">Section Administrateur : Modération, validation ou suppression des messages du livre d'Or</h2>
</div>
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>Pseudo</th>
            <th>Message</th>
            <th>Date</th>
            <th>Date Saisie</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($articles as $art){ ?>
        <tr>
            <td><?= $art->id ?></td>
            <td><?= $art->pseudo ?></td>
            <td><?= $art->message ?></td>
            <td><?= $art->date ?></td>
            <td><?= $art->date_valid ?></td>
            <td>
               <a href="view/valid.php?id=<?= $art->id ?>"><button class="btn btn-primary">Valider</button></a>
               <a href="view/modify.php?id=<?= $art->id ?>"><button class="btn btn-warning">Modifier</button></a>
               <a href="view/delete.php?id=<?= $art->id ?>"><button class="btn btn-danger">Supprimer</button></a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
