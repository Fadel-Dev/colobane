# Configuration de la page de contact

## Variables d'environnement requises

Ajoutez ces variables dans votre fichier `.env` :

```env
# Configuration Email
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io  # ou votre serveur SMTP
MAIL_PORT=2525
MAIL_USERNAME=votre_username
MAIL_PASSWORD=votre_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=contact@noflayhub.com
MAIL_FROM_NAME="${APP_NAME}"

# Email de l'administrateur (où recevoir les messages)
MAIL_ADMIN_EMAIL=admin@noflayhub.com
```

## Migration de la base de données

Exécutez la migration pour créer la table `contacts` :

```bash
php artisan migrate
```

## Structure de la table contacts

- `id` : Identifiant unique
- `name` : Nom complet
- `email` : Adresse email
- `phone` : Téléphone (optionnel)
- `subject` : Sujet du message
- `message` : Contenu du message
- `read` : Statut de lecture (boolean)
- `read_at` : Date de lecture
- `created_at` : Date de création
- `updated_at` : Date de mise à jour

## Fonctionnalités

1. **Enregistrement en base de données** : Tous les messages sont sauvegardés dans la table `contacts`
2. **Email à l'administrateur** : Un email est envoyé à l'adresse configurée dans `MAIL_ADMIN_EMAIL`
3. **Email de confirmation** : Un email de confirmation est envoyé à l'utilisateur
4. **Validation** : Les champs sont validés avant l'enregistrement
5. **Gestion des erreurs** : Les erreurs d'envoi d'email sont loggées mais n'empêchent pas l'enregistrement

## Test de l'envoi d'email

Pour tester en local, vous pouvez utiliser :
- **Mailtrap** : https://mailtrap.io (gratuit pour le développement)
- **MailHog** : Outil local pour capturer les emails
- **Log** : Configurez `MAIL_MAILER=log` pour voir les emails dans les logs

## Exemple de configuration Mailtrap

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=votre_username_mailtrap
MAIL_PASSWORD=votre_password_mailtrap
MAIL_ENCRYPTION=tls
```

