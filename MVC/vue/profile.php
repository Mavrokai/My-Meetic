<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include_once __DIR__ . '/../Controller/ProfilController.php';

$profileData = getProfile();

if (!$profileData) die("Erreur de chargement du profil");

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../public/assets/CSS/profile.css">
    <link rel="shortcut icon" href="/public/assets/360_F_822290684_HRDh4AwTs97Pr0jKVaCGEEXRGRX1mG43.jpg" type="image/x-icon">
    <title>Profil - Meetic</title>
</head>

<body>

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

    <div class="profile-container">

        <div class="profile-header">
            <?php
            $photos = !empty($profileData['user']['profile_photo']) ?
                explode(',', $profileData['user']['profile_photo']) : [];

            $initials = strtoupper(
                substr($profileData['user']['firstname'], 0, 1) .
                    substr($profileData['user']['lastname'], 0, 1)
            );
            ?>

            <div class="profile-picture-container">
                <?php if (!empty($photos)): ?>
                    <img src="/profile_photos/<?= $profileData['user']['id'] ?>/<?= htmlspecialchars($photos[0]) ?>"
                        alt="Photo de profil"
                        class="profile-picture">
                <?php else: ?>
                    <div class="initials-fallback"><?= $initials ?></div>
                <?php endif; ?>
            </div>
            <h1>Profil de <?= htmlspecialchars($profileData['user']['firstname']) ?></h1>
        </div>


        <div class="profile-section">
            <div class="info-group">
                <label>Nom complet :</label>
                <p><?= htmlspecialchars($profileData['user']['firstname'] . ' ' . $profileData['user']['lastname']) ?></p>
            </div>

            <div class="info-group">
                <label>Email :</label>
                <p><?= htmlspecialchars($profileData['user']['email']) ?></p>
            </div>

            <div class="info-group">
                <label>Date de naissance :</label>
                <p><?= htmlspecialchars($profileData['user']['birthday']) ?></p>
            </div>

            <div class="info-group">
                <label>Genre :</label>
                <p><?= htmlspecialchars($profileData['user']['gender']) ?></p>
            </div>

            <div class="info-group">
                <label>Ville :</label>
                <p><?= htmlspecialchars($profileData['user']['city'] ?? 'Non renseignée') ?></p>
            </div>

            <div class="info-group">
                <label>Loisirs :</label>
                <?php if (isset($_SESSION['hobby_error'])): ?>
                    <div class="hobby-error-message" style="color: red; margin-top: 5px;">
                        <?= $_SESSION['hobby_error'] ?>
                        <?php unset($_SESSION['hobby_error']); ?>
                    </div>
                <?php endif; ?>
                <div class="hobbies">
                    <?php foreach ($profileData['hobbies'] as $hobby): ?>
                        <form method="POST" action="../Controller/ProfilController.php?action=delete_hobby" class="hobby-form">
                            <input type="hidden" name="hobby_id" value="<?= $hobby['id'] ?>">
                            <span class="hobby">
                                <?= htmlspecialchars($hobby['name']) ?>
                                <button type="submit" class="delete-hobby" title="Supprimer">&times;</button>
                            </span>
                        </form>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>



        <div class="profile-section">
            <h2>Modifier les informations</h2>
            <form action="../Controller/ProfilController.php?action=update" method="POST">
                <div class="form-group">
                    <label>Email :</label>
                    <input type="email" name="email" id="emailInput"
                        value="<?= htmlspecialchars($_SESSION['old_email'] ?? $profileData['user']['email']) ?>"
                        required>
                    <div id="emailError" class="error-message">
                        <?= $_SESSION['email_error'] ?? '' ?>
                    </div>
                </div>
                <div class="form-group">
                    <label>Ajouter des loisirs :</label>
                    <div id="selectedHobbies" class="selected-hobbies-container"></div>
                    <select name="hobbies" id="hobbySelector">
                        <?php displayHobbiesOptions(); ?>
                    </select>
                    <select name="hobbiesfinal[]" id="hiddenHobbies" multiple="multiple" style="display: none;"></select>
                </div>
                <div class="form-group">
                    <label>Genre :</label>
                    <select name="gender" required>
                        <option value="Homme" <?= $profileData['user']['gender'] === 'Homme' ? 'selected' : '' ?>>Homme</option>
                        <option value="Femme" <?= $profileData['user']['gender'] === 'Femme' ? 'selected' : '' ?>>Femme</option>
                        <option value="Non-binaire" <?= $profileData['user']['gender'] === 'Non-binaire' ? 'selected' : '' ?>>Non-binaire</option>
                        <option value="Gender fluide" <?= $profileData['user']['gender'] === 'Gender fluide' ? 'selected' : '' ?>>Gender fluide</option>
                        <option value="Agender" <?= $profileData['user']['gender'] === 'Agender' ? 'selected' : '' ?>>Agender</option>
                        <option value="Androgyne" <?= $profileData['user']['gender'] === 'Androgyne' ? 'selected' : '' ?>>Androgyne</option>
                        <option value="Transgenre" <?= $profileData['user']['gender'] === 'Transgenre' ? 'selected' : '' ?>>Transgenre</option>
                        <option value="Cisgenre" <?= $profileData['user']['gender'] === 'Cisgenre' ? 'selected' : '' ?>>Cisgenre</option>
                        <option value="Intersexe" <?= $profileData['user']['gender'] === 'Intersexe' ? 'selected' : '' ?>>Intersexe</option>
                        <option value="Autre" <?= $profileData['user']['gender'] === 'Autre' ? 'selected' : '' ?>>Autre</option>


                    </select>
                </div>
                <button type="submit" class="BtnSubmit">Mettre à jour</button>
            </form>
        </div>



        <div class="profile-section">
            <h2>Gestion des photos de profil</h2>
            <div class="photo-preview-container" id="photoPreview">
                <?php foreach ($profileData['photos'] as $photo): ?>
                    <div class="photo-thumbnail">
                        <img src="/profile_photos/<?= $profileData['user']['id'] ?>/<?= htmlspecialchars($photo) ?>"
                            alt="Photo de profil">
                        <button class="delete-photo" data-photo="<?= htmlspecialchars($photo) ?>">&times;</button>
                    </div>
                <?php endforeach; ?>
            </div>

            <form action="../Controller/ProfilController.php?action=upload_photos" method="POST" enctype="multipart/form-data" id="uploadPhotosForm">
                <div class="form-group">
                    <label class="file-upload-label">
                        <span class="upload-text">Glissez-déposez ou cliquez pour sélectionner des photos</span>
                        <input type="file" name="profile_photos[]" multiple accept="image/jpeg, image/png, image/webp">
                    </label>
                    <small>Formats acceptés : JPG, PNG, WEBP (max 5Mo par photo)</small>
                </div>
                <button type="submit" class="BtnSubmit">Télécharger les photos</button>
            </form>

            <?php if ($profileData['photo_pagination']['total_pages'] > 1): ?>
                <div class="pagination">
                    <?php if ($profileData['photo_pagination']['current_page'] > 1): ?>
                        <a href="?photo_page=<?= $profileData['photo_pagination']['current_page'] - 1 ?>#photoPreview"
                            class="pagination-link">&laquo; Précédent</a>
                    <?php endif; ?>

                    <span class="pagination-info">
                        Page <?= $profileData['photo_pagination']['current_page'] ?>
                        sur <?= $profileData['photo_pagination']['total_pages'] ?>
                    </span>

                    <?php if ($profileData['photo_pagination']['current_page'] < $profileData['photo_pagination']['total_pages']): ?>
                        <a href="?photo_page=<?= $profileData['photo_pagination']['current_page'] + 1 ?>#photoPreview"
                            class="pagination-link">Suivant &raquo;</a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

        </div>



        <div class="profile-section">
            <h2>Changer le mot de passe</h2>
            <form action="../Controller/ProfilController.php?action=change_password" method="POST">
                <div class="form-group">
                    <label>Mot de passe actuel :</label>
                    <input type="password" name="current_password" required>
                    <div class="error-message"><?= $_SESSION['password_errors']['current'] ?? '' ?></div>
                </div>
                <div class="form-group">
                    <label>Nouveau mot de passe :</label>
                    <input type="password" name="new_password" required>
                    <div class="error-message"><?= $_SESSION['password_errors']['new'] ?? '' ?></div>
                </div>
                <div class="form-group">
                    <label>Confirmer le nouveau mot de passe :</label>
                    <input type="password" name="confirm_password" required>
                    <div class="error-message"><?= $_SESSION['password_errors']['confirm'] ?? '' ?></div>
                </div>
                <button type="submit" class="BtnSubmit">Changer le mot de passe</button>
            </form>
        </div>



        <div class="profile-section">
            <h2>Supprimer le compte</h2>
            <form action="../Controller/ProfilController.php?action=delete" method="POST" onsubmit="return confirm('Êtes-vous sûr ?');">
                <div class="form-group">
                    <label>Entrez votre mot de passe pour confirmer :</label>
                    <input type="password" name="password" required>
                </div>
                <button type="submit" class="delete-btn">Supprimer définitivement</button>
            </form>
        </div>
    </div>
    </div>
    <script src="../../public/JS/profile.js"></script>
</body>

</html>