<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<div id="headerblock">
    <?php
    $title = "Accueil";
    $nav = "Modeles";
    include_once("header.php");
    ?>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-9">
        <div id="lrider"></div>
            <div class="item2">
                <h2>LOW RIDER</h2>
                <a href="LowRider.php"><img class="img-size-logo" src="images/Low Rider.jpg"></a>
                <p style="color:red;font-size:25px;">Cliquez sur l'image pour voir les caracteristiques de nos trikes</p>
            </div>
            <div id="mtrike"></div>
            <div class="item2">
                <h2>MUSTANG TRIKE</h2>
                <a href="Mustang.php"><img class="img-size-logo" src="images/Mustang Trike.jpg"></a>
                <p style="color:red;font-size:25px;">Cliquez sur l'image pour voir les caracteristiques de nos trikes</p>
            </div>
            <div id="mturbo"></div>
            <div class="item2">
                <h2>MUSTANG TURBO</h2>
                <img class="img-size-logo" src="images/Mustang Turbo.jpg">
                <p style="color:red;font-size:25px;">Cliquez sur l'image pour voir les caracteristiques de nos trikes</p>
            </div>
            <div id="mfamily"></div>
            <div class="item2">
                <h2>MUSTANG FAMILY</h2>
                <a href="MustangFamily.php"><img class="img-size-logo" src="images/MustangFamily.jpg"></a>
                <p style="color:red;font-size:25px;">Cliquez sur l'image pour voir les caracteristiques de nos trikes</p>
            </div>
        </div>
        <div class="fixed col-md-3" style="margin-top:20%">
            <li>
                <a href="#lrider"><ul>LOW RIDER</ul></a>
                <a href="#mtrike"><ul>MUSTANG TRIKE</ul></a>
                <a href="#mturbo"><ul>MUSTANG TURBO</ul></a>
                <a href="#mfamily"><ul>MUSTANG FAMILY</ul></a>
            </li>
        </div>
    </div>
</div>





<div id="footerblock">
    <?php
    include_once("footer.php");
    ?>
</div>
</body>

</html>