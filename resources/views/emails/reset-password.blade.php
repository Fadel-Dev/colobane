<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation de mot de passe - NoflayHub</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', -apple-system, BlinkMacSystemFont, sans-serif;
            line-height: 1.6;
            color: #333;
            background: linear-gradient(135deg, #f5f7fa 0%, #e9ecef 100%);
            padding: 20px;
        }
        
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }
        
        .header {
            background: linear-gradient(135deg, #eb2d53 0%, #ff6b7a 100%);
            color: white;
            padding: 40px 20px;
            text-align: center;
            position: relative;
        }
        
        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"><path d="M0,50 Q300,0 600,50 T1200,50 L1200,120 L0,120 Z" fill="rgba(255,255,255,0.05)"/></svg>') repeat-x;
            opacity: 0.1;
        }
        
        .logo-section {
            position: relative;
            z-index: 1;
            margin-bottom: 20px;
        }
        
        .logo {
            width: 80px;
            height: 80px;
            margin: 0 auto 15px;
            background: rgba(255,255,255,0.95);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }
        
        .logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
        
        .header h1 {
            font-size: 28px;
            margin-bottom: 8px;
            font-weight: 700;
            position: relative;
            z-index: 1;
            letter-spacing: -0.5px;
        }
        
        .header p {
            font-size: 15px;
            opacity: 0.95;
            position: relative;
            z-index: 1;
            font-weight: 300;
            letter-spacing: 0.3px;
        }
        
        .content {
            padding: 45px 35px;
        }
        
        .greeting {
            font-size: 18px;
            margin-bottom: 24px;
            color: #1a1a1a;
            font-weight: 600;
        }
        
        .greeting strong {
            color: #eb2d53;
        }
        
        .message {
            font-size: 15px;
            line-height: 1.8;
            color: #555;
            margin-bottom: 32px;
            border-left: 4px solid #eb2d53;
            padding-left: 16px;
            background: #f8f9fa;
            padding: 16px;
            border-radius: 6px;
        }
        
        .warning-box {
            background: linear-gradient(135deg, #fff9e6 0%, #fff3cd 100%);
            border-left: 4px solid #ffc107;
            padding: 18px;
            margin: 24px 0;
            border-radius: 8px;
            font-size: 14px;
            color: #664d00;
        }
        
        .warning-box strong {
            display: block;
            margin-bottom: 8px;
            color: #e67e00;
            font-size: 15px;
        }
        
        .warning-box p {
            margin: 0;
            line-height: 1.6;
        }
        
        .button-container {
            text-align: center;
            margin: 40px 0;
        }
        
        .reset-button {
            background: linear-gradient(135deg, #eb2d53 0%, #ff6b7a 100%);
            color: white;
            padding: 16px 48px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 700;
            font-size: 16px;
            display: inline-block;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            box-shadow: 0 8px 24px rgba(235, 45, 83, 0.3);
            letter-spacing: 0.5px;
        }
        
        .reset-button:hover {
            background: linear-gradient(135deg, #d1233f 0%, #e85a6a 100%);
            transform: translateY(-3px);
            box-shadow: 0 12px 32px rgba(235, 45, 83, 0.4);
        }
        
        .reset-button:active {
            transform: translateY(-1px);
        }
        
        .alternative-link {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 24px;
            border-radius: 10px;
            margin: 32px 0;
            text-align: center;
            border: 1px solid #dee2e6;
        }
        
        .alternative-link p {
            font-size: 13px;
            color: #666;
            margin-bottom: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.6px;
        }
        
        .alternative-link code {
            display: block;
            background-color: white;
            padding: 14px;
            border-radius: 8px;
            word-break: break-all;
            font-family: 'Monaco', 'Menlo', 'Courier New', monospace;
            font-size: 12px;
            color: #eb2d53;
            border: 2px solid #eb2d53;
            margin-top: 12px;
            line-height: 1.5;
        }
        
        .security-tips {
            background: linear-gradient(135deg, #e3f2fd 0%, #f3e5f5 100%);
            padding: 24px;
            border-radius: 10px;
            margin: 32px 0;
            border-left: 5px solid #2196f3;
        }
        
        .security-tips h3 {
            font-size: 16px;
            color: #1565c0;
            margin-bottom: 16px;
            font-weight: 700;
        }
        
        .security-tips ul {
            list-style: none;
            padding: 0;
            font-size: 14px;
            color: #0d47a1;
            line-height: 2;
        }
        
        .security-tips li {
            margin-bottom: 10px;
            padding-left: 28px;
            position: relative;
            font-weight: 500;
        }
        
        .security-tips li:before {
            content: "✓";
            position: absolute;
            left: 0;
            font-weight: 900;
            color: #4caf50;
            font-size: 18px;
        }
        
        .footer {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 40px 30px 30px;
            text-align: center;
            border-top: 1px solid #dee2e6;
            font-size: 13px;
            color: #666;
        }
        
        .footer p {
            margin: 10px 0;
            line-height: 1.6;
        }
        
        .footer a {
            color: #eb2d53;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }
        
        .footer a:hover {
            color: #d1233f;
            text-decoration: underline;
        }
        
        .contact-info {
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid #dee2e6;
            font-size: 13px;
            color: #666;
        }
        
        .contact-info p {
            margin: 8px 0;
        }
        
        .footer-logo {
            font-size: 20px;
            font-weight: 800;
            color: #eb2d53;
            letter-spacing: -0.8px;
            margin-bottom: 10px;
        }
        
        .timestamp {
            font-size: 12px;
            color: #999;
            margin-top: 20px;
            font-style: italic;
        }
        
        .divider {
            height: 2px;
            background: linear-gradient(90deg, transparent, #eb2d53, transparent);
            margin: 20px 0;
        }
        
        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            body {
                background-color: #1a1a1a;
            }
            
            .container {
                background-color: #2a2a2a;
                box-shadow: 0 2px 8px rgba(0,0,0,0.3);
            }
            
            .content {
                color: #e0e0e0;
            }
            
            .greeting, .message {
                color: #e0e0e0;
            }
            
            .footer {
                background-color: #1a1a1a;
                color: #999;
            }
            
            .alternative-link {
                background-color: #333;
            }
            
            .alternative-link code {
                background-color: #1a1a1a;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- En-tête avec logo -->
        <div class="header">
            <div class="logo-section">
                <div class="logo">
                    <img src="{{ asset('logo.png') }}" alt="NoflayHub Logo" style="width: 100%; height: 100%; object-fit: contain;">
                </div>
            </div>
            <h1>🔐 Réinitialisation de mot de passe</h1>
            <p>Sécurisez votre compte NoflayHub</p>
        </div>
        
        <!-- Contenu principal -->
        <div class="content">
            <!-- Salutation personnalisée -->
            <div class="greeting">
                Bonjour <strong>{{ $user->name }}</strong> 👋
            </div>
            
            <!-- Message d'introduction -->
            <div class="message">
                💡 Vous avez demandé à réinitialiser le mot de passe de votre compte NoflayHub. 
                Cliquez sur le bouton ci-dessous pour créer un nouveau mot de passe sécurisé.
            </div>
            
            <!-- Avertissement de sécurité -->
            <div class="warning-box">
                <strong>⚠️ Important - Sécurité</strong>
                <p>Ce lien de réinitialisation expire dans <strong>{{ $expiresIn }} minutes</strong>. Si vous n'avez pas demandé cette réinitialisation, 
                ignorez cet email et votre mot de passe restera complètement sécurisé.</p>
            </div>
            
            <!-- Bouton de réinitialisation -->
            <div class="button-container">
                <a href="{{ $resetUrl }}" class="reset-button">
                    Réinitialiser mon mot de passe
                </a>
            </div>
            
            <!-- Alternative (copier-coller le lien) -->
            <div class="alternative-link">
                <p>Ou copiez ce lien dans votre navigateur :</p>
                <code>{{ $resetUrl }}</code>
            </div>
            
            <!-- Conseils de sécurité -->
            <div class="security-tips">
                <h3>🔒 Conseils de sécurité pour votre mot de passe</h3>
                <ul>
                    <li>Créez un mot de passe unique et complexe (min. 8 caractères)</li>
                    <li>Mélangez majuscules, minuscules, chiffres et symboles</li>
                    <li>Évitez les informations personnelles (nom, date de naissance, etc.)</li>
                    <li>Ne réutilisez pas d'anciens mots de passe</li>
                    <li>Utilisez un gestionnaire de mots de passe pour plus de sécurité</li>
                </ul>
            </div>
            
            <!-- Message de non-action -->
            <div style="margin-top: 30px; padding: 20px; background: linear-gradient(135deg, #e8f5e9 0%, #f1f8e9 100%); border-radius: 10px; border-left: 4px solid #4caf50; font-size: 14px; color: #2e7d32;">
                <strong style="font-size: 15px; display: block; margin-bottom: 8px;">ℹ️ Vous n'avez pas demandé cette réinitialisation ?</strong>
                Si vous n'avez pas initié cette demande, vous pouvez ignorer cet email sans danger. 
                Votre compte reste sécurisé et aucun changement n'aura lieu. Si vous trouvez cela suspect, 
                <a href="{{ config('app.url') }}/contact" style="color: #2e7d32; font-weight: 600;">contactez-nous</a> immédiatement.
            </div>
        </div>
        
        <!-- Pied de page -->
        <div class="footer">
            <div class="footer-logo">🏠 NoflayHub</div>
            <p style="margin-top: 8px; font-size: 14px; color: #555; font-weight: 500;">
                La plateforme N°1 de l'immobilier et l'automobile au Sénégal 🚗
            </p>
            
            <div class="divider"></div>
            
            <div class="contact-info">
                <p>
                    <span style="color: #333;">📧</span> 
                    <a href="mailto:support@noflayhub.com">support@noflayhub.com</a>
                </p>
                <p>
                    <span style="color: #333;">📞</span> 
                    <a href="tel:+221331234567">+221 33 123 45 67</a>
                </p>
                <p>
                    <span style="color: #333;">🌐</span> 
                    <a href="https://noflayhub.com">www.noflayhub.com</a>
                </p>
            </div>
            
            <div style="margin-top: 24px; padding-top: 24px; border-top: 1px solid #dee2e6;">
                <p style="margin: 8px 0; color: #666;">
                    <strong style="color: #333;">© 2025 NoflayHub.</strong> Tous droits réservés.
                </p>
                <p style="margin-top: 12px; font-size: 12px; color: #888;">
                    <a href="https://noflayhub.com/privacy" style="color: #eb2d53;">📄 Politique de confidentialité</a>
                    <span style="color: #ddd; margin: 0 8px;">•</span>
                    <a href="https://noflayhub.com/terms" style="color: #eb2d53;">⚖️ Conditions d'utilisation</a>
                </p>
            </div>
            
            <div class="timestamp">
                ✉️ Cet email a été envoyé le <strong>{{ now()->format('d/m/Y à H:i') }}</strong>
            </div>
        </div>
    </div>
</body>
</html>

