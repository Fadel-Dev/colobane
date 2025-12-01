<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de réception</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #eb2d53 0%, #101634 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            background: #f9f9f9;
            padding: 30px;
            border: 1px solid #ddd;
            border-top: none;
        }
        .success-box {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .info-box {
            background: white;
            padding: 20px;
            margin: 15px 0;
            border-radius: 5px;
            border-left: 4px solid #eb2d53;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #666;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Message reçu !</h1>
        <p>NoflayHub</p>
    </div>
    
    <div class="content">
        <p>Bonjour {{ $contact->name }},</p>
        
        <div class="success-box">
            <strong>✓ Votre message a été reçu avec succès !</strong>
        </div>
        
        <p>Nous avons bien reçu votre message concernant : <strong>{{ $contact->subject }}</strong></p>
        
        <p>Notre équipe va examiner votre demande et vous répondra dans les plus brefs délais.</p>
        
        <div class="info-box">
            <p><strong>Résumé de votre message :</strong></p>
            <p style="white-space: pre-wrap; color: #666;">{{ Str::limit($contact->message, 200) }}</p>
        </div>
        
        <p>En attendant, n'hésitez pas à consulter notre <a href="{{ url('/faq') }}" style="color: #eb2d53;">FAQ</a> ou notre <a href="{{ url('/aide') }}" style="color: #eb2d53;">centre d'aide</a> pour trouver des réponses rapides.</p>
        
        <p>Cordialement,<br>
        <strong>L'équipe NoflayHub</strong></p>
    </div>
    
    <div class="footer">
        <p>Cet email a été envoyé automatiquement. Merci de ne pas y répondre.</p>
        <p>&copy; {{ date('Y') }} NoflayHub. Tous droits réservés.</p>
    </div>
</body>
</html>

