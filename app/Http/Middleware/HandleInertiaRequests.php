<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        $user = $request->user();
        
        // Charger les relations nécessaires pour Jetstream
        if ($user) {
            $user->load('currentTeam');
        }
        
        // Compter les notifications non lues
        $unreadNotificationsCount = 0;
        if ($user) {
            $unreadNotificationsCount = \App\Models\Notification::where('user_id', $user->id)
                ->where('read', false)
                ->count();
        }
        
        // Compter les favoris
        $favoritesCount = 0;
        if ($user) {
            $favoritesCount = \App\Models\Favori::where('user_id', $user->id)->count();
        }
        
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $user,
            ],
            'flash' => [
                'message'=>session('message')
            ],
            'unreadNotificationsCount' => $unreadNotificationsCount,
            'favoritesCount' => $favoritesCount,
        ]);
    }
}
