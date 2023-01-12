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
                                        <p><?php $getCarteJoueur->getNom() ?></p>
                                    </div>
                                    <div class="col-6">
                                        <img class="carte-info" src="<?php $getCarteJoueur->getImage() ?>" alt="<?php $getCarteJoueur->getNom() ?>">
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
                                $getJoueursInPartie = ["Jean", "Pierre", "Paul", "Test", "Michel", "Polo", "Benj", "Abdul"];
                                foreach ($getJoueursInPartie as $joueur) {
                                    echo "<div class='col-3 mt-5'>";
                                    echo "<img class='carte-joueur' src='images/dos_carte.png' alt='dos carte'>";
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

