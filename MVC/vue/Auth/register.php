<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include_once __DIR__ . '/../../../config.php';


$errorMessage = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/public/assets/CSS/Inscription.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="/public/assets/360_F_822290684_HRDh4AwTs97Pr0jKVaCGEEXRGRX1mG43.jpg" type="image/x-icon">
    <title>Inscription - Meetic</title>
</head>

<body>
    <div class="container">
        <h1>Inscription</h1>
        <form id="registerForm" method="POST" action="../../Controller/AuthController.php?action=register" enctype="multipart/form-data">
            <div class="form-group">
                <label>Prénom:</label>
                <input class="firstnameInput" type="text" name="firstname" minlength="2" required>
                <div id="firstnameError" class="error-message"></div>
            </div>
            <div class="form-group">
                <label>Nom:</label>
                <input class="lastnameInput" type="text" name="lastname" minlength="2" required>
                <div id="lastnameError" class="error-message"></div>
            </div>
            <div class="form-group">
                <label>Date de naissance:</label>
                <input class="birthdayDate" type="date" name="birthday" required>
                <div id="birthdayError" class="error-message"></div>
            </div>
            <div class="form-group">
                <label>Genre:</label>
                <select name="gender" required>
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
            </div>
            <div class="form-group">
                <label>Ville:</label>
                <input type="text" name="city" id="cityInput" required autocomplete="off">
                <div id="citySuggestions" class="city-suggestions"></div>
                <div id="cityError" class="error-message"></div>
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" required>
                <div id="emailError" class="error-message"></div>
            </div>
            <div class="form-group">
                <label>Mot de passe:</label>
                <input type="password" name="password" required>
                <div id="passwordError" class="error-message"></div>
            </div>
            <div class="form-group">
                <label>Confirmation de Mot de passe:</label>
                <input type="password" name="confirm_password" required>
                <div id="confirmPasswordError" class="error-message"></div>
            </div>
            <div class="form-group">
                <label>Loisirs:</label>
                <div id="selectedHobbies" class="selected-hobbies-container"></div>
                <select name="hobbies" id="hobbySelector">
                    <?php
                    include_once __DIR__ . '../../../Controller/AuthController.php';
                    displayHobbiesOptions();
                    ?>
                </select>
                <select name="hobbiesfinal[]" id="hiddenHobbies" multiple="multiple" style="display: none;"></select>
                <div id="hobbyError" class="error-message"></div>
            </div>
            <div class="form-group">
                <label>Photo de profil :</label>
                <input type="file" name="profilePhoto" id="profilePhoto" accept="image/jpeg, image/png" required>
                <div id="profileImagePreview" class="profile-image-preview"></div>
                <div id="photoError" class="error-message"></div>
            </div>
            <button class="submit" type="submit" name="submitBtn">S'inscrire</button>

            <?php if (!empty($errorMessage)): ?>
                <div class="error-message" style="color: #ff69b4; margin-bottom: 20px;">
                    <?php echo $errorMessage; ?>
                </div>
            <?php endif; ?>

            <p class="LinkConnexion">Vous êtes déjà inscrit ? Alors <a href="./login.php">Connectez-vous !</a></p>
        </form>

        <div id="message"></div>
    </div>
    <script src="/public/JS/Register.js"></script>
</body>

</html>