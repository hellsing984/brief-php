<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance en cours</title>
    <script>
        // Activer le bouton envoyer uniquement si l'utilisateur coche la case
        function activerBouton() {
            const bouton = document.getElementById('btn-envoyer');
            const checkbox = document.getElementById('anti-robot-checkbox');
            bouton.disabled = !checkbox.checked;
        }
    </script>
    <script>
        // Vérifier le contrôle anti-robot (simple calcul)
        function verifierCaptcha() {
            const reponse = document.getElementById('anti-robot').value;
            return reponse == "7"; // Exemple : 5 + 2 = 7
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Page de maintenance</h1>
        <p>Nous travaillons actuellement sur une mise à jour importante. Merci pour votre patience.</p>
        <form method="post" action="traitement.php" onsubmit="return verifierCaptcha();">
            <div>
                <label for="email">Votre email :</label>
                <input type="email" name="email" id="email" required placeholder="email@example.com">
            </div>
            <div>
                <label for="anti-robot">Question anti-robot : 5 + 2 = </label>
                <input type="text" name="anti-robot" id="anti-robot" required>
            </div>
            <div>
                <input type="checkbox" id="anti-robot-checkbox" onchange="activerBouton()">
                <label for="anti-robot-checkbox">Je ne suis pas un robot</label>
            </div>
            <button type="submit" id="btn-envoyer" disabled>Envoyer</button>
        </form>
    </div>
    <footer>
        <p>FOOTER - Tout droits réservés DVWWM 2025</p>
    </footer>
</body>
</html>
