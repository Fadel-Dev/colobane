<?php

namespace App\Http\Controllers;

use App\Services\BoostPricingService;
use Illuminate\Http\Request;

class BoostPricingController extends Controller
{
    /**
     * Obtenir tous les plans de pricing
     */
    public function getPlans()
    {
        return response()->json([
            'success' => true,
            'plans' => BoostPricingService::getPlansForFrontend(),
            'currency' => config('boost-pricing.currency_symbol'),
        ]);
    }

    /**
     * Obtenir les détails d'un plan spécifique
     */
    public function getPlan($planKey)
    {
        if (!BoostPricingService::validatePlan($planKey)) {
            return response()->json([
                'success' => false,
                'message' => 'Plan non trouvé',
            ], 404);
        }

        $plan = BoostPricingService::getPlan($planKey);

        return response()->json([
            'success' => true,
            'plan' => [
                'key' => $planKey,
                'label' => BoostPricingService::getLabel($planKey),
                'icon' => BoostPricingService::getIcon($planKey),
                'description' => BoostPricingService::getDescription($planKey),
                'price' => $plan['price'],
                'formattedPrice' => BoostPricingService::formatPrice($plan['price']),
                'durationDays' => BoostPricingService::getDurationDays($planKey),
                'durationHours' => BoostPricingService::getHours($planKey),
                'durationMinutes' => BoostPricingService::getDurationMinutes($planKey),
                'pricePerHour' => BoostPricingService::getPricePerHour($planKey),
                'savings' => round(BoostPricingService::getSavings($planKey), 1),
            ],
        ]);
    }

    /**
     * Calculer le prix avec remise
     */
    public function calculatePrice(Request $request)
    {
        $request->validate([
            'plan' => 'required|string',
            'discount' => 'nullable|numeric|min:0|max:100',
        ]);

        $planKey = $request->input('plan');
        $discount = $request->input('discount', 0);

        if (!BoostPricingService::validatePlan($planKey)) {
            return response()->json([
                'success' => false,
                'message' => 'Plan non trouvé',
            ], 404);
        }

        $originalPrice = BoostPricingService::getPrice($planKey);
        $discountedPrice = BoostPricingService::calculateDiscountedPrice($planKey, $discount);
        $discountAmount = $originalPrice - $discountedPrice;

        return response()->json([
            'success' => true,
            'plan' => $planKey,
            'originalPrice' => $originalPrice,
            'originalPriceFormatted' => BoostPricingService::formatPrice($originalPrice),
            'discountPercentage' => $discount,
            'discountAmount' => $discountAmount,
            'discountAmountFormatted' => BoostPricingService::formatPrice($discountAmount),
            'finalPrice' => $discountedPrice,
            'finalPriceFormatted' => BoostPricingService::formatPrice($discountedPrice),
        ]);
    }

    /**
     * Obtenir le meilleur rapport prix/durée
     */
    public function getBestValue()
    {
        $bestValueKey = BoostPricingService::getBestValue();
        
        return response()->json([
            'success' => true,
            'bestValue' => $bestValueKey,
            'plan' => [
                'key' => $bestValueKey,
                'label' => BoostPricingService::getLabel($bestValueKey),
                'icon' => BoostPricingService::getIcon($bestValueKey),
                'price' => BoostPricingService::getPrice($bestValueKey),
                'formattedPrice' => BoostPricingService::getFormattedPrice($bestValueKey),
                'pricePerHour' => BoostPricingService::getPricePerHour($bestValueKey),
            ],
        ]);
    }

    /**
     * Comparaison complète des plans
     */
    public function compareAll()
    {
        $plans = BoostPricingService::getPlansForFrontend();
        $bestValue = BoostPricingService::getBestValue();

        return response()->json([
            'success' => true,
            'plans' => $plans,
            'bestValue' => $bestValue,
            'currency' => config('boost-pricing.currency_symbol'),
            'comparison' => [
                'cheapest' => min(array_column($plans, 'price')),
                'mostExpensive' => max(array_column($plans, 'price')),
                'averagePrice' => round(array_sum(array_column($plans, 'price')) / count($plans)),
                'bestValueRatio' => $bestValue,
            ],
        ]);
    }
}

