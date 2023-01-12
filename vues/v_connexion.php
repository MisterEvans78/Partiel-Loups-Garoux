<div class="container mt-5" id="contenu">
	<h1 class="title">Connexion</h1>
	<form method="POST" action="index.php?uc=connexion&action=valideConnexion">
		<p>
			<label for="nom" class="form-label">Pseudo*</label>
			<input class="form-control" id="pseudo" type="text" name="pseudo" size="30" maxlength="45" onInput="verifChampsLogin()" required>
		</p>
		<p>
			<label for="mdp" class="form-label">Mot de passe*</label>
			<input class="form-control" id="mdp" type="password" name="mdp" size="30" maxlength="45" onInput="verifChampsLogin()" required>
		</p>
		<input class="btn btn-primary" id="LoginBuValidate" type="submit" value="Valider" name="valider" disabled>
		<input class="btn btn-secondary" type="reset" value="Annuler" name="annuler">
		</p>
	</form>
</div>