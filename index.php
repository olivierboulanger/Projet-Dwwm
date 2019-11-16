 <div id="headerblock">
     <?php
        $title = "Accueil";
        $nav = "index";
        include_once("header.php");
        ?>
 </div>
 <div id="monCarousel" class="carousel slide" data-ride="carousel">
     <ol class="carousel-indicators">
         <li data-target="#moncarousel" data-slide-to="0" class="active"></li>
         <li data-target="#moncarousel" data-slide-to="1"></li>
         <li data-target="#moncarousel" data-slide-to="2"></li>
         <li data-target="#moncarousel" data-slide-to="3"></li>
     </ol>
     <div class="carousel-inner" role="listbox">
         <div class="item active">
             <img src="images/Low Rider.jpg" class="img-rounded">
             <div class="carousel-caption">
                 <h3>Low Rider</h3>
             </div>
         </div>
         <div class="item">
             <img src="images/Mustang Trike.jpg">
             <div class="carousel-caption">
                 <h3>Mustang Trike</h3>
             </div>
         </div>
         <div class="item">
             <img src="images/Mustang Turbo.jpg">
             <div class="carousel-caption">
                 <h3>Mustang Turbo (Xtreme)</h3>
             </div>
         </div>
         <div class="item">
             <img src="images/MustangFamily.jpg">
             <div class="carousel-caption">
                 <h3>Mustang Family</h3>
             </div>
         </div>

     </div>
     <a href="#monCarousel" class="left carousel-control" role="button" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
     <a href="#monCarousel" class="right carousel-control" role="button" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>

 </div>

 <div class="caracteristique">
     <div class="plex">
         <h2>Low Rider</h2>
         <ul>
             <li>Moteur : 1,5 L, 4 cylindres</li>
             <li>Puissance : 110 CV (81 kW)</li>
             <li>Vitesse max : 160km/h</li>
             <li>Carburant : Super SP 95-E10</li>
             <li>Réservoir : 38 L</li>
             <li>Places assises : 2</li>
         </ul>
     </div>
     <div class="plex">
         <h2>Mustang Trike</h2>
         <ul>
             <li>Moteur : 4 cylindres</li>
             <li>Puissance : De 110 CV (81 kW) à 140 CV (103 kW)</li>
             <li>Vitesse max : De 160 km/h à 180 km/h</li>
             <li>Carburant : Super SP 95-E10</li>
             <li>Réservoir : 38 L</li>
             <li>Places assises : 2</li>
         </ul>
     </div>
     <div class="plex">
         <h2>Mustang Turbo</h2>
         <ul>
             <li>Moteur : 2L GTDI Ecoboost, 4 cylindres</li>
             <li>Puissance : 200 CV (147 kW)</li>
             <li>Vitesse max : 216km/h</li>
             <li>Carburant : Super SP 95-E10</li>
             <li>Réservoir : 38 L</li>
             <li>Places assises : 2</li>
         </ul>
     </div>
     <div class="plex">
         <h2>Mustang Family</h2>
         <ul>
             <li>Moteur : 4 cylindres</li>
             <li>Puissance : De 110 CV (81 kW) à 140 CV (103 kW)</li>
             <li>Vitesse max : De 160 km/h à 180 km/h</li>
             <li>Carburant : Super SP 95-E10</li>
             <li>Réservoir : 38 L</li>
             <li>Places assises : 3</li>
         </ul>
     </div>
 </div>

 <div id="footerblock">
     <?php
        include_once("footer.php");
        ?>
 </div>

 <script src="JS/app.js"></script>


 </body>