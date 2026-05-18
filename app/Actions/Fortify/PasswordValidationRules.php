<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Rules\Password;
use Illuminate\Validation\Rules\Password as PasswordRule;

trait PasswordValidationRules
{
    /**
     * Get the validation rules used to validate passwords.
     * 
     * Le mot de passe doit être simple avec:
     * - Au moins 8 caractères
     * - Un chiffre (0-9)
     *
     * @return array<int, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    protected function passwordRules(): array
    {
        return [
            'required',
            'string',
            PasswordRule::min(8)
                ->numbers(),
            'confirmed',
        ];
    }
    
    /**
     * Get strict password validation rules (all 5 criteria required)
     * Utilisé pour l'inscription et la réinitialisation de mot de passe
     *
     * @return array<int, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    protected function strictPasswordRules(): array
    {
        return [
            'required',
            'string',
            'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*]).{8,}$/',
            'confirmed',
        ];
    }
}
