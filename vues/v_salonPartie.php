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
                        echo" <tr class='table-active'>";
                        echo"<th> ". $i+1  ."/".  $partie->getnbJoueursMax() ."</th>";
                        echo"<th>". $getJoueursInPartie[$i]->getPseudo() ."</th>";
                        echo"</tr>";
                    }
                ?>
                
                
            </tbody>
    </div>
</div>

<script>
    var tableJoueurs= document.getElementById("tableJoueurs");
    
    let idRoom = <?php echo $partie->getId() ?>;
    var nbSeconde=0
setInterval(function(){
   //  location.reload();
}, 400);

</script>