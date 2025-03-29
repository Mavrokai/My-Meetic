<?php
include_once __DIR__ . '/../Controller/AcceuilController.php';
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/assets/CSS/Inscription.css">
    <link rel="stylesheet" href="/public/assets/CSS/home.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="/public/assets/360_F_822290684_HRDh4AwTs97Pr0jKVaCGEEXRGRX1mG43.jpg" type="image/x-icon">
    <title>Accueil - Meetic</title>
</head>

<body>
    <?php
    session_start();
    ?>
    <nav class="navbar">
        <div class="navbar-container">
            <a href="./acceuil.php" class="navbar-logo">Meetic</a>
            <ul class="navbar-menu">
                <li><a href="./acceuil.php" class="navbar-link">Accueil</a></li>
                <li><a href="./recherche.php" class="navbar-link">Rechercher</a></li>
                <li><a href="#" class="navbar-link" id="nav__recherche">Description</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="./profile.php" class="navbar-link">Profil</a></li>
                    <li><a href="../Controller/Auth/logout.php" class="navbar-link">Déconnexion</a></li>
                <?php else: ?>
                    <li><a href="../vue/Auth/login.php" class="navbar-link">Connexion</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
    <div class="dropdownRecherche">
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

    <div class="container">
        <h1>Bienvenue sur Meetic</h1>
        <p>Trouvez la personne qui vous correspond !</p>
        <div class="cta-buttons">
            <?php if (!isset($_SESSION['user_id'])): ?>
                <a href="../vue/Auth/register.php" class="cta-button">Inscrivez-vous</a>
                <a href="../vue/Auth/login.php" class="cta-button">Connectez-vous</a>
            <?php endif; ?>
        </div>
    </div>
    <script src="../../public/JS/home.js"></script>
</body>

</html>