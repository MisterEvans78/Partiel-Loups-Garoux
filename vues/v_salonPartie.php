<div class="container mt-5">

    <h1 class="title">Salon de la partie : <?php echo $partie->getNomPartie() ; ?></h1> 
    <div class="row fond-regle">
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
    url: "index.php?&uc=partie&action=getJoueursSalon&idRoom="+idRoom+"&sec="+nbSeconde,
    timeout: 2000,
    success: function(data) {
        //console.log(data);
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
    var container = document.createElement("div");
    container.innerHTML = data;
    var elements = container.querySelectorAll("#tableJoueurs");
    console.log(container);
    document.getElementById("tableJoueurs").innerHTML = elements;
 

}

</script>