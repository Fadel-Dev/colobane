<?php

namespace App\Services;

use Illuminate\Support\Facades\Config;

class BoostPricingService
{
    /**
     * Obtenir tous les plans de boost
     */
    public static function getPlans()
    {
        return Config::get('boost-pricing.plans');
    }

    /**
     * Obtenir un plan spécifique
     */
    public static function getPlan($planKey)
    {
        $plans = self::getPlans();
        return $plans[$planKey] ?? null;
    }

    /**
     * Obtenir le prix d'un plan
     */
    public static function getPrice($planKey)
    {
        $plan = self::getPlan($planKey);
        return $plan['price'] ?? 0;
    }

    /**
     * Obtenir la durée en jours d'un plan
     */
    public static function getDurationDays($planKey)
    {
        $plan = self::getPlan($planKey);
        return $plan['duration_days'] ?? 0;
    }

    /**
     * Obtenir la durée en minutes d'un plan
     */
    public static function getDurationMinutes($planKey)
    {
        $plan = self::getPlan($planKey);
        return $plan['duration_minutes'] ?? 0;
    }

    /**
     * Obtenir le label du plan
     */
    public static function getLabel($planKey)
    {
        $plan = self::getPlan($planKey);
        return $plan['label'] ?? '';
    }

    /**
     * Obtenir le prix avec symbole de devise
     */
    public static function formatPrice($price)
    {
        $currency = Config::get('boost-pricing.currency_symbol');
        return number_format($price, 0, ',', ' ') . $currency;
    }

    /**
     * Obtenir le prix d'un plan formaté
     */
    public static function getFormattedPrice($planKey)
    {
        $price = self::getPrice($planKey);
        return self::formatPrice($price);
    }

    /**
     * Obtenir tous les plans avec les clés
     */
    public static function getPlansWithKeys()
    {
        $plans = self::getPlans();
        $result = [];
        foreach ($plans as $key => $plan) {
            $result[$key] = $plan;
            $result[$key]['key'] = $key;
        }
        return $result;
    }

    /**
     * Calculer le prix avec remise
     */
    public static function calculateDiscountedPrice($planKey, $discountPercentage = 0)
    {
        $price = self::getPrice($planKey);
        $discount = ($price * $discountPercentage) / 100;
        return $price - $discount;
    }

    /**
     * Obtenir le plan avec le meilleur rapport prix/durée
     */
    public static function getBestValue()
    {
        $plans = self::getPlans();
        $bestValue = null;
        $bestRatio = PHP_FLOAT_MAX;

        foreach ($plans as $key => $plan) {
            $ratio = $plan['price'] / $plan['duration_hours'];
            if ($ratio < $bestRatio) {
                $bestRatio = $ratio;
                $bestValue = $key;
            }
        }

        return $bestValue;
    }

    /**
     * Obtenir les économies par rapport au tarif le plus cher
     */
    public static function getSavings($planKey)
    {
        $plans = self::getPlans();
        $maxPrice = max(array_column($plans, 'price'));
        $planPrice = self::getPrice($planKey);
        
        if ($planPrice == $maxPrice) {
            return 0;
        }

        return (($maxPrice - $planPrice) / $maxPrice) * 100;
    }

    /**
     * Valider un plan
     */
    public static function validatePlan($planKey)
    {
        return self::getPlan($planKey) !== null;
    }

    /**
     * Obtenir le prix par heure de visibilité
     */
    public static function getPricePerHour($planKey)
    {
        $price = self::getPrice($planKey);
        $hours = self::getHours($planKey);
        
        if ($hours == 0) return 0;
        
        return round($price / $hours, 2);
    }

    /**
     * Obtenir les heures d'un plan
     */
    public static function getHours($planKey)
    {
        $plan = self::getPlan($planKey);
        return $plan['duration_hours'] ?? 0;
    }

    /**
     * Obtenir l'emoji du plan
     */
    public static function getIcon($planKey)
    {
        $plan = self::getPlan($planKey);
        return $plan['icon'] ?? '📌';
    }

    /**
     * Obtenir la description du plan
     */
    public static function getDescription($planKey)
    {
        $plan = self::getPlan($planKey);
        return $plan['description'] ?? '';
    }

    /**
     * Créer un tableau JSON pour le frontend
     */
    public static function getPlansForFrontend()
    {
        $plansWithKeys = self::getPlansWithKeys();
        $result = [];

        foreach ($plansWithKeys as $key => $plan) {
            $result[] = [
                'key' => $key,
                'label' => $plan['label'],
                'icon' => $plan['icon'],
                'description' => $plan['description'],
                'price' => $plan['price'],
                'formattedPrice' => self::formatPrice($plan['price']),
                'durationDays' => $plan['duration_days'],
                'durationHours' => $plan['duration_hours'],
                'durationMinutes' => $plan['duration_minutes'],
                'pricePerHour' => round($plan['price'] / $plan['duration_hours'], 2),
                'isBestValue' => $key === self::getBestValue(),
                'savings' => round(self::getSavings($key), 1),
            ];
        }

        return $result;
    }
}

