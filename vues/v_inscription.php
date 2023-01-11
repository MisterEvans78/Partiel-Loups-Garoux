<div class="container mt-5" id="contenu">
  <h1 class="title">Identification utilisateur</h1>
  <form method="POST" action="index.php?uc=connexion&action=valideInscription">
    <p>
      <label for="pseudo" class="form-label">Pseudo*</label>
      <input class="form-control" id="pseudoIns" type="text" name="Pseudo" size="30" maxlength="45" placeholder="Saisi un pseudo qui fait peur"  onInput="verifChampsRempInc()" required>
    </p>
    <p>
      <label for="mdp" class="form-label">Mot de passe*</label>
      <input class="form-control" id="mdpIns" type="password" name="mdp" size="30" maxlength="45" placeholder="Saisi un mot de passe"  onInput="verifChampsRempInc()" required>
    </p>
    <p>
      <label class="form-label" for="Cmdp">Confirme mot de passe*</label>
      <input class="form-control" id="CmdpIns" type="password" name="Cmdp" size="30" maxlength="45" onInput="verifPassword()" placeholder="Confirme ton mot de passe"  onInput="verifChampsRempInc()" required>
      <div id="warning"></div>
    </p>
    <p>
      <label class="form-label" for="mail">Mail*</label>
      <input class="form-control" id="mailIns" type="text" name="mail" size="30" maxlength="75" placeholder="Saisi un mail valide"  onInput="verifChampsRempInc()" required>
    </p>
    <p>
      <input type="checkbox" name="rgpd" id="rgpd" onclick="verifChampsRempInc()">
      <label for="rgpd">J'accepte le traitement de mes données.*</label>
    </p>
    <div id="warningBis"></div>
    <input id="IscBuValidate" type="submit" value="Valider" name="valider" disabled>
    <input type="reset" value="Annuler" name="annuler">
    </p>
  </form>
</div>