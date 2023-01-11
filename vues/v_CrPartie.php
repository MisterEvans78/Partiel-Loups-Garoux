<div class="container mt-5">
    <h1 class="title">Création partie</h1>
    <div class="row fond-regle">
        <form method="POST" action="index.php?uc=partie&action=PartieSalonWaiting">
            <p>
            <label for="nom">Nom de la partie*</label>
            <input id="nPartie" type="text" name="nPartie" size="30" maxlength="45">
            </p>
            <p>
                <label for="mdp">nombre de joueur*</label>
                <input id="nbJoueur" type="number" name="nbJoueur" size="30" maxlength="45" min="8" max="24">
            </p>
            <p>
                <label for="mdp">Pays*</label>
                <select name="paysPartie" id="paysPartie">
                    <option value="" hidden>--Please choose an option--</option>
                    <option value="France">France</option>
                    <option value="England">England</option>
                    <option value="Germany">Germany</option>
                </select>

            </p>
            <input type="submit" value="Valider" name="valider">
            <input type="reset" value="Annuler" name="annuler">
            </p>
      </form>
    </div>
</div>