<?php

namespace App\Services;

class SEOService
{
    /**
     * Générer un slug SEO-friendly à partir d'une chaîne
     */
    public static function slugify($text)
    {
        // Supprimer les accents
        $text = transliterator_transliterate('Any-Latin; Latin-ASCII; Lower()', $text);
        
        // Remplacer les espaces par des tirets
        $text = preg_replace('/[^a-z0-9-]+/', '-', $text);
        
        // Supprimer les tirets en début et fin
        $text = trim($text, '-');
        
        // Supprimer les tirets multiples
        $text = preg_replace('/-+/', '-', $text);
        
        return $text;
    }

    /**
     * Générer une meta description optimisée
     */
    public static function generateMetaDescription($text, $maxLength = 160)
    {
        $text = strip_tags($text);
        $text = preg_replace('/\s+/', ' ', $text);
        $text = trim($text);

        if (strlen($text) > $maxLength) {
            $text = substr($text, 0, $maxLength);
            // Couper au dernier mot complet
            $text = substr($text, 0, strrpos($text, ' ')) . '...';
        }

        return $text;
    }

    /**
     * Générer les mots-clés à partir d'un titre et d'une description
     */
    public static function generateKeywords($title, $description, $count = 5)
    {
        $text = strtolower($title . ' ' . $description);
        
        // Mots vides français et anglais à exclure
        $stopwords = [
            'le', 'la', 'les', 'un', 'une', 'des', 'de', 'du', 'et', 'ou', 'à', 'au', 'avec',
            'sur', 'dans', 'par', 'pour', 'en', 'est', 'sont', 'être', 'avoir', 'faire',
            'ce', 'que', 'qui', 'quoi', 'dont', 'où', 'comment', 'pourquoi', 'when', 'what',
            'the', 'a', 'an', 'and', 'or', 'but', 'in', 'on', 'at', 'to', 'for', 'of', 'is'
        ];

        // Extraire les mots
        preg_match_all('/\b[a-z0-9]+\b/', $text, $matches);
        $words = $matches[0];

        // Filtrer les stopwords et compter les occurrences
        $frequency = array_count_values(array_filter($words, function($word) use ($stopwords) {
            return !in_array($word, $stopwords) && strlen($word) > 2;
        }));

        // Trier par fréquence
        arsort($frequency);

        // Retourner les $count mots les plus fréquents
        return array_keys(array_slice($frequency, 0, $count));
    }

    /**
     * Analyser la qualité SEO d'un contenu
     */
    public static function analyzeContent($title, $description, $content)
    {
        $issues = [];
        $warnings = [];
        $success = [];

        // Vérifier le titre
        if (empty($title)) {
            $issues[] = 'Le titre est manquant';
        } elseif (strlen($title) < 30) {
            $warnings[] = 'Le titre est trop court (moins de 30 caractères)';
        } elseif (strlen($title) > 60) {
            $warnings[] = 'Le titre est trop long (plus de 60 caractères)';
        } else {
            $success[] = 'Le titre est de bonne longueur';
        }

        // Vérifier la description
        if (empty($description)) {
            $issues[] = 'La description est manquante';
        } elseif (strlen($description) < 120) {
            $warnings[] = 'La description est trop courte (moins de 120 caractères)';
        } elseif (strlen($description) > 160) {
            $warnings[] = 'La description est trop longue (plus de 160 caractères)';
        } else {
            $success[] = 'La description est de bonne longueur';
        }

        // Vérifier le contenu
        if (empty($content)) {
            $issues[] = 'Le contenu est manquant';
        } else {
            $wordCount = str_word_count(strip_tags($content));
            if ($wordCount < 100) {
                $warnings[] = 'Le contenu est très court (moins de 100 mots)';
            } else {
                $success[] = 'Le contenu a une longueur acceptable';
            }
        }

        return [
            'issues' => $issues,
            'warnings' => $warnings,
            'success' => $success,
            'score' => count($success) * 2 - count($warnings) - count($issues) * 3
        ];
    }

    /**
     * Générer une structure de breadcrumb
     */
    public static function generateBreadcrumbs($path)
    {
        $breadcrumbs = [];
        $url = '';

        $breadcrumbs[] = [
            'name' => 'Accueil',
            'url' => '/',
            'position' => 1
        ];

        $segments = array_filter(explode('/', trim($path, '/')));
        $position = 2;

        foreach ($segments as $segment) {
            $url .= '/' . $segment;
            $breadcrumbs[] = [
                'name' => ucfirst(str_replace('-', ' ', urldecode($segment))),
                'url' => $url,
                'position' => $position
            ];
            $position++;
        }

        return $breadcrumbs;
    }

    /**
     * Générer des données structurées pour Schema.org
     */
    public static function generateSchemaOrganization()
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => 'NoflayHub',
            'url' => config('app.url'),
            'logo' => config('app.url') . '/logo.png',
            'description' => config('seo.defaults.description'),
            'sameAs' => array_values(array_filter(config('seo.social'))),
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'telephone' => config('seo.structured_data.organization.phone'),
                'contactType' => 'Customer Service',
                'email' => config('seo.structured_data.organization.email')
            ]
        ];
    }

    /**
     * Générer des données structurées pour un produit/annonce
     */
    public static function generateSchemaProduct($product)
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Product',
            'name' => $product['name'] ?? 'Produit',
            'description' => $product['description'] ?? '',
            'image' => $product['image'] ?? [],
            'offers' => [
                '@type' => 'Offer',
                'price' => $product['price'] ?? '0',
                'priceCurrency' => 'XOF',
                'availability' => 'https://schema.org/InStock'
            ],
            'aggregateRating' => [
                '@type' => 'AggregateRating',
                'ratingValue' => $product['rating'] ?? '4.5',
                'reviewCount' => $product['reviewCount'] ?? '0'
            ]
        ];
    }

    /**
     * Générer des données structurées pour un événement local
     */
    public static function generateSchemaLocalBusiness($business)
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'LocalBusiness',
            'name' => $business['name'] ?? 'NoflayHub',
            'image' => $business['image'] ?? '',
            'description' => $business['description'] ?? '',
            'url' => $business['url'] ?? config('app.url'),
            'telephone' => $business['phone'] ?? config('seo.structured_data.organization.phone'),
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => $business['street'] ?? '',
                'addressLocality' => $business['city'] ?? 'Dakar',
                'addressRegion' => $business['region'] ?? 'Dakar',
                'postalCode' => $business['postalCode'] ?? '',
                'addressCountry' => 'SN'
            ],
            'openingHoursSpecification' => [
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                'opens' => '08:00',
                'closes' => '20:00'
            ]
        ];
    }
}

