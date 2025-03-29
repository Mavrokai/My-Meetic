<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../../../public/assets/CSS/Connexion.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="../../../public/assets/360_F_822290684_HRDh4AwTs97Pr0jKVaCGEEXRGRX1mG43.jpg" type="image/x-icon">
    <title>Connexion - My Meetic</title>
</head>

<body>
    <div class="container">
        <h1>Connection</h1>
        <form id="loginForm" method="POST" action="../../Controller/LoginController.php">
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label>Mot de passe:</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">Se connecter</button>
            <div id="error-message" class="error"></div>
        </form>
        <div class="LinkInscription">
            Pas encore inscrit ? <a href="register.php">S'inscrire</a>
        </div>
    </div>
    <script src="../../../public/JS/Login.js"></script>
</body>

</html>