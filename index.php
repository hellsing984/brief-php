<?php
// Paramètres de la page
$page_title = "Page de maintenance"; // Titre de la page
$subtitle = "Sous-titre"; // Sous-titre
$description = "Bienvenue et désolé pour le dérangement, ce n'est que temporaire."; // Description
$illustration_text = "ILLUSTRATION"; // Texte de l'illustration
$footer_text = "FOOTER - Tous droits réservés DVWMM 2025."; // Texte du pied de page

// Traitement du formulaire
$email = ""; // Initialiser la variable email
$anti_robot = ""; // Initialiser la variable anti-robot
$message = ""; // Initialiser la variable message

// Déclaration des constantes
define('ADMIN_EMAIL', 'greta48.dwwm@gmail.com');
define('FROM_EMAIL', 'kevin.sicre.dwwm48@gmail.com'); // Remplacer par votre adresse

// Fonction de sanitisation des entrées
function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitiser les données soumises
    $email = sanitizeInput($_POST['email']);
    $anti_robot = sanitizeInput($_POST['anti-robot']);
    
    // Vérifier si la réponse anti-robot est correcte
    if ($anti_robot == "7") {
        // Envoyer un message de confirmation
        $message = "Votre demande a bien été prise en compte !";
        // Envoyer un email à l'utilisateur
        mail($email, "Votre demande a été prise en compte", "Merci, nous vous informerons dès que le site est de nouveau en ligne.", "From: " . FROM_EMAIL . "\r\nCc: " . ADMIN_EMAIL);
        // Alerter l'administrateur de la demande validée
        mail(ADMIN_EMAIL, "Demande valide reçue", "L'utilisateur $email a validé le formulaire.", "From: " . FROM_EMAIL);
    } else {
        // Pas de message d'erreur, "Silence is golden"
        $message = ""; // Aucun message affiché si l'utilisateur est un robot
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title; ?></title>
    <link rel="stylesheet" href="style.css">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const antiRobotInput = document.getElementById('anti-robot');
            const submitButton = document.getElementById('submit-button');
            
            antiRobotInput.addEventListener('input', function() {
                submitButton.disabled = antiRobotInput.value !== "7";
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <header>
            <h1><?= $page_title; ?></h1>
        </header>
        
        <section class="content">
        <div class="illustration-container">
    <div class="text-content">
        <h2><?= $subtitle; ?></h2>
        <p><?= $description; ?></p>
    </div>
    <div class="illustration">
        <img src="./image/maintenace.jpg" alt="Illustration" />
    </div>
</div>
        </section>

        <section class="form-section">
            <?php if (!empty($message)) : ?>
                <p><?= $message; ?></p>
            <?php endif; ?>
            
            <form action="index.php" method="POST">
                <label for="email">Votre email :</label>
                <input type="email" id="email" name="email" placeholder="email@email.com" value="<?= $email; ?>" required>
                
                <!-- Question anti-robot : 5 + 2 -->
                <label for="anti-robot">Question anti-robot : 5 + 2</label>
                <input type="text" id="anti-robot" name="anti-robot" value="<?= $anti_robot; ?>" required>
                
                <button type="submit" id="submit-button" disabled>ENVOYER</button>
            </form>
        </section>
        
        <footer>
            <p><?= $footer_text; ?></p>
        </footer>
    </div>
</body>
</html>
