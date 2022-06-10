<nav class="nav flex-column py-3">
    <ul class="__listeVerticale">
        
        <li class="nav-item ms-md-3 mt-3">
            <span class="text-uppercase">Gestion des utilisateurs</span>
            <ul class="__listeVerticale">
                <li class="nav-item">
                <a class="nav-link active" href="<?= DOMAIN . 'modules/user/vues/admin/users.php'?>">Liste des utilisateurs</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" aria-current="page" href="<?= DOMAIN . 'modules/user/vues/admin/security.php'?>">Sécurité</a>
                </li>
            </ul>
        </li>
        
        <li class="nav-item ms-md-3 mt-3">
            <span class="text-uppercase">Gestion de contenu</span>
            <ul class="__listeVerticale">
                <li class="nav-item">
                    <a class="nav-link" href="#">Abonnements</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="modifyPrograms.php">Programmes</a>
                </li>
            </ul>
        </li>

    </ul>
</nav>