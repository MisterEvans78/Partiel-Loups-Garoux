<?php
$all_players = [];
function roles($user) {
    global $all_players;
    $sp_roles = ['Voyante', 'Petit fille', 'Sorcière', 'Cupidon', 'Chasseur']; 
    if (count($user) <= 11) {
        $walf_roles = ['Loup Garou'] * 2;
    } else {
        $walf_roles = ['Loup Garou'] * 3;
    }

    $villager_roles = ['Villageois'] * (count($user) - (count($walf_roles) + count($sp_roles)));
    $roles = array_merge($sp_roles, $walf_roles, $villager_roles);
    shuffle($roles);
    
    $players = [];
    for ($i = 0; $i < count($user); $i++) {
        $players[$user[$i][0]] = [$user[$i][1], $roles[$i]];
    }

    for ($i = 0; $i < count($roles); $i++) {
        $all_players[array_keys($players)[$i]] = new Player(array_keys($players)[$i], array_values($players)[$i][0], array_values($players)[$i][1]);
    }
}

class Player {
    public $Id;
    public $player;
    public $role;
    public $Is_alive;
    public $Is_president;
    public $Is_loved;
    public $life_potion;
    public $death_potion;

    public function __construct($Id, $player, $role) {
        $this->Id = $Id; 
        $this->player = $player;
        $this->role = $role;
        $this->Is_alive = true;
        $this->Is_president = false;
        $this->Is_loved = false;
        if ($role == 'Sorcière') {
            $this->life_potion = true;
            $this->death_potion = true;
        }
    }
}


function night($nb_nuit) {
    global $all_players;
    if ($nb_nuit == 1) {
        foreach ($all_players as $i) {
            if ($i->role == 'Cupidon') {
                //demander et récupérer le choix en utilisant $i->Id, forme: $cupi = [id_choix_1,id_choix_2]
                $all_players[$cupi[0]]->Is_loved = true;
                $all_players[$cupi[1]]->Is_loved = true;
            }
        }
    }
    foreach ($all_players as $i) {
        if ($i->role == 'Voyante' && $i->Is_alive == true) {
            echo '#######################################';
            //demander et récupérer le choix en utilisant $all_players[$i]->Id, forme $voy = id_choix
            //echo de $all_players[$voy]->role
        }
    }
    foreach ($all_players as $i) {
        if ($i->role == 'Loup Garou' && $i->Is_alive == true) {
            $vote = [];
            //demander et récupérer le choix en utilisant $all_players[$i]->Id, forme $W = id_choix
            if (isset($vote[$W])) {
                $vote[$W]++;
            } else {
                $vote[$W] = 1;
            }
        }
        $killed = array_keys($vote)[array_search(max($vote), $vote)];
        $all_players[$killed]->Is_alive = false;
        unset($vote);
    }
    foreach ($all_players as $i) {
        if ($i->role == 'Sorcière' && $i->Is_alive == true) {
            if ($i->life_potion == true) {
                //echo: cette personne est morte veux-tu la sauver
                if ($reponse == 'yes') {
                     //demander et récupérer le choix en utilisant $all_players[$i]->Id, forme $Sorci = id_choix
                    $all_players[$Sorci]->Is_alive = true;
                    $i->life_potion = false;
                }
            }
            if ($i->death_potion == true) {
                //echo: Voulez-vous tuer quelqu'un
                if ($reponse == 'yes') {
                    $all_players[$Sorci]->Is_alive = false;
                    $i->death_potion = false;
                }
            }
        }
    }
}


function day() {
    global $all_players;
    $president = false;
    $vote = [];
    foreach ($all_players as $i) {
        if ($i->Is_president == true) {
            $president = true;
        }
    }
    if ($president == false) {
        foreach ($all_players as $i) {
            $vote = [];
             //demander et récupérer le choix en utilisant $all_players[$i]->Id, forme $prez = id_choix
            if (isset($vote[$prez])) {
                $vote[$prez]++;
            } else {
                    $vote[$prez] = 1;
            }
        }
    }
    $President = array_keys($vote)[array_search(max($vote), $vote)];
    $all_players[$President]->Is_president = true;
    unset($vote);
    $vote = [];
    foreach ($all_players as $i) {
        //demander et récupérer le choix en utilisant $all_players[$i]->Id, forme $village = id_choix
        if (isset($vote[$village])) {
            $vote[$village]++;
        } else {
            $vote[$village] = 1;
        }
    }
    $Village = array_keys($vote)[array_search(max($vote), $vote)];
    $all_players[$Village]->Is_alive = false;
}

?>