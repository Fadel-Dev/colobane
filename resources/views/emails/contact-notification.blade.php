<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau message de contact</title>
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
        .info-box {
            background: white;
            padding: 20px;
            margin: 15px 0;
            border-radius: 5px;
            border-left: 4px solid #eb2d53;
        }
        .info-label {
            font-weight: bold;
            color: #101634;
            margin-bottom: 5px;
        }
        .info-value {
            color: #666;
        }
        .message-box {
            background: white;
            padding: 20px;
            margin: 15px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
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
        <h1>Nouveau message de contact</h1>
        <p>NoflayHub</p>
    </div>
    
    <div class="content">
        <p>Vous avez reçu un nouveau message de contact depuis le site NoflayHub.</p>
        
        <div class="info-box">
            <div class="info-label">Nom complet :</div>
            <div class="info-value">{{ $contact->name }}</div>
        </div>
        
        <div class="info-box">
            <div class="info-label">Email :</div>
            <div class="info-value">{{ $contact->email }}</div>
        </div>
        
        @if($contact->phone)
        <div class="info-box">
            <div class="info-label">Téléphone :</div>
            <div class="info-value">{{ $contact->phone }}</div>
        </div>
        @endif
        
        <div class="info-box">
            <div class="info-label">Sujet :</div>
            <div class="info-value">{{ $contact->subject }}</div>
        </div>
        
        <div class="message-box">
            <div class="info-label">Message :</div>
            <div class="info-value" style="white-space: pre-wrap;">{{ $contact->message }}</div>
        </div>
        
        <p style="margin-top: 20px;">
            <strong>Date :</strong> {{ $contact->created_at->format('d/m/Y à H:i') }}
        </p>
    </div>
    
    <div class="footer">
        <p>Cet email a été envoyé automatiquement depuis le site NoflayHub.</p>
        <p>&copy; {{ date('Y') }} NoflayHub. Tous droits réservés.</p>
    </div>
</body>
</html>

