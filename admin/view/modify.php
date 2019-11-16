<?php

require '../vendor/autoload.php';
require '../src/models/Connect.php';
require '../src/models/Repository.php';
require '../config/config.php';

use App\models\Connect;
use App\models\Repository;

$rep = new Repository();

if(isset($_GET['id'])){
    $id = $_GET['id'];    
}else{
    $id = "";
}


$articles = $rep->getMessage($id);

$errors = [];

if (isset($_POST)){
    if (!empty($_POST['message'])) {
        $message = $_POST['message'];
    }
    else {
        $errors = "Vous n'avez pas rempli le champ message";
    }
    if (empty($errors)){
        $articles = $rep->modifyMessage($id, $message);  
        exit();      
    }
}

require '../header.php';


?>




<?php foreach($articles as $art){ ?>
<form action="" method="POST">

<div class="container" style="margin:10%">

<div class="form-group">
    <label for="">Message</label>
    <input type="text" name="message" value="<?= $art->message ?>" class="form-control" />
</div>


<button type="submit" class="btn btn-default bg-primary text-white">Modifier</button>
</form>
<a href="../admin.php"><button type="button"class="btn btn-default bg-success text-white">Annuler</button></a>

</div>

<?php } ?>

