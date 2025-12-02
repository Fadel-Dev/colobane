<?php

return [
    /*
    |--------------------------------------------------------------------------
    | SEO Configuration for NoflayHub
    |--------------------------------------------------------------------------
    */

    'site_name' => env('SEO_SITE_NAME', 'NoflayHub'),
    'site_url' => env('APP_URL', 'https://noflayhub.com'),
    'locale' => env('APP_LOCALE', 'fr_SN'),
    
    /*
    |--------------------------------------------------------------------------
    | Meta Tags par défaut
    |--------------------------------------------------------------------------
    */
    'defaults' => [
        'title' => 'NoflayHub - Marketplace Immobilier & Automobile au Sénégal',
        'description' => 'Découvrez NoflayHub, la plateforme N°1 de location et vente immobilière au Sénégal. Trouvez villas, appartements, terrains et véhicules. Affaires rapides et sécurisées.',
        'keywords' => 'immobilier Sénégal, location villa, appartement Dakar, terrain Sénégal, voiture occasion, covoiturage, services Sénégal',
        'image' => 'https://noflayhub.com/logo.png',
    ],

    /*
    |--------------------------------------------------------------------------
    | Metas par section
    |--------------------------------------------------------------------------
    */
    'sections' => [
        'immobilier' => [
            'title' => 'Annonces Immobilières au Sénégal | NoflayHub',
            'description' => 'Trouvez votre logement idéal au Sénégal. Villas, appartements, studios, chambres et terrains à louer ou acheter. Milliers d\'annonces vérifiées.',
            'keywords' => 'immobilier Sénégal, villa à louer, appartement Dakar, chambre à louer, studio Sénégal, terrain à vendre, location immobilière',
        ],
        'vehicules' => [
            'title' => 'Véhicules Occasion & Location au Sénégal | NoflayHub',
            'description' => 'Achetez, vendez ou louez votre véhicule au Sénégal. Voitures, motos, scooters - Annonces vérifiées et prix compétitifs.',
            'keywords' => 'voiture occasion Sénégal, location voiture Dakar, moto occasion, scooter Sénégal, achat voiture sécurisé',
        ],
        'covoiturage' => [
            'title' => 'Covoiturage au Sénégal | NoflayHub',
            'description' => 'Partagez vos trajets et réduisez vos frais de transport. Service de covoiturage sûr et économique au Sénégal.',
            'keywords' => 'covoiturage Sénégal, partage trajet Dakar, transport économique, trajets partagés',
        ],
        'services' => [
            'title' => 'Services Professionnels au Sénégal | NoflayHub',
            'description' => 'Trouvez les meilleurs services professionnels au Sénégal. Électriciens, plombiers, menuisiers, et bien d\'autres professionnels qualifiés.',
            'keywords' => 'services Sénégal, électricien Dakar, plombier, menuisier, services professionnels, artisans Sénégal',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Villes majeures pour le SEO local
    |--------------------------------------------------------------------------
    */
    'cities' => [
        'Dakar', 'Thiès', 'Saint-Louis', 'Kaolack', 'Tambacounda', 
        'Kaolack', 'Louga', 'Kédougou', 'Ziguinchor', 'Kolda'
    ],

    /*
    |--------------------------------------------------------------------------
    | Open Graph & Social Media
    |--------------------------------------------------------------------------
    */
    'social' => [
        'facebook' => env('SOCIAL_FACEBOOK_URL', 'https://facebook.com/noflayhub'),
        'twitter' => env('SOCIAL_TWITTER_URL', 'https://twitter.com/noflayhub'),
        'instagram' => env('SOCIAL_INSTAGRAM_URL', 'https://instagram.com/noflayhub'),
        'linkedin' => env('SOCIAL_LINKEDIN_URL', ''),
    ],

    /*
    |--------------------------------------------------------------------------
    | Google & Webmaster Tools
    |--------------------------------------------------------------------------
    */
    'google' => [
        'site_verification' => env('GOOGLE_SITE_VERIFICATION', ''),
        'analytics_id' => env('GOOGLE_ANALYTICS_ID', 'G-XXXXXXXXXX'),
        'search_console_id' => env('GOOGLE_SEARCH_CONSOLE_ID', ''),
    ],

    /*
    |--------------------------------------------------------------------------
    | Bing Webmaster Tools
    |--------------------------------------------------------------------------
    */
    'bing' => [
        'site_verification' => env('BING_SITE_VERIFICATION', ''),
        'webmaster_id' => env('BING_WEBMASTER_ID', ''),
    ],

    /*
    |--------------------------------------------------------------------------
    | Structured Data (Schema.org)
    |--------------------------------------------------------------------------
    */
    'structured_data' => [
        'organization' => [
            'name' => 'NoflayHub',
            'url' => 'https://noflayhub.com',
            'logo' => 'https://noflayhub.com/logo.png',
            'description' => 'Marketplace immobilier et automobile au Sénégal',
            'email' => env('CONTACT_EMAIL', 'contact@noflayhub.com'),
            'phone' => env('CONTACT_PHONE', '+221 33 123 45 67'),
            'address' => 'Dakar, Sénégal',
        ],
    ],

];

