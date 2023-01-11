<div class="container mt-5">
    <h1 class="title">Loup-garou</h1>
    <div class="row fond-regle">
        <h2 class="title_2">Règles du jeu</h2>
        <div class="col-4 regle">
            <h3 class="title_3 mt-3">Objectif</h3>
            <ul>
                <li>Pour les villageois :</li>
            </ul>
            <p>éliminer les Loups-Garous.</p>
            <ul>
                <li>Pour les Loups-Garous :</li>
            </ul>
            <p>éliminer tous les villageois.</p>
            <h3 class="title_3">Joueurs</h3>
            <p>Le nombre de joueurs n'est pas limité, mais il est recommandé d'avoir au moins 7 joueurs.</p>
        </div>
        <div class="col-4 regle">
            <h3 class="title_3 mt-3">Rôles</h3>
            <p>Il y a plusieurs rôles différents dans le jeu, chacun avec ses propres capacités :</p>
            <ul>
                <li>Loup-garou : tue chaque nuit une personne</li>
                <li>Villageois : vote chaque jour pour découvrir le Loup-garou</li>
                <li>Voyante : peut voir la profession d'un joueur chaque nuit</li>
                <li>Chasseur : peut tuer un joueur après sa mort</li>
                <li>...</li>
            </ul>
        </div>
        <div class="col-4 regle">
            <h3 class="title_3 mt-3">Déroulement</h3>
            <p>Le jeu se déroule en plusieurs tours de jour et de nuit :</p>
            <ul>
                <li>Pendant la nuit, les loups-garous tuent une personne et la voyante découvre la profession d'un
                    joueur</li>
                <li>Pendant la journée, les joueurs discutent entre eux et votent pour découvrir le Loup-garou.</li>
                <li>Si un joueur est démasqué comme Loup-garou, il est exécuté et le jeu continue jusqu'à ce qu'il n'y
                    ait plus de Loups-garous ou que les villageois soient tous morts.</li>
            </ul>
        </div>
        <div class="row mt-3">
            <h2 class="title_2">Les cartes</h2>
            <?php
            foreach ($getAllCarte as $carte) {
                echo "<div class='col-3'>";
                echo "<img class='carte' src=" . $carte->getImage() . " alt=" . $carte->getNom() . " data-bs-toggle='modal' data-bs-target='#" . $carte->getId() . "'>";
                echo "</div>";
                echo '<div class="modal fade" id="' . $carte->getId() . '" tabindex="-1" aria-labelledby="ModalLabel-' . $carte->getNom() . '" aria-hidden="true">
                        <div class="row">
                        <img class="carte-modal modal-dialog modal-dialog" src="' . $carte->getImage() . '" alt="' . $carte->getNom() . '">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="ModalLabel-' . $carte->getNom() . '">' . $carte->getNom() . '</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>' . $carte->getDescription() . '</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>';
            }
            ?>
        </div>
        <div class="row mt-3">
            <h2 class="title_2">Tours de jeu</h2>
            <h2 class="title_3">Tour de démarrage</h2>
            <div id="carouselExampleIndicators" class="carousel slide">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                        class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"
                        aria-label="Slide 4"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="p-carousel">
                            <p>Le meneur endort le village.</p>
                            <p>
                                Le meneur dit :
                                “ C’est la nuit, tout le village s’endort,
                                les joueurs ferment les yeux ”. Tous
                                les joueurs baissent la tête et ferment les
                                yeux. Puis selon le choix des personnages
                                en jeu, le meneur appelle les différents
                                personnages.
                            </p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row p-carousel">
                            <div class="col-6">
                                <img src="images/voleur.jpg" class="d-block carte-carousel" alt="Voleur">
                            </div>
                            <div class="col-6">
                                <p>Le meneur appelle le <strong class="red-strong">Voleur</strong></p>
                                <p>
                                    Le meneur dit :
                                    “le Voleur se réveille !”
                                    Le joueur qui possède la
                                    carte Voleur ouvre les yeux
                                    et regarde discrètement
                                    les deux cartes cachées
                                    au milieu, puis change éventuellement
                                    de personnage. Le meneur dit “Le Voleur
                                    se rendort”. Le Voleur referme les yeux.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row p-carousel">
                            <div class="col-6">
                                <img src="images/cupidon.jpg" class="d-block carte-carousel" alt="Cupidon">
                            </div>
                            <div class="col-6">
                                <p>Le meneur appelle <strong class="red-strong">Cupidon</strong></p>
                                <p>
                                    Le meneur dit :
                                    “Cupidon se réveille !”
                                    Cupidon ouvre les yeux
                                    et désigne deux joueurs
                                    (dont éventuellement luimême).
                                    Le meneur fait le tour de la table et touche
                                    discrètement le dos des deux Amoureux.
                                    Le meneur dit : “Cupidon se rendort”.
                                    Cupidon referme les yeux.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="p-carousel">
                            <p>Le meneur appelle les <strong class="red-strong">Amoureux</strong></p>
                            <p>
                                Le meneur dit “les Amoureux se réveillent, se reconnaissent, et se rendorment !”
                                Ils ne se montrent pas leur carte de sorte
                                que chacun ignore la véritable personnalité de l’être aimé. Puis le meneur suit
                                le tour normal.
                            </p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            <h2 class="title_3">Tour normal</h2>
            <div id="carouselExampleIndicators2" class="carousel slide">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleIndicators2" data-bs-slide-to="0"
                        class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators2" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators2" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators2" data-bs-slide-to="3"
                        aria-label="Slide 4"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators2" data-bs-slide-to="4"
                        aria-label="Slide 5"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators2" data-bs-slide-to="5"
                        aria-label="Slide 6"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators2" data-bs-slide-to="6"
                        aria-label="Slide 7"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row p-carousel">
                            <div class="col-6">
                                <img src="images/voyante.jpg" class="d-block carte-carousel" alt="Voyante">
                            </div>
                            <div class="col-6">
                                <p>Le meneur appelle la <strong class="red-strong">Voyante</strong></p>
                                <p>
                                    Le meneur dit :
                                    “la Voyante se réveille, et
                                    désigne un joueur dont
                                    elle veut sonder la véritable
                                    personnalité !”.
                                    Le meneur montre à la Voyante la face
                                    cachée de la carte du joueur que la Voyante
                                    a désigné. Le meneur dit :
                                    “La Voyante se rendort”.
                                    La Voyante referme les yeux.

                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row p-carousel">
                            <div class="col-6">
                                <img src="images/loup_garou.jpg" class="d-block carte-carousel" alt="Loup Garou">
                            </div>
                            <div class="col-6">
                                <p>Le meneur appelle les <strong class="red-strong">Loups-Garous</strong></p>
                                <p>
                                    Le meneur dit :
                                    “les Loups-Garous se
                                    réveillent, se reconnaissent
                                    et désignent une nouvelle
                                    victime !!!”.
                                    Durant ce tour, la Petite Fille peut espionner
                                    les Loups-Garous en entrouvrant les yeux
                                    discrètement.
                                    Le meneur dit : “les Loups-Garous repus
                                    se rendorment et rêvent de prochaines
                                    victimes savoureuses !”.
                                    Les Loups-Garous ferment les yeux
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row p-carousel">
                            <div class="col-6">
                                <img src="images/sorcière.jpg" class="d-block carte-carousel" alt="Sorcière">
                            </div>
                            <div class="col-6">
                                <p>Le meneur appelle la <strong class="red-strong">Sorcière</strong></p>
                                <p>
                                    Le meneur dit :
                                    “la Sorcière se réveille,
                                    je lui montre la victime des
                                    Loups-Garous. Va-t-elle user
                                    de sa potion de guérison,
                                    ou d’empoisonnement ?”
                                    Le meneur montre à la Sorcière la victime
                                    des Loups-Garous.
                                    La Sorcière n’est pas obligée d’user de
                                    son pouvoir à un tour spécifique.
                                    Si elle utilise une potion, elle doit désigner
                                    au meneur sa cible avec le pouce tendu
                                    vers le haut pour la guérison, ou vers
                                    le bas pour l’empoisonnement.
                                    Le meneur révélera son effet éventuel
                                    le matin suivant.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="p-carousel">
                            <p>Le meneur <strong class="red-strong">réveille</strong> tout le village</p>
                            <p>
                                Le meneur dit : “c’est le matin, le village
                                se réveille, tout le monde se réveille et
                                ouvre les yeux, tout le monde sauf …”
                                Le meneur désigne alors le ou les joueurs
                                qui ont été victimes des Loups-Garous ou
                                de la Sorcière durant la nuit.
                                Si un de ces joueurs est le Chasseur, il
                                doit répliquer et éliminer immédiatement
                                un autre joueur de son choix.
                                Si un des joueurs est un des deux
                                Amoureux, l’autre Amoureux meurt
                                de chagrin immédiatement.
                                Si un des joueurs est le Capitaine,
                                il désigne son successeur
                            </p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="p-carousel">
                            <p>Le village <strong class="red-strong">débat</strong> des suspects</p>
                            <p>
                                Au cours de cette phase il ne faut pas
                                perdre de vue que les objectifs de chacun
                                sont différents :
                                • Chaque Villageois tente de démasquer
                                un Loup-Garou et de faire voter contre lui.
                                • Les Loups-Garous doivent se faire
                                passer pour des Villageois.
                                • La Voyante ainsi que la Petite Fille
                                doivent aider les autres Villageois,
                                mais sans mettre trop tôt leur vie en
                                danger en exposant leur identité.
                                • Les Amoureux doivent se protéger
                                l’un l’autre.
                                Chacun a le droit de se faire passer pour
                                un autre. Cette phase est le cœur du jeu.

                            </p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="p-carousel">
                            <p>Le village <strong class="red-strong">vote</strong></p>
                            <p>
                                Les joueurs doivent éliminer un joueur suspecté d’être un Loup-Garou.
                                Au signal du meneur, chaque joueur pointe son doigt dans la direction du joueur qu’il
                                souhaite éliminer. Le joueur qui a la majorité des voix est éliminé. La voix du
                                Capitaine compte double. En cas d’égalité, s’il est présent, le vote du Capitaine
                                désigne la victime. Sinon, les joueurs votent à nouveau pour départager les ex-aequo (y
                                compris les joueurs en cause).
                                S’il y a toujours égalité, aucun joueur n’est éliminé.
                                Le joueur éliminé révèle sa carte et ne
                                pourra plus communiquer avec les autres
                                joueurs d’aucune manière.
                            </p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="p-carousel">
                            <p>Le village <strong class="red-strong">s'endort</strong></p>
                            <p>
                                Le meneur dit : “c’est la nuit, les survivants
                                se rendorment !”, les joueurs referment
                                les yeux. (Les joueurs éliminés se taisent,
                                surtout quand ils découvrent qui sont
                                vraiment les Loups-Garous…).
                                Le jeu reprend au début du tour, étape 1.
                            </p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators2"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators2"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</div>