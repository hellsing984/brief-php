<?php
// Définir les constantes
define("ADMIN_EMAIL", "greta48.dwwm@gmail.com");

// Fonction pour sécuriser les données du formulaire
function secure_data($data) {
    return htmlspecialchars(trim($data));
}

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = secure_data($_POST["email"]);
    $anti_robot = secure_data($_POST["anti_robot"]);

    // Vérifier la réponse anti-robot
    if ($anti_robot == "7") {
        // Envoyer l'email au visiteur
        $to = $email;
        $subject = "Confirmation de la prise en compte de votre demande";
        $message = "Votre demande a bien été prise en compte. Vous serez informé dès que le site est de nouveau en ligne.";
        $headers = "From: noreply@dwwm2025.odns.fr\r\n";
        $headers .= "Cc: " . ADMIN_EMAIL;

        mail($to, $subject, $message, $headers);

        // Afficher un message de confirmation
        echo "Votre demande a bien été prise en compte !";
    }
}
?>
