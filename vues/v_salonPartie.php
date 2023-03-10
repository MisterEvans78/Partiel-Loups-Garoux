<div class="container mt-5">

    <h1 class="title">Salon de la partie : <?=$partie->getNomPartie()?></h1> 
    <div class="row fond-regle">
        <?php
            if($partie->getHost()->getId() == $_SESSION['joueur']->getId()){
                ?>
                <a class="btn btn-primary" id="commencer">Commencer la partie </a>
                <?php
            } else {
                ?>
                <a class="btn btn-primary" id="commencer" style="pointer-events: none;" hidden>Commencer la partie </a>
                <?php
            }
            
        ?>
    <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th> Numéro Joueur</th>
                <th> Pseudo joueur</th>
            </tr>
            </thead>
            <tbody id="tableJoueurs">
                <?php
                    for ($i=0; $i < count($getJoueursInPartie); $i++) { 
                        echo" <tr class='table-active' id='tableJ'>";
                        echo"<th> ". $i+1  ."/".  $partie->getnbJoueursMax() ."</th>";
                        echo"<th>". $getJoueursInPartie[$i]->getPseudo() ."</th>";
                        echo"</tr>";
                    }

                ?>
                
                
            </tbody>
    </table>
    <a class="btn btn-danger" href="index.php?&uc=partie&action=quitterSalon&idRoom=<?=$partie->getId()?>" >Quitter la partie </a>       
    </div>
</div>

<script TYPE="text/javascript">
    var tableJoueurs= document.getElementById("tableJoueurs");
    
    let idRoom = <?=$partie->getId()?>;
    var nbSeconde=0

    document.getElementById("commencer").addEventListener("click", function(){
        $.ajax({
            type: "GET",
            url: "index.php?&uc=partie&action=commencerPartie&fluxAjax=oui&idPartie="+idRoom,
            timeout: 2000,
            error: function(xhr, status, error) {
                if(status==="timeout") {
                console.log("request timed out");
                }
            }
        });
    });

    ////Intervale qui ajoute des joueurs
setInterval(function(){
    nbSeconde++
    $.ajax({
        type: "GET",
        url: "index.php?&uc=partie&action=getJoueursSalon&idRoom="+idRoom+"&sec="+nbSeconde+"&fluxAjax=oui",
        timeout: 2000,
        success: function(data) {
            salonTabJoueur(data);
        },
        error: function(xhr, status, error) {
            if(status==="timeout") {
            console.log("request timed out");
            }
        }
    });


}, 4000);

///// Verifie si la partie est commencer
setInterval(function(){
    $.ajax({
        type: "GET",
        url: "index.php?&uc=partie&action=PartieInProgress&fluxAjax=oui&idPartie="+idRoom,
        timeout: 2000,
        success: function(response) {
            let reponse = JSON.parse(response.trim());
            if(reponse == true){
                window.location.href = "index.php?&uc=partie&action=afficherPartie&fluxAjax=oui&idPartie="+idRoom;
            }
        },
        error: function(xhr, status, error) {
            if(status==="timeout") {
            console.log("request timed out");
            }
        }
    });
}, 1000);

function salonTabJoueur(data){
    var $data = $(data);
    var $elements = $data.find("#tableJoueurs");
    var $elements= $elements.children().map(function() {return $(this).prop('outerHTML');}).get();
    document.getElementById("tableJoueurs").innerHTML = "";
    for (let index = 0; index < $elements.length; index++) {
        document.getElementById("tableJoueurs").innerHTML += $elements[index];
        
    }
}

</script>