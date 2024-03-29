<?php
    require_once 'functions.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content=<?php if (isset($content)) {
                                            echo $content;
                                        } else {
                                            echo "Bienvenue sur Fitness Essential";
                                        } ?>>
    <link rel="icon" type="image/x-icon" href="sources/img/icon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://kit.fontawesome.com/17a81231c9.js" crossorigin="anonymous"></script>
    <title><?php if (isset($title)) {
                echo $title;
            } else {
                echo "Fitness Essential";
            } ?></title>
</head>

<body>

    <?php
    function isActive($active_page, $link)
    {
        if ($active_page == $link) {
            echo "active";
        }
    }
    ?>

    <header class="sticky-top px-1">

        <!-- Nativement, avec la classe 'navbar', les éléments enfants de la nav utilisent flex, par défaut -> 'justify-content: space-between'  -->

        <!-- Création de la navbar -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid d-flex flex-column">
                <div class="container-fluid row">
                    <!-- LIENS NAVBAR -->
                    <div class="col-5 p-0 d-flex align-items-center">
                        <ul class="navbar-nav __navbarIcons justify-content-start">
                            <li class="navbar-toggler border-0 px-0" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <a class="nav-link __navIcon" href="#"><i class="fa-solid fa-bars"></i></a>
                            </li>
                        </ul>
                        <div class="d-none d-lg-inline">
                            <ul class="navbar-nav ms-3 align-items-center">
                                <li class="nav-item">
                                    <a class="nav-link <?php if (isset($currentPage)) {
                                                            isActive($currentPage, "gyms");
                                                        } ?>" href="gyms.php">Salles</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?php if (isset($currentPage)) {
                                                            isActive($currentPage, "subscriptions");
                                                        } ?>" href="subscriptions.php">Abonnements</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?php if (isset($currentPage)) {
                                                            isActive($currentPage, "reservations");
                                                        } ?>" href="reservations.php">Réservations</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link <?php if (isset($currentPage)) {
                                                            isActive($currentPage, "programs");
                                                        } ?>" href="programs.php">Programmes</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?php if (isset($currentPage)) {
                                                            isActive($currentPage, "forum");
                                                        } ?>" href="forum.php">Forum</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?php if (isset($currentPage)) {
                                                            isActive($currentPage, "about");
                                                        } ?>" href="about.php">Informations</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- LOGO -->
                    <div class="col-2 text-center">
                        <a href="index.php" class="navbar-brand mx-auto">
                            <img src="sources/img/icon.png" alt="logo" class="img-fluid __logoIcon">
                        </a>
                    </div>

                    <!-- ICONES -->
                    <div class="col-5 p-0">
                        <ul class="navbar-nav __navbarIcons justify-content-end align-items-center">
                            <div id="__searchbar">
                            <li class="input-group rounded">
                                <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                                <!--<span class="input-group-text border-0 __navIcon nav-link" id="search-addon"> A quoi sert cet élémént ? et pourquoi quand on le commente, la barre de recherche est surélevée
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </span>-->
                            </li>
                            </div>
                            <li class="nav-item" id="__search-trigger">
                                <a class="nav-link __navIcon" href="#"><i class="fa-solid fa-magnifying-glass"></i></a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link __navIcon" href="#" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-user"></i>
                                </a>
                                <ul class="dropdown-menu __userDropdown" aria-labelledby="dropdownMenuButton1">
                                    <?php if(isConnected()){ ?>
                                        <?php if(isAdmin()){ ?>
                                            <li class="nav-item">
                                                <a class="nav-link" href="users.php" role="button">Back-Office</a>
                                            </li>
                                        <?php } ?>
                                        <li class="nav-item">
                                            <a class="nav-link" href="profilePage.php" role="button">Mon profil</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="logout.php" role="button">Déconnexion</a>
                                        </li>
                                    <?php } else{ ?>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="modal" href="#login-modal" role="button">Connexion</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="modal" href="#register-modal" role="button">Inscription</a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link __navIcon" href="#"><i class="fa-solid fa-bag-shopping"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link __navIcon" href="#"><i class="fa-solid fa-moon"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- MENU BURGER CACHÉ EN DESKTOP -->
                <div class="container-fluid row d-lg-none">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-3">
                            <li class="nav-item">
                                <a class="nav-link <?php if (isset($currentPage)) {
                                                        isActive($currentPage, "gyms");
                                                    } ?>" href="gyms.php">Salles</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if (isset($currentPage)) {
                                                        isActive($currentPage, "subscriptions");
                                                    } ?>" href="subscriptions.php">Abonnements</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if (isset($currentPage)) {
                                                        isActive($currentPage, "reservations");
                                                    } ?>" href="reservations.php">Réservations</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link <?php if (isset($currentPage)) {
                                                        isActive($currentPage, "programs");
                                                    } ?>" href="programs.php">Programmes</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if (isset($currentPage)) {
                                                        isActive($currentPage, "forum");
                                                    } ?>" href="forum.php">Forum</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php if (isset($currentPage)) {
                                                        isActive($currentPage, "about");
                                                    } ?>" href="about.php">Informations</a>
                            </li>
                            <li class="input-group rounded nav-item d-lg-none">
                                <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon"/>
                                <span class="d-flex align-items-center border-0 nav-item" id="search-addon">
                                    <a class="nav-link __navIcon" href="#"><i class="fa-solid fa-magnifying-glass"></i></a>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </nav>

    </header>

    <div class="modal" id="login-modal" aria-hidden="true" aria-labelledby="login-modal-label" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="login-modal-label">Connexion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body row">
                    <div class="col-3"></div>
                    <form id="login-form" action="login.php" method="POST" class="col-6">
                        <label for="login-email">Adresse mail : </label>
                        <input class="form-control" type="email" name="login-email" id="login-email" placeholder="Adresse mail" required="required"><br>

                        <label for="login-password">Mot de passe : </label>
                        <input class="form-control" type="password" name="login-password" id="login-password" placeholder="Mot de passe" required="required">

                    </form>
                    <div class="col-3"></div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Annuler</button>
                    <button class="btn btn-secondary" data-bs-target="#register-modal" data-bs-toggle="modal">Inscription</button>
                    <button class="btn btn-primary" form="login-form">Connexion</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="register-modal" aria-hidden="true" aria-labelledby="register-modal-label" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="register-modal-label">Inscription</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="register-form" action="register.php" method="POST">
                        <div class="row">
                            <div class="col">
                                <label for="register-civility">Civilité :</label>
                                <select id="register-civility" class="form-select" name="register-civility" aria-label="Default select example" required="required">
                                    <option value="" selected disabled hidden>Veuillez choisir</option>
                                    <option value="F">Madame</option>
                                    <option value="M">Monsieur</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="register-birthday">Date de naissance : </label>
                                <input class="form-control" type="date" name="register-birthday" required="required"><br>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="register-lastname">Nom : </label>
                                <input id="register-lastname" class="form-control" type="text" name="register-lastname" placeholder="Nom" required="required">
                            </div>

                            <div class="col">
                                <label for="register-firstname">Prénom : </label>
                                <input id="register-firstname" class="form-control" type="text" name="register-firstname" placeholder="Prénom" required="required"><br>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="register-email">Email : </label>
                                <input id="register-email" class="form-control" type="email" name="register-email" placeholder="Adresse mail" required="required">
                            </div>

                            <div class="col">
                                <label for="register-address">Adresse : </label>
                                <input id="register-address" class="form-control" type="text" name="register-address" placeholder="Adresse" required="required"><br>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="register-city">Ville : </label>
                                <input id="register-city" class="form-control" type="text" name="register-city" placeholder="Ville" required="required">
                            </div>

                            <div class="col">
                                <label for="register-zip-code">Code postal : </label>
                                <input id="register-zip-code" class="form-control" type="number" name="register-zip-code" placeholder="Code postal" required="required"><br>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="register-password">Mot de passe : </label>
                                <input id="register-password" class="form-control" type="password" name="register-password" placeholder="Mot de passe" required="required">
                            </div>

                            <div class="col">
                                <label for="register-confirmed-password">Confirmation mot de passe : </label>
                                <input id="register-confirmed-password" class="form-control" type="password" name="register-confirmed-password" placeholder="Confirmation du mot de passe" required="required"><br>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Annuler</button>
                    <button class="btn btn-secondary" data-bs-target="#login-modal" data-bs-toggle="modal">Connexion</button>
                    <button class="btn btn-primary" form="register-form">Inscription</button>
                </div>
            </div>
        </div>
    </div>

    <section id="__userSlide">
        <nav class="navbar" id="__userVerticalNav">
            <ul>
                <?php 
                if(isAdmin()){?>
                    <li class="nav-item">
                        <a class="nav-link" href="users.php" role="button">Back-Office</a>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a class="nav-link " href="profilePage.php">Mon profil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="logout.php">Déconnexion</a>
                </li>
            </ul>
        </nav>
    </section>

<!-- <script src="js/user-slide.js"></script> -->
<script src="js/searchbar.js"></script>