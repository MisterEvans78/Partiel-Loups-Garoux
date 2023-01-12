<div class="container mt-5">

    <h1 class="title">Salon de la partie : <?=$partie->getNomPartie()?></h1> 
    <div class="row fond-regle">
        <?php
            if($partie->getHost()->getId() == $_SESSION['joueur']->getId()){
                ?>
                    <a class="btn btn-primary" href="index.php?&uc=partie&action=PartieInProgress&idPartie=<?=$partie->getId()?>&idJoueur=<?=$_SESSION['joueur']->getId()?>&idCarteJoueur=<?=$_SESSION['joueur']->getcarte_id()?>">Commencer la partie</a>
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
    
    let idRoom = <?php echo $partie->getId() ?>;
    var nbSeconde=0
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