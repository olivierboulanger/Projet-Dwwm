<?php

require '../vendor/autoload.php';
require '../src/models/Connect.php';
require '../src/models/Repository.php';
require '../config/config.php';

use App\models\Repository;
use App\models\Connect;

$connection = Connect::connect();
$rep = new Repository($connection);

if(isset($_GET['id'])){
    $id = $_GET['id'];    
}else{
    $id = "";
}

$articles = $rep->validMessage($id);

?>

