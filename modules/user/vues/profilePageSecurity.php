<?php
require '../../../functions.php';
if(!isConnected()){
    header('Location: ../../../error404.php');
    die();
}
$title = "Fitness Essential - Page profil Sécurité";
$content = "Profil utilisateur";

require '../../../header.php';
$db = database();
$getUserInfoQuery = $db->prepare("SELECT firstName, lastName, email FROM RkU_USER WHERE id=:id");
$getUserInfoQuery->execute(['id'=>$_SESSION['userId']]);
$user = $getUserInfoQuery->fetch();
Message('DeleteUser');
Message('updateMail');
Message('updatePassword');
?>

<h2 class="aligned-title"> Mon profil </h2>
<div class="container-fluid">
    <div class="row">
        <div class="d-none col-2 d-md-flex justify-content-center">
            <nav class="nav flex-column py-3">
                <a class="nav-link active" href="profilePage.php">Mon Profil</a>
                <a class="nav-link" aria-current="page" href="profilePageSecurity.php">Sécurité</a>
                <a class="nav-link" href="#">jaaj 1</a>
                <a class="nav-link disabled">jaaj 2</a>
            </nav>
        </div>
        <div class="col-12 col-md-8">

            <div class="row border-bottom py-3 mb-3">
                <div class="col-8">
                    <p class="d-flex align-items-start fw-bold fs-3">
                        <?php
                        echo isset($user['firstName']) && isset($user['lastName']) ? $user['firstName'] . ' ' . $user['lastName'] : ''
                        ?>
                    </p>
                </div>
            </div>

            <div class="row">
                    <div class="row">
                        <div class="col-6 mb-3" id="__profileSecEmailGroup">
                            <form id="updateEmail" method="POST" action="../scripts/updateMail.php">
                                <label for="__profileSecMailInput" class="form-label">
                                    <p class="fw-bold my-0 __profileInfoLabel">Adresse e-mail</p>
                                    <p id="__profileSecMailValue" class="my-0"> <?= $user['email'] ?? '' ?> </p>
                                    <a href="#" class="link-primary" id="__profileSecModifyEmail">Modifier mon adresse e-mail</a>
                                </label>
                                <input type="text" class="form-control" id="__profileSecMailInput" name="profileEmail" value="<?= $user['email'] ?? '' ?>" required="required">
                                <br><small class="form-text text-muted">/!\ Une fois l'adresse changée vous serez déconnecté et devrez obligatoirement confirmer par mail pour pouvoir vous reconnecter</small>
                            </form>
                        </div>

                        <div class="col-6 mb-3" id="__profileSecPasswordGroup">
                            <label for="__profileSecPasswordInput" class="form-label">
                                <p class="fw-bold my-0 __profileInfoLabel">Mot de passe</p>
                                <p id="__profileSecPasswordValue" class="my-0"> ************** </p>
                                <a href="#" class="link-primary" id="__profileSecModifyPassword" data-bs-toggle="modal" data-bs-target="#modifyPasswordModal">Modifier mon mot de passe</a>
                            </label>
                        </div>
                    </div>
                    <span id="__buttonGroup">
                        <a href="<?= DOMAIN . 'modules/user/scripts/userDel.php'?>" id="__profileDeleteAccount" class="btn btn-danger mt-5" data-bs-toggle="modal" data-bs-target="#delModal">Supprimer mon compte</a>
                        <a href="<?= DOMAIN . 'modules/user/scripts/exportDataRGPD.php'?>" id="__profileExportDataRGPD" target="_blank" class="btn btn-secondary mt-5">Export données RGPD</a>
                        <a href="" class="btn btn-secondary mt-5" id="__profileSecCancel"">Annuler</a>

                        <button class="btn btn-primary mt-5" id="__modifyEmailButton" data-bs-toggle="modal" data-bs-target="#modifyEmailModal">Modifier adresse e-mail</button>
                    </span>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="modifyEmailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Changement d'adresse mail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="deleteFormInfo">
                    <h5>Vous êtes sur le point de changer votre adresse mail :</h5>
                    <p class="delete-passwordConfirmDescription">Êtes-vous sûr de vouloir la modifier ?</p>
                </div>
                <div class="row deletePassword">
                    <div class="col">
                        <label for="userPassword" class="fw-bold">Mot de passe </label>
                        <input form="updateEmail" id="userPassword" class="form-control" type="password" name="profilePassword" placeholder="Veuillez saisir votre mot de passe" required="required">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <!--<button class="btn btn-primary delete-passwordConfirm">Supprimer</button>-->
                <button class="btn btn-primary <!--delete-confirm-->" form="updateEmail" type="submit">Changer d'adresse mail</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modifyPasswordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Changement de mot de passe</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="deleteFormInfo">
                    <h5>Vous êtes sur le point de changer votre mot de passe :</h5>
                    <p class="delete-passwordConfirmDescription">Êtes-vous sûr de vouloir le modifier ?</p>
                </div>
                <form id="updatePassword" method="POST" action="../scripts/updatePassword.php">
                    <div class="row deletePassword">
                        <div class="col">
                            <label for="profilePassword" class="fw-bold">Ancien mot de passe </label>
                            <input id="profilePassword" class="form-control" type="password" name="profilePassword" required="required">
                        </div>
                    </div>
                    <div class="row deletePassword">
                        <div class="col">
                            <label for="profileNewPassword" class="fw-bold">Nouveau mot de passe </label>
                            <input id="profileNewPassword" class="form-control" type="password" name="profileNewPassword" required="required">
                        </div>
                    </div>
                    <div class="row deletePassword">
                        <div class="col">
                            <label for="profileConfirmNewPassword" class="fw-bold">Confirmer le nouveau mot de passe </label>
                            <input form="updatePassword" id="profileConfirmNewPassword" class="form-control" type="password" name="profileConfirmNewPassword" required="required">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <!--<button class="btn btn-primary delete-passwordConfirm">Supprimer</button>-->
                <button class="btn btn-primary <!--delete-confirm-->" form="updatePassword" type="submit">Valider</button>
            </div>
        </div>
    </div>
</div>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<?php
include '../../../footer.php';
?>

<script src="<?= DOMAIN . 'js/profilePageSecurity.js'?>" crossorigin="anonymous"></script>