<?php

namespace App\Http\Controllers;

use App\Models\Favori;
use App\Models\Immobiliers;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class FavoriController extends Controller
{
    /**
     * Ajouter un bien aux favoris
     */
    public function add($id)
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour ajouter aux favoris');
        }

        $immobilier = Immobiliers::findOrFail($id);

        // Utiliser une transaction pour garantir l'intégrité
        try {
            DB::beginTransaction();

            // Vérifier si le favori existe déjà
            $favori = Favori::where('user_id', $user->id)
                ->where('immobilier_id', $id)
                ->first();

            if ($favori) {
                DB::rollBack();
                return back()->with('message', 'Ce bien est déjà dans vos favoris');
            }

            // Créer le favori (entrée dans la table favoris)
            $favori = Favori::create([
                'user_id' => $user->id,
                'immobilier_id' => $id,
            ]);

            // Créer une notification pour l'utilisateur
            Notification::create([
                'user_id' => $user->id,
                'type' => 'favori',
                'title' => 'Bien ajouté aux favoris',
                'message' => "Vous avez ajouté \"{$immobilier->nom}\" à vos favoris",
                'immobilier_id' => $id,
                'read' => false,
            ]);

            DB::commit();

            return back()->with('message', 'Bien ajouté aux favoris');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Erreur lors de l\'ajout aux favoris: ' . $e->getMessage());
            return back()->with('error', 'Erreur lors de l\'ajout aux favoris');
        }
    }

    /**
     * Retirer un bien des favoris
     */
    public function remove($id)
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        try {
            DB::beginTransaction();

            $favori = Favori::where('user_id', $user->id)
                ->where('immobilier_id', $id)
                ->first();

            if ($favori) {
                $favori->delete();
                DB::commit();
                return back()->with('message', 'Bien retiré des favoris');
            }

            DB::rollBack();
            return back()->with('error', 'Favori non trouvé');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Erreur lors de la suppression du favori: ' . $e->getMessage());
            return back()->with('error', 'Erreur lors de la suppression du favori');
        }
    }

    /**
     * Toggle favori (ajouter si absent, retirer si présent)
     */
    public function toggle($id)
    {
        $user = Auth::user();
        
        if (!$user) {
            return response()->json(['status' => 'error', 'message' => 'Vous devez être connecté'], 401);
        }

        try {
            DB::beginTransaction();

            $favori = Favori::where('user_id', $user->id)
                ->where('immobilier_id', $id)
                ->first();

            if ($favori) {
                // Supprimer l'entrée de la table favoris
                $favori->delete();
                DB::commit();
                return response()->json(['status' => 'removed', 'message' => 'Retiré des favoris']);
            } else {
                // Créer une nouvelle entrée dans la table favoris
                $favori = Favori::create([
                    'user_id' => $user->id,
                    'immobilier_id' => $id,
                ]);
                
                // Récupérer l'immobilier pour la notification
                $immobilier = Immobiliers::findOrFail($id);
                
                // Créer une notification pour l'utilisateur
                Notification::create([
                    'user_id' => $user->id,
                    'type' => 'favori',
                    'title' => 'Bien ajouté aux favoris',
                    'message' => "Vous avez ajouté \"{$immobilier->nom}\" à vos favoris",
                    'immobilier_id' => $id,
                    'read' => false,
                ]);
                
                DB::commit();
                return response()->json(['status' => 'added', 'message' => 'Ajouté aux favoris']);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Erreur lors du toggle favori: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Erreur lors de l\'opération'], 500);
        }
    }

    /**
     * Afficher la liste des favoris de l'utilisateur
     */
    public function index()
    {
        $user = Auth::user();
        
        if (!$user) {
            return redirect()->route('login');
        }

        $favoris = Favori::where('user_id', $user->id)
            ->with('immobilier.user')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return Inertia::render('Favoris', [
            'favoris' => $favoris,
        ]);
    }

    /**
     * Vérifier si un bien est dans les favoris
     */
    public function check($id)
    {
        $user = Auth::user();
        
        if (!$user) {
            return response()->json(['isFavorite' => false]);
        }

        $isFavorite = Favori::where('user_id', $user->id)
            ->where('immobilier_id', $id)
            ->exists();

        return response()->json(['isFavorite' => $isFavorite]);
    }
}
