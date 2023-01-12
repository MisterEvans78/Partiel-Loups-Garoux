<div class="container mt-5">
    <h1 class="title">Jouer en ligne</h1>
    <div class="row fond-regle">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th><a class="btn btn-primary" href="index.php?uc=partie&action=CrPartie" > Créer une partie </a> </th>
                <th> Nombre joueurs </th>
                <th> Nom partie </th>
                <th> Pays </th>
            </tr>
            </thead>
            <tbody>
                <?php
                    for ($i=0; $i < $nbPartie; $i++) { 
                        echo" <tr class='table-active'>";
                        echo"<th> <a class='btn btn-secondary' href='index.php?uc=partie&action=JoinSalon&idRoom=". $lesParties[$i][0] ."'> Rejoindre la partie </a> </th>";
                        echo"<th>".Partie::nbJoueurPartie($lesParties[$i][0]) ."/".$lesParties[$i][1] ."</th>";
                        echo"<th>".$lesParties[$i][2] ."</th>";
                        echo"<th>".$lesParties[$i][3] ."</th>";
                        echo"</tr>";
                    }
                ?>
                

                
            </tbody>

            

           
        </table>

    </div>

</div>