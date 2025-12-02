<?php

namespace App\Actions\Fortify;

/**
 * Messages de validation personnalisés en français
 * Utilisés pour les formulaires d'authentification
 */
class ValidationMessages
{
    /**
     * Get validation messages in French
     */
    public static function getMessages(): array
    {
        return [
            // Nom
            'name.required' => 'Le nom est requis.',
            'name.string' => 'Le nom doit être une chaîne de caractères.',
            'name.max' => 'Le nom ne doit pas dépasser 255 caractères.',
            'name.min' => 'Le nom doit contenir au moins 2 caractères.',

            // Email
            'email.required' => 'L\'adresse email est requise.',
            'email.string' => 'L\'adresse email doit être une chaîne de caractères.',
            'email.email' => 'L\'adresse email doit être valide.',
            'email.max' => 'L\'adresse email ne doit pas dépasser 255 caractères.',
            'email.unique' => 'Cet email est déjà utilisé. Veuillez vous connecter ou utiliser un autre email.',

            // Téléphone
            'phone.required' => 'Le numéro de téléphone est requis.',
            'phone.int' => 'Le numéro de téléphone doit contenir uniquement des chiffres.',
            'phone.integer' => 'Le numéro de téléphone doit contenir uniquement des chiffres.',
            'phone.numeric' => 'Le numéro de téléphone doit contenir uniquement des chiffres.',
            'phone.unique' => 'Ce numéro de téléphone est déjà utilisé. Veuillez utiliser un autre numéro.',
            'phone.regex' => 'Le numéro de téléphone doit contenir entre 9 et 15 chiffres (ex: 221XXXXXXXXX pour le Sénégal).',
            'phone.digits' => 'Le numéro de téléphone doit contenir uniquement des chiffres.',

            // Mot de passe
            'password.required' => 'Le mot de passe est requis.',
            'password.string' => 'Le mot de passe doit être une chaîne de caractères.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
            'password.regex' => 'Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.mixed_case' => 'Le mot de passe doit contenir des majuscules et des minuscules.',
            'password.numbers' => 'Le mot de passe doit contenir au moins un chiffre.',
            'password.symbols' => 'Le mot de passe doit contenir au moins un caractère spécial.',
            'password.uncompromised' => 'Ce mot de passe a été compromis dans une fuite de données. Veuillez en choisir un autre.',

            // Confirmation mot de passe
            'password_confirmation.required' => 'La confirmation du mot de passe est requise.',
            'password_confirmation.confirmed' => 'Les mots de passe ne correspondent pas.',

            // Conditions
            'terms.accepted' => 'Vous devez accepter les conditions d\'utilisation.',
            'terms.required' => 'Vous devez accepter les conditions d\'utilisation.',

            // Login
            'email_or_phone.required' => 'L\'email ou le téléphone est requis.',
            'password.current' => 'Le mot de passe actuel est incorrect.',

            // Generic messages
            'required' => 'Le champ :attribute est requis.',
            'email' => 'Le champ :attribute doit être une adresse email valide.',
            'unique' => 'La valeur du champ :attribute existe déjà.',
            'confirmed' => 'La confirmation du champ :attribute ne correspond pas.',
            'min' => 'Le champ :attribute doit contenir au moins :min caractères.',
            'max' => 'Le champ :attribute ne doit pas dépasser :max caractères.',
        ];
    }
}

