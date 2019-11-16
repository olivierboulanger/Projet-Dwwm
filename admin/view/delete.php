<?php

require '../vendor/autoload.php';
require '../src/models/Connect.php';
require '../src/models/Repository.php';
require '../config/config.php';

use App\models\Repository;

$rep = new Repository();

if(isset($_GET['id'])){
    $id = $_GET['id'];    
}else{
    $id = "";
}

$articles = $rep->deleteMessage($id);

header ('location:../admin.php')


?>

