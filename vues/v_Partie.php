<!-- On redeclare l'entete et le pied de page car c'est un fluxAjax -->
<?= include("vues/v_entete.php") ?>
<div class="container-chat">
    <div class="corps">
        <div class="haut">
            <div class="row">
                <div class="col-4">
                    <div class="infos-joueur mt-5">
                        <div class="card" style="width: 18rem;">
                            <h5 class="card-title">MES INFOS</h5>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <p>Mon rôle :</p>
                                        <p><?= $getJoueurCarte->getNom() ?></p>
                                    </div>
                                    <div class="col-6">
                                        <img src="<?= $getJoueurCarte->getImage() ?>" alt="<?= $getJoueurCarte->getNom() ?>" class="carte-info">
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="liste-joueurs">
                        <div class="row">
                            <?php
                                foreach ($getJoueursInPartie as $joueur) {
                                    if($joueur->getId() == $_SESSION['joueur']->getId()) {
                                        continue;
                                    }
                                    echo "<div class='col-3'>";
                                    echo "<img src='images/dos_carte.png' alt='dos_carte' class='carte-joueur'>";
                                    echo "<p class='nom-joueur'>" . $joueur->getPseudo() . "</p>";
                                    echo "</div>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

