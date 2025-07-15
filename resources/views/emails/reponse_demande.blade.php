<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réponse à votre demande</title>
</head>
<body>
    <h2>Bonjour {{ $nom }},</h2>
    <p>Merci pour votre demande de participation à l’itinéraire : <strong>{{ $itineraire->titre }}</strong>.</p>
    <p>Voici notre réponse :</p>
    <blockquote style="border-left: 4px solid #ccc; padding-left: 10px; color: #555;">
        {{ $messageAdmin }}
    </blockquote>
    <p>Nous restons disponibles pour tout complément d'information.</p>
    <p>Cordialement,</p>
    <p>L'équipe Toché</p>
</body>
</html>
