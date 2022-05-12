<?php
require 'functions.php';

	if(!isAdmin()) {
        header('Location: error404.php');
        die();
    }

require 'header.php';
?>

<h1 class="aligned-title">Liste des utilisateurs</h1>

<div class="row d-flex justify-content-center">
    <div class="col-10">
	<table class="table">
		<thead>
			<tr>
				<th>Id</th>
				<th>Email</th>
				<th>Nom</th>
				<th>Prénom</th>
				<th>Date de naissance</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php
				$pdo = database();
				
				$query = $pdo->query("SELECT * FROM rku_user");
				$results = $query->fetchAll();

				foreach($results as $user)
				{
                    $userId = $user["id"];
                    $userMail = $user["email"];
                    $userLastName = $user["lastName"];
                    $userFirstName = $user["firstName"];
                    $userBirthday = $user["birthday"];
                    $userAddress = $user["address"];
                    $userZipCode = $user["zipCode"];
                    $userCity = $user["city"];
					?>

						<tr>
							<td><?php echo $userId;?></td>
							<td><?php echo $userMail;?></td>
							<td><?php echo $userLastName;?></td>
							<td><?php echo $userFirstName;?></td>
							<td><?php echo $userBirthday;?></td>
							<td>
								<div class="btn-group">
									<a href="#" class="btn btn-primary modifyModal--trigger" data-bs-toggle="modal" data-bs-target="#modifyModalUid<?php echo $userId;?>">Modifier</a>
									<a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delModalUid<?php echo $userId;?>">Supprimer</a>
								</div>

							</td>

						</tr>

						<div class="modal fade" id="delModalUid<?php echo $userId;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Suppression d'un utilisateur</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									Vous êtes sur le point de supprimer l'utilisateur suivant:
									<div class="row">
										<p class="col"><strong>Nom</strong><br><?php echo $userLastName;?></p>
										<p class="col"><strong>Prénom</strong><br><?php echo $userFirstName;?></p>
									</div>
									<div class="row">
										<p><strong>Adresse e-mail</strong><br><?php echo $userMail;?></p>
									</div>
									<p id="delete-passwordConfirmDescription">Êtes-vous sûr de vouloir le supprimer?</p>
									
									<div class="row" id="delete-adminPassword">
										<div class="col">
											<label for="delete-adminPasswordInput" class="fw-bold">Mot de passe Administrateur </label>
											<input id="delete-adminPasswordInput" class="form-control" type="email" name="delete-adminPasswordInput" placeholder="Veuillez saisir votre mot de passe" required="required">
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
									<a href="#" class="btn btn-primary" id="delete-passwordConfirm">Supprimer</a>
									<a href="userDel.php?id=<?php echo $userId;?>" class="btn btn-primary" id="delete-confirm">Supprimer</a>
								</div>
								</div>
							</div>
						</div>

						<div class="modal fade" id="modifyModalUid<?php echo $userId;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Modification des informations de l'utilisateur</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									Vous êtes sur le point de modifier les informations de l'utilisateur suivant:
									<form id="modify-formUid<?php echo $userId;?>" action="userModify.php?id=<?php echo $userId;?>" method="POST">
										<div class="modifyFormInfo">
											<div class="row mt-3">
												<div class="col-6">
													<label for="modify-lastNameUid<?php echo $userId;?>" class="fw-bold">Nom </label>
													<input id="modify-lastNameUid<?php echo $userId;?>" class="form-control" type="text" name="modify-lastNameUid<?php echo $userId;?>" value="<?php echo $userLastName;?>" required="required">
												</div>
												<div class="col-6">
													<label for="modify-firstNameUid<?php echo $userId;?>" class="fw-bold">Prénom </label>
													<input id="modify-firstNameUid<?php echo $userId;?>" class="form-control" type="text" name="modify-firstNameUid<?php echo $userId;?>" value="<?php echo $userFirstName;?>" required="required">
												</div>
											</div>
											<div class="row">
												<div class="col-6">
													<label for="modify-birthdayUid<?php echo $userId;?>" class="fw-bold">Date de naissance </label>
													<input id="modify-birthdayUid<?php echo $userId;?>" class="form-control" type="date" name="modify-birthdayUid<?php echo $userId;?>" value="<?php echo $userBirthday;?>" required="required">
												</div>
											</div>
											<div class="row mt-3">
												<div class="col">
													<label for="modify-emailUid<?php echo $userId;?>" class="fw-bold">Adresse e-mail </label>
													<input id="modify-emailUid<?php echo $userId;?>" class="form-control" type="email" name="modify-emailUid<?php echo $userId;?>" value="<?php echo $userMail;?>" required="required">
												</div>
											</div>
											<div class="row mt-3">
												<div class="col">
													<label for="modify-addressUid<?php echo $userId;?>" class="fw-bold">Adresse </label>
													<input id="modify-addressUid<?php echo $userId;?>" class="form-control" type="text" name="modify-addressUid<?php echo $userId;?>" value="<?php echo $userAddress;?>" required="required">
												</div>
											</div>
											<div class="row">
												<div class="col-6">
													<label for="modify-zipCodeUid<?php echo $userId;?>" class="fw-bold">Code postal </label>
													<input id="modify-zipCodeUid<?php echo $userId;?>" class="form-control" type="text" name="modify-zipCodeUid<?php echo $userId;?>" value="<?php echo $userZipCode;?>" required="required">
												</div>
												<div class="col-6">
													<label for="modify-cityUid<?php echo $userId;?>" class="fw-bold">Ville </label>
													<input id="modify-cityUid<?php echo $userId;?>" class="form-control" type="text" name="modify-cityUid<?php echo $userId;?>" value="<?php echo $userCity;?>" required="required">
												</div>
											</div>
										</div>
										<div class="row mt-3 modify-adminPassword">
											<div class="col">
												<label for="modify-adminPasswordInputUid<?php echo $userId;?>" class="fw-bold">Mot de passe Administrateur </label>
												<input id="modify-adminPasswordInputUid<?php echo $userId;?>" class="form-control" type="email" name="modify-adminPasswordInputUid<?php echo $userId;?>" placeholder="Veuillez saisir votre mot de passe" required="required">
											</div>
										</div>
									</form>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
									<a href="#" class="btn btn-primary modify-passwordConfirm">Modifier</a>
									<button class="btn btn-primary modify-confirm" form="modify-formUid<?php echo $userId;?>" type="submit">Modifier</button>
								</div>
								</div>
							</div>
						</div>

					<?php
				}
			?>


		</tbody>
	</table>
    </div>
</div>

<?php

include "footer.php";

?>

<script src="js/modifyUserAdmin.js" crossorigin="anonymous"></script>
<script src="js/deleteUserAdmin.js" crossorigin="anonymous"></script>