<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include_once __DIR__ . '/../Controller/RechercheController.php';

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../public/assets/CSS/recherche.css">
    <link rel="shortcut icon" href="/public/assets/360_F_822290684_HRDh4AwTs97Pr0jKVaCGEEXRGRX1mG43.jpg" type="image/x-icon">
    <title>Recherche - Meetic</title>
</head>

<body>

    <nav class="navbar">
        <div class="navbar-container">
            <a href="./acceuil.php" class="navbar-logo">Meetic</a>
            <ul class="navbar-menu">
                <li><a href="./acceuil.php" class="navbar-link">Accueil</a></li>
                <li class="navbar-link" id="nav__recherche"> Rechercher &#11167; </li>
                <li><a href="#" class="navbar-link" id="nav__description">Description</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="./profile.php" class="navbar-link">Profil</a></li>
                    <li><a href="../Controller/Auth/logout.php" class="navbar-link">Déconnexion</a></li>
                <?php else: ?>
                    <li><a href="../vue/Auth/login.php" class="navbar-link">Connexion</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <div class="dropdownDescription">
        <h1>🌟 Bienvenue sur my_meetic 🌟</h1>

        <div class="section">
            <h2><i class="fas fa-heart"></i>Pourquoi nous choisir ?</h2>
            <ul>
                <li><span class="highlight">Profil ultra-personnalisé</span> : Âge vérifié (+18), localisation précise, loisirs uniques</li>
                <li><span class="highlight">Algorithmes intelligents</span> : Correspondances basées sur vos centres d'intérêt</li>
                <li><span class="highlight">Communauté vérifiée</span> : Profils authentiques et sérieux</li>
            </ul>
        </div>

        <div class="section">
            <h2><i class="fas fa-search"></i>Recherche intelligente</h2>
            <div class="feature-box">
                <p>🔍 Filtres combinables :</p>
                <ul>
                    <li>Genre • Ville • Tranche d'âge</li>
                    <li>Centres d'intérêt (Manga, Skateboard, Cuisine...)</li>
                    <li>Carrousel interactif avec navigation tactile</li>
                </ul>
            </div>
        </div>

        <div class="section">
            <h2><i class="fas fa-shield-alt"></i>Sécurité</h2>
            <div class="example-query">
                "Trouvez un passionné de mangas entre 25 et 35 ans, à Paris ou Lyon !"
            </div>
            <ul>
                <li>Mot de passe haché</li>
                <li>Protection anti-injections SQL</li>
                <li>Données chiffrées en base</li>
            </ul>
            <div class="security-badge">100% RGPD</div>
        </div>

        <div class="section">
            <h2><i class="fas fa-star"></i>Fonctionnalités premium</h2>
            <ul>
                <li>Messagerie privée sécurisée</li>
                <li>Contact rapide depuis le carrousel</li>
                <li>Suggestions quotidiennes personnalisées</li>
            </ul>
        </div>

        <div class="section">
            <h2><i class="fas fa-mobile-alt"></i>Accessibilité</h2>
            <ul>
                <li>Interface responsive</li>
                <li>Navigation intuitive</li>
                <li>Compatibilité mobile/tablette</li>
            </ul>
        </div>
    </div>




    <div class="dropdownRecherche">
        <form action="recherche.php" method="post">
            <label for="Genre">Genre:</label>
            <select name="gender">
                <option value="">Tous les genres</option>
                <option value="homme">Homme</option>
                <option value="femme">Femme</option>
                <option value="non-binaire">Non-binaire</option>
                <option value="gender fluide">Gender fluide</option>
                <option value="agender">Agender</option>
                <option value="androgyne">Androgyne</option>
                <option value="transgenre">Transgenre</option>
                <option value="cisgenre">Cisgenre</option>
                <option value="intersexe">Intersexe</option>
                <option value="autre">Autre</option>
            </select>

            <label for="ville">Ville:</label>
            <input type="search" name="ville" id="">

            <label for="loisir">Loisir:</label>
            <select name="hobbies[]" id="hobbySelector" multiple>
                <?php
                include_once __DIR__ . '../../Controller/RechercheController.php';
                displayHobbiesOptions();
                ?>
            </select>

            <label for="age">Tranche d'âge:</label>
            <select name="age">
                <option value="">Toutes tranches</option>
                <option value="18/25">18/25</option>
                <option value="25/35">25/35</option>
                <option value="35/45">35/45</option>
                <option value="45+">45+</option>
            </select>

            <button type="submit">Rechercher</button>
        </form>
    </div>

    <?php
    handleSearch();
    ?>

    <script src="../../public/JS/recherche.js"></script>
</body>

</html>